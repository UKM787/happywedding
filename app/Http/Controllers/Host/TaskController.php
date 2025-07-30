<?php

namespace App\Http\Controllers\Host;

use App\Models\Host\Host;
use App\Models\Host\Member;
use Illuminate\Http\Request;
use App\Models\Member\Members;
use App\Models\Host\Invitation;
use App\Models\Host\MemberTask;
use App\Models\Admin\TaskMaster;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Models\Host\InvitationTask;
use Carbon\Carbon;
use Exception;
use Spatie\Permission\Traits\HasRoles;

// Task Status
// 0 -- Not Started // Pending
// 1 -- Started // in Process
// 2 -- Assigned
// 3 -- Started by Assigned // in Process
// 5 -- On Hold
// 6 -- Completed


class TaskController extends Controller
{
    use HasRoles;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $host = auth()->guard('host')->user();
        $invitation=$host->invitations->first();
        if($invitation == null){
                return redirect(route('hostinvitations.index'));
            }
        $active = 'tasklist';
        if ($host->invitations->isNotEmpty()) {
            $invitation = $host->invitations[0];
            $taskList = $invitation->invitationtasks()->with('timeline')->get();
            foreach ($taskList as $single) {
                //dd($single->pivot);
                if($single->pivot->custom_timeline_id != null){
                    $single->custom_timeline = $single->pivot->timeline($single->pivot->custom_timeline_id);
                }
                if($single->pivot->completeable_type != null){
                    $single->completed_by = $single->pivot->completeable;
                }
                if($single->pivot->assignable_type != null){
                    $single->assigned_to = $single->pivot->assignable;
                }
            }
            //dd(TaskMaster::limit(10)->with('admin')->get());
            $taskCat = TaskMaster::whereNull('parent_id')->orderBy('name', 'asc')->get();
            // dd('tfyghbjn');
            $tasks = MemberTask::where('invitation_id', auth()->guard('host')->user()->invitations[0]->id)
                ->with('category', 'invitation', 'assignable')->get();
            $brideGroom = Host::where('parent_id', auth()->guard('host')->user()->id)->with('roles')->get();
            $self = null;
            // dd($host->role);
            foreach($host->role as $role){
                if($role == 'bride' || $role == 'groom'){
                    $self = $host;
                }
            }

            $newMembers = $host->members($invitation->id)->get();
            foreach ($newMembers as $single) {
                $single->deptartment = $single->pivot->department($single->pivot->departnment_id);
                $single->leaderId = $single->pivot->leader($single->pivot->leader_id);
            }
            $members = $newMembers->concat($brideGroom);
            //dd($members);
            if($self){
                $members->prepend($host);
            }
            //dd($tasks);
            return view('host.tasks.index', compact('host', 'tasks', 'invitation', 'active', 'members', 'taskList', 'taskCat', 'newMembers'));
        } else {
            $host = auth()->guard('host')->user();
            $brideGroom = Host::where('parent_id', auth()->guard('host')->user()->id)->with('roles')->get();
            $self = null;
            foreach ($host->roles_user as $role) {
                if ($role == 'bride' || $role == 'groom') {
                    $self = $host;
                }
            }
            $newMembers = $host->members;
            $members = $newMembers->merge($brideGroom);
            $members->push($host);
            return view('host.tasks.index', compact('host', 'members', 'active'));
        }
    }

    public function gettasks($id = null)
    {
        $tasks = MemberTask::where('invitation_id', auth()->guard('host')->user()->invitations[0]->id)
            ->with('category', 'invitation', 'assignable')->get();
        // dd(MemberTask::where('invitation_id', auth()->guard('host')->user()->invitations[0]->id)->first()->category);
        // $task = MemberTask::where('invitation_id', auth()->guard('host')->user()->invitations[0]->id)->get();
        return $tasks;
    }

    public function bulkupload(Host $host)
    {
        return view('host.tasks.bulkupload', compact('host'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return 'creates tasklist form here';
        $host = auth()->guard('host')->user();
        $user = Host::where('parent_id', $host->id)->where('name', 'Viddhant Gautam')->get('name');

        $members = Host::where('parent_id', $host->id)->get()->map(function ($host) {
            foreach ($host->getRoleNames() as $role) {
                if ($role == 'member') {
                    return ['id' => $host->id, 'name' => $host->name];
                }
            }
        });
        $members = array_filter($members->toArray());
        return view('host.tasks.create', compact('host', 'members'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            if($request->type == 'start'){
                $item = InvitationTask::where('id', $request->id)->first();
                $item->update(['taskStatus' => 1, 'started_date' => Carbon::now()]);
                return response([
                    'message' => 'Task Status Updated Successfully!;',
                    'data' => $item
                ]);
            }
            if($request->type == 'complete'){
                $loggedIn = auth()->guard('host')->user() ?? auth()->guard('host')->user();
                $item = InvitationTask::where('id', $request->id)->first();
                $item->update(['taskStatus' => 6, 'complete_date' => Carbon::now(), 'completeable_type' => get_class($loggedIn),'completeable_id' => $loggedIn->id ]);
                return response([
                    'message' => 'Task Status Updated Successfully!;',
                    'data' => $item
                ]);
            }
            if($request->type == 'assign'){
                $member = Members::where('id', (int)$request->member_id)->first();
                if($member){
                    $item = InvitationTask::where('id', $request->id)->first();
                    $item->update(['taskStatus' => 2, 'started_date' => null, 'assignable_type' => get_class($member),'assignable_id' => $member->id ]);
                    return response([
                        'message' => 'Task Assigned Successfully!;',
                        'data' => $item
                    ]);
                }
            }
            dd($request);
        }catch(Exception $e){
            dd($e);
        }
    }

    public function submittask(Request $request)
    {

        //dd($request);
        $data = $this->validate($request, [
            'title' => 'required|string',
            'taskStatus' => 'required|string',
            'taskPriority' => 'required|string',
            'pinned' => 'sometimes|boolean',
            'startDate' => 'required',
            'completionDate' => 'required',
            'startTime' => 'required',
            'completionTime' => 'required',
            'category_id' => 'required',
            'member_id' => 'required|integer',
            'invitation_id' => 'required',
            'type' => 'required'

        ]);
        //dd($data);
        $model = null;
        if ($data['type'] == 'host') {
            $model = Host::where('id', $data['member_id'])->first();
        }
        if ($data['type'] == 'member') {
            $model = Members::where('id', $data['member_id'])->first();
        }
        //dd($model);
        if ($model) {
            $task = $model->tasksAll()->create($data);
        }

        /*
          Add mail functionality here.
        */

        return response()->json($task, 200);
    }

    public function updatetask(Request $request, $id)
    {
        //dd($request);
        $data = $this->validate($request, [
            'title' => 'required|string',
            'taskStatus' => 'required|string',
            'taskPriority' => 'required|string',
            'startDate' => 'required',
            'completionDate' => 'required',
            'startTime' => 'required',
            'completionTime' => 'required',
            'category_id' => 'required',
            'member_id' => 'required|json',
            //'invitation_id' => 'required'

        ]);
        $task = MemberTask::findOrFail($id);
        $task = $task->update($data);
        return response()->json($task, 200);

        /*
          Add mail functionality here.
        */

        return response()->json($task, 200);
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

    public function deletetask(Request $request)
    {
        $task = MemberTask::find($request->id)->delete();
    }
}
