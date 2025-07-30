<?php

namespace App\Http\Controllers\Api\Company;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Company\Company;
use App\Models\Company\Profile;
use App\Http\Controllers\Controller;
use App\Models\Admin\LocationMaster;
use Illuminate\Support\Facades\Auth;
use App\Models\Company\CompanyProfile;
use App\Models\Vendor\VendorCategory;
use App\Http\Resources\Vendor\ProfileResource;

class ProfileController extends Controller
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
            if($request->type == 'personal'){
                $data = json_decode($request->data, true);
                $vendor =  Company::where('id' , $data['company_id'])->first()->slug;
                $name = $vendor.'/'.time().'-personal'.'.'.$request->img->getClientOriginalExtension();

                $added =  Profile::create($data+['slug' => Str::slug($data['firstname'], '-', 'en') . '-' . rand(1, 10000), 'imageOne' => $name]);

                $request->img->move(public_path('assets/wedding_planner/uploads/'.$vendor.'/'), $name);
                return $added -> id;
            }
            if($request->type == 'company'){
                //dd($request->data);
                $data = json_decode($request->data, true);
                $vendor =  Company::where('id' , $data['company_id'])->first()->slug;
                $name = $vendor.'/'.time().'-personal'.'.'.$request->img->getClientOriginalExtension();

                $added =  CompanyProfile::create($data+['slug' => Str::slug($data['companyname'], '-', 'en') . '-' . rand(1, 10000), 'imageOne' => $name]);

                $request->img->move(public_path('assets/wedding_planner/uploads/'.$vendor.'/'), $name);
                return $added -> id;
            
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
        $planner = Company::where('id', $id)->first();
        //$profileid = $vendor->profile->id;
        //dd($profileid);
        $profile = $planner->profile;
        //dd($profile);
        $states = LocationMaster::all();
        $companyprofile = $planner->companyProfile;
        return [$planner, $profile, $states, $companyprofile];  
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
        //dd($request->hasFile('img'));
        if($request->type == 'personal'){
            $data = json_decode($request->data, true);
            if($request->hasFile('img')){
                $vendor =  Company::where('id' , $data['company_id'])->first()->slug;
                $name = $vendor.'/'.time().'-personal'.'.'.$request->img->getClientOriginalExtension();


                $added =  Profile::where('id' , $id)->update($data+['imageOne' => $name]);

                $request->img->move(public_path('assets/wedding_planner/uploads/'.$vendor.'/'), $name);
                return $added;
            }else{
                return Profile::where('id' , $id)->update($data);
            }
        }
        //dd('eh');
        if($request->type == 'company'){
            
            $data = json_decode($request->data, true);
            //dd($data);
            
            if($request->hasFile('img')){
                $vendor =  Company::where('id' , $data['company_id'])->first()->slug;
                $name = $vendor.'/'.time().'-company'.'.'.$request->img->getClientOriginalExtension();
                //dd($data);


                $added =  CompanyProfile::where('id' , $id)->update(['imageOne' => $name] + $data);
                // /dd(CompanyProfile::where('id' , $id)->first());

                $request->img->move(public_path('assets/wedding_planner/uploads/'.$vendor.'/'), $name);
                return $added;
            }else{
                return CompanyProfile::where('id' , $id)->update($data);
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
    public function requestValidate($request)
    {
        return $request->validate(
            [
                'firstname'    => ['required', 'string', 'min:3', 'max:255'],
                'lastname'    => [ 'nullable','string', 'min:3', 'max:255'],
                'fathername'    => [ 'nullable','string', 'min:3', 'max:255'],
                'mobile'    => [ 'nullable','required','numeric', 'min:3', 'max:12'],
                'mobile1'    => [ 'nullable','numeric', 'min:3', 'max:12'],
                'landline'    => [ 'nullable','numeric', 'min:3', 'max:12'],
                'email'    => [ 'required','email', 'unique:vendors,email'],
                'whatsapp'    => [ 'numeric', 'min:3', 'max:12'],
                'complex'    => [ 'nullable','string', 'min:3', 'max:12'],
                'area'    => [ 'nullable','string', 'min:3', 'max:12'],
                'district'    => [ 'nullable','string', 'min:3', 'max:12'],
                'state'    => [ 'nullable','string', 'min:3', 'max:12'],
                'whatsapp1'    => ['nullable', 'numeric', 'min:3', 'max:12'],
                'country'    => [ 'nullable','string', 'min:3', 'max:12'],
                'zipcode'    => [ 'nullable','numeric', 'min:3', 'max:8'],
                'imageOne' => 'Image|sometimes|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]
        );
    }
}

