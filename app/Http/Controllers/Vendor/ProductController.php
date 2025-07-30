<?php

namespace App\Http\Controllers\Vendor;

use Illuminate\Http\Request;
use App\Models\Vendor\Vendor;
use App\Models\Vendor\Product;
use App\Models\Admin\VendorMaster;
use App\Http\Controllers\Controller;
use App\Models\Admin\LocationMaster;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Vendor $vendor)
    {
        $locationcats = LocationMaster::orderBy('name', 'ASC')->pluck('name', 'id');
        $vendorcats = VendorMaster::orderBy('name', 'ASC')->where('parent_id', '!=', Null)->pluck('name', 'id');
        return view('vendors.products.index', compact('vendor', 'locationcats', 'vendorcats'));
        // $host = auth()->guard('host')->user();
        // $products = Product::all();
        // return view('vendor.products.index', compact('products', 'host'));

        //return ProductResource::collection(Product::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
}
