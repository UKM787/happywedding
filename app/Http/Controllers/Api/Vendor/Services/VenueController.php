<?php

namespace App\Http\Controllers\Api\Vendor\Services;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Vendor\Vendor;
use App\Http\Controllers\Controller;
use App\Models\Admin\LocationMaster;
use App\Models\Host\Host;
use App\Models\Host\Invitation;
use App\Models\Host\Vendorables;
use App\Models\Vendor\Service\Venue;
//use App\Models\Vendor\Service\VendorVenue;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\ContentTypes;

class VenueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd('ss');
        $states = LocationMaster::all();
           return [$states];
    }
    


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->type == "finalize"){
            $data = json_decode($request->data, true);
            $invi = [];
            foreach($data as $single){
                array_push($invi, Invitation::where('id', (int)$single)->first());
            }
            foreach($invi as $single){
                $exists  = Vendorables::where('invitation_id', (int)$single->id)->where('vendorable_type', 'App\Models\Vendor\Service\Venue')->where('vendorable_id', (int)$request->venue)->get();
                //var_dump($exists);
                if(count($exists) == 0){
                    Vendorables::create(['invitation_id' =>$single->id,'title' =>$request->title, 'vendorable_type' => "App\Models\Vendor\Service\Venue", 'vendorable_id' => (int)$request->venue]);
                }
            }
            return;
        }
        $this->requestValidate($request);
        $data = json_decode($request->data, true);
        $name = str_replace(' ', '', $data['name']);
        $added = Venue::create($data+['slug' => Str::slug($name, '-', 'en') . '-' . rand(1, 10000), 'venueable_type' => 'App\Models\Vendor\Vendor', 'venueable_id' => (int)$request->vendorId,'category_id' => (int)$request->catId]);
        return $added->id;



        // $added = Venue::create($data+['slug' => Str::slug($name, '-', 'en') . '-' . rand(1, 10000), 'venueable_type' => 'App\Models\Vendor\Vendor', 'venueable_id' => (int)$request->vendorId,'category_id' => (int)$request->catId, 'district' => LocationMaster::where('id' , $data['location_id'])->pluck('name')[0] ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        //dd('aaa', $request);
        if($id == 'filter'){
            $filters = json_decode($request->filters, true);
            $search = json_decode($request->search, true);
            $venues = Venue::all();
            $where = [];
            //dd($filters);
            if(array_key_exists('city', $search)){
                array_push($where, ['location_id', '=', (int)$search['city']]);
            }
            if(array_key_exists('venueType', $search)){
                //dd($search['venueType']);
                array_push($where, ['type', '=', (int)$search['venueType']]);
            }
            if(array_key_exists('stars', $filters) && isset($filters['stars'])){
                //dd($search['venueType']);
                array_push($where, ['stars', '=', (int)$filters['stars']]);
            }
            if(array_key_exists('price_per_plate', $filters) && isset($filters['price_per_plate'])){
                //dd($filters['price_per_plate']);
                if (str_contains($filters['price_per_plate'], '-')) { 
                    $first = (int)substr($filters['price_per_plate'], 0, strpos($filters['price_per_plate'], "-"));
                    $second = (int)substr($filters['price_per_plate'], strpos($filters['price_per_plate'], "-") + 1);

                    array_push($where, ['non_veg_plate', '>', $first], ['non_veg_plate', '<', $second]);
                }
                if (str_contains($filters['price_per_plate'], '<')){
                    $amt = (int)substr($filters['price_per_plate'], 1);
                    //dd($amt);
                    array_push($where, ['non_veg_plate', '<', $amt]);
                }
                if (str_contains($filters['price_per_plate'], '>')){
                    $amt = (int)substr($filters['price_per_plate'], 1);
                    //dd($amt);
                    array_push($where, ['non_veg_plate', '>', $amt]);
                }
            }
            //dd($where, Venue::where($where)->get());
            $venues = Venue::where($where)->get();
            return $venues;
            //dd($filters, $search, $venues);
        }
        //dd($id);
        if($request->venueid){
            $host = Host::where('id', (int)$id)->first();
            $invi = $host->invitations;
            $finalInvi = [];
            foreach($invi as $single){
                $exists  = Vendorables::where('invitation_id', $single->id)->where('vendorable_type', 'App\Models\Vendor\Service\Venue')->where('vendorable_id', (int)$request->venueid)->get();
                if(count($exists) != 0){
                    array_push($finalInvi, $single->id);
                }
            }
            // /dd($finalInvi);
            return $finalInvi;
        }
        //dd()
        return Venue::where('id' , $id)->with('services')->first();
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
        //dd($request->has('data'));
        if($request->has('data')){
        $data =json_decode($request->data, true);
        }
        //dd('ss');
        $this->requestValidate($request);
        //dd('checled');
        if($request->all()['contentType'] == 'details'){
            //dd($request->data);
            
            Venue::where('id' , $id)->first()->update(json_decode($request->data, true));
            return $id;
        }
        if($request->all()['contentType'] == 'contactdetails'){
            //dd($request->data);
            
            Venue::where('id' , $id)->first()->update(json_decode($request->data, true)+['district' => LocationMaster::where('id' , json_decode($request->data, true)['location_id'])->pluck('name')[0]]);
            return $id;
        }
        if($request->all()['contentType'] == 'partyArea'){
            //  dd($request->all()['ifdelete']);
            if($request->has('ifdelete')){
                if($request->all()['ifdelete'] == 'dlt'){
                    $existingparty = Venue::where('id' , $id)->first()['party_area'];
                        $index = null;
                        foreach ($existingparty as $key => $val) {
                            if ($val['name'] == $data['name']) {
                                $index =  $key;
                                break;
                            }
                            $index =  'noexist';
                        }
                        if($index != 'noexist'){
                            array_splice($existingparty, $index, 1);
                            Venue::where('id' , $id)->first()->update(['party_area'=>$existingparty]);
                            return Venue::where('id' , $id)->first()['party_area'];
                        // dd($index, $existingparty, 'ss');
                        }else{
                            throw ValidationException::withMessages(['Something went wrong! Please try again later']);
                        }
                    //dd($index, $existingparty);
                }
            }
            if(array_key_exists("partyimagePreview",$data)){
                $data =array_diff_key($data, 
                        array_flip((array) ['partyimagePreview']));
                //dd('ss', $data);
            }
            if(array_key_exists("partyvideoPreview",$data)){
                $data =array_diff_key($data, 
                        array_flip((array) ['partyvideoPreview']));
                //dd('ss', $data);
            }
            //dd($data);
            $vendor  =  Venue::where('id' , $id)->first()->venueable->slug;
            //dd($request->files->all()['files']);
            $images = [];
            $videos = [];
            $index = 0;
            //dd($request->has('files'));
            if($request->has('files')){
                //dd('ff');
                foreach($request->files->all()['files'] as $single){
                $mime =  $single->getClientMimeType();
                $name  = $vendor.'/'.Venue::where('id' , $id)->first()->slug.'/'.time().'.-'. $index++ .'-'. str_replace(' ', '', Venue::where('id' , $id)->first()->name).'.'.$single->getClientOriginalExtension();
                    //var_dump($name);
                $single->move(public_path('assets/vendors/uploads/'.$vendor.'/'.Venue::where('id' , $id)->first()->slug.'/'), $name);
                if(strstr($mime, "video/")){
                    array_push($videos, $name);
                }
                if(strstr($mime, "image/")){
                    array_push($images, $name);
                }
                //dd($data);
                }
                //dd(Venue::where('id' , $id)->first()['party_area']);
                if(Venue::where('id' , $id)->first()['party_area'] == null OR count(Venue::where('id' , $id)->first()['party_area']) == 0){
                    $data['img'] = $images;
                    $data['vid'] = $videos;
                    Venue::where('id' , $id)->first()->update(['party_area'=>[$data]]);
                }else{
                    //dd('ss');
                    $existingparty = Venue::where('id' , $id)->first()['party_area'];
                    $index = null;
                    foreach ($existingparty as $key => $val) {
                        if ($val['name'] == $data['name']) {
                            $index =  $key;
                            break;
                        }
                        $index =  'noexist';
                    }
                    //dd($index,$index != null, $index >= 0);
                    if($index != 'noexist'){
                        //dd(isset($data['img']) == false);
                        if(isset($data['img']) == false){
                            $data['img'] = [];
                        }
                        if(isset($data['vid']) == false){
                            $data['vid'] = [];
                        }
                        $data['img'] =    array_merge($data['img'],$images);
                        $data['vid'] =    array_merge($data['vid'],$videos);
                        //dd('exis',$existingparty[$index], $data, $images, $videos);
                        $existingparty[$index] = $data;
                        Venue::where('id' , $id)->first()->update(['party_area'=>$existingparty]);

                    }else{
                        //dd($existingparty);
                        $data['img'] = $images;
                    $data['vid'] = $videos;
                        array_push($existingparty, $data);
                        //dd($existingparty);
                        Venue::where('id' , $id)->first()->update(['party_area'=>$existingparty]);
                    }
                }
                //dd('s');
                return Venue::where('id' , $id)->first()['party_area'];
            }
            //dd('sss');
            if(Venue::where('id' , $id)->first()['party_area'] == null OR count(Venue::where('id' , $id)->first()['party_area']) == 0){
                //dd('ss');
                Venue::where('id' , $id)->first()->update(['party_area'=>[$data]]);
            }else{ 
                //dd('ss');
                $existingparty = Venue::where('id' , $id)->first()['party_area'];
                //dd($existingparty, $data);
                $index = null;
                foreach ($existingparty as $key => $val) {
                    if ($val['name'] == $data['name']) {
                        $index =  $key;
                        break;
                    }
                    $index =  null;
                }
                //dd($index);
                if($index != 'noexist'){
                    //dd($existingparty[$index], $data);
                    $existingparty[$index] = $data;
                    Venue::where('id' , $id)->first()->update(['party_area'=>$existingparty]);

                }else{
                    //dd('s');
                    array_push($existingparty, $data);
                    Venue::where('id' , $id)->first()->update(['party_area'=>$existingparty]);
                }
                return Venue::where('id' , $id)->first()['party_area'];
            }
            
            //Venue::where('id' , $id)->first()->update(['party_area'=>json_decode($request->data, true)]);
            //dd('entered');
            //dd('done');
            return $id;
        }
        if($request->all()['contentType'] == 'json'){
            //dd(json_decode($request->data));
            Venue::where('id' , $id)->first()->update(['venue_facilities'=>json_decode($request->data, true)]);
            return $id;
        }
        if($request->all()['contentType'] == 'policy'){
            //dd(json_decode($request->data));
            Venue::where('id' , $id)->first()->update(['venue_facilities'=>json_decode($request->data, true)]);
            return $id;
        }
        if($request->all()['contentType'] == 'image'){

            $vendor  =  Venue::where('id' , $id)->first()->venueable->slug;
            $images = [];
            $videos = [];
            $index = 0; 

                        //dd($request->all());
            if($request->has('uploadimg')){
                if($request->all()['uploadimg'] == 'uploadimg'){
                    $images = Venue::where('id' , $id)->first()->images;
                    if($images == null){
                        $images = [];
                    }
                    $videos =  Venue::where('id' , $id)->first()->videos;
                    if($videos == null){
                        $videos = [];
                    }
                }
            }
           //dd($request->has('files'));
            if($request->has('files')){
                foreach($request->files->all()['files'] as $single){
                $mime =  $single->getClientMimeType();
                $name  = $vendor.'/'.Venue::where('id' , $id)->first()->slug.'/'.time().'.-'. $index++ .'-'. Venue::where('id' , $id)->first()->name.'.'.$single->getClientOriginalExtension();

                $single->move(public_path('assets/vendors/uploads/'.$vendor.'/'.Venue::where('id' , $id)->first()->slug.'/'), $name);
                if(strstr($mime, "video/")){
                    array_push($videos, $name);
                }
                if(strstr($mime, "image/")){
                    array_push($images, $name);
                }
                //dd(json_decode($request->data, true));
                }
                Venue::where('id' , $id)->first()->update(['images' => $images, "videos" => $videos]);
            }
            
           // Venue::where('id' , $id)->first()->update(json_decode($request->data, true));
            //dd(Accommodation::where('id' , $id)->first()->images);
            return $id;
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
        $myArray = explode(',', $id);
       //dd($id);
        if($myArray[0] == 'venue'){
            //dd($myArray);
            $acc = Venue::where('id', $myArray[1])->first();
            //dd($acc);
            $owner = $acc->venueable;
            if($myArray[4] == 'image'){
                $files  = Venue::where('id', $myArray[1])->first()->images;
            }
            if($myArray[4] == 'video'){
                $files  = Venue::where('id', $myArray[1])->first()->videos;
            }
            $index = array_search($owner->slug."/".$acc->slug."/".$myArray[2], $files);
            array_splice($files, $index, 1);
            if(file_exists(public_path("/assets/vendors/uploads/".$owner->slug."/".$acc->slug."/".$myArray[2]))){
                unlink(public_path("/assets/vendors/uploads/".$owner->slug."/".$acc->slug."/".$myArray[2]));
            }
            if($myArray[4] == 'image'){
                Venue::where('id', $myArray[1])->first()->update(['images' => $files]);
                return true;
            }
            if($myArray[4] == 'video'){
                Venue::where('id', $myArray[1])->first()->update(['videos' => $files]);
                return true;
            }
        }

        if($myArray[0] == 'partyarea'){
            //dd($myArray);
            $acc = Venue::where('id', $myArray[1])->first();
            //dd($acc);
            $owner = $acc->venueable;
            if($myArray[4] == 'image'){
                $files  = Venue::where('id', $myArray[1])->first()->party_area[$myArray[5]]['img'];
                //dd($files);
            }
            if($myArray[4] == 'video'){
                $files  = Venue::where('id', $myArray[1])->first()->party_area[$myArray[5]]['vid'];
            }

            $index = array_search($owner->slug."/".$acc->slug."/".$myArray[2], $files);
            //dd($index);
            array_splice($files, $index, 1);
             if(file_exists(public_path("/assets/vendors/uploads/".$owner->slug."/".$acc->slug."/".$myArray[2]))){
                unlink(public_path("/assets/vendors/uploads/".$owner->slug."/".$acc->slug."/".$myArray[2]));
            }
            //dd($files, Venue::where('id', $myArray[1])->first()->party_area[$myArray[5]]);
            $arr = Venue::where('id', $myArray[1])->first()->party_area[$myArray[5]];
            $existingparty = Venue::where('id' , $myArray[1])->first()['party_area'];
            if($myArray[4] == 'image'){
                $arr['img'] = $files;
                //dd($arr, $existingparty);
                $existingparty[$myArray[5]] = $arr;
                Venue::where('id', $myArray[1])->first()->update(['party_area'=>$existingparty]);
            return Venue::where('id' , $myArray[1])->first()['party_area'];
            }
            if($myArray[4] == 'video'){
                $arr['vid'] = $files;
                $existingparty[$myArray[5]] = $arr;
                Venue::where('id', $myArray[1])->first()->update(['party_area'=>$existingparty]);
            return Venue::where('id' , $myArray[1])->first()['party_area'];
            }
        }
    
    }
    public function requestValidate($request)
    {
        $data =  [];
        if($request->has('data')){
        $data =json_decode($request->data, true);
        }
        //dd('aaa'); 
        $filevideos = [];
        $fileimages = [];
        if($request->all()['contentType'] == 'partyArea'){
            //$data = [];
            $data = ['data'=> json_decode($request->data, true)];
            //dd($data['data']);
            //dd('ss');
            if($request->has('files')){
                foreach($request->files->all()['files'] as $single){
                    $mime =  $single->getClientMimeType();
                    if(strstr($mime, "video/")){
                        array_push($filevideos, $single);
                    }
                    if(strstr($mime, "image/")){
                        array_push($fileimages, $single);
                    }
                }
                if(count($fileimages) >0){
                    $data['data']['uploadimg'] = $fileimages; 
                }
                if(count($filevideos) >0){
                    $data['data']['uploadvid'] = $filevideos; 
                }
            }
            //dd($data); 
        } 
        if($request->all()['contentType'] == 'image')  {
            //dd($request->files->all()['files']);
            if($request->has('files')){
                foreach($request->files->all()['files'] as $single){
                    $mime =  $single->getClientMimeType();
                    if(strstr($mime, "video/")){
                        array_push($filevideos, $single);
                    }
                    if(strstr($mime, "image/")){
                        array_push($fileimages, $single);
                    }
                }
                if(count($fileimages) >0){
                    $data['img'] = $fileimages;
                }
                if(count($filevideos) >0){
                    $data['vid'] = $filevideos;
                }
            }
        }
        if($request->all()['contentType'] == 'json'){
            //dd($data);
            $data = ['amenities' => json_decode($request->data, true)];
           // dd($data);
        }
        if($request->all()['contentType'] == 'policy'){
            //dd(json_decode($request->data1, true),$data);
            $data = ['policy' => json_decode($request->data, true)];
            $data['veg_plate'] = json_decode($request->data1, true)['veg_plate'];
            $data['non_veg_plate'] = json_decode($request->data1, true)['non_veg_plate'];
            //dd($data);
        } 
        Validator::make($data, [
                // first form
                'name'    => ['sometimes','required', 'string', 'min:3', 'max:255'],
                'landline'    => ['sometimes','required','required','digits:10'],
                'number_2'    => ['sometimes','required','digits:10'],
                'watsapp'    => ['sometimes','required','digits:10'],
                'email'    => ['sometimes','required','email'],
                'type'    => ['sometimes','required'],
                //'stars'    => ['sometimes','required'],
                'address'    => ['sometimes','required','string', 'min:3', 'max:50'],
                'area'    => ['sometimes','required','string', 'min:3', 'max:50'],
                'state'    => ['sometimes', 'required','string', 'min:3', 'max:50'],
                //'country'    => ['sometimes','required','string', 'min:3', 'max:50'],
                'location_id'    => ['sometimes','required'],
                'pincode'    => ['sometimes','required','digits_between:2,8'],
                'latitude'    => ['sometimes','required','regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
                'longitude'    => ['sometimes','required','regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
                'map'    => ['sometimes','required','string', 'url'],

                //second form
                'data.Seating' => ['sometimes','required', 'numeric'],
                'data.Maximum capacity' => ['sometimes','required', 'numeric'],
                'data.uploadimg.*' => ['sometimes','required','image','mimes:jpeg,png,jpg,gif,svg','file','max:10000'],
                'data.uploadvid.*' => ['sometimes','required','mimetypes:video/avi,video/mpeg,video/mp4','max:10000'],

                //third form
                'img.*' => ['sometimes','required','image','mimes:jpeg,png,jpg,gif,svg','file','max:10000'],
                'vid.*' => ['sometimes','required','mimetypes:video/avi,video/mpeg,video/mp4','max:10000'],
                'snapchat_link'    => ['sometimes','required', 'url'],
                'twitter_link'    => ['sometimes','required', 'url'],
                'instagram_link'    => ['sometimes','required', 'url'],
                'facebook_link'    => ['sometimes','required', 'url'],
                'veg_plate'    => ['sometimes','required', 'numeric'],
                'non_veg_plate'    => ['sometimes','required', 'numeric'],
                'description'    => ['sometimes','required', 'string', 'min:100'],
                'features'   => ['sometimes','required'],

                //fourth form
                'policy.*.facilities.*' => ['sometimes','required', 'string', 'min:10', 'max:100'],
                'amenities.*.facilities.*' => ['sometimes','required', 'string', 'min:10', 'max:100'],




        ],[], [
                'name'    => 'Venue Name',
                'number_1'    => 'Number',
                'number_2'    => 'Number',
                'type'    => 'Venue Tyoe',
                'stars'    => 'Venue Stars',
                'address'    => 'Venue Address',
                'area'    => 'Area',
                'state'    => 'State',
                'location_id'    => 'District',
                'zipcode'    => 'Zipcode',
                'country'    => 'Country',
                'latitude'    => "Latitude",
                'longitude'    => 'Longitude',
                'map'    => 'Map Link',
                'data.Maximum capacity' => 'Maximum Capacity',
                'data.Seating' => 'Seating',
                'img.*' => 'Image',
                'vid.*' => 'Video',
                'data.uploadimg.*' => 'Image',
                'data.uploadvid.*' => 'Video'
        ])->validate();
    }
}

