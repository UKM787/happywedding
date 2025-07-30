<?php

namespace App\Http\Controllers\Host;

use Exception;
use App\Models\User;
use App\Models\Host\Host;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Models\Guest\Privilege;
use App\Models\Host\AccommRoom;
use App\Models\Host\Invitation;
use App\Models\Host\AccommBlock;
use App\Models\Host\AccommFloor;
use App\Models\Admin\VendorMaster;
use App\Models\Guest\Accommodation;
use App\Http\Controllers\Controller;
use App\Models\Admin\LocationMaster;
use App\Models\Guest\GuestInvitation;
use App\Models\Vendor\Service\Venue;
use App\Notifications\Host\AccommodationNotifications;
use App\Models\Host\Accommodation as HostAccommodation;
//use App\Models\Vendor\Service\Accommodation as HostAccommodation;
class AccommodationController extends Controller
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

        if($host->invitations->isNotEmpty()){

        $invitation = $host->invitations->first();
        $venues=Venue::pluck('name','id');
        $accom=HostAccommodation::where('invitation_id',$invitation->id)->get();
        $guestlists = $invitation->guests()->where('inviteStatus', 6)->get();
        $active = 'accommodation';
            if ($guestlists->isNotEmpty()) {
                foreach($guestlists as $guest){
                    if($guest->has('family')) {
                    $guestfamily[$guest->id] = $guest->family;
                    }
                }
                return view('host.accommodation.index', compact('host', 'invitation', 'guestlists', 'guestfamily', 'venues', 'accom', 'active'));
            }
            return view('host.accommodation.index', compact('host', 'invitation', 'guestlists', 'venues', 'accom', 'active'));
        } else {
            return view('404', compact('host'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()  {
        $host = auth()->guard('host')->user();
        $locations = LocationMaster::orderBy('name', 'ASC')->pluck('id', 'name');
        $categories = VendorMaster::latest()->whereNotNull('parent_id')->pluck('id', 'name');
        $accommodation = new Accommodation();
        return view('host.accommodation.create', ['host' =>$host, 'accommodation' => $accommodation, 'locations' => $locations, 'categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $host = auth()->guard('host')->user();
        if(isset($request->guest_id)){
            try {
                $accommodationData = $this->requestValidate($request);
                $accommodationData['status'] = 3;
                $invitation = Invitation::where('id', $request->invitation_id)->first();
                $user = User::where('id', $request->guest_id)->first();
                $pivotTable = GuestInvitation::where('user_id', $user->id)->where('invitation_id', $request->invitation_id)->first();
                //dd();
                $inaccommodation = $invitation->accommodations->filter(function ($item) use ($user, $invitation) { return $item->guest_id == $user->id && $item->invitation_id == $invitation->id;
                })->first();
               $useraccomo = $user->accommodations->where('guest_id', $user->id)->first();

                if (isset($inaccommodation)) {
                    //dd('haveacc');
                    $inaccommodation->update(['hotelName' => $request->mhotelName, 'block' => $request->mblock, 'floor' => $request->mfloor, 'roomno' => $request->mroomno, 'invitation_id' => $request->invitation_id, 'guest_id' => $request->guest_id, 'status' => 3]);
                    $pivotTable->update(['hostAccommodationStatus' => 1]);
                } else {
                    $inaccommodation =  Accommodation::create(['hotelName' => $request->mhotelName, 'block' => $request->mblock, 'floor' => $request->mfloor, 'roomno' => $request->mroomno, 'invitation_id' => $request->invitation_id, 'guest_id' => $request->guest_id, 'status' => 3]);
                    $pivotTable->update(['hostAccommodationStatus' => 1]);
                    //set $user->pivot->accommodaiton == 3
                }

            } catch (Exception $e) {
                //dd('fff');
                return redirect()->back()->with([
                    'status' => 'failure',
                    'message' => $e->getMessage()
                ]);
            }
        }
        //dd($request->family_id);
        if($request->family_id && is_array($request->family_id) && count($request->family_id) > 0){
            try {
            //dd('ss');
                $family = User::where('id', $request->guest_id)->first()->family;
                $user = User::where('id', $request->guest_id)->first();
                $pivotTable = GuestInvitation::where('user_id', $user->id)->where('invitation_id', $request->invitation_id)->first();
                if ($family->isNotEmpty()) {
                    for ($i = 0; $i < count($request->family_id); $i++) {
                        $privil = Privilege::where('family_id', $request->family_id[$i])->first();
                        if (isset($privil)) {
                            $privil->update(['hotelName' => $request->hotelName[$i], 'block' => $request->block[$i], 'floor' =>  $request->floor[$i], 'roomno' => $request->roomno[$i], 'invitation_id' => $request->invitation_id, 'family_id' =>  $request->family_id[$i], 'status' => 1]);
                            $pivotTable->update(['hostAccommodationStatus' => 1]);
                        } else {
                            Privilege::create(['hotelName' => $request->hotelName[$i], 'block' => $request->block[$i], 'floor' =>  $request->floor[$i], 'roomno' => $request->roomno[$i], 'invitation_id' => $request->invitation_id, 'family_id' =>  $request->family_id[$i], 'status' => 1]);
                            $pivotTable->update(['hostAccommodationStatus' => 1]);
                        }
                    }
                }
            } catch (Exception $e ){
                return redirect()->back()->with([
                    'status' => 'failure',
                    'message' => $e->getMessage()
                ]);
            }
        }
        
        $user->notify(new AccommodationNotifications($host, $inaccommodation, 'accommodation booked'));
        //$user->invitations->where('id', $invitation->id)->first()->guest_invitation->update(['accommodation' => 3]);
        return redirect()->back()->with(['status', 'hotel accommodation booked']);


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

    public function storeAccomm(Request $request){
        $host = auth()->guard('host')->user();
        $invitation=$host->invitations->first();
        // dd($request);
        foreach($request->hotels as $hotel){
            $accom= new HostAccommodation();
            $accom->name=$hotel;
            $accom->invitation_id=$invitation->id;
            $accom->save();

        }

        return back()->with('success','Hotel added Successfully');
    }

    // public function roomIndex(Host $host, Invitation $invitation){
    //     $invitation=$host->invitations->first();
    //     $accoms=HostAccommodation::where('invitation_id',$invitation->id)->get();

    //     return view('host.accomodation.roomIndex',compact('host','accoms'));
    // }

    public function storeBlock(Host $host,Request $request)
    {
        //$accom=Accomodation::where("name",$request->selectedHotels)->first();
        //$accom=Accomodation::find($request->selectedHotels);
        // dd($request);
        foreach($request->block as $item){
            $block=new AccommBlock();
            $block->name=$item;
            $block->accommodation_id=$request->selectedHotels;
            $block->save();

        }

        // $accom->block=$request->block;
        //$accom->save();
        return back()->with('success','Blocks added Successfully');

    }

    public function storeFloor(Host $host,Request $request)
    {

        //$accom=AccomBlock::where("name",$request->Block)->first();
        //$accom=AccomBlock::find($request->Block);

        foreach($request->block as $item){
            $block=new AccommFloor();
            $block->name=$item;
            $block->block_id=$request->Block;
            $block->save();

        }

        // $accom->block=$request->block;
        //$accom->save();
        return back()->with('success','Floors added Successfully');

    }

    public function storeRoom(Host $host,Request $request)
    {
        // dd($request->all());
        $i=0;
        foreach($request->room as $roo){
            $room=new AccommRoom();
            $room->room=$roo;
            $room->members=$request->members[$i];
            $room->floor_id=$request->Floor;

            $room->save();
            $i++;
        }

        return back()->with('success','Rooms added Successfully');

    }

    public function getBlock($id)
    {
        $blocks=HostAccommodation::find($id);
        if(isset($blocks->blocksAll)){
            //$blockAcom=AccomBlock::where('accomodation_id',$blocks->id)->get();
            $blockAcom=$blocks->blocksAll;
            return response()->json($blockAcom);
        }
        return ["No Blocks"=>"No Blocks"];
    }

    public function getFloor($id)
    {
        $blocks=AccommBlock::find($id);
        if(isset($blocks)){
            $blockAcom=AccommFloor::where('block_id',$blocks->id)->get();
            return response()->json($blockAcom);
        }
        return ["No Blocks"=>"No Blocks"];
    }

    public function getRoom($id)
    {
        //$block=AccomFloor::where('block_id',$id)->first();
        if(isset($id)){
            $room=AccommRoom::where('floor_id',$id)->get();
            return response()->json($room);
        }
        return ["No Blocks"=>"No Blocks"];
    }

    private function requestValidate($request)
    {
        // dd($request);
        return $request->validate(
            [
                'mhotelName'    => ['required', 'string'],
                'mblock'        => ['sometimes', 'string'],
                'mfloor'        => ['required' , 'string'],
                'mroomno'       => ['required', 'string']
            ],
            [
                'mhotelName.required' => 'Hotel Name is required & minimum 4 characters are required',
                'mblock.sometimes' => 'Block Name is required Name is required',
                'mfloor.required' => 'Floor level is required',
                'mroomno.required' => 'Room number is required',
            ]
        );
    }

}
