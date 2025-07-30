<?php

namespace App\Http\Controllers\Vendor;

use auth;
use Exception;
use App\Wed\Happy;
use App\Traits\ImageUpload;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Vendor\Vendor;
use App\Models\Vendor\Profile;
use Illuminate\Http\UploadedFile;
use App\Models\Admin\VendorMaster;
use App\Models\Admin\ServiceMaster;
use App\Http\Controllers\Controller;
use App\Models\Admin\CategoryMaster;
use App\Models\Admin\LocationMaster;
use App\Models\Vendor\VendorService;
use App\Models\Vendor\CompanyProfile;
use App\Models\Vendor\VendorCategory;
use Illuminate\Support\Facades\Validator;

//use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendor= auth()->guard('vendor')->user();
        $vendor = Vendor::where('id', $vendor->id)->with('mainCategory')->first();
        //dd();
        $vendorID = $vendor->id;
        $profile = $vendor->profile;
        $company = $vendor->company;
        $categories = $vendor->categories->pluck('id');
        $servicesSelected = $vendor->services->pluck('id');
        //dd($servicesSelected);
        $cities = Happy::getActiveLocations()->map(function ($loc) {
            return ['code' => $loc->id, 'name' => $loc->name];
        }); 
        $cats = CategoryMaster::where('parent_id', $vendor->category_id)->get();
        $services = ServiceMaster::all();
        //dd($services);
        //dd($cats);
        if(isset($vendor->profile)){
            $exists =1;
            $cexists = 0;
            if(isset($vendor->company)){
                $cexists = 1;               
            }
            return view('vendors.profiles.index', compact('vendor', 'profile', 'company' , 'vendorID', 'exists', 'cexists', 'cats', 'cities', 'categories', 'services', 'servicesSelected')) ;
        }else{
            $exists = 0;
            $cexists = 0;
            if(isset($vendor->company)){
                $cexists = 1;                
            }
            return view('vendors.profiles.index', compact('vendor', 'profile', 'company' , 'vendorID', 'exists', 'cexists', 'cats', 'cities', 'categories', 'services', 'servicesSelected')) ;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Vendor $vendor)
    {
        // return view('vendors.profiles.index', compact('vendor'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Vendor $vendor, Request $request)
    {
       //dd($request->type);
        if($request->type == 'company'){
            $this->companyValidate($request);
           // dd($request);
            $data = json_decode($request->data, true);
            $cat = json_decode($request->categories, true);
            $services = json_decode($request->services, true);
            if($request->hasFile('companyimg')){
                 $vendor =  Vendor::where('id', $data['vendor_id'])->first()->slug;
                //dd($data, $cat, $vendor);
                $name = $vendor . '/' . time() . '-company' . '.' . $request->companyimg->getClientOriginalExtension();
                //dd($name);
                $added =  CompanyProfile::create($data + ['companyimg' => $name, 'slug' => Str::slug($data['companyname'], '-', 'en') . '-' . rand(1, 10000)]);
                //dd($added);
                $request->companyimg->move(public_path('assets/vendors/uploads/' . $vendor . '/'), $name);
            }else{
                $added =  CompanyProfile::create($data + ['slug' => Str::slug($data['companyname'], '-', 'en') . '-' . rand(1, 10000)]);
            }

            foreach ($cat as $item) {
                $checkifExist  = count(VendorCategory::where("vendor_id", $item['vendor_id'])->where('category_id', $item['category_id'])->get());
                if ($checkifExist == 0) {
                    VendorCategory::create($item + ['slug' => Str::slug($item['vendor_id'], '----', 'en') . '-' . rand(1, 10000)]);
                }
            }
            // foreach ($services as $item) {
            //     //dd($item);
            //         $checkifExist  = count(VendorService::where("vendor_id", $item['vendor_id'])->where('service_master_id', $item['service_master_id'])->get());
            //         if ($checkifExist == 0) {
            //             VendorService::create($item + ['slug' => Str::slug($item['vendor_id'], '----', 'en') . '-' . rand(1, 10000)]);
            //         }
            //     }
            return $added->id;
        }
        if($request->type == 'personal'){
            $this->profileValidate($request);
            $data = json_decode($request->data, true);
            //dd('validated');
            if($request->hasFile('avatar')){
                $vendor =  Vendor::where('id', $data['vendor_id'])->first()->slug;
                $name = $vendor . '/' . time() . '-personal' . '.' . $request->avatar->getClientOriginalExtension();

                $added =  Profile::create($data + ['slug' => Str::slug($data['firstname'], '-', 'en') . '-' . rand(1, 10000), 'avatar' => $name]);

                $request->avatar->move(public_path('assets/vendors/uploads/' . $vendor . '/'), $name);
            }else{
                $added =  Profile::create($data + ['slug' => Str::slug($data['firstname'], '-', 'en') . '-' . rand(1, 10000)]);
            }
            return $added->id;
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
    public function edit(Vendor $vendor, Profile $profile)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Vendor $vendor, $id, Request $request)    
    {
       // dd('sssss');
        if ($request->type == 'personal') {
            $this->profileValidate($request);
            $data = json_decode($request->data, true);
            if ($request->hasFile('avatar')) {
                //dd('ss');
                $vendor =  Vendor::where('id', $data['vendor_id'])->first()->slug;
                $name = $vendor . '/' . time() . '-personal' . '.' . $request->avatar->getClientOriginalExtension();
                // dd(Profile::where('id', (int)$id)->first()->update($data + ['avatar' => $name]));

                $added =  Profile::where('id', (int)$id)->first()->update(['avatar' => $name]+ $data);

                $request->avatar->move(public_path('assets/vendors/uploads/' . $vendor . '/'), $name);
                return $added;
            } else {
                //dd($id, Profile::where('id', $id)->first());
                return Profile::where('id', (int)$id)->first()->update($data);
            }
        }
        //dd('eh');
        if ($request->type == 'company') {
            $this->companyValidate($request);
            $cat = json_decode($request->categories, true);
            $services = json_decode($request->services, true);
            $data = json_decode($request->data, true);
            //dd($data, $this->companyValidate($request));
            if ($request->hasFile('companyimg')) {
                $vendor =  Vendor::where('id', $data['vendor_id'])->first()->slug;
                $name = $vendor . '/' . time() . '-company' . '.' . $request->companyimg->getClientOriginalExtension();
                //dd($data);


                $added =  CompanyProfile::where('id', (int)$id)->first()->update(['companyimg' => $name] + $data);
                foreach ($cat as $item) {
                    $checkifExist  = count(VendorCategory::where("vendor_id", $item['vendor_id'])->where('category_id', $item['category_id'])->get());
                    if ($checkifExist == 0) {
                        VendorCategory::create($item + ['slug' => Str::slug($item['vendor_id'], '----', 'en') . '-' . rand(1, 10000)]);
                    }
                }
                // foreach ($services as $item) {
                //     $checkifExist  = count(VendorService::where("vendor_id", $item['vendor_id'])->where('service_master_id', $item['service_master_id'])->get());
                //     if ($checkifExist == 0) {
                //         VendorService::create($item + ['slug' => Str::slug($item['vendor_id'], '----', 'en') . '-' . rand(1, 10000)]);
                //     }
                // }
                // /dd(CompanyProfile::where('id' , $id)->first());

                $request->companyimg->move(public_path('assets/vendors/uploads/' . $vendor . '/'), $name);
                return $added;
            } else {
                //dd();
                $added = CompanyProfile::where('id', (int)$id)->first()->update($data);
                foreach ($cat as $item) {
                    $checkifExist  = count(VendorCategory::where("vendor_id", $item['vendor_id'])->where('category_id', $item['category_id'])->get());
                    if ($checkifExist == 0) {
                        VendorCategory::create($item + ['slug' => Str::slug($item['vendor_id'], '----', 'en') . '-' . rand(1, 10000)]);
                    }
                }
                // foreach ($services as $item) {
                //     $checkifExist  = count(VendorService::where("vendor_id", $item['vendor_id'])->where('service_master_id', $item['service_master_id'])->get());
                //     if ($checkifExist == 0) {
                //         VendorService::create($item + ['slug' => Str::slug($item['vendor_id'], '----', 'en') . '-' . rand(1, 10000)]);
                //     }
                // }
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

    public function companyValidate($request)
    {
        $data = json_decode($request->data, true);
        $cats = json_decode($request->categories, true);
        //dd($data);
        if(count($cats) > 0){
            $data['categories'] = $request->categories;
        }
        // if(array_key_exists('companyimg', $data)){
        //     unset($data['companyimg']);
        // }
        // if ($request->type == "company") {
        //     //$data['categories'] = $request->categories;
        //     if ($request->companyimg !=  "null" and $request->companyimg !=  null) {
        //         $data['companyimg'] = $request->companyimg;
        //     }
        // }   
        $meth = 'POST';
        if($request->has('_method')){
            $meth = 'PATCH';
            if($request->hasFile('companyimg')){
                $data['companyimg'] = $request->companyimg;
            }
        }   
        if ($meth == "POST") {
            $data['companyimg'] = $request->companyimg;
        }
        if(array_key_exists('companyimg', $data)){
            if(!$data['companyimg'] instanceof UploadedFile){
                unset($data['companyimg']);
            }
        }
        //dd($data, gettype($data['companyimg']), $data['companyimg'] instanceof UploadedFile);     
        //dd($data, $meth);   
        Validator::make($data, [
            'companyname'   => ['required', 'string', 'min:3', 'max:255'],
            'companyinfo'   => ['required', 'string', 'min:3', 'max:255'],
            'address'       => ['required', 'string', 'min:3', 'max:255'],
            // 'area'          => ['required', 'string', 'min:3', 'max:255'],
            'latitude'      => ['sometimes', 'regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'longitude'     => ['sometimes', 'regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
            'map'           => ['sometimes', 'url'],
            'establish'     => ['required', 'digits:4'],
            'gst'           => ['sometimes', 'required', 'string', 'min:3', 'max:20'],
            'phone'         => ['required', 'digits:10'],
            'mobile'       => ['required', 'digits:10'],
            'whatsup'       => ['required', 'digits:10'],
            'email'         => ['required', 'email'],
            'location_id'    => ['required'],
            'categories'    => ['required'],
            'companyimg'    => 'required|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
            //'imageOne'      => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'file', 'max:10000'],

        ], [
            'companyname.required'    => 'enter company name please!',
            'companyinfo.required'    => 'enter detailed description about company',
            'address.required'    => 'enter complete company address!',
            'area.required'    => 'enter locality area or zone of your presence!',
            'map.sometimes'    => 'enter correct link url for location please!',
            'latitude.sometimes'    => 'enter correct latitude in the format xx.xxx',
            'longitude.sometimes'    => 'enter correct longitude in the format xx.xxx',
            'establish.requried'    => 'Which years your establish your company!',
            'gst.sometimes'    => 'enter your correct gst number please!',
            'phone.required'    => 'enter your correct landline number please!',
            'mobile.required'    => 'enter your correct mobile number please!',
            'whatsup.requried'    => 'enter your correct whatsapp number please!',
            'location_id.required'    => 'select your location please!',
            'categories.required'    => 'select business sub-categories',
            'companyimg.required' => 'upload logo !',
            //'imageOne.required' => 'upload logo !',


        ])->validate();
    }

    public function profileValidate($request)
    {
        $data = json_decode($request->data, true);

        // if(array_key_exists('avatar', $data)){
        //     unset($data['avatar']);
        // }
        $meth = 'POST';
        if($request->has('_method')){
            $meth = 'PATCH';
            if($request->hasFile('avatar')){
                $data['avatar'] = $request->avatar;
            }
        }   
        if ($meth == "POST") {
            $data['avatar'] = $request->avatar;
        }
        if(array_key_exists('avatar', $data)){
            if(!$data['avatar'] instanceof UploadedFile){
                unset($data['avatar']);
            }
        }
        //dd($data, $meth);
            
        Validator::make($data, [
            'firstname'    => ['required', 'string', 'min:3', 'max:255'],
            'lastname'    => ['sometimes', 'string', 'min:3', 'max:255'],
            'desgination'    => ['sometimes', 'required', 'string', 'min:3', 'max:255'],
            'mobile'    => ['required', 'required', 'string', 'size:10'],
            'landline'    => ['sometimes', 'required', 'string', 'size:10'],
            'email'    => ['required', 'email'],
            'whatsapp'    => ['sometimes', 'required', 'string', 'size:10'],
            //'img' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'file', 'max:10000'],
            'avatar' => 'required|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'firstname.required'    => 'Guest ! enter your firstname',
            'lastname.sometimes'    => 'enter your lastname',
            'desination.sometime' => 'enter your designation in the company',
            'mobile.required'    => 'enter your correct mobile number',
            'landline.sometimes'    => 'enter your correct landline number with stdcode',
            'email.required'    => 'enter your correct email id',
            'whatsapp.sometimes'    => 'enter your correct what\'s number',
            'avatar.required'    => 'upload your photo !',
        ])->validate();
    }

}
