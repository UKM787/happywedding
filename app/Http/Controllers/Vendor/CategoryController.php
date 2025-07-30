<?php

namespace App\Http\Controllers\Vendor;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Vendor\Vendor;
use App\Models\Vendor\Service;
use App\Models\Vendor\Category;
use App\Models\Admin\VendorMaster;
use App\Models\Vendor\Master\Hotel;
use App\Http\Controllers\Controller;
use App\Models\Admin\LocationMaster;
use App\Http\Resources\ServiceResource;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $vendor = auth()->guard('vendor')->user();

        //dd($vendor->categories);
       if($vendor->categories->isNotEmpty()){
            $categories = $vendor->categories;

            return view('vendors.categories.index', compact('vendor', 'categories'));
      } else {

        return redirect()->route('vendorprofile.index', $vendor);
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
    public function edit(Vendor $vendor, Category $category, Request $request)
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
