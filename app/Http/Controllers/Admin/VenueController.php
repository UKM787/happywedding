<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Admin\CategoryMaster;
use App\Http\Controllers\Controller;
use App\Models\Admin\LocationMaster;
use App\Models\Vendor\Service\Venue;

class VenueController extends Controller
{

    public $venues, $categories, $locations;

    public function __construct()
    {
        $this->venues = Venue::latest()->get();
        $this->locations = LocationMaster::orderBy('name', 'ASC')->pluck('id', 'name');
        $categories = CategoryMaster::latest()->whereNotNull('parent_id')->pluck('id', 'name');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $venues = Venue::with(['location', 'stateLocation'])->latest()->paginate(15);
        $categories = CategoryMaster::latest()->whereNotNull('parent_id')->pluck('name', 'id');
        $locations = LocationMaster::paginate(15);
        $loggedIn = auth()->guard('admin')->user();
        return view('admin.venues.index', compact('venues', 'loggedIn', 'categories', 'locations'))->with('i', (request()->input('page', 1) - 1) * 15);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $loggedIn = auth()->guard('admin')->user();
        $locations = LocationMaster::pluck('id', 'name');
        $categories = CategoryMaster::latest()->whereNotNull('parent_id')->pluck('name', 'id');
        $venue = new Venue();
        return view('admin.venues.create', compact('loggedIn', 'locations', 'venue', 'categories'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->requestValidate($request);

        // $data['category_id'] = empty($data['category_id']) ? Null : $data['category_id'];
        $data['status'] = $request->input('status') == 'on' ? 1 : 0;

        // Handle locationmaster_id and state_id from the form
        $data['locationmaster_id'] = $request->locationmaster_id;
        $data['state_id'] = $request->state_id;

        $data['slug'] = Str::slug($request->name, '-', 'en') . '-' . rand(1, 10000);
        $admin = auth()->guard('admin')->user();

        if ($imageOne = $request->file('imageOne')) {
            $destinationPath = 'assets/venues';
            $locationImage = $data['slug'] . '-' . date('YmdHis') . "." . $imageOne->getClientOriginalExtension();
            $imageOne->move($destinationPath, $locationImage);
            $data['imageOne'] = "$locationImage";
        } else {
            $data['imageOne'] = 'venueDefault.png';
        }
        try {
            $admin->venues()->create($data);
            return redirect()->route('adminvenues.index')->with('success', "$request->name added successfully.");
        } catch (Exception $e) {
            return redirect()->back()->with([
                'status' => 'failure',
                'message' => $e->getMessage()
            ]);
        }

        return redirect()->back()->with(['status' => "added successfully"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Venue $venue)
    {
        $categories = CategoryMaster::latest()->whereNotNull('parent_id')->pluck('name', 'id');
        $loggedIn = auth()->guard('admin')->user();
        return view('admin.venues.show', compact('venue', 'venuecats', 'loggedIn'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Venue $venue)
    {
        $loggedIn = auth()->guard('admin')->user();
        // $venue = Venue::findOrFail($id);
        $locations = LocationMaster::pluck('id', 'name');
        $venues = Venue::where('category_id', null)->get();
        $categories = CategoryMaster::latest()->whereNotNull('parent_id')->pluck('id', 'name');

        // Ensure state_id and locationmaster_id are set for the form
        // If they're not set but we have string values, try to find the IDs
        if (empty($venue->state_id) && !empty($venue->state)) {
            $stateRecord = LocationMaster::where('name', $venue->state)->where('parent_id', 1)->first();
            if ($stateRecord) {
                $venue->state_id = $stateRecord->id;
            }
        }

        if (empty($venue->locationmaster_id) && !empty($venue->city)) {
            $cityRecord = LocationMaster::where('name', $venue->city)->whereNotNull('parent_id')->where('parent_id', '!=', 1)->first();
            if ($cityRecord) {
                $venue->locationmaster_id = $cityRecord->id;
            }
        }

        //dd($venues,$venuecats);
        return view('admin.venues.edit', compact('loggedIn', 'locations', 'categories', 'venues', 'venue'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Venue $venue, Request $request)
    {
        $data = $this->requestValidate($request);
        $data['category_id'] = empty($data['category_id']) ? null : $data['category_id'];
        $data['status'] = $request->input('status') == 'on' ? 1 : 0;

        // Handle locationmaster_id and state_id from the form
        $data['locationmaster_id'] = $request->locationmaster_id;
        $data['state_id'] = $request->state_id;

        // Also save the string values for backward compatibility
        if ($request->state_id) {
            $stateRecord = LocationMaster::find($request->state_id);
            if ($stateRecord) {
                $data['state'] = $stateRecord->name;
            }
        }

        if ($request->locationmaster_id) {
            $cityRecord = LocationMaster::find($request->locationmaster_id);
            if ($cityRecord) {
                $data['city'] = $cityRecord->name;
            }
        }

        $data['slug'] = Str::slug($request->description);
        if ($image = $request->file('imageOne')) {
            $destinationPath = 'assets/venues';
            $locationImage = $data['slug'] . '-' . date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $locationImage, 'public');
            $data['imageOne'] = "$locationImage";
        } else {
            unset($data['imageOne']);
        }
        $data['venueable_type'] = $venue->venueable_type;
        $data['venueable_id'] = $venue->venueable_id;
        //dd($data, $venue);
        try {
            $venue->update($data);
            return redirect()->route('adminvenues.index')
                ->with('success', 'New venue added successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with([
                'status' => 'failure',
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Venue $venue)
    {
        $venue->delete();
        return redirect()->route('adminvenues.index')
            ->with('status', "$venue->name deleted successfully");
    }

    public function requestValidate(Request $request)
    {
        return $request->validate(
            [
                'name'          =>  ['required', 'string', 'min:3', 'max:255'],
                'description'   =>  ['required', 'string', 'min:3', 'max:1024'],
                'address'       =>  ['required', 'string', 'min:3', 'max : 255'],
                'landline'      =>  ['nullable', 'string', 'max:20'],
                'number_2'      =>  ['nullable', 'string', 'max:20'],
                'email'         =>  ['nullable', 'email', 'max:255'],
                'watsapp'       =>  ['nullable', 'string', 'max:20'],
                'longitude'     =>  ['sometimes', 'string', 'min:3', 'max:20'],
                'latitude'      =>  ['sometimes', 'string', 'min:3', 'max:20'],
                'map'           =>  ['sometimes', 'string'],
                'status'        =>  ['sometimes'],
                'priority'      =>  ['sometimes'],
                'icon'          =>  ['sometimes', 'string'],
                'category_id'   =>  ['sometimes'],
                'state_id'      =>  ['required', 'integer', 'exists:locationmaster,id'],
                'locationmaster_id'   =>  ['required', 'integer', 'exists:locationmaster,id'],
                'imageOne'      => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ],
            [
                'name.required' => 'Name of Hall is required',
                'description.required' => 'Name of Place Name is required & minimum 3 characters are required',
                'address.required' => 'Adress is required',
                'email.email' => 'Please enter a valid email address',
                'longitude.required' => 'enter logitude',
                'latitude.required' => 'enter latitude',
                'state_id.required' => 'State is required',
                'state_id.exists' => 'Selected state is invalid',
                'locationmaster_id.required' => 'City Name is required',
                'locationmaster_id.exists' => 'Selected city is invalid',
                'priority.required' => 'Choose prioirty'
            ]
        );
    }
}
