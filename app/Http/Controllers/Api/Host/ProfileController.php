<?php

namespace App\Http\Controllers\Api\Host;

use App\Models\Host\Home;
use App\Models\Host\Host;
use App\Models\Host\Office;
use Illuminate\Support\Str;
use App\Models\Host\Profile;
use Illuminate\Http\Request;
use App\Models\Company\Company;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Models\Admin\LocationMaster;
use Illuminate\Support\Facades\Auth;
use App\Models\Vendor\VendorCategory;
use App\Models\Company\CompanyProfile;
use Illuminate\Support\Facades\Validator;
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
        $this->requestValidate($request);
        //dd($data);
            if($request->type == 'personal'){
                $data = json_decode($request->data, true);
                $vendor =  Host::where('id' , $data['host_id'])->first()->slug;
                $loggedIn = Host::where('id' , $data['host_id'])->first();

                if($request->hasFile('personalimg')){
                    $name = $vendor.'/'.time().'-personal'.'.'.$request->personalimg->getClientOriginalExtension();
                    $request->personalimg->move(public_path('assets/hosts/uploads/'.$vendor.'/'), $name);
                    $added =  Profile::create($data+['slug' => Str::slug($data['name'], '-', 'en') . '-' . rand(1, 10000), 'imageOne' => $name]);
                }else{
                    $added =  Profile::create($data+['slug' => Str::slug($data['name'], '-', 'en') . '-' . rand(1, 10000)]);
                }

                
                $loggedIn->update(['email' => $data['email'], 'name' => $data['name'], 'mobile' => $data['mobile']]);

                return $added->id;
            }
            if($request->type == 'home'){
                //dd($request->data);
                $data = json_decode($request->data, true);

                $added =  Home::create($data+['slug' => Str::slug($data['complexName'], '-', 'en') . '-' . rand(1, 10000)]);
                //dd($added);
                return $added->id;
            
            }
            if($request->type == 'office'){
                //dd($request->data);
                $data = json_decode($request->data, true);

                //dd($data);
                $added =  Office::create($data+['slug' => Str::slug($data['officecompanyName'], '-', 'en') . '-' . rand(1, 10000)]);
                //dd($added);
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
        //dd('ss');
        $planner = Host::where('id', $id)->first();
        //$profileid = $vendor->profile->id;
        //dd($profileid);
        $profile = $planner->profile;
        $office = $planner->office;
        $home = $planner->home;
        //dd($profile);
        //$companyprofile = $planner->companyProfile;
        return [$planner, $profile, $office, $home];  
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
        //dd($id);
        if($request->type == 'personal'){
            //dd($request);
            $data = json_decode($request->data, true);
            //dd($data);
            $loggedIn = Host::where('id' , $data['host_id'])->first();

            if($request->hasFile('personalimg')){
                //dd('img');
                $vendor =  Host::where('id' , $data['host_id'])->first()->slug;
                $name = $vendor.'/'.time().'-personal'.'.'.$request->personalimg->getClientOriginalExtension();


                $added =  Profile::where('id' , (int)$id)->update($data+['imageOne' => $name]);
                $loggedIn->update(['email' => $data['email'], 'name' => $data['name'], 'mobile' => $data['mobile']]);

                $request->personalimg->move(public_path('assets/hosts/uploads/'.$vendor.'/'), $name);
                return $added;
            }else{
                //dd('no');
                $add =  Profile::where('id' , (int)$id)->update($data);
                $loggedIn->update(['email' => $data['email'], 'name' => $data['name'], 'mobile' => $data['mobile']]);

                return $add;
            }
        }
        //dd('eh');
        if($request->type == 'home'){
            
            $data = json_decode($request->data, true);
                return Home::where('id' , (int)$id)->update($data);
        }
        if($request->type == 'office'){
            
            $data = json_decode($request->data, true);
                return Office::where('id' , (int)$id)->update($data);
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
        $id = $data['host_id'];
        //dd($id);
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
        }
        //dd($data);
        Validator::make($data, [
                'name'    => ['sometimes','required', 'string', 'min:3', 'max:255'],
                // 'fatherName'    => ['sometimes','string', 'min:3', 'max:255'],
                // 'surname'    => ['sometimes','string', 'min:3', 'max:255'],
                // 'age'    => ['sometimes','numeric', 'min:3', 'max:200'],
                'mobile'    => ['sometimes','required', 'digits:10', Rule::unique('hosts', 'mobile')->ignore($id)],
                // 'mobile1'    => ['sometimes', 'digits:10'],
                // 'phone'    => ['sometimes', 'digits:10'],
                // 'whatsup'    => ['sometimes', 'digits:10'],
                'email'    => ['sometimes','email', Rule::unique('hosts', 'email')->ignore($id)],
                // 'relation'    => ['sometimes','required', 'string', 'min:3', 'max:255'],
                // 'gender'    => ['sometimes', 'string', 'min:3', 'max:255'],


                'complexName'    => ['sometimes','required', 'string', 'min:3', 'max:255'],
                'floor'    => ['sometimes','required', 'string', 'min:3', 'max:255'],
                'doorNo'    => ['sometimes','required','string'],
                'streetNo'    => ['sometimes','required','string'],
                'area'    => ['sometimes','required', 'string', 'min:3', 'max:255'],
                'pin'    => ['sometimes','required', 'digits:6'],
                'state'    => ['sometimes','required', 'string', 'min:3', 'max:255'],
                'district'    => ['sometimes','required', 'string', 'min:3', 'max:255'],
                'zone'    => ['sometimes','required', 'string', 'min:3', 'max:255'],
                'country'    => ['sometimes','required', 'string', 'min:3', 'max:255'],
                'reachus'    => ['sometimes','required', 'url', 'min:3'],


                
                'officecompanyName'    => ['sometimes','required', 'string', 'min:3', 'max:255'],
                'officecomplexName'    => ['sometimes','required', 'string', 'min:3', 'max:255'],
                'officefloor'    => ['sometimes','required', 'string', 'min:3', 'max:255'],
                'officedoorNo'    => ['sometimes','required','string'],
                'officestreetNo'    => ['sometimes','required','string'],
                'officearea'    => ['sometimes','required', 'string', 'min:3', 'max:255'],
                'officepin'    => ['sometimes','required', 'digits:6'],
                'officestate'    => ['sometimes','required', 'string', 'min:3', 'max:255'],
                'officedistrict'    => ['sometimes','required', 'string', 'min:3', 'max:255'],
                'officezone'    => ['sometimes','required', 'string', 'min:3', 'max:255'],
                'officecountry'    => ['sometimes','required', 'string', 'min:3', 'max:255'],
                'officereachus'    => ['sometimes','required', 'url', 'min:3'],
        ], [], [
                'name'    => 'Name',
                'surname'    => 'Last Name',
                'fatherName'    => 'Father Name',
                'age'    => 'Age',
                'gender'    => 'Gender',
                'relation'    => 'Relation',
                'email'    => 'Email',
                'phone'    => 'Landline',
                'mobile'    => 'Mobile',
                'mobile1'    => 'Mobile',
                'whatsup'    => 'Whatsapp Number',

                'complexName'   => 'Complex Name',
                'floor'    => 'Floor',
                'doorNo'    => 'Door No',
                'streetNo'    => 'Street No',
                'area'    => 'Area',
                'district'    => 'District',
                'pin'    => 'Pin',
                'state'    => 'State',
                'zone'    => 'Zone',
                'country'    => 'Country',
                'reachus'    => 'Reachus',


                'officecompanyName'   => 'Company Name',
                'officecomplexName'   => 'Complex Name',
                'officefloor'    => 'Floor',
                'officedoorNo'    => 'Door No',
                'officestreetNo'    => 'Street No',
                'officearea'    => 'Area',
                'officedistrict'    => 'District',
                'officepin'    => 'Pin',
                'officestate'    => 'State',
                'officezone'    => 'Zone',
                'officecountry'    => 'Country',
                'officereachus'    => 'Reachus',
        ])->validate();
    }
}

