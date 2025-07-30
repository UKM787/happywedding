<?php

namespace App\Http\Controllers\Guest;

use App\Models\User;
use App\Models\Guest\Family;
use Hamcrest\Arrays\IsArray;
use Illuminate\Http\Request;
use App\Models\Guest\Privilege;
use App\Models\Host\Invitation;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\GuestFamilyExport1;
use App\Models\Guest\Accommodation;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Guest\AccomodationExport;
use App\Notifications\Guest\AccommodationNotifications;

//use Barryvdh\DomPDF\PDF;

class AccommodationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user, Invitation $invitation)
    {
        $host = $invitation->host->first();
            $privilege = $user->invitations->where('slug', $invitation->slug)->first();


            if ($privilege->guest_invitation->inviteStatus == 6) {

                if( $privilege->guest_invitation->accommodation >= 1) {

                $guest_accommodation = $privilege->guest_invitation->accommodation;
                //dd($guest_accommodation, $user->family);
                if ($user->family->isNotEmpty()) {  
                    $family = $user->family;
                    //dd($user->accommodations);
                    $guestaccomo = $user->accommodations->filter(function ($item) use ($user, $invitation) {
                        return $item->guest_id == $user->id && $item->invitation_id == $invitation->id;
                    })->values();
                    //dd($user->accommodations);
                    if ($guestaccomo->isEmpty()) {
                        $guestaccomo = new Accommodation();
                    }
                    return view('guest.invitation.accommodation.index', compact('user', 'invitation', 'family', 'guestaccomo', 'guest_accommodation'));
                } else {

                    $family = new Family();
                    $guestaccomo = $user->accommodations->filter(function ($item) use ($user, $invitation) {
                        return $item->guest_id == $user->id && $item->invitation_id == $invitation->id;
                    })->values();
                    if ($guestaccomo->isEmpty()) {
                        $guestaccomo = new Accommodation();
                    } else {
                        $guestaccomo = $guestaccomo->first();
                    }
                    
                    return view('guest.invitation.accommodation.index', compact('user', 'invitation', 'family', 'guestaccomo', 'guest_accommodation'));
                }
            } else {
                    return redirect()->route('guestwelcome.index', $user)->with(['feedback' => 'feedback', 'message' => " $user->name ! call back $host->name to avail accommodation support at $host->mobile"]);
            }

            } else {
                return redirect()->route('guestwelcome.index', $user)->with(['feedback' => 'feedback', 'message' => "$user->name! request to accept Invitation First"]);
            }

    }


    public function export(User $user, Invitation $invitation){
        // return (new GuestFamilyExport1($invitation))->download('invoices.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
        
        // return Excel::download(new GuestFamilyExport1($invitation), 'GuestFamily.xlsx'); 
        //dd($user->invitations->first());
        $accomodationInfo = Privilege::where('user_id', $user->id)->where('invitation_id', $invitation->id)->with('family')->get(); 
        //$accomodationInfo['guest'] = 'helo'
        $guestAccommodationInfo = $user->accommodations->first();
        $invi =$user->invitations->first();
         $data = [
            'user'=>$user,
            'accomodationInfo'=>$accomodationInfo,
            'guestAccommodationInfo'=>$guestAccommodationInfo,
            'privileges'=>$invi

        ];

        $pdf = PDF::loadView('guestAccommodationExportDesign', $data);
        //$pdf->getDomPDF()->setHttpContext($contxt);
        //dd($pdf, url('/assets/guestInvi/acc-right.png'), public_path('/assets/guestInvi/acc-right.png'));
        //$pdf->loadView('guestAccommodationExportDesign', $data);
        $pdf->setOption('isHtml5ParserEnabled', true);
        //dd($pdf);
    
        return $pdf->stream($user->name.'-AccomodationDetails.pdf');

        //return Excel::download(new AccomodationExport($invitation), 'GuestFamily.pdf');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(user $user, Invitation $invitation, Request $request)
    {
       dd($user, $invitation, $request);
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

    public function guestupdate(user $user, Invitation $invitation, Request $request){
        //dd($invitation, $user);
        $invi = $user->invitations->where('id', $invitation->id)->first();
        if($request->accommodation == 2){
            $invi->guest_invitation->update(['accommodationStatus' => $request->accommodation]);
            $invitation->host->notify(new AccommodationNotifications($user, $invitation, ' accepted accommodation offer'));
        }else{
            $invi->guest_invitation->update(['accommodationStatus' => $request->accommodation]);
            $items = Privilege::where('user_id', $user->id)->where('invitation_id', $invitation->id)->delete();
            //dd($items);
            //$items->delete();
            $invitation->host->notify(new AccommodationNotifications($user, $invitation, ' declined accommodation offer'));
        }
        return $user->invitations()->with('venues')->get()->where('id', $invitation->id)->first();


    }

    public function familyupdate(user $user, Invitation $invitation, Request $request) {
        
        foreach($request->list as $single){
            $exist = Privilege::where('family_id', $single['id'])->first();
            if($exist == null){
                $added = Privilege::create(['attending' => 1, 'family_id' => $single['id'], 'invitation_id' => $invitation->id, 'user_id' => $single['guest_id']]);
            }
        }
        $accList = Privilege::where('user_id', $user->id)->where('invitation_id', $invitation->id)->with('family')->get();
        if($accList == null){
            $accList = [];
        }
        $user->invitations->where('id', $invitation->id)->first()->guest_invitation->update(['accommodationStatus' => $request->accommodation]);

        return [$user->invitations()->with('venues')->get()->where('id', $invitation->id)->first(), $accList];
    }
}
