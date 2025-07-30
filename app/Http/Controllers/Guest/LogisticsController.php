<?php

namespace App\Http\Controllers\Guest;

use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Guest\Family;
use Illuminate\Http\Request;
use App\Models\Guest\Arrival;
use App\Models\Guest\Departure;
use App\Notifications\Guest\ArrivalNotifications;
use App\Notifications\Guest\DepartureNotifications;
use App\Models\Guest\Privilege;
use App\Models\Host\Invitation;
use App\Http\Controllers\Controller;


class LogisticsController extends Controller
{
    public function __construct(){

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( User $user, Invitation $invitation ) {
        $host = $invitation->host->first();
        //dd(request()->route()->parameters['invitation']->slug);
        $privilege = $user->invitations->where('slug', $invitation->slug)->first();
          if($privilege->guest_invitation->inviteStatus == 6){

                if( $privilege->guest_invitation->logistics >= 1) {
                    $family = $user->family;
                    $guest_logistics = $privilege->guest_invitation->logistics;
                    $arrival = $user->arrivals->filter(function ($item) use ($user, $invitation) {
                        return $item->guest_id == $user->id && $item->invitation_id == $invitation->id;
                    });

                    $departure = $user->departures->filter(function ($item) use ($user, $invitation) {
                        return $item->guest_id == $user->id && $item->invitation_id == $invitation->id;
                    });

                    if ($arrival->isEmpty()) {
                        $arrival = new Arrival();
                    } else {
                        $arrival = $arrival->where('guest_id', $user->id)->first();
                    }
                    if ($departure->isEmpty()) {
                        $departure = new Departure();
                    } else {
                        $departure = $departure->where('guest_id', $user->id)->first();
                    }
                    $count = 1;
                    foreach($family as $familymember){
                        //dd($familymember->privileges);
                        if(count($familymember->privileges) > 0){
                            if($familymember->privileges[0]->attending == 1){
                            $count++;
                        }
                        }
                    }
                    return view('guest.invitation.logistics.index', compact('user', 'invitation', 'family','arrival', 'departure', 'guest_logistics','count'));
                } else {
                    return redirect()->route('guestwelcome.index', $user)->with(['feedback' => 'feedback', 'message' => " $user->name ! call back $host->name to avail logistics support at $host->mobile"]);
                }
            } else {

                return redirect()->route('guestwelcome.index', $user)->with(['feedback' => 'feedback', 'message' => "$user->name!   request to accept Invitation First"]);
            }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user, Invitation $invitation)  {
        $arrival = new Arrival();
        $departure = new Departure();
        return view('guest.invitation.logistics.index', compact('user','invitation','arrival','departure'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(User $user, Invitation $invitation, Request $request) {
      //
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

    public function arrival(User $user, Invitation $invitation, Request $request){

        //dd($request);
        $exist = Arrival::where('guest_id', $user->id)->where('invitation_id', $invitation->id)->first();

        if($exist != null){
            $exist->update($request->all() + ['slug' => Str::slug($request->location . '-' . $request->input('date'))]);
        }else{
            return response([
                'message' => 'Add family members first'
            ], 404);
        }
        $user->invitations->where('id', $invitation->id)->first()->guest_invitation->update(['hostLogisticsArrivalStatus' => 1]);
        return [$user->invitations()->with('venues')->get()->where('id', $invitation->id)->first(), Arrival::where('guest_id', $user->id)->where('invitation_id', $invitation->id)->first()];

    //    $arrivals = $user->arrivals->filter(function($item) use ($user, $invitation){
        //     return $item->guest_id == $user->id && $item->invitation_id == $invitation->id;
        //    });
        //    //dd($arrivals);
        //     if ($arrivals->isNotEmpty()){
        //         $arrivalData = ['date' => $request->input('date'), 'travelMode' => $request->input('travelMode'), 'location' => $request->input('location'), 'memberCount' => $request->input('memberCount'), 'status' => 1];
        //        $arrivalData['guest_id'] = $user->id;
        //        $arrivalData['invitation_id'] = $invitation->id;
        //        foreach($arrivals as $arrival){
        //             $arrival->update($arrivalData + ['slug' => Str::slug($request->input('travelMode').'-'.$request->input('location') . '-' . $request->input('date'))]);
        //             $invitation->host->notify(new ArrivalNotifications($user, $invitation, 'updated arrival offer and submitted details'));
        //        }
        //     }
        //     else {
        //         $arrivalData = ['date' => $request->input('date'), 'travelMode' => $request->input('travelMode'), 'location' => $request->input('location'), 'memberCount' => $request->input('memberCount'), 'status' => 1];
        //         $arrivalData['guest_id'] = $user->id;
        //         $arrivalData['invitation_id'] = $invitation->id;
        //         $arrival = Arrival::create($arrivalData + ['slug' => Str::slug($request->input('travelMode') . '-' . $request->input('location') . '-' . $request->input('date'))]);
        //         $invitation->host->notify(new ArrivalNotifications($user, $invitation, 'accepted arrival offer and submitted details'));
        //     }
        //     $user->invitations->where('id',$invitation->id)->first()->guest_invitation->update(['logistics' => 3]);
    //     return redirect()->route('guestlogistics.index', [$user, $invitation])->with(['status' => "$user->name arrival details updated successfully"]);

    }

    public function departure(User $user, Invitation $invitation, Request $request){

        //dd('ssssss');
        $exist = Departure::where('guest_id', $user->id)->where('invitation_id', $invitation->id)->first();

        if($exist != null){
            $exist->update($request->all() + ['slug' => Str::slug($request->location . '-' . $request->input('date'))]);
        }else{
            return response([
                'message' => 'Add family members first'
            ], 404);
        }
        $user->invitations->where('id', $invitation->id)->first()->guest_invitation->update(['hostLogisticsDepartureStatus' => 1]);
        return [$user->invitations()->with('venues')->get()->where('id', $invitation->id)->first(), Departure::where('guest_id', $user->id)->where('invitation_id', $invitation->id)->first()];

        // $departs = $user->departures->filter(function ($item) use ($user, $invitation) {
            //     return $item->guest_id == $user->id && $item->invitation_id == $invitation->id;
            // });

            // if ($departs->isNotEmpty()) {
            //     $departureData =  ['date' => $request->input('date'), 'travelMode' => $request->input('travelMode'), 'location' => $request->input('location'), 'memberCount' => $request->input('memberCount'), 'status' => 1];
            //     $departureData['guest_id'] = $user->id;
            //     $departureData['invitation_id'] = $invitation->id;
            //     foreach ($departs as $depart) {
            //         $depart->update($departureData + ['slug' => Str::slug($request->input('travelMode') . '-' . $request->input('location') . '-' . $request->input('date'))]);
            //     }
            //     $invitation->host->notify(new DepartureNotifications($user, $invitation, 'updated departure offer and submitted details'));
            // }
            // else {
            //     $departureData =  ['date' => $request->input('date'), 'travelMode' => $request->input('travelMode'), 'location' => $request->input('location'), 'memberCount' => $request->input('memberCount'), 'status' => 1];
            //     $departureData['guest_id'] = $user->id;
            //     $departureData['invitation_id'] = $invitation->id;
            //     Departure::create($departureData + ['slug' => Str::slug($request->input('travelMode') . '-' . $request->input('location') . '-' . $request->input('date'))]);
            //     $invitation->host->notify(new DepartureNotifications($user,$invitation, 'accepted departure offer and submitted details'));
            // }
            // $user->invitations->where('id', $invitation->id)->first()->guest_invitation->update(['logistics' => 4]);
        // return redirect()->route('guestlogistics.index', [$user, $invitation])->with(['status' => "$user->name departure details updated successfully"]);

    }

    public function guestarrival(User $user, Invitation $invitation, Request $request){
        //dd('ss');

        $invi = $user->invitations->where('id', $invitation->id)->first();
        if($request->logistics == 2){
            $invi->guest_invitation->update(['logisticsArrivalStatus' => $request->logistics, 'logisticsDepartureStatus' => $request->logistics]);
            $invitation->host->notify(new ArrivalNotifications($user, $invitation, ' accepted logistics offer'));
        }else{
            $invi->guest_invitation->update(['logisticsArrivalStatus' => $request->logistics, 'logisticsDepartureStatus' => $request->logistics]);
            $invitation->host->notify(new ArrivalNotifications($user, $invitation, ' declined logistics offer'));
        }
        return $user->invitations()->with('venues')->get()->where('id', $invitation->id)->first();


        // foreach($user->invitations as $privilege){
        //         if ($request->logistics == 'on') {
        //             $privilege->guest_invitation->logistics = 2;
        //             $privilege->guest_invitation->save();
        //             $invitation->host->notify(new ArrivalNotifications($user, $invitation, 'accepted logistics offer'));
        //         } else {
        //             $privilege->guest_invitation->logistics = 1;
        //             $privilege->guest_invitation->save();
        //             $invitation->host->notify(new ArrivalNotifications($user, $invitation, 'declined logistics offer'));
        //         }
        //     }
        // return redirect()->back()->with(['status' => " $user->name logistic requirement updated successfully"]);
    }


    public function familyarrival(User $user, Invitation $invitation, Request $request)  {
        //dd('ss', $request);
        if($request->type == 'arrival'){
            $user->invitations->where('id', $invitation->id)->first()->guest_invitation->update(['logisticsArrivalStatus' => $request->logistics]);
            $exist = Arrival::where('guest_id', $user->id)->where('invitation_id', $invitation->id)->first();
            if($exist == null){
                Arrival::create(['memberCount' => $request->list, 'guest_id' => $user->id, 'invitation_id' => $invitation->id]);
            }else{
                $exist->update(['memberCount' => $request->list]);
            }
            
            return [$user->invitations()->with('venues')->get()->where('id', $invitation->id)->first(), Arrival::where('guest_id', $user->id)->where('invitation_id', $invitation->id)->first()];
            //dd('done');
        }
        if($request->type == 'departure'){
            //dd('ss');
            $user->invitations->where('id', $invitation->id)->first()->guest_invitation->update(['logisticsDepartureStatus' => $request->logistics]);
            $exist = Departure::where('guest_id', $user->id)->where('invitation_id', $invitation->id)->first();
            if($exist ==  null){
                Departure::create(['memberCount' => $request->list, 'guest_id' => $user->id, 'invitation_id' => $invitation->id]);
            }else{
                $exist->update(['memberCount' => $request->list]);
            }
        
            return [$user->invitations()->with('venues')->get()->where('id', $invitation->id)->first(), Departure::where('guest_id', $user->id)->where('invitation_id', $invitation->id)->first()];
            //dd('done');
        }

        // $privilege = Privilege::where('family_id', $request->family_id)->get();
        // //dd($privilege);
        // if($privilege->isEmpty() ){
        //     Privilege::create(['attending' => $request->attending == 'on' ? 1 : '', 'family_id' => $request->family_id, 'invitation_id' => $invitation->id]);
        // } else {
        //         foreach($privilege as $privil) {
        //         if($privil->attending == 1){
        //             $privil->update(['attending' => 0]);
        //             $privil->save();
        //         } else {
        //             $privil->update(['attending' => 1]);
        //             $privil->save();
        //         }

        //     }
        // }

        // return redirect()->back()->with(['status' => "$user->name family info updated"]);
    }

}
