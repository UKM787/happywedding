<?php

namespace App\Http\Controllers\Host\Invitation;

use App\Models\Host\Host;
use Illuminate\Support\Str;
use App\Models\Host\Message;
use Illuminate\Http\Request;
use App\Models\Host\Invitation;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($invi = null)
    {   
        if($invi == null){
            return redirect(route('hostinvitations.index'));
        }
        $host = auth()->guard('host')->user();
        $invitation = Invitation::where('slug', $invi)->first();
        //$members = Host::where('parent_id', auth()->guard('host')->user()->id)->get();
        // $brideGroom = Host::where('parent_id', auth()->guard('host')->user()->id)->with('roles')->get();
        //$newMembers = $host->members;
        //dd($newMembers);
        //$members = $newMembers->merge($brideGroom);
        $members = $host->members;
        $contactList = Message::with('member')->get();
        //dd($contactList);
        $active = 'helpline';
        return view('host.invitation.contact.index', compact('host','invitation', 'members', 'contactList', 'active'));
        // $messages = Message::all();
        // return response()->json(['success' => true, 'message' => $messages], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Host $host, Invitation $invitation,Request $request)
    {
        //dd($request);
        $data = $this->validate($request, [
            'contact_for' => 'required|string',
            'host_id' => 'required',
        ],[
            'host_id.required' => 'Member is required, kindly select or add members first!'
        ]);
    //    / dd($data);
        Message::create($data+['slug' => Str::slug($data['contact_for'], '-', 'en') . '-' . rand(1, 10000), 'invitation_id' => $invitation->id     ]);
        //dd(Message::all());
        /*
          Add mail functionality here.
        */
        $messages = Message::with('member')->get();
        return $messages;
        //return response()->json(['success' => true, 'messages' => $messages], 200);
    }

    public function submit(Request $request)  {
        $data = $this->validate($request, [
            'contact' => 'required|string',
            'name' => 'required|string',
            'mobile' => 'required',
            'host_id' => 'required'
        ], [
            'host_id.required' => 'Member is required, kindly select or add members first!'
        ]
            
        );

        $message = Message::create($data);

        /*
          Add mail functionality here.
        */

        return response()->json(['success' => true, 'message' => $message], 200);
    }

    public function getcontacts(){

        $messages = Message::all();
         //dd($messages);
        return response()->json(['success' => true, 'message' => $messages], 200);
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
    public function update(Request $request, $invi, $id)
    {
         $data = $this->validate($request, [
            'contact_for' => 'required|string',
            'host_id' => 'required',
        ], [], [
            'host_id' => 'Member is required, kindly sleect or add memebers first!'
        ]);
        // /dd($data, $id);
        Message::where('id', (int)$id)->update($data);
        //$messages = Message::all();
        $messages = Message::with('member')->get();
        return $messages;
        //return response()->json(['success' => true, 'message' => $messages], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($nvi, $id)
    {
        Message::where('id', $id)->delete();

        $messages = Message::with('member')->get();
        return $messages;
        //$messages = Message::all();
        //dd($messages);
        //return response()->json(['success' => true, 'message' => $messages], 200);
    }
}
