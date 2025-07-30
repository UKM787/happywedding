<?php

namespace App\Http\Controllers\Vendor;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Vendor\Vendor;
use App\Models\Vendor\Service;
use App\Models\Admin\VendorMaster;
use App\Models\Vendor\Master\Hotel;
use App\Http\Controllers\Controller;
use App\Models\Admin\LocationMaster;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ServiceResource;

class ServiceMultipleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Vendor $vendor)
    {
       if (auth()->guard('vendor')->check()) {
            $loggedIn = auth()->guard('vendor')->user();
            $profile = $vendor->profile;
            $vendorID = $vendor->id;
            $categories = $vendor->services()->where('productable_type', NULL)->with('parent')->get();
            $main = $vendor->mainCategory;
            if($vendor->profile AND $vendor->company){
                return view('vendors.checkVendor.serviceMultiple', compact('loggedIn', 'vendorID', 'categories', 'vendor'));
            }else{
                return redirect()->route('vendorprofile.index', compact('vendor'));
            }
            //dd($vendor);
        } else {
            return redirect()->route('vendorLogin');
        }
    }

    public function productGet($id, $catid){
        $vendor = Vendor::where('id', $id)->first();
       // dd($vendor, $id, $catid);
        $subCat = $vendor->categories->where('id', $catid)->first();
        $mainCat = null;
        if($subCat->parent_id != null){
            $mainCat = $subCat->parent->relation;
        }
        $rel = $vendor->categories->where('id', $catid)->pluck('relation')[0];
        $cat = $vendor->categories->where('id', $catid)->pluck('path')[0];
       // dd($mainCat);
       //dd($vendor->venues);
        if($vendor->$rel == null){
            if($mainCat){
                $prods =$vendor->$mainCat->where('category_id', $catid);
                //dd($prods->where('category_id', $catid), $prods);
                return [$prods, $cat];
            }else{
                return [0, $cat];
            }
        }else{
            return  [$vendor->$rel, $cat];
        }
    }
    // public function showService(Request $request){
    //     $vendor = Vendor::where('id', $request->route()->parameters()['v'])->first();
    //     $vendorCat = VendorMaster::where('id', $request->route()->parameters()['catid'])->first();
    //     return view('vendors.checkVendor.services', compact('vendor', 'vendorCat'));
    //     //dd($request->route()->parameters(), $vendorCat);
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Vendor $vendor)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Vendor $vendor, Request $request)
    {
        //
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
    public function edit(Vendor $vendor, Request $request)
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
}
