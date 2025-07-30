<?php

namespace App\Http\Controllers\Host;

use Exception;
use App\Models\User;
use App\Models\Host\Host;
use Illuminate\Http\Request;
use App\Models\Guest\Arrival;
use App\Models\Guest\Departure;
use App\Models\Host\Invitation;
use App\Http\Controllers\Controller;
use App\Models\Guest\GuestInvitation;
use App\Notifications\Host\ArrivalNotifications;
use App\Notifications\Host\DepartureNotifications;

class LogisticsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()  {

        $host = auth()->guard('host')->user();
        $host = Host::where('id', $host->id)->with('profile')->first();
        $invitations=$host->invitations->first();
        if($invitations == null){
                return redirect(route('hostinvitations.index'));
            }
       // dd($host->invitations);
        $invitation = $host->invitations->first();
        if(isset($invitation)) {
            //dd($invitation, $invitation->arrivals);
           $arrivals = $invitation->arrivals()->with(['guest.invitations' => function ($query) use($invitation) {
                $query->where('invitation_id', $invitation->id);
            }])->get();
            //dd($arrivals);
            // $test = $invitation->arrivals()->with(['guest.single' => function ($query) use($invitation) {
            //     $query->where('invitation_id', $invitation->id);
            // }])->get();
           //dd($arrivals);
           $departures = $invitation->departures()->with(['guest.invitations' => function ($query) use($invitation) {
                $query->where('invitation_id', $invitation->id);
            }])->get();
            //dd($departures);
            $active = 'logistics';
           //dd($arrivals);
        return view('host.logistics.index', compact('host', 'invitation','arrivals','departures', 'active'));
        } else {
            return view('404', compact('host'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Host $host, Invitation $invitation) {

        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // /dd($request);
        $host = auth()->guard('host')->user();
        $invitation = Invitation::where('id', $request->invitation_id)->first();
        if($request->type == 'arrival'){
            $arrivalData = $this->requestValidate($request);
            //dd('sss');
            try {
                //dd('sssss', $request);
                if($request->list){
                    $userIds = array_values(json_decode($request->list, true));
                }else{
                    $userIds = null;
                }
                //dd($arrivalData);
                $arrivalData['status'] = 3;
                //dd($userIds);
                if($userIds){
                    foreach($userIds as $id){
                        //dd($id, User::where('id', $id)->first());
                        $user = User::where('id', $id)->first();
                        //dd($user, $id);
                        $arrival = $invitation->arrivals->filter(function ($item) use ($user, $invitation) {
                            return $item->guest_id == $user->id && $item->invitation_id == $invitation->id;
                        });
                        //dd($arrival);
                        $arrival->first()->update($arrivalData);
                        GuestInvitation::where('user_id', $id)->where('invitation_id', $request->invitation_id)->first()->update(['hostLogisticsArrivalStatus' => 2]);
                        $user->notify(new ArrivalNotifications($host, $arrival->first(), 'booked arrival transport'));
                    }
                    //dd(User::whereIn('id', $userIds)->get());
                }else{
                    $user = User::where('id', $request->guest_id)->first();
                    $arrival = $invitation->arrivals->filter(function ($item) use ($user, $invitation) {
                        return $item->guest_id == $user->id && $item->invitation_id == $invitation->id;
                    });
                    $arrival->first()->update($arrivalData);
                    GuestInvitation::where('user_id', $user->id)->where('invitation_id', $request->invitation_id)->first()->update(['hostLogisticsArrivalStatus' => 2]);
                    $user->notify(new ArrivalNotifications($host, $arrival->first(), 'booked arrival transport'));
                }
            } catch (Exception $e) {
                return response()->json([
                'message'    => 'Kindly correct the feilds with error!',
                'errors' => $e->getMessage(),
            ], 422);
            }
        }

        if($request->type == 'departure'){
            $departureData = $this->requestValidate($request);
            try {
                if($request->list){
                    $userIds = array_values(json_decode($request->list, true));
                }else{
                    $userIds = null;
                }
                $departureData['status'] = 3;

                if($userIds){
                    foreach($userIds as $id){
                        $user = User::where('id', $id)->first();
                        //dd($user, $id);
                        $departure = $invitation->departures->filter(function ($item) use ($user, $invitation) {
                            return $item->guest_id == $user->id && $item->invitation_id == $invitation->id;
                        });
                        //dd($arrival);
                        $departure->first()->update($departureData);
                        GuestInvitation::where('user_id', $id)->where('invitation_id', $request->invitation_id)->first()->update(['hostLogisticsDepartureStatus' => 2]);
                        $user->notify(new DepartureNotifications($host, $departure->first(), 'booked departure transport'));
                    }
                }else{
                    $user = User::where('id', $request->guest_id)->first();
                    $departure = $invitation->departures->filter(function ($item) use ($user, $invitation) {
                        return $item->guest_id == $user->id && $item->invitation_id == $invitation->id;
                    });
                    $departure->first()->update($departureData);
                    GuestInvitation::where('user_id', $user->id)->where('invitation_id', $request->invitation_id)->first()->update(['hostLogisticsDepartureStatus' => 2]);
                    $user->notify(new DepartureNotifications($host, $departure->first(), 'booked departure transport'));
                }
            } catch( Exception $e){
                return response()->json([
                'message'    => 'Kindly correct the feilds with error!',
                'errors' => $e->getMessage(),
            ], 422);
            } 
        }
        $arrivals = $invitation->arrivals()->with(['guest.invitations' => function ($query) use($invitation) {
                $query->where('invitation_id', $invitation->id);
            }])->get();
           //dd($arrivals);
        $departures = $invitation->departures()->with(['guest.invitations' => function ($query) use($invitation) {
                $query->where('invitation_id', $invitation->id);
            }])->get();
        
        return response([
            $arrivals, $departures
        ], 200);

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

    private function requestValidate($request)    {
       // dd($request);
        return $request->validate(
            [
                'vehicleNo'         => ['sometimes', 'string', 'min:4', 'max:20'],
                'driverName'        => ['sometimes', 'string', 'min:3', 'max:100'],
                'driverMobile'      => ['sometimes', 'digits:10'],
                'transport'         => ['sometimes', 'string'],
                'inchargeName'      => ['sometimes', 'string', 'min:3', 'max:100'],
                'inchargeMobile'    => ['sometimes', 'digits:10'],
                // 'inchargeLocation'  => ['required', 'string', 'min:3', 'max:100']
            ],
            [
                'vehicleNo.required' => 'Vehicle Number is required & minimum 4 characters are required',
                'driverName.required' => 'Driver Name is required',
                'driverMobile.required' => 'Driver Mobile No is required',
                'transport.required' => 'Transport vehicle type is required',
                'inchargeName.required' => 'Incharge Name is required',
                'inchargeMobile.required' => 'Inchage Mobile Number is required',
                'inchargeLocation.required' => 'Incharge Location is required',
            ]
        );
    }
}
