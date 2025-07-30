<?php

namespace App\Http\Controllers\Host;

use Exception;
use App\Models\Host\Host;
use App\Models\SiteDefault;
use App\Traits\ImageUpload;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Host\Ceramony;
use App\Models\Host\Invitation;
use Illuminate\Validation\Rule;
use App\Models\Admin\TaskMaster;
use App\Models\Host\Vendorables;
use App\Models\Host\CeramonyVenue;
use App\Http\Controllers\Controller;
use App\Models\Admin\CeramonyMaster;
use App\Models\Admin\LocationMaster;
use App\Models\Vendor\Service\Venue;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Storage;

class InvitationController extends Controller
{
    use ImageUpload, HasRoles;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($invi = null)
    {
        if (auth()->guard('host')->check()) {
            $host = auth()->guard('host')->user();
            $host = Host::where('id', $host->id)->with('profile')->first();
            $invitation = Invitation::where('host_id', $host->id)->with(['venues.location', 'venues.stateLocation'])->first();
          //  dd($invitation->venues, optional($invitation->venues));
            //dd($invitation->venues[0]);
            if ($invitation) {
                $invitation->venue_id = $invitation->venues[0]->id;
                $invitation->city  = LocationMaster::where('id', $invitation->location_id)->first()->id;
            }
            //dd($invitation);

           // $venues = Venue::latest()->orderBy('name', 'ASC')->get();
            $venues = Venue::orderBy('name', 'ASC')->get()->map(function ($city) {
                return ['name' => $city->name, 'code' => $city->id];
            });
            $hostvenues = $host->venues;
            foreach ($hostvenues as $hostvenue) {
                $newElement = ['name' => $hostvenue->name, 'code' => $hostvenue->id];
                $venues->prepend($newElement);
            }

           // dd($hostvenues);
            $locations = LocationMaster::orderBy('name', 'ASC')->get()->map(function ($city) {
                return ['name' => $city->name, 'code' => $city->id, 'state' => $city->state];
            });
            //dd($invitation);
            $active = 'invitation';
            return view('host.invitation.index', compact('host', 'invitation', 'venues', 'locations', 'active', 'hostvenues'));
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $host = auth()->guard('host')->user();
        $invitation = new Invitation();
        $pic = SiteDefault::where('name', 'invitationcover')->inRandomOrder()->first()->img;
        $venueList = Venue::latest()->where('status', 0)->orderBy('name')->get()->toArray();
        //dd($venueList);
        $host_venues = auth()->guard('host')->user()->venues->toArray() ?? [];
        $venues = collect(array_merge($host_venues, $venueList))->pluck('name', 'id');
        return view('host.invitation.create', compact('host', 'invitation', 'pic', 'venues'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request, Invitation $currentInvitation)
    {

        $host = auth()->guard('host')->user();
        $data =  $this->requestValidate($request, $host->id, $host->id);
        //dd($data);
        $data['brideEmail'] = strtolower($data['brideEmail']);
        $data['groomEmail'] = strtolower($data['groomEmail']);
        // if ($request->file('imageOne') == null) {
        //     $data['imageOne'] = SiteDefault::where('name','invitationcover')->inRandomOrder()->first()->img;
        // }

        if (auth()->guard('host')->check()) {
            try {
                if ($request->groomEmail == $request->brideEmail || $request->groomMobile == $request->brideMobile) {
                    return response([
                        'message' => 'Groom and Bride email/mobile cannot be same!!'
                    ], 422);
                }
                if ($host->email == $request->brideEmail || $host->mobile == $request->brideMobile) {
                    if($host->email == $request->brideEmail && $host->mobile == $request->brideMobile){
                        $role = $host->role;
                        array_push($role, 'bride');
                        //dd($role);
                        $host->update(['role' => $role]);
                    }else{
                        return response([
                            'message' => 'Bride email or mobile is alrady linked with another account!!'
                        ], 422);
                    }
                } elseif ((Host::all()->contains('mobile', $request->brideMobile)) || (Host::all()->contains('email', $request->brideEmail))) {
                    return response([
                        'message' => 'Bride email or mobile is alrady linked with another account!!'
                    ], 422);
                } else {
                    $bride = Host::create(['name' => $request->brideName, 'email' => $request->brideEmail, 'mobile' => $request->brideMobile, 'slug' => Str::slug($request->brideName), 'location_id' => $host->location_id, 'parent_id' => $host->id, 'password' => Hash::make($request->brideMobile), 'role' => ['bride']]);
                }


                if ($host->email == $request->groomEmail || $host->mobile == $request->groomMobile) {
                    if($host->email == $request->groomEmail && $host->mobile == $request->groomMobile){
                        $role = $host->role;
                        array_push($role, 'groom');
                        //dd($role);
                        $host->update(['role' => $role]);
                    }else{
                        return response([
                            'message' => 'Groom email or mobile is alrady linked with another account!!'
                        ], 422);
                    }
                } elseif ((Host::all()->contains('mobile', $request->groomMobile)) || (Host::all()->contains('email', $request->groomEmail))) {
                    return response([
                        'message' => 'Groom email or mobile is alrady linked with another account!!'
                    ], 422);
                } else {
                    $groom = Host::create(['name' => $request->groomName, 'email' => $request->groomEmail, 'mobile' => $request->groomMobile, 'role' => ['groom'], 'slug' => Str::slug($request->groomName), 'location_id' => $host->location_id, 'parent_id' => $host->id, 'password' => Hash::make($request->groomMobile), 'role' => ['groom']]);
                }

                //dd('succesfully');

                $invitation = Invitation::create($data + ['host_id' => auth()->guard('host')->user()->id, 'slug' => Str::slug($request->brideName . '-weds-' . $request->groomName . '-by-' . $host->name)]);

                $destImgPath = '/assets/defaults/ceramonies/images/Uploads/'.$invitation->host->slug.'/'.$invitation->slug;
                $path = 'Uploads/'.$invitation->host->slug.'/'.$invitation->slug;



                //code for finalize venue when invitation is saved
                $exists  = Vendorables::where('invitation_id', (int)$invitation->id)->where('vendorable_type', 'App\Models\Vendor\Service\Venue')->where('vendorable_id', (int)$data['venue_id'])->get();
                if (count($exists) == 0) {
                    Vendorables::create(['invitation_id' => $invitation->id, 'title' => 'Venue', 'vendorable_type' => "App\Models\Vendor\Service\Venue", 'vendorable_id' => (int)$data['venue_id']]);
                }
                //finalize code end


                if ($invitation) {
                    $invitation->venues()->attach($request->venue_id, ['invitation_id' => $invitation->id]);
                    //dd($invitation->venues);
                    if ($request->file('imageOne') != null) {

                        // $this->storeImage($invitation, $destImgPath, 'imageOne', $currentInvitation);
                        $img = time() . rand(1, 100) . '.' . $request->file('imageOne')->getClientOriginalExtension();
                        $request->file('imageOne')->move(public_path() . $destImgPath, $img);
                        $invitation->update(['imageOne' =>  $path .'/' . $img]);
                    }
                }

                $cera = Ceramony::create(['name' => 'wedding', 'imageOne' => Invitation::where('id', $invitation->id)->first()->imageOne, 'startDate' => date('Y-m-d', strtotime($request->startDate)), 'startTime' => date('H:i:s', strtotime($request->startDate)), 'ceremony_id' => CeramonyMaster::where('name', 'Wedding')->first()->id, 'invitation_id' => $invitation->id, 'slug' => $invitation->slug . '-' . $invitation->startDate . '-wedding']);
                if ($cera) {
                    CeramonyVenue::create(['ceramony_id' => $cera->id, 'invitation_id' => $invitation->id, 'venue_id' => $request->venue_id]);
                }


                $tasks = TaskMaster::where('parent_id', '!=', 'null')->each(function ($task) use ($invitation) {
                    $task->taskmaster()->attach($invitation);
                });

                $invi = Invitation::where('id', $invitation->id)->with(['venues.location', 'venues.stateLocation'])->first();
                $invi->venue_id = $invi->venues[0]->id;
                //dd($invi);

                return response([
                    'message' => $host->name . ' Invitation created successfully, Add SavetheDate for wedding',
                    'data' => $invi
                ]);
            } catch (Exception $e) {
                $bride->delete();
                $groom->delete();
                dd($e);
                return response([
                    'message' => $e->getMessage(),
                ], 422);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Invitation $invitation)
    {
        $pic = asset('storage/' . $invitation->imageOne);
        $host = auth()->guard('host')->user();
        return view('host.invitation.show', compact('host', 'invitation', 'pic'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Invitation $invitation)
    {
        $pic = '';
        $host = auth()->guard('host')->user();
        $venueList = Venue::latest()->where('status', 0)->orderBy('name')->get()->toArray();
        //dd($venueList);
        $host_venues = auth()->guard('host')->user()->venues->toArray() ?? [];
        $venues = collect(array_merge($host_venues, $venueList))->pluck('name', 'id');
        //dd($venues);
        //dd(array_merge($host_venues,$venueList));
        //$venues = Venue::pluck('name', 'id');
        return view('host.invitation.edit', compact('host', 'invitation', 'pic', 'venues'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Invitation $invitation, Request $request)
    {

        // return;
        // dd('helo');
        $currentInvitation = $invitation->imageOne;
        //dd($invitation, $request);
        $bride = Host::where('email', $invitation->brideEmail)->first();
if (!$bride) {
    return redirect()->back()->with('error', 'Bride host not found for the given email.');
}
$brideID = $bride->id;

$groom = Host::where('email', $invitation->groomEmail)->first();
if (!$groom) {
    return redirect()->back()->with('error', 'Groom host not found for the given email.');
}
$groomID = $groom->id;


        $data =  $this->requestValidate($request, $brideID, $groomID);
        $data['brideEmail'] = strtolower($data['brideEmail']);
        $data['groomEmail'] = strtolower($data['groomEmail']);
        $host = auth()->guard('host')->user();
        if ($invitation->host_id != $host->id) {
            return response([
                'message' => 'Something went wrong!',
            ], 422);
        }
        //$destImgPath = '\invitations' ;
        if (auth()->guard('host')->check()) {
            try {
                Host::where('email', $invitation->brideEmail)->update(['email' => $data['brideEmail'], 'mobile' => $data['brideMobile']]);
                Host::where('email', $invitation->groomEmail)->update(['email' => $data['groomEmail'], 'mobile' => $data['groomMobile']]);
                $newinvitation = $invitation->update($data + ['host_id' => auth()->guard('host')->user()->id])
                ;
                $destImgPath = '/assets/defaults/ceramonies/images/Uploads/'.$invitation->host->slug.'/'.$invitation->slug;
                $path = 'Uploads/'.$invitation->host->slug.'/'.$invitation->slug;
                //dd($invitation->id, $data);


                //code for finalize venue when invitation is saved
                $exists  = Vendorables::where('invitation_id', (int)$invitation->id)->where('vendorable_type', 'App\Models\Vendor\Service\Venue')->where('vendorable_id', (int)$data['venue_id'])->get();
                if (count($exists) == 0) {
                    Vendorables::create(['invitation_id' => $invitation->id, 'title' => 'Venue', 'vendorable_type' => "App\Models\Vendor\Service\Venue", 'vendorable_id' => (int)$data['venue_id']]);
                }
                //finalize code end


                if ($newinvitation) {
                    $invitation->venues()->sync($request->venue_id, ['invitation_id' => $invitation->id]);
                    //dd($invitation->venues);
                    if ($request->file('imageOne') != null) {
                        // $imggpath = asset('storage').$invitation->imageOne ;
                        // dd($imggpath);
                        $img = time() . rand(1, 100) . '.' . $request->file('imageOne')->getClientOriginalExtension();
                        $request->file('imageOne')->move(public_path() . $destImgPath, $img);
                        $invitation->update(['imageOne' =>  $path .'/' . $img]);
                    }
                }

                $cera = Ceramony::where('invitation_id', $invitation->id)->where('name', 'wedding')->first();
                $cera->update(['imageOne' => Invitation::where('id', $invitation->id)->first()->imageOne, 'startDate' => date('Y-m-d', strtotime($request->startDate)), 'startTime' => date('H:i:s', strtotime($request->startDate))]);
                if ($cera) {
                    $cera->venues()->update(['venue_id' => $request->venue_id]);
                }


                $invi = Invitation::where('id', $invitation->id)->with(['venues.location', 'venues.stateLocation'])->first();
                // if ($invi) {
                //     $invi->venue_id = $invi->venues[0]->id;
                //     $invi->city  = LocationMaster::where('id', $invi->location_id)->first()->name;
                // }
                $invi->venue_id = $invi->venues[0]->id;
                //dd($invi);

                return response([
                    'message' => $host->name . ' Invitation updated successfully',
                    'data' => $invi
                ]);

                // return redirect()->route('hostinvitations.index')
                //     ->with([
                //         'status' => 'success',
                //         'message' => $host->name . ' Invitation updated successfully'
                //     ]);
            } catch (Exception $e) {
                return response([
                    'message' => $e->getMessage(),
                ], 422);
            }
        }
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

    /**
     * Storing and updating the guest_image
     *
     * @param  App\Models\Host\Invitation
     * @return \Illuminate\Http\Response
     */

    private function requestValidate($request, $id = null, $id2 = null)
    {
        //dd($request);
        return $request->validate(
            [
                'brideName'         => ['required', 'string', 'min:3', 'max:100'],
                'brideMotherName'   => ['required', 'string', 'min:3', 'max:100'],
                'brideFatherName'   => ['required', 'string', 'min:2', 'max:50'],
                'brideEmail'        => ['required', 'email', Rule::unique('hosts', 'email')->ignore($id)],
                'brideMobile'       => ['required', 'digits:10', Rule::unique('hosts', 'mobile')->ignore($id)],
                'groomName'         => ['required', 'string'],
                'groomMotherName'   => ['required', 'string', 'min:3', 'max:100'],
                'groomFatherName'   => ['required', 'string', 'min:3', 'max:100'],
                'groomEmail'        => ['required', 'email', Rule::unique('hosts', 'email')->ignore($id2)],
                'groomMobile'       => ['required', 'digits:10', Rule::unique('hosts', 'mobile')->ignore($id2)],
                'startDate'         => ['required', 'date'],
                'side'        => ['required','string', 'not_in: ,\'\',null'],
                'location_id'        => ['required','string', 'not_in: ,\'\',null,"undefined",undefined'],
                //'endDate'           => ['required', 'date'],
                'venue_id'          => 'required|not_in:Select Venues',
                //'imageOne'          => 'image|sometimes|mimes:jpeg,png,jpg,gif,svg|max:20248'
            ],
            [
                'brideName.required' => 'Bride Name is required & minimum 3 characters are required',
                'brideMotherName.required' => 'Bride Mother name is required',
                'brideFatherName.required' => 'Bride Father Name is required',
                'brideEmail.required' => 'Bride Email is required',
                'brideMobile.required' => 'Bride Mobile is required',
                'groomName.required' => 'Groom Name is required',
                'groomMotherName.required' => 'Groom Mother name is required',
                'groomFatherName.required' => 'Groom Father Name is required',
                'groomEmail.required' => 'Groom Email is required',
                'groomMobile.required' => 'Groom Mobile is required',
                'startDate.required' => 'Wedding Starting Date is required',
                'side.required' => 'Select whose side you are on!!',
                'venue_id.required' => 'Wedding venue is Required',
                'location_id.required' => 'Wedding Location is Required',
                'location_id.not_in' => 'Wedding Location is Required',

            ]
        );
    }

    /**
     * Get locations for dropdown
     */
    public function getLocations()
    {
        // Get locations from both tables
        $adminLocations = LocationMaster::select('id', 'name')
            ->where('status', 1)
            ->get();
        
        $hostLocations = \App\Models\LocationMaster::select('id as code', 'city as name', 'state')
            ->where('status', 1)
            ->get();
        
        // Combine the results
        $locations = $adminLocations->map(function($location) {
            return [
                'id' => $location->id,
                'name' => $location->name,
                'code' => $location->id,
                'source' => 'admin'
            ];
        });
    
        $hostLocations = $hostLocations->map(function($location) {
            return [
                'id' => $location->code,
                'name' => $location->name,
                'state' => $location->state,
                'code' => $location->code,
                'source' => 'host'
            ];
        });
    
        // Merge and remove duplicates
        $allLocations = $locations->concat($hostLocations)->unique('name');
    
        return response()->json([
            'success' => true,
            'data' => $allLocations
        ]);
    }
}



