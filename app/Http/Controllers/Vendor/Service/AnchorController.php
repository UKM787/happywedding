<?php

namespace App\Http\Controllers\Vendor\Service;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Vendor\Vendor;
use App\Models\Admin\VendorMaster;
use App\Http\Controllers\Controller;
use App\Models\Admin\LocationMaster;
use App\Models\Vendor\Service\Anchor;

class AnchorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Vendor $vendor)
    {

        if ($vendor->services->isEmpty()) {

            $locations = LocationMaster::orderBy('name', 'ASC')->pluck('id', 'name');
            $categories = VendorMaster::latest()->whereNotNull('parent_id')->pluck('id', 'name');
            $anchor = new Anchor();
            return view('vendors.services.anchors.create', compact('vendor', 'anchor', 'locations', 'categories'));
        } else {
            return view('vendors.services.anchors.index')->with(['vendor' => $vendor, 'anchors' =>  $vendor->anchors]);
        }

        //return ServiceResource::collection(Service::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Vendor $vendor)
    {
        $locations = LocationMaster::orderBy('name', 'ASC')->pluck('id', 'name');
        $categories = VendorMaster::latest()->whereNotNull('parent_id')->pluck('id', 'name');
        $anchor = new Anchor();
        return view('vendors.services.anchors.create', compact('vendor', 'anchor', 'locations', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Vendor $vendor, Request $request)
    {
        // dd($request);
        $data = $this->requestValidate($request);

        $data['slug'] = Str::slug($request->name, '-', 'en') . '-' . rand(1, 10000);
        if ($imageOne = $request->file('imageOne')) {
            $destinationPath = 'assets/hotels';
            $locationImage = $data['slug'] . '-' . date('YmdHis') . "." . $imageOne->getClientOriginalExtension();
            $imageOne->move($destinationPath, $locationImage);
            $data['imageOne'] = "$locationImage";
        } else {
            $data['imageOne'] = 'hotelDefault.png';
        }

        if (auth()->guard('vendor')->check()) {
            //$data['vendor_id'] = $vendor->id;
            //$data['vendor_id'] = $vendor->id;
            $data['category_id'] = empty($request->category_id) ? Null : $request->category_id;
            $data['status'] = $request->status == 'on' ? '1' : '0';
            //dd($data);
            try {
                $vendor->anchors()->create($data);
                return redirect()->route('weddinganchors.index', $vendor)
                    ->with([
                        'status' => 'success',
                        'message' => " $vendor->name! hotel creation added successfully"
                    ]);
            } catch (Exception $e) {
                return redirect()->back()->with([
                    'status' => 'failure',
                    'message' => " $vendor->name Hotel creation creation failed, Try Again"
                ]);
            }
        } else {
            return back()->with(['status' => 'you need to login first']);
        }
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

    /**
     * Storing and updating the guest_image
     *
     * @param  App\Models\Guest\GuestProfile
     * @return \Illuminate\Http\Response
     */

    private function requestValidate($request)
    {

        return $request->validate([
            'name'          =>  ['required', 'string', 'min:3', 'max:255'],
            'description'   =>  ['required', 'string', 'min:3', 'max:1024'],
            'address'       => ['required', 'string', 'min:3', 'max : 255'],
            'longitude'     =>  ['required', 'string', 'min:3', 'max:20'],
            'latitude'      =>  ['required', 'string', 'min:3', 'max:20'],
            'map'           =>  ['required', 'string'],
            'status'        =>  ['sometimes'],
            'priority'      =>  ['required'],
            'icon'          =>  ['required', 'string'],
            'category_id'   =>  ['sometimes'],
            'location_id'   =>  ['required'],
            'imageOne'      => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
    }

}
