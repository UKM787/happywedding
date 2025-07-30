<?php

namespace App\Http\Controllers\Api\Guest;

use App\Models\User;
use App\Models\Guest\Home;
use Illuminate\Support\Str;
use App\Models\Guest\Family;
use App\Models\Guest\Office;
use Illuminate\Http\Request;
use App\Models\Guest\Profile;
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
        //dd('ss', 'index');
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
       
            if($request->type == 'personal'){
                $data = json_decode($request->data, true);
                $vendor =  User::where('id' , $data['guest_id'])->first()->slug;
                $loggedIn = User::where('id' , $data['guest_id'])->first();
                //  dd($request);
                if($request->hasFile('personalimg')){
                    $name = $vendor.'/'.time().'-personal'.'.'.$request->personalimg->getClientOriginalExtension();
                    $added =  Profile::create($data+['slug' => Str::slug($data['name'], '-', 'en') . '-' . rand(1, 10000), 'imageOne' => $name]);
                    $request->personalimg->move(public_path('assets/guests/uploads/'.$vendor.'/'), $name);
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
            if($request->type == 'family'){
                //dd($request->hasFile('familyimageOne'), $request);
                $data = json_decode($request->data, true);
                //dd($request, $request->hasFile('familyimageThree'));
                $added =  Family::create($data+['slug' => Str::slug($data['familyname'], '-', 'en') . '-' . rand(1, 10000)]);
                //dd($added);
                
                if($request->hasFile('familyimageOne')){
                    $vendor =  User::where('id' , (int)$data['guest_id'])->first()->slug;
                    $name = $vendor.'/'.time().'-family'.'.'.$request->familyimageOne->getClientOriginalExtension();
                    //dd( $added->update(['familyimageOne' => $name]));
                    $added->update(['familyimageOne' => $name]);
                    $request->familyimageOne->move(public_path('assets/guests/uploads/'.$vendor.'/'), $name);
                }
                if($request->hasFile('familyimageTwo')){
                    $vendor =  User::where('id' , (int)$data['guest_id'])->first()->slug;
                    $name = $vendor.'/'.time().'-family'.'.'.$request->familyimageTwo->getClientOriginalExtension();
                    $added->update(['familyimageTwo' => $name]);
                    $request->familyimageTwo->move(public_path('assets/guests/uploads/'.$vendor.'/'), $name);
                }

                //dd($added);
                return User::where('id' , (int)$data['guest_id'])->first()->family;
            
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
        $planner = User::where('id', (int)$id)->first();
        //$profileid = $vendor->profile->id;
        //dd($profileid);
        $profile = $planner->profile;
        $office = $planner->office;
        $home = $planner->home;
        $family = $planner->family;
        //dd($planner->family);
        //$companyprofile = $planner->companyProfile;
        return [$planner, $profile, $office, $home, $family];  
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
       // dd($id,'ss');
        if($request->type == 'personal'){
            $data = json_decode($request->data, true);
            $loggedIn = User::where('id' , $data['guest_id'])->first();
            //dd($data);
            if($request->hasFile('personalimg')){
                //dd('img', $request->personalimg);
                $vendor =  User::where('id' , (int)$data['guest_id'])->first()->slug;
                $name = $vendor.'/'.time().'-personal'.'.'.$request->personalimg->getClientOriginalExtension();
                //dd($name);
                $added =  Profile::where('id' , (int)$id)->update($data+['imageOne' => $name]);
                $loggedIn->update(['email' => $data['email'], 'name' => $data['name'], 'mobile' => $data['mobile']]);
                //dd($added);

                $request->personalimg->move(public_path('assets/guests/uploads/'.$vendor.'/'), $name);
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
        if($request->type == 'family'){
            //dd('famileu');
                $data = json_decode($request->data, true);
                $added =  Family::where('id', (int)$id)->update($data);
                $added =Family::where('id', (int)$id);
                
                if($request->hasFile('familyimageOne')){
                    $vendor =  User::where('id' , (int)$data['guest_id'])->first()->slug;
                    $name = $vendor.'/'.time().'-family'.'.'.$request->familyimageOne->getClientOriginalExtension();
                    $added->update(['familyimageOne' => $name]);
                    $request->familyimageOne->move(public_path('assets/guests/uploads/'.$vendor.'/'), $name);
                }
                if($request->hasFile('familyimageTwo')){
                    $vendor =  User::where('id' , (int)$data['guest_id'])->first()->slug;
                    $name = $vendor.'/'.time().'-family'.'.'.$request->familyimageTwo->getClientOriginalExtension();
                    $added->update(['familyimageTwo' => $name]);
                    $request->familyimageTwo->move(public_path('assets/guests/uploads/'.$vendor.'/'), $name);
                }

              //  dd($added);
                return User::where('id' , (int)$data['guest_id'])->first()->family;
            
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
        $user = Family::where('id', (int)$id)->first()->guest_id;
        if(Family::where('id', (int)$id)->first()){
            Family::where('id', (int)$id)->delete();
        }
        if(User::where('id', (int)$user)->first()){
            return User::where('id', (int)$user)->first()->family;
        }else{
            return [];
        }
        
    }
        public function requestValidate($request)
     {
        $data = json_decode($request->data, true);
        $id = $data['guest_id'];
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
                //'fatherName'    => ['sometimes','required','string', 'min:3', 'max:255'],
                //'surname'    => ['sometimes','required','string', 'min:3', 'max:255'],
                //'age'    => ['sometimes','required','numeric', 'min:3', 'max:200'],
                'mobile'    => ['sometimes','required', 'digits:10', Rule::unique('users', 'mobile')->ignore($id)],
                //'mobile1'    => ['sometimes','required', 'digits:10'],
                //'phone'    => ['sometimes','required', 'digits:10'],
                //'whatsup'    => ['sometimes','required', 'digits:10'],
                //'email'    => ['sometimes','required','email', Rule::unique('users', 'email')->ignore($id)],
                'email'    => ['sometimes'],
                //'relation'    => ['sometimes','required', 'string', 'min:3', 'max:255'],
                //'gender'    => ['sometimes','required', 'string', 'min:3', 'max:255'],


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

                'familyname'    => ['sometimes','required','string', 'min:3', 'max:255'],
                'familyage'    => ['sometimes','required','numeric', 'min:3', 'max:200'],
                'familygender'    => ['sometimes','required','string', 'min:3', 'max:255'],
                'familyrelation'    => ['sometimes','required','string', 'min:3', 'max:255'],
                'familymobile'    => ['sometimes','required', 'digits:10'],
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


                'familyname'    => 'Name',
                'familyage'    => 'Age',
                'familygender'    => 'Gender',
                'familyrelation'    => 'Relation',
                'familymobile'    => 'Mobile',
        ])->validate();
    }
}

