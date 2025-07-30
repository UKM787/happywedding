<?php

namespace App\Http\Controllers\Host;

use Exception;
use App\Models\Host\Host;
use App\Models\Vendor\Service\Venue;
use App\Models\SiteDefault;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Host\Ceramony;
use App\Models\Host\Invitation;
use App\Models\Admin\CeramonyMaster;
use App\Http\Controllers\Controller;
use App\Traits\ImageUpload;
use App\Models\Host\Vendorables;
use App\Models\Event;

class CeramonyController extends Controller {

    use ImageUpload;
    protected $ceramonyImages = [];
    protected $ceramonyAdded = [];
    protected $venuelist = [];

    public function __construct(){
        $this->venuelist =  Venue::latest()->orderBy('name','ASC')->pluck('name', 'id');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($invi = null) {
        if(auth()->guard('host')->user()) {
            if($invi == null){
                return redirect(route('hostinvitations.index'));
            }
            $host = auth()->guard('host')->user();
            $host = Host::where('id', $host->id)->with('profile')->first();
            $venueList = Venue::latest()->orderBy('name', 'ASC')->where('status' , 0)->get()->toArray();
            //dd($venueList);
            $host_venues = $host->venues->toArray() ?? [];
            //dd($host_venues);
            //Venue::latest()->orderBy('name','ASC')->get();
            $venues = collect(array_merge($host_venues,$venueList));
            //dd($venues);
            $invitation = Invitation::where('slug', $invi)->first();
                $ceramonies = $invitation->ceramonies($invitation)->orderBy('startDate', 'asc')->orderBy('startTime', 'asc')->with('venues')->get();
                //dd($ceramonies);
                $ceramonyAdded = $invitation->ceramonies->pluck('name')->toArray();
                $ceramonyName = CeramonyMaster::orderBy('type', 'asc')->where('name', '!=', 'Custom')->whereNotin('name', $ceramonyAdded)->get()->map->only('name', 'id', 'type')->toArray();
                $custom = CeramonyMaster::where('name', 'Custom')->get()->map->only('name', 'id')->first();
                array_push($ceramonyName, $custom);
                $active = 'ceramonies';
                $hostvenues = $host->venues;

                //dd($venues);
                return view('host.invitation.ceramony.index', compact('host', 'invitation', 'ceramonies','venues', 'ceramonyName', 'active', 'hostvenues'));
        }
        else {
            return redirect(route('hostwelcome'));
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Invitation $invitation) {

            $host = auth()->guard('host')->user();
            $ceramonyAdded = $invitation->ceramonies->pluck('name')->toArray();
            //dd($ceramonyAdded);
            $ceramonyData = [];

            $ceramonyName = CeramonyMaster::orderBy('type', 'asc')->where('parent_id', '!=', 0)->whereNotin('name', $ceramonyAdded)->get()->map(function ($cera) {
                $ceramonyData['name'] = $cera->name;
                $ceramonyData['type'] = $cera->type;
                $ceramonyData['imageOne'] = CeramonyMaster::where('name', $cera->name)->inRandomOrder()->first()->imageOne;
                $ceramonyData['ladiesDress'] =  SiteDefault::where('name', 'ceramony-ladiesdress')->inRandomOrder()->first()->img;
                $ceramonyData['gentsDress'] =  SiteDefault::where('name', 'ceramony-gentsdress')->inRandomOrder()->first()->img;
                return $ceramonyData;
            });

            $ceramonyType = $ceramonyName->all();
            //dd($ceramonyType, $ceramonyName, $ceramonyAdded );
            $ceramony = new Ceramony();
            $venueList = Venue::latest()->where('status' , 0)->orderBy('name')->get()->toArray();
            //dd($venueList);
            $host_venues = auth()->guard('host')->user()->venues->toArray() ?? [];
            $hostvenues = $host->venues;
            $venues = collect(array_merge($host_venues,$venueList))->pluck('name', 'id');
            return view('host.invitation.ceramony.create', compact('host', 'invitation', 'ceramony', 'venues', 'hostvenues'))->with(['ceramonyType' => $ceramonyType]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Invitation $invitation, Request $request, Ceramony $currentCeramony) {


        //dd($invitation->ceramonies->firstWhere('name', $request->name));
        //dd($request);
        $data =  $this->requestValidate($request);
        $data['name'] = strtolower($request->name);
        //$invitation = Invitation::where('id', (int)$invi->id)->first();
        
        $cerId = CeramonyMaster::where('name', ucfirst($data['name']))->pluck('id')->first();
        if($cerId == null){
            $cerId = CeramonyMaster::where('name', "Custom")->pluck('id')->first();
        }
        //dd($cerId);
      if($invitation->ceramonies->firstWhere('name', strtolower($request->name)) == null){
            //dd($data);
            $destImgPath = '/assets/defaults/ceramonies/images/Uploads/'.$invitation->host->slug.'/'.$invitation->slug;
            $path = 'Uploads/'.$invitation->host->slug.'/'.$invitation->slug;
            //dd($destImgPath);
            if(CeramonyMaster::all()->whereIn('name', $request->name)->count() > 0 ){
                if ($request->file('imageOne') == null) {
                    //dd(CeramonyMaster::where('name', '=', $request->name)->first()->imageOne[0]);
                    $data['imageOne'] = CeramonyMaster::where('name', '=', $request->name)->first()->imageOne[0];
                }
                else {
                    $data['imageOne'] = $request->file('imageOne');
                }
            }else {
                if ($request->file('imageOne') == null) {
                    $data['imageOne'] = CeramonyMaster::where('name', '=', 'Custom')->first()->imageOne[0];
                } else {

                    $data['imageOne'] = $request->file('imageOne');
                }
            }

            if ($request->file('imageTwo') == null) {
                // $data['imageTwo'] =  SiteDefault::where('name', 'ceramony-ladiesdress')->inRandomOrder()->first()->img;
            } else {
                $data['imageTwo'] = $request->file('imageTwo');
            }
            if ($request->file('imageThree') == null) {
                // $data['imageThree'] = SiteDefault::where('name', 'ceramony-gentsdress')->inRandomOrder()->first()->img;
            } else {
                $data['imageThree'] = $request->file('imageThree');
            }

            if (auth()->guard('host')->check()) {
                $host = auth()->guard('host')->user();
                try {
                    //dd('command', $data);
                    $ceramony = Ceramony::create($data + ['invitation_id' => $invitation->id, 'ceremony_id' => $cerId ,'slug' => Str::slug($request->name.'-'.$request->startDate.'-'.$request->endDate)]);
                    
                    // Create corresponding calendar event
                    Event::create([
                        'title' => $ceramony->name,
                        'start' => $ceramony->startDate . ' ' . $ceramony->startTime,
                        'end' => $ceramony->startDate . ' ' . $ceramony->startTime
                    ]);
                    //dd($ceramony, $data);
                    //code for finalize venue when invitation is saved
                    $exists  = Vendorables::where('invitation_id', (int)$invitation->id)->where('vendorable_type', 'App\Models\Vendor\Service\Venue')->where('vendorable_id', (int)$request->venue_id)->get();
                    if(count($exists) == 0){
                        Vendorables::create(['invitation_id' =>$invitation->id,'title' =>'Venue', 'vendorable_type' => "App\Models\Vendor\Service\Venue", 'vendorable_id' => (int)$request->venue_id]);
                    }
                    //finalize code end

                   // dd('sss');
                    $ceramony->venues()->attach($request->venue_id, ['invitation_id' => $invitation->id]);
                    //dd($this->storeImage($ceramony, $destImgPath, 'imageOne', $currentCeramony));
                    if ($ceramony) {
                        if ($request->file('imageOne') != null) {
                            $img = time() . rand(1, 100) . '.' . $request->file('imageOne')->getClientOriginalExtension();
                            $request->file('imageOne')->move(public_path() . $destImgPath, $img);
                            $ceramony->update(['imageOne' =>  $path .'/' . $img]);
                            //$this->storeImage($ceramony, $destImgPath, 'imageOne', $currentCeramony);
                        }
                        if ($request->file('imageTwo') != null) {
                            $img = time() . rand(1, 100) . '.' . $request->file('imageTwo')->getClientOriginalExtension();
                            $request->file('imageTwo')->move(public_path() . $destImgPath, $img);
                            $ceramony->update(['imageTwo' =>  $path .'/' . $img]);
                            //$this->storeImage($ceramony, $destImgPath, 'imageTwo', $currentCeramony);
                        }
                        if ($request->file('imageThree') != null) {
                            $img = time() . rand(1, 100) . '.' . $request->file('imageThree')->getClientOriginalExtension();
                            $request->file('imageThree')->move(public_path() . $destImgPath, $img);
                            $ceramony->update(['imageThree' =>  $path.'/' . $img]);
                            //$this->storeImage($ceramony, $destImgPath, 'imageThree', $currentCeramony);
                        }
                    }
                    //dd('hmne');

                    //dd(count($invitation->ceramonies));
                    // if(count($invitation->ceramonies) == 9){
                       // dd('uploaded');
                       //dd($invitation->id);
                       
                       $invi = Invitation::where('id', $invitation->id)->first();
                       $ceramonies = $invitation->ceramonies($invitation)->orderBy('startDate', 'asc')->orderBy('startTime', 'asc')->with('venues')->get();
                       $ceramonyAdded = $invi->ceramonies->pluck('name')->toArray();
                       $ceramonyName = CeramonyMaster::orderBy('type', 'asc')->where('name', '!=', 'Custom')->whereNotin('name', $ceramonyAdded)->get()->map->only('name', 'id')->toArray();
                       $custom = CeramonyMaster::where('name', 'Custom')->get()->map->only('name', 'id', 'type')->first();
                        array_push($ceramonyName, $custom);
                       //dd($ceramonies);

                       return [$ceramonies, $ceramonyName];
                        // return redirect()->route('invitedguests.index', [$invitation])
                        // ->with([
                        //     'status' => 'success',
                        //     'message' => $host->name . ' ceramony created successfully, Add Guestlist '
                        // ]);
                    // }else{
                    //     return redirect()->route('hostceramony.create', [$invitation])
                    //     ->with([
                    //         'status' => 'success',
                    //         'message' => $host->name . ' ceramony created successfully, Add More '
                    //     ]);
                    // }

                } catch (Exception $e) {
                    //dd('errpr', $e->getMessage());
                     return response()->json([
                            'message'    => 'Something went wrong!',
                            'errors' => $e->getMessage(),
                        ], 422);
                    }
                //     return redirect()->back()->with([
                //         'status' => 'failure',
                //         'message' => $e->getMessage()
                //     ]);
                // }
            }
      } else {
         return response()->json([
                            'message'    => 'This ceramony alaready exists for this inviation, Add Another!',
                            //'errors' => $e->getMessage(),
                        ], 422);
                    
            // return redirect()->route('hostceramony.create', [$invitation])
            //     ->with([
            //         'status' => 'failure',
            //         'message' => ' this ceramony alaready exists for this inviation, Add Another '
            //     ]);
      }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Invitation $invitation, Ceramony $ceramony)  {
        $venueList = Venue::latest()->where('status' , 0)->orderBy('name')->get()->toArray();
        //dd($venueList);
        $host_venues = auth()->guard('host')->user()->venues->toArray() ?? [];
        $venues = collect(array_merge($host_venues,$venueList))->pluck('name', 'id');
        $host = auth()->guard('host')->user();
        return view('host.invitation.ceramony.show', compact('host','invitation','ceramony','venues'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Invitation $invitation, Ceramony $ceramony)  {
        $venueList = Venue::latest()->where('status' , 0)->orderBy('name')->get()->toArray();
        //dd($venueList);
        $host_venues = auth()->guard('host')->user()->venues->toArray() ?? [];
        $venues = collect(array_merge($host_venues,$venueList))->pluck('name', 'id');
        $host = auth()->guard('host')->user();
        CeramonyMaster::inRandomOrder()->each(function ($ceramony) {
            return $this->ceramonyImages[$ceramony->name] = collect([$ceramony->name, $ceramony->type, $ceramony->imageOne, SiteDefault::where('name', 'ceramony-ladiesdress')->inRandomOrder()->first()->img, SiteDefault::where('name', 'ceramony-gentsdress')->inRandomOrder()->first()->img]);
        });
        $val = ['','','','',''];
        return view('host.invitation.ceramony.edit', compact('host', 'invitation', 'ceramony',  'venues', 'val'))->with(['ceramonyImages' => $this->ceramonyImages]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Invitation $invitation, Ceramony $ceramony, Request $request) {
        //dd($invitation->ceramonies->firstWhere('name', $request->name)->id , $ceramony->id,$invitation->ceramonies->firstWhere('name', $request->name)->id != $ceramony->id);
        //dd($ceramony);
        // /dd($request);
        $data =  $this->requestValidate($request);
        $data['name'] = strtolower($request->name);

    
        if($invitation->ceramonies->firstWhere('name', strtolower($request->name))->id == $ceramony->id){

            $imgOne = $ceramony->imageOne;
            $imgTwo = $ceramony->imageTwo;
            $imgThree = $ceramony->imageThree;
            $destImgPath = '/assets/defaults/ceramonies/images/Uploads/'.$invitation->host->slug.'/'.$invitation->slug;
            $path = 'Uploads/'.$invitation->host->slug.'/'.$invitation->slug;
            //dd($data, $ceramony);
            if (auth()->guard('host')->check()) {
                $host = auth()->guard('host')->user();
                try {
                    $newceramony =$ceramony->update($data + ['invitation_id' => $invitation->id, 'slug' => Str::slug($request->name.'-'.$request->startDate.'-'.$request->endDate)]);
                    //dd('ss');
                    
                    //code for finalize venue when invitation is saved
                    $exists  = Vendorables::where('invitation_id', (int)$invitation->id)->where('vendorable_type', 'App\Models\Vendor\Service\Venue')->where('vendorable_id', (int)$request->venue_id)->get();
                    if(count($exists) == 0){
                        Vendorables::create(['invitation_id' =>$invitation->id,'title' =>'Venue', 'vendorable_type' => "App\Models\Vendor\Service\Venue", 'vendorable_id' => (int)$request->venue_id]);
                    }
                    //finalize code end


                    $ceramony->venues()->sync([$request->venue_id]);
                    if ($newceramony) {
                        if ($request->file('imageOne') != null) {
                            $img = time() . rand(1, 100) . '.' . $request->file('imageOne')->getClientOriginalExtension();
                            $request->file('imageOne')->move(public_path() . $destImgPath, $img);
                            $ceramony->update(['imageOne' =>  $path .'/' . $img]);
                            //$this->storeImage($ceramony, $destImgPath, 'imageOne', $currentCeramony);
                        }
                        if ($request->file('imageTwo') != null) {
                            $img = time() . rand(1, 100) . '.' . $request->file('imageTwo')->getClientOriginalExtension();
                            $request->file('imageTwo')->move(public_path() . $destImgPath, $img);
                            $ceramony->update(['imageTwo' =>  $path .'/' . $img]);
                            //$this->storeImage($ceramony, $destImgPath, 'imageTwo', $currentCeramony);
                        }
                        if ($request->file('imageThree') != null) {
                            $img = time() . rand(1, 100) . '.' . $request->file('imageThree')->getClientOriginalExtension();
                            $request->file('imageThree')->move(public_path() . $destImgPath, $img);
                            $ceramony->update(['imageThree' =>  $path.'/' . $img]);
                            //$this->storeImage($ceramony, $destImgPath, 'imageThree', $currentCeramony);
                        }
                    }

                    if($data['name'] == 'wedding'){
                        $cera = Ceramony::where('id', $ceramony->id)->first();
                        $invitation->update(['imageOne' => $cera->imageOne, 'startDate' => $cera->startDate.' '.$cera->startTime]);
                        $invitation->venues()->sync($request->venue_id, ['invitation_id' => $invitation->id]);
                    }

                    $invi = Invitation::where('id', $invitation->id)->first();
                    $ceramonies = $invitation->ceramonies($invitation)->orderBy('startDate', 'asc')->orderBy('startTime', 'asc')->with('venues')->get();
                    $ceramonyAdded = $invi->ceramonies->pluck('name')->toArray();
                    $ceramonyName = CeramonyMaster::orderBy('type', 'asc')->where('name', '!=', 'Custom')->whereNotin('name', $ceramonyAdded)->get()->map->only('name', 'id', 'type')->toArray();
                    $custom = CeramonyMaster::where('name', 'Custom')->get()->map->only('name', 'id')->first();
                    array_push($ceramonyName, $custom);
                    //dd($ceramonies);

                    return [$ceramonies, $ceramonyName];

                } catch (Exception $e) {
                    //dd('ee');
                    return response()->json([
                            'message'    => 'Something went wrong!',
                            'errors' => $e->getMessage(),
                        ], 422);
                    
                }
            }
        } else {
            return response()->json([
                'message'    => 'This ceramony alaready exists for this inviation, Add Another!',
                //'errors' => $e->getMessage(),
            ], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invitation $invitation, $id)
    {
        //dd($invitation, $id);
        $ceramony = Ceramony::where('id', (int)$id)->first();
        if($ceramony){
            $ceramony->delete();
            $invi = Invitation::where('id', $invitation->id)->first();
            $ceramonies = $invitation->ceramonies($invitation)->with('venues')->get();
            $ceramonyAdded = $invi->ceramonies->pluck('name')->toArray();
            $ceramonyName = CeramonyMaster::orderBy('type', 'asc')->where('name', '!=', 'Custom')->whereNotin('name', $ceramonyAdded)->get()->map->only('name', 'id', 'type')->toArray();
            $custom = CeramonyMaster::where('name', 'Custom')->get()->map->only('name', 'id')->first();
            array_push($ceramonyName, $custom);
            //dd($ceramonies, $ceramonyName);
            return [$ceramonies, $ceramonyName];
        }else{
            return response([
                'message' => 'Please try again later'
            ], 422);
        }
    }

    /**
     * Storing and updating the guest_image
     *
     * @param  App\Models\Host\Invitation
     * @return \Illuminate\Http\Response
     */

    private function requestValidate($request)
    {
        return $request->validate([
            'name'              => ['required'],
            'startDate'         => ['required'],
            'startTime'           => ['required'],
            'venue_id'           => ['required'],
            'ladiesDress'         => ['sometimes'],
            'menDress'           => ['sometimes'],
            // 'ceremony_id' => ['required'],
            //'imageOne'          => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:20248',
            //'imageTwo'          => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:20248',
            //'imageThree'        => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:20248'
        ]);
    }

}
