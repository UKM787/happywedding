<?php

namespace App\Http\Controllers\Host;

use Exception;
use App\Models\Host\Host;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Admin\VendorMaster;
use App\Http\Controllers\Controller;
use App\Models\Admin\CategoryMaster;
use App\Models\Admin\LocationMaster;
use App\Models\Vendor\Service\Venue;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;

class VenueController extends Controller
{
    public $venues, $categories, $locations;

    public function __construct()
    {
        $this->venues = Venue::latest()->get();
        $this->locations = LocationMaster::orderBy('name', 'ASC')->pluck('id', 'name');
        $this->categories = CategoryMaster::latest()->whereNotNull('parent_id')->pluck('id', 'name');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$host = auth()->guard('host')->user();
        //$venues = Venue::where('host_id',$host->id)->get();
        // $venues->transform(function ($venue) {
        //     return [
        //         'id' => $venue->id,
        //         'name' => $venue->nameOfPlace
        //     ];
        // });

        // Do not comment out- used to give slug to venues
        // $venues = Venue::all();
        // foreach($venues as $venue){
        //     $name = str_replace(' ', '', $venue->slug);
        //     $venue->update(['slug' => Str::slug($name, '-', 'en') . '-' . rand(1, 10000)]);
        //     //dd($venue->slug);
        // }
        // dd($venues);

        if (auth()->guard('host')->check()) {
            if ($request->city) {
                $venueList = Venue::latest()->where('status', 0)->where('location_id', $request->city)->orderBy('name')->get()->toArray();
                $host_venues = auth()->guard('host')->user()->venues->toArray() ?? [];
                $venues = json_encode(array_merge($host_venues, $venueList));
                $city  = $request->city;
                $type  = $request->type;
                $state = $request->state;
                $states = LocationMaster::all();
                $vendorCat = VendorMaster::where('name', 'Wedding Venues')->first();
                $subCat = VendorMaster::where('parent_id', $vendorCat->id)->get();
                return view('host.venue.index')->with(['host' => auth()->guard('host')->user(), 'venues' => $venues, 'states' => $states, 'city' => $city, 'type' => $type, 'state' => $state, 'subCat' => $subCat]);
            } else {
                $venueList = Venue::latest()->where('status', 0)->orderBy('name')->get()->toArray();
                // dd($venueList);
                $host_venues = auth()->guard('host')->user()->venues->toArray() ?? [];
                $venues = json_encode(array_merge($host_venues, $venueList));
                //dd($venues, $host_venues, $venueList);
                //dd(Venue::latest()->orderBy('name')->get());
                $states = LocationMaster::all();
                $city  = null;
                $type  = null;
                $state = null;
                $vendorCat = VendorMaster::where('name', 'Wedding Venues')->first();
                $subCat = VendorMaster::where('parent_id', $vendorCat->id)->get();
                //$venues = Venue::latest()->orderBy('name')->paginate(12);
                return view('host.venue.index')->with(['host' => auth()->guard('host')->user(), 'venues' => $venues, 'states' => $states, 'city' => $city, 'type' => $type, 'state' => $state, 'subCat' => $subCat]);
            }
        } else {
            return redirect()->route('hostLogin');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // dd(url()->previous());
        //dd(Session::get('prev'));


        //dd(Session::get('prev'));

        //    if(Session::has('prev')){
        //     if(Session::get('prev') == "http://wedding.test/host/venues/create"){
        //         $prevUrl = route('hostinvitations.index');
        //     }else{
        //         $prevUrl = Session::get('prev');
        //     }
        //    }else{
        //     $prevUrl = url()->previous();
        //    }

        if (Session::has('prev')) {
            if (Session::get('prev') == "http://wedding.test/host/venues/create" || Session::get('prev') == null) {
                $prevUrl = route('hostinvitations.index');
            } else {
                $prevUrl = Session::get('prev');
            }
        } else {
            if (url()->previous() == "http://wedding.test/host/venues/create") {
                $prevUrl = route('hostinvitations.index');
            } else {
                $prevUrl = url()->previous();
            }
        }

        //dd(Session::has('prev'));

        //    if(Session::has('prev') == false){
        //         session(['prev' => $prevUrl]);
        //    }
        $host = auth()->guard('host')->user();
        return view('host.venue.create')->with(['host' => $host, 'venue' => new Venue(), 'categories' => $this->categories, 'locations' => $this->locations, 'vendor' => null, 'prevUrl' => $prevUrl]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (auth()->guard('host')->check()) {
            try {
                $data = $this->requestValidate($request);
                $host = auth()->guard('host')->user();
                
                // Create the venue with the polymorphic relationship
                $venue = new \App\Models\Vendor\Service\Venue($data + [
                    'status' => 1, 
                    'category_id' => 2, 
                    'slug' => Str::slug($request->name, '-', 'en') . '-' . rand(1, 10000),
                    'venueable_type' => get_class($host),
                    'venueable_id' => $host->id
                ]);
                
                // Save the venue
                $venue->save();
                
                // Get all venues for the host using the relationship
                $venues = $host->venues;
                
                return response()->json([
                    'success' => true,
                    'data' => [
                        'venue' => [
                            'id' => $venue->id,
                            'name' => $venue->name,
                            'address' => $venue->address
                        ],
                        'all' => $venues->map(function($venue) {
                            return [
                                'id' => $venue->id,
                                'name' => $venue->name,
                                'address' => $venue->address
                            ];
                        })
                    ],
                    'message' => 'Venue Added Successfully!'
                ]);
            } catch (\Illuminate\Validation\ValidationException $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation Error',
                    'errors' => $e->errors()
                ], 422);
            } catch (Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Something went wrong: ' . $e->getMessage()
                ], 500);
            }
        }
        return response()->json([
            'success' => false,
            'message' => 'Unauthorized'
        ], 401);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Venue $venue)
    {
        $host = auth()->guard('host')->user();
        return view('host.venue.show', compact('host', 'venue'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Venue $venue)
    {
        $host = auth()->guard('host')->user();
        return view('host.venue.edit', compact('host', 'venue'))->with(['categories' => $this->categories, 'locations' => $this->locations]);
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
       // dd($request);
        $data =  $this->requestValidate($request);
        if (auth()->guard('host')->check()) {
            $host = auth()->guard('host')->user();
            try {
                $existingVenue = Venue::where('id', (int)$id)->first();
                $existingVenue->update($data+['slug' => Str::slug($request->name, '-', 'en') . '-' . rand(1, 10000)]);
                $venues = $host->venues;
                return response([
                    'data' => Venue::where('id', (int)$id)->first(),
                    'all' => $venues,
                    'message' => 'Venue Updated Successfully!',
                ]);
            } catch (Exception $e) {
                return response([
                    'message' => 'Something went wong',
                ]);
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

    private function requestValidate($request)
    {
        return $request->validate([
            'name'          =>  ['required', 'string', 'min:3', 'max:255'],
            'description'   =>  ['sometimes', 'string', 'min:3', 'max:1024'],
            'address'       =>  ['required', 'string', 'min:3', 'max : 255'],
            'longitude'     =>  ['sometimes', 'string', 'min:3', 'max:20'],
            'latitude'      =>  ['sometimes', 'string', 'min:3', 'max:20'],
            'map'           =>  ['sometimes', 'string'],
            'status'        =>  ['sometimes'],
            'priority'      =>  ['sometimes'],
            'icon'          =>  ['sometimes', 'string'],
            'category_id'   =>  ['sometimes'],
            'state'   =>  ['sometimes'],
            'location_id'   =>  ['sometimes'],
            'imageOne'      => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
    }

    private function storeImage($data, $folder, $image)
    {
        if (request()->has($image)) {
            // resizing image using intrvention/image
            if ($data->update([$image => request()->$image->store($folder, 'public')])) {
                $guest_image = Image::make(public_path('storage/' . $data->$image))->fit(100, 100);
                $guest_image->save();
            }
        }
    }

    public function weddingVenues()
    {
        $venues = Venue::all();
        //$venues = Venue::where('host_id',$host->id)->get();
        // $venues->transform(function ($venue) {
        //     return [
        //         'id' => $venue->id,
        //         'name' => $venue->nameOfPlace
        //     ];
        // });
        $venue = new Venue();
        return view('host.venue.weddingVenues', compact('venues', 'venue'));
    }
}
