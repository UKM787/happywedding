<?php

namespace App\Http\Controllers\Host;

use App\Models\Host\Host;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Member\Members;
use App\Models\Host\MemberTask;
use Illuminate\Validation\Rule;
use App\Models\Member\HostMember;
use App\Http\Controllers\Controller;
use App\Models\Member\MemberDepartment;
use Exception;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;

class MemberController extends Controller
{
    use HasRoles;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()  {
        $host = auth()->guard('host')->user();
        $host = Host::where('id', $host->id)->with('profile')->first();
        //dd(MemberDepartment::where('host_id', null)->orWhere('host_id', $host->id)->get());
        $departments = MemberDepartment::where('host_id', null)->orWhere('host_id', $host->id)->get();

        $invitation=$host->invitations->first();
        if($invitation == null){
                return redirect(route('hostinvitations.index'));
            }
        $brideGroom = Host::where('parent_id', auth()->guard('host')->user()->id)->with('roles')->get();
        $self = null;
        foreach($host->roles as $role){
            if($role == 'bride' || $role == 'groom'){
                $self = $host;
            }
        }
        $members = $host->members($invitation->id)->get();
        foreach ($members as $single) {
            $single->deptartment = $single->pivot->department($single->pivot->departnment_id);
            $single->leaderId = $single->pivot->leader($single->pivot->leader_id);
        }
        // dd($newMembers);
        $members = $members->concat($brideGroom);
        //dd($members);
        if($self){
            $members->prepend($host);
        }
        //dd($members);
        $leaders = $host->leaderMembers($invitation->id)->get();

        $active = 'members';
        return view('host.members.index', compact('host', 'members', 'active', 'invitation', 'departments', 'leaders'));
    }

    public function getmembers(){
        $host = auth()->guard('host')->user();
        $invitation=$host->invitations->first();
        $brideGroom = Host::where('parent_id', auth()->guard('host')->user()->id)->with('roles')->get();
        $self = null;
        foreach($host->roles as $role){
            if($role == 'bride' || $role == 'groom'){
                $self = $host;
            }
        }
        $newMembers = $host->members($invitation->id)->get();
        foreach ($newMembers as $member) {
            $member->deptartment = $member->pivot->department($member->pivot->departnment_id);
            $member->leaderId = $member->pivot->leader($member->pivot->leader_id);
        }
        $members = $newMembers->merge($brideGroom);
        if($self){
            $members->push($host);
        }
        return $members;
        //return view('host.members.newindex', compact('members'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Host $host) {
        return view('host.members.create', compact('host'));
    }

    public function bulkupload(Host $host)    {
        return view('host.members.bulkupload', compact('host'));
    }
    /**
     * Store a newly created resource in storage.d
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       //
    }

    public function storemember(Request $request){

        // $member = Member::create($request->all(),['host_id' => auth()->guard('host')->user()->id]);
       //dd($request->leader); 
        $data = $this->validate($request, [
            'name' => 'required|string',
            'email' => ['required','email','unique:members,email'],
            'mobile' => ['required','digits:10','unique:members,mobile'],
            'leader' => ['required'],
            // 'leader_id' => [Rule::requiredIf($request->leader == 'false')]
            // 'password' => 'required',
        ], [
            'leader_id' => 'Leader'
        ]);
        //dd($data);member
        //dd(optional($request->departnment_id)['id']); 
        try{
            $host = auth()->guard('host')->user();
            if($host){
                $departId = null;
                if($request->departnment_id == null){
                    $departId = null;
                }
                elseif(optional($request->departnment_id)['id'] != null){
                    $departId = $request->departnment_id['id'];
                }else{
                    $dept = MemberDepartment::create(['name' =>  $request->departnment_id['name'], 'host_id' => $host->id]);
                    $departId = $dept->id;
                }
                $member = Members::create(['email'=>$request->email, 'mobile'=>$request->mobile, 'name' => $request->name, 'slug' => Str::slug($request->name), 'password' => Hash::make(123)]);
                $is_leader = 'true';
                if($request->leader == false || $request->leader == 0 || $request->leader == 'false'){
                    $is_leader = 'false';
                }

                HostMember::create(['host_id' => $host->id,'member_id' => $member->id, 'invitation_id' => $request->invitation_id, 'is_leader' => $request->leader, 'is_leader' => $is_leader, 'leader_id' => optional($request->leader_id)['id'], 'departnment_id' => $departId]);
            } 
            return ['flash' => 'You are added to member-list successfully!', 'members' => $this->getmembers(), 'departments' =>MemberDepartment::where('host_id', null)->orWhere('host_id', $host->id)->get(), 'leaders' =>$host->leaderMembers($request->invitation_id)->get()];

        }catch(Exception $e){
            return redirect()->back()->with(['flash' => 'Something Went Wrong!']);
        }
       //return $member;
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    public function updatemembers(Request $request, $id) {
        $member = Members::where('id', $id)->first();
        $data = $this->validate($request, [
            'name' => 'required|string',
            'email' => ['required','email', Rule::unique('members', 'email')->ignore($member->id)],
            'mobile' => ['required','digits:10', Rule::unique('members', 'mobile')->ignore($member->id)],
            'leader' => ['required'],
        ], [
            'leader_id' => 'Leader'
        ]);

        try{
            $host = auth()->guard('host')->user();
            if($host){
                $departId = null;
                if($request->departnment_id == null){
                    $departId = null;
                }
                elseif(optional($request->departnment_id)['id'] != null){
                    $departId = $request->departnment_id['id'];
                }else{
                    $dept = MemberDepartment::create(['name' =>  $request->departnment_id['name'], 'host_id' => $host->id]);
                    $departId = $dept->id;
                }
                $member->update(['email'=>$request->email, 'mobile'=>$request->mobile, 'name' => $request->name, 'slug' => Str::slug($request->name), 'password' => Hash::make(123)]);
                $is_leader = 'true';
                if($request->leader == false || $request->leader == 0 || $request->leader == 'false'){
                    $is_leader = 'false';
                }
                $hostMember = HostMember::where('host_id', $host->id)->where('member_id', $member->id)->where('invitation_id', $request->invitation_id)->first();
                $hostMember->update(['host_id' => $host->id,'member_id' => $member->id, 'invitation_id' => $request->invitation_id, 'is_leader' => $request->leader, 'is_leader' => $is_leader, 'leader_id' => optional($request->leader_id)['id'], 'departnment_id' => $departId]);
            } 
            return ['flash' => 'Member Updated succesfully!', 'members' => $this->getmembers(), 'departments' =>MemberDepartment::where('host_id', null)->orWhere('host_id', $host->id)->get(), 'leaders' =>$host->leaderMembers($request->invitation_id)->get()];
        }catch(Exception $e){
            return redirect()->back()->with(['flash' => 'Something Went Wrong!']);
        }

        //dd($member);
        $member->name = $request->get('name');
        $member->email = $request->get('email');
        $member->mobile = $request->get('mobile');
        $member->save();

        return $member;
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function deletemember($id)
    {
        //dd($id);
        $loggedin = auth()->guard('host')->user();
        if($loggedin){
            HostMember::where('host_id', $loggedin->id)->where('member_id', $id)->delete();
            return;
        }
        return;
        //$member = Members::find($request->id)->delete();
    }

}
