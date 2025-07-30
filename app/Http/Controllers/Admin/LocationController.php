<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Wed\Happy;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\LocationMaster;

class LocationController extends Controller
{
    public $locations, $states, $allCity, $stateCount, $cityCount;

    public function __construct()
    {
        // $this->locations =  LocationMaster::all()->filter(function ($val, $key) {
        //     if ($val['parent_id'] == 1) {
        //         return true;
        //     } 
        // });
        //->where('parent_id', '!=', NUll)
        // $this->items = VendorMaster::whereNull('parent_id')->paginate(10);
        // $this->vendors = VendorMaster::with('children')->get();
        // $this->categories = VendorMaster::latest()->whereNull('parent_id')->orderBy('parent_id', 'ASC')->orderBy('name', 'ASC')->get();
        // $this->states = LocationMaster::all()->filter(function ($val, $key) {
        //     if ($val['parent_id'] == 1 && $val['status'] == 1) {
        //         return true;
        //     }
        // });

        // $this->locations = LocationMaster::whereNotNull('parent_id')->paginate(9);
        // $this->states = LocationMaster::where('parent_id', '=', 1)->latest()->orderBy('parent_id', 'ASC')->orderBy('name', 'ASC')->get();
        // $this->allCity = LocationMaster::where('parent_id', '>', 1)->latest()->orderBy('name', 'ASC')->get();
        // $this->stateCount = LocationMaster::where('parent_id', 1)->count();
        // $this->cityCount = LocationMaster::whereNotNull('parent_id')->where('parent_id', '!=', 1)->get()->count();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->guard('admin')->check()) {
            // dd($this->items, $this->locations);
            // dd(Happy::getActiveLocations());
            $loggedIn = auth()->guard('admin')->user();

            return view('admin.locations.index', ['loggedIn' => $loggedIn, 'locations' => Happy::getLocations(), 'countries' => Happy::getCountry(), 'states' => Happy::getStates(), 'cities' => Happy::getCities(), 'countryCount' => Happy::getCountryCount(), 'stateCount' => Happy::getStatesCount(), 'cityCount' => Happy::getCitiesCount(), 'activeLocationsCount' => Happy::getActiveLocationCount(), 'activeLocations' => Happy::getActiveLocations(), 'selected' => 1])->with('i', (request()->input('page', 1) - 1) * 9);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //dd($this->states);
        $loggedIn = auth()->guard('admin')->user();
        $location = new LocationMaster();
        return view('admin.locations.create', ['loggedIn' => $loggedIn, 'location' => $location, 'locations' => Happy::getLocations()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (auth()->guard('admin')->check()) {
            //dd($request);
            $data = $this->requestValidate($request);
            //dd($data);
            $data['parent_id'] = $data['parent_id'] == 'NULL' ? NULL : $data['parent_id'];
            $data['admin_id'] = auth()->guard('admin')->user()->id;
            $data['slug'] = Str::slug($request->name . '-' . $request->state);
            //($data);
            if ($imageOne = $request->file('imageOne')) {
                $destinationPath = 'assets/defaults/locations/images/';
                $locationImage = $data['slug'] . '-' . date('YmdHis') . "." . $imageOne->getClientOriginalExtension();
                $imageOne->move($destinationPath, $locationImage);
                $data['imageOne'] = "$locationImage";
            }
            //  else {
            //     dd('noimage');
            //     //$data['imageOne'] = '/assets/defaults/locationDefault.png';
            //     // unset($data['imageOne']);
            // }
            // dd($data);
            try {
                LocationMaster::create($data);
                return redirect()->route('adminlocation.index')
                    ->with(['status' => 'success', 'message' => "$request->name added successfully."]);
            } catch (Exception $e) {
                return redirect()->back()->with([
                    'status' => 'failure',
                    'message' => $e->getMessage()
                ]);
            }
        } else {
            return redirect()->route('admin.getlogin');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param    $location
     * @return \Illuminate\Http\Response
     */
    public function show(LocationMaster $location)
    {
        $loggedIn = auth()->guard('admin')->user();
        return view('admin.locations.show', ['loggedIn' => $loggedIn,  'location' => $location,  'locations' => Happy::getLocations(), 'states' => Happy::getStates()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  object  $location
     * @return \Illuminate\Http\Response
     */
    public function edit(LocationMaster $location)
    {
        $loggedIn = auth()->guard('admin')->user();
        return view('admin.locations.edit', ['loggedIn' => $loggedIn, 'locations' => Happy::getLocations(), 'states' => Happy::getStates(), 'location' => $location]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  object  $location
     * @return \Illuminate\Http\Response
     */
    public function update(LocationMaster $location, Request $request)
    {
        if (auth()->guard('admin')->check()) {
            //dd($request);
            $data = $this->requestValidate($request);
            //$location = LocationMaster::find($id);
            // if ($location->parent_id == null) {
            //     $data['parent_id'] = $location->parent_id;
            //     return redirect()->back()
            //         ->with(['status' => 'success', 'message' => "master category udpate is not permitted"]);
            // } else {
            //     $data['parent_id'] = $request->parent_id;
            // }
            $data['parent_id'] = $data['parent_id'] == 'NULL' ? NULL : $request->parent_id;
            $data['admin_id'] = auth()->guard('admin')->user()->id;
            $data['slug'] = Str::slug($request->name . '-' . $request->state);

            if ($imageOne = $request->file('imageOne')) {
                $destinationPath = 'assets/defaults/locations/images/';
                $locationImage = $data['slug'] . '-' . date('YmdHis') . "." . $imageOne->getClientOriginalExtension();
                $imageOne->move($destinationPath, $locationImage);
                $data['imageOne'] = "$locationImage";
            } else {
                unset($data['imageOne']);
            }
            //dd($data);
            try {
                $location->update($data);
                return redirect()->route('adminlocation.index')
                    ->with(['status' => 'success', 'message' => "$location->name updated successfully."]);
            } catch (Exception $e) {
                return redirect()->back()->with([
                    'status' => 'failure',
                    'message' => $e->getMessage()
                ]);
            }
        } else {
            return redirect()->route('admin.getlogin');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  object $location
     * @return \Illuminate\Http\Response
     */
    public function destroy(LocationMaster $location)
    {
        if (auth()->guard('admin')->check()) {
            if ($location->parent_id == null) {
                return redirect()->back()->with([
                    'status' => 'failure',
                    'message' => "$location->name can't be deleted since it is a country"
                ]);
            }
            $location->delete();
            return redirect()->route('adminlocation.index')
                ->with(['status' => 'success', 'message' => "$location->name remove successfully"]);
        } else {
            return redirect()->route('admin.getlogin');
        }
    }

    private function requestValidate(Request $request)
    {
        return $this->validate(
            $request,
            [
                'name'    => ['required', 'string', 'min:3', 'max:100'],
                'longitude' => ['required', 'string', 'min:3', 'max:11'],
                'latitude' => ['required', 'string', 'min:3', 'max:11'],
                'parent_id' => ['required'],
                'priority' => ['required', 'string'],
                'status'  => ['required'],
                'imageOne' => 'bail|Image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ],
            [
                'name.required' => 'Country/State/City name is required & minimum 3 characters are required',
                'longitude.required' => 'longitude is required',
                'latitude.required' => 'latitude is required',
                'parent_id.required' => 'state is required',
                'priority.required' => 'Priority needs to be chosen',
                'status.required' => 'Publishing status is required'
            ]
        );
    }

    public function filter(Request $request)
    {

        $query = LocationMaster::query();
        if ($request->categoryId != null) {
            $query->when($request->categoryId, function ($q, $categoryId) {
                return $q->where('id', $categoryId);
            });
        }

        //dd($cat);
        //->when($request->order == 'descendantDateOrder', function ($q) {
        //     return $q->orderBy('created_at', 'DESC');
        // })->when(
        //     $request->order == 'ascendantDateOrder',
        //     function ($q) {
        //         return $q->orderBy('created_at', 'ASC');
        //         $ads = $query->get();
        //         return view('ad.index', compact('ads'));
        //     }

        $selected = $query->get();
        // dd($states, $request->categoryId);        
        $locations = LocationMaster::where('id', '=', $selected->first()->id)->paginate(100);
        $loggedIn = auth()->guard('admin')->user();
        return view('admin.locations.index', ['loggedIn' => $loggedIn, 'locations' => $locations, 'countries' => Happy::getCountry(), 'states' => Happy::getStates($selected->first()->id), 'cities' => Happy::getCities(), 'countryCount' => Happy::getCountryCount(), 'stateCount' => Happy::getStatesCount(), 'cityCount' => Happy::getCitiesCount(), 'activeLocationsCount' => Happy::getActiveLocationCount(), 'activeLocations' => Happy::getActiveLocations(), 'selected' => $selected->first()->id])->with('i', (request()->input('page', 1) - 1) * 110);
    }
}
