<?php

namespace App\Http\Controllers\Host;

use App\Models\User;
use App\Models\Host\Host;
use App\Models\Host\Guest;
use Illuminate\Http\Request;
use App\Models\Host\Invitation;
use App\Models\Host\CeramonyGuest;
use App\Http\Controllers\Controller;

class GuestCeramonyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()  {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Host $host, Invitation $invitation)  {
        $guest = new Guest();
       return view('host.invitation.guest.create',compact('host','invitation','guest'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(User $user, Invitation $invitation, Request $request)  {
        dd('ss');

       if($user->ceramonies->isEmpty()){
            foreach ($request->ceramony_id as $key => $val) {
                $user->ceramonies()->attach($val, ['invitation_id' => $invitation->id, 'invitationStatus' => $request->invitationStatus[$key]]);
            }
       } else {
          // dd($request);
            // foreach ($request->ceramony_id as $key => $val) {
            //     $user->ceramonies()->sync($val, ['invitationStatus' => $request->invitationStatus[$key], 'invitation_id' => $request->invitation_id]);
            // }
       }

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Host\CeramonyGuest  $ceramonyGuest
     * @return \Illuminate\Http\Response
     */
    public function show(CeramonyGuest $ceramonyGuest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Host\CeramonyGuest  $ceramonyGuest
     * @return \Illuminate\Http\Response
     */
    public function edit(CeramonyGuest $ceramonyGuest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Host\CeramonyGuest  $ceramonyGuest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CeramonyGuest $ceramonyGuest)
    {
       dd('reached update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Host\CeramonyGuest  $ceramonyGuest
     * @return \Illuminate\Http\Response
     */
    public function destroy(CeramonyGuest $ceramonyGuest)
    {
        //
    }
}
