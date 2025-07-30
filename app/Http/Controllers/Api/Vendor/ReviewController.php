<?php

namespace App\Http\Controllers\Api\Vendor;

use App\Models\Host\Host;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Vendor\Review;
use App\Models\Vendor\Vendor;
use App\Models\Admin\VendorMaster;
use App\Http\Controllers\Controller;
use App\Models\Admin\LocationMaster;
use App\Models\Vendor\Service\Venue;
use Illuminate\Support\Facades\Auth;
use App\Models\Vendor\Service\Accommodation;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\ContentTypes;

class ReviewController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }
    


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request);        
        $name = str_replace(' ', '', request()->all()[0]['title']);

         return Review::create($request->all()[0]+['slug' => Str::slug($name, '-', 'en') . '-' . rand(1, 10000), 'category_id' => request()->all()[1], 'productable_type' => 'App\Models\Vendor\Service\\'. request()->all()[4], 'productable_id' => request()->all()[2], 'reviewable_type' => 'App\Models\Host\Host', 'reviewable_id' => request()->all()[5]['id'], 'given_by' => request()->all()[5]['name'] ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $model = '\\App\\Models\\Vendor\\Service\\'.request()->cat;
        //dd($model::where('id', $id)->first()->reviews, $id);
        //dd($model::where('id', $id)->first()->reviews->reverse());
        $reviews = $model::where('id', $id)->first()->reviews;
        return $reviews;
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
    public function requestValidate($request)
    {
        // return $request->validate(
        //     [
        //         'firstname'    => ['required', 'string', 'min:3', 'max:255'],
        //         'lastname'    => [ 'nullable','string', 'min:3', 'max:255'],
        //         'fathername'    => [ 'nullable','string', 'min:3', 'max:255'],
        //         'mobile'    => [ 'nullable','required','numeric', 'min:3', 'max:12'],
        //         'mobile1'    => [ 'nullable','numeric', 'min:3', 'max:12'],
        //         'landline'    => [ 'nullable','numeric', 'min:3', 'max:12'],
        //         'email'    => [ 'required','email', 'unique:vendors,email'],
        //         'whatsapp'    => [ 'numeric', 'min:3', 'max:12'],
        //         'complex'    => [ 'nullable','string', 'min:3', 'max:12'],
        //         'area'    => [ 'nullable','string', 'min:3', 'max:12'],
        //         'district'    => [ 'nullable','string', 'min:3', 'max:12'],
        //         'state'    => [ 'nullable','string', 'min:3', 'max:12'],
        //         'whatsapp1'    => ['nullable', 'numeric', 'min:3', 'max:12'],
        //         'country'    => [ 'nullable','string', 'min:3', 'max:12'],
        //         'zipcode'    => [ 'nullable','numeric', 'min:3', 'max:8'],
        //         'imageOne' => 'Image|sometimes|mimes:jpeg,png,jpg,gif,svg|max:2048'
        //     ]
        // );
    }
}

