<?php

namespace App\Http\Controllers\Api\Vendor;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Vendor\Vendor;
use App\Models\Vendor\Profile;
use App\Http\Controllers\Controller;
use App\Models\Admin\LocationMaster;
use Illuminate\Support\Facades\Auth;
use App\Models\Vendor\CompanyProfile;
use App\Models\Vendor\VendorCategory;
use App\Http\Resources\Vendor\ProfileResource;
use Illuminate\Support\Facades\Validator;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $vendor = Vendor::where('id', $id)->first();
        //$profileid = $vendor->profile->id;
        //dd($profileid);
        $profile = $vendor->profile;
        $states = LocationMaster::all();
        $company = $vendor->company;
        $categories = $vendor->categories;
        //dd($vendor->categories->all());
        return [$vendor, $profile, $states, $company, $categories];  
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
    public function store(Request $request)
    {
        $this->requestValidate($request);
        $data = json_decode($request->data, true);
        //dd('validated');
        $vendor =  Vendor::where('id' , $data['vendor_id'])->first()->slug;
        $name = $vendor.'/'.time().'-personal'.'.'.$request->img->getClientOriginalExtension();

        $added =  Profile::create($data+['slug' => Str::slug($data['firstname'], '-', 'en') . '-' . rand(1, 10000), 'imageOne' => $name]);

        $request->img->move(public_path('assets/vendors/uploads/'.$vendor.'/'), $name);
        return $added -> id;

    }
    public function storeCompany(Request $request)
    {
        $this->requestValidate($request);
        //dd($request);
        $data = json_decode($request->data, true);
        $cat = json_decode($request->categories, true);
        $vendor =  Vendor::where('id' , $data['vendor_id'])->first()->slug;
        //dd($data, $cat, $vendor);
        $name = $vendor.'/'.time().'-company'.'.'.$request->companyimg->getClientOriginalExtension();
        //dd($name);
        $added =  CompanyProfile::create($data+[ 'imageOne' => $name,'slug' => Str::slug($data['companyname'], '-', 'en') . '-' . rand(1, 10000)]);
        //dd($added);
        $request->companyimg->move(public_path('assets/vendors/uploads/'.$vendor.'/'), $name);

        foreach($cat as $item){
                    $checkifExist  = count(VendorCategory::where("vendor_id" , $item['vendor_id'])->where('category_id', $item['category_id'])->get());
                    if($checkifExist == 0){
                        VendorCategory::create($item+['slug' => Str::slug($item['vendor_id'], '----', 'en') . '-' . rand(1, 10000)] );
                    }
                }


 
        return $added->id;
    }
    public function catStore(Request $request){
        //dd($request->all());
        foreach($request->all() as $item){
            VendorCategory::create($item+['slug' => Str::slug($item['vendor_id'], '----', 'en') . '-' . rand(1, 10000)] );
        }
    }

    public function catGet($id){
        $vendor = Vendor::where('id', $id)->first();
        //dd($vendor->categories);
        $categories = $vendor->categories;
                    //dd($vendor, $profile);
        return [$vendor, $categories];  
    }


    
    public function productGet($id, $catid){
        $vendor = Vendor::where('id', $id)->first();
        $rel = $vendor->categories->where('id', $catid)->pluck('relation')[0];
        $cat = $vendor->categories->where('id', $catid)->pluck('path')[0];
        if($vendor->$rel == null){
            return [0, $cat];
        }else{
            return  [$vendor->$rel, $cat];
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
        $this->requestValidate($request);
        //dd($request->hasFile('img'));
        if($request->type == 'personal'){
            $data = json_decode($request->data, true);
            if($request->hasFile('img')){
                $vendor =  Vendor::where('id' , $data['vendor_id'])->first()->slug;
                $name = $vendor.'/'.time().'-personal'.'.'.$request->img->getClientOriginalExtension();


                $added =  Profile::where('id' , $id)->update($data+['imageOne' => $name]);

                $request->img->move(public_path('assets/vendors/uploads/'.$vendor.'/'), $name);
                return $added;
            }else{
                return Profile::where('id' , $id)->update($data);
            }
        }
        //dd('eh');
        if($request->type == 'company'){
            $cat = json_decode($request->categories, true);
            $data = json_decode($request->data, true);
            
            if($request->hasFile('companyimg')){
                $vendor =  Vendor::where('id' , $data['vendor_id'])->first()->slug;
                $name = $vendor.'/'.time().'-company'.'.'.$request->companyimg->getClientOriginalExtension();
                //dd($data);


                $added =  CompanyProfile::where('id' , $id)->update(['imageOne' => $name] + $data);
                foreach($cat as $item){
                    $checkifExist  = count(VendorCategory::where("vendor_id" , $item['vendor_id'])->where('category_id', $item['category_id'])->get());
                    if($checkifExist == 0){
                        VendorCategory::create($item+['slug' => Str::slug($item['vendor_id'], '----', 'en') . '-' . rand(1, 10000)] );
                    }
                }
                // /dd(CompanyProfile::where('id' , $id)->first());

                $request->companyimg->move(public_path('assets/vendors/uploads/'.$vendor.'/'), $name);
                return $added;
            }else{
                $added = CompanyProfile::where('id' , $id)->update($data);
                foreach($cat as $item){
                    $checkifExist  = count(VendorCategory::where("vendor_id" , $item['vendor_id'])->where('category_id', $item['category_id'])->get());
                    if($checkifExist == 0){
                        VendorCategory::create($item+['slug' => Str::slug($item['vendor_id'], '----', 'en') . '-' . rand(1, 10000)] );
                    }
                }
                return $added;
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
        $data = json_decode($request->data, true);
        //dd($data);
        // if($request->img !=  "null" AND $request->img !=  null){
        //     $data['img'] = $request->img;
        // }
        //dd($request->companyimg);
        // if($request->companyimg !=  "null" AND $request->companyimg !=  null){
        //     $data['companyimg'] = $request->companyimg;
        // }
        //dd('ss', $request);
        if($request->type == "company"){
            $data['categories'] = $request->categories;
            if($request->companyimg !=  "null" AND $request->companyimg !=  null){
                $data['companyimg'] = $request->companyimg;
            }
            //dd('ss');
        }else{
            if($request->img !=  "null" AND $request->img !=  null){
                $data['img'] = $request->img;
            }
        }
        //dd($data);
        Validator::make($data, [
                'firstname'    => ['sometimes','required', 'string', 'min:3', 'max:255'],
                'lastname'    => ['sometimes','required','string', 'min:3', 'max:255'],
                // 'fathername'    => ['sometimes','required','string', 'min:3', 'max:255'],
                'mobile'    => ['sometimes','required','required','string', 'size:10'],
                'desgination'    => ['sometimes','required', 'string', 'min:3', 'max:255'],
                // 'mobile1'    => ['sometimes','required','string', 'size:10'],
                'landline'    => ['sometimes','required','string', 'size:10'],
                'email'    => ['sometimes','required','email'],
                'whatsapp'    => ['sometimes','required','string', 'size:10'],
                // 'complex'    => ['sometimes','required','string', 'min:3', 'max:50'],
                // 'area'    => ['sometimes','required','string', 'min:3', 'max:50'],
                // 'district'    => ['sometimes','required','string', 'min:3', 'max:50'],
                // 'state'    => ['sometimes', 'required','string', 'min:3', 'max:50'],
                // 'whatsapp1'    => ['sometimes','required', 'string', 'size:10'],
                // 'country'    => ['sometimes','required','string', 'min:3', 'max:12'],
                // 'zipcode'    => ['sometimes','required','string', 'max:10'],
                'img' => ['sometimes','required','image','mimes:jpeg,png,jpg,gif,svg','file','max:10000'],

                //company form
                'companyname'    => ['sometimes','required', 'string', 'min:3', 'max:255'],
                'companyinfo'    => ['sometimes','required','string', 'min:3', 'max:255'],
                'address'    => ['sometimes','required','string', 'min:3', 'max:255'],
                'map'    => ['sometimes','url'],
                'latitude'    => ['sometimes','regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
                'longitude'    => ['sometimes','regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
                'establish'    => ['sometimes','required', 'digits:4'],
                'gst'    => ['sometimes','required','string', 'min:3', 'max:20'],
                'phone'    => ['sometimes','required','digits:10'],
                'cmobile'    => ['sometimes','required','digits:10'],
                // 'cmobile1'    => ['sometimes','required','string', 'size:10'],
                'whatsup'    => ['sometimes','required', 'digits:10'],
                'locationmaster_id'    => ['sometimes','required'],
                'companyimg' => ['sometimes','required','image','mimes:jpeg,png,jpg,gif,svg','file','max:10000'],
                'categories' => ['sometimes','required']
        ], [], [
                'firstname'    => 'First Name',
                'lastname'    => 'Last Name',
                'fathername'    => 'Father Name',
                'mobile'    => 'Mobile',
                'mobile1'    => 'Mobile',
                'landline'    => 'Landline',
                'email'    => 'Email',
                'whatsapp'    => 'Whatsapp Number',
                'complex'    => 'Complex',
                'area'    => 'Area',
                'district'    => 'District',
                'state'    => "State",
                'whatsapp1'    => 'Whatsapp Number',
                'country'    => 'Country',
                'zipcode'    => 'Zipcode',
                'img' => 'Profile Picture',
                'companyname'    => 'Company Name',
                'companyinfo'    => 'Company Description',
                'address'    => 'Company Address',
                'map'    => 'Map link',
                'latitude'    => 'Latitude',
                'longitude'    => 'Longitude',
                'establish'    => 'Established date',
                'gst'    => 'GST Number',
                'phone'    => 'Landline',
                'cmobile'    => 'Mobile',
                'cmobile1'    => 'Mobile',
                'whatsup'    => "Whatsapp Number",
                'locationmaster_id'    => 'Location',
                'companyimg' => 'Company Logo',
                'categories' => 'Categories',
        ])->validate();
    }
}

