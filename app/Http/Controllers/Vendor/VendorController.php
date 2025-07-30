<?php

namespace App\Http\Controllers\Vendor;

use Exception;
use App\Models\Admin\Admin;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Admin\VendorMaster;
use App\Http\Controllers\Controller;
use App\Models\Admin\LocationMaster;
use App\Models\Vendor\Vendor;
use Illuminate\Support\Facades\Auth;

class VendorController extends Controller
{
    public function __construct(){
        $this->middleware('guest:vendor')->except('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    //    if (auth()->guard('vendor')->check()) {
    //         $vendor = Auth::guard('vendor')->user();
    //         $profile = $vendor->profile;
    //         $vendorID = $vendor->id;
    //         $vendorCat = count($vendor->categories->all());
    //         if($vendor->profile){
    //             if($vendorCat > 0){    
    //                 return view('vendors.checkVendor.selectDashboard', compact('vendor', 'profile', 'vendorID', 'vendorCat'));
    //             }else{
    //                 return view('vendors.checkVendor.category', compact('vendor', 'profile', 'vendorID'));
    //             }
    //         }else{
    //             return view('vendors.checkVendor.profile', compact('vendor', 'profile', 'vendorID'));
    //         }
    //         //dd($vendor);
    //     } else {
    //         return redirect()->route('vendorLogin');
    //     }
        if (auth()->guard('vendor')->check()) {
            $vendor = Auth::guard('vendor')->user();
            return view('vendors.welcome', compact('vendor'));
        } else {
            return redirect()->route('vendorLogin');
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $admin = auth()->guard('admin')->user();
        // $locations = LocationMaster::pluck('id', 'name');
        // $vendorcats = VendorMaster::pluck('id', 'name')->all();
        // $vendor = new VendorMaster();
        // return view('admin.vendors.create', compact('admin', 'locations', 'vendorcats', 'vendor'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $data = $this->requestValidate($request);
        // // dd($data);
        // $data['parent_id'] = empty($data['parent_id']) ? null : $data['parent_id'];
        // $data['status'] = $request->input('status') == 'on' ? 1 : 0;
        // $data['locationmaster_id'] = $request->locationmaster_id;
        // $data['admin_id'] = auth()->guard('admin')->user()->id;
        // $data['slug'] = Str::slug($request->name);

        // if ($imageOne = $request->file('imageOne')) {
        //     $destinationPath = 'img/cities/';
        //     $locationImage = $data['slug'] . '-' . date('YmdHis') . "." . $imageOne->getClientOriginalExtension();
        //     $imageOne->move($destinationPath, $locationImage);
        //     $data['imageOne'] = "$locationImage";
        // } else {
        //     $data['imageOne'] = 'cityDefault.png';
        // }
        // // dd($data);
        // try {
        //     VendorMaster::create($data);
        //     return redirect()->route('admin.vendor.index')->with('success', "$request->name added successfully.");
        // } catch (Exception $e) {
        //     return redirect()->back()->with([
        //         'status' => 'failure',
        //         'message' => $e->getMessage()
        //     ]);
        //}

       // return redirect()->route('admin.vendor.index')->with(['status' => "added successfully"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showss()
    {
        dd('helo');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(VendorMaster $vendor)
    {
        // $admin = auth()->guard('admin')->user();
        // $locations = LocationMaster::pluck('id', 'name');
        // $vendorcats = VendorMaster::where('parent_id', null)->pluck('id', 'name')->all();
        // return view('admin.vendors.edit', compact('admin', 'locations', 'vendorcats', 'vendor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Admin $admin, VendorMaster $vendor, Request $request)
    {
        // $data = $this->requestValidate($request);
        // $data['parent_id'] = empty($data['parent_id']) ? null : $data['parent_id'];
        // $data['status'] = $request->input('status') == 'on' ? 1 : 0;
        // $data['locationmaster_id'] = $request->locationmaster_id;
        // $data['admin_id'] = auth()->guard('admin')->user()->id;
        // $data['slug'] = Str::slug($request->name);
        // if ($image = $request->file('imageOne')) {
        //     $destinationPath = 'img/cities/';
        //     $locationImage = $data['slug'] . '-' . date('YmdHis') . "." . $image->getClientOriginalExtension();
        //     $image->move($destinationPath, $locationImage, 'public');
        //     $data['imageOne'] = "$locationImage";
        // } else {
        //     unset($data['imageOne']);
        // }
        // // dd($data, $vendor);
        // try {
        //     $vendor->update($data);
        //     return redirect()->route('admin.vendor.index', $admin)
        //         ->with('success', 'New LocationMaster added successfully.');
        // } catch (Exception $e) {
        //     return redirect()->back()->with([
        //         'status' => 'failure',
        //         'message' => $e->getMessage()
        //     ]);
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(VendorMaster $vendor)
    {
        //  $venue = VenueMaster::findOrFail($id);
        // $vendor->delete();

        // return redirect()->route('admin.vendor.index')
        // ->with('status', "$vendor->name deleted successfully");
    }

    public function requestValidate(Request $request)
    {
        return $this->validate(
            $request,
            [
                'name'    => ['required', 'string', 'min:3', 'max:255'],
                'description'   => ['required', 'string', 'min:3', 'max:255'],
                'locationmaster_id' => ['required', 'string', 'min:1', 'max:11'],
                'priority' => ['required', 'string'],
                'icon' => ['sometimes', 'string', 'min:3', 'max:255'],
                'status'  => ['sometimes'],
                'imageOne' => 'Image|sometimes|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ],
            [
                'name.required' => 'Vendor Name is required & minimum 3 characters are required',
                'description.required' => 'Vendor Business Description required',
                'locationmaster_id.required' => 'City Name is required',
                'priority.required' => 'Choose prioirty'
            ]
        );
    }


}
