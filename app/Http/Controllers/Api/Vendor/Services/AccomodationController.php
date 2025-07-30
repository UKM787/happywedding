<?php

namespace App\Http\Controllers\Api\Vendor\Services;

use App\Models\Host\Host;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Vendor\Vendor;
use App\Models\Host\Invitation;
use App\Models\Host\Vendorables;
use App\Http\Controllers\Controller;
use App\Models\Admin\LocationMaster;
use Illuminate\Support\Facades\Validator;
use App\Models\Vendor\Service\Accommodation;
use App\Models\Vendor\Service\AccomodationRooms;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\ContentTypes;

class AccomodationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        //dd('sss');
        if($request->type == "finalize"){
            $data = json_decode($request->data, true);
            $invi = [];
            foreach($data as $single){
                array_push($invi, Invitation::where('id', (int)$single)->first());
            }
            foreach($invi as $single){
                $exists  = Vendorables::where('invitation_id', (int)$single->id)->where('vendorable_type', 'App\Models\Vendor\Service\Accommodation')->where('vendorable_id', (int)$request->accomodation)->get();
                //var_dump($exists);
                if(count($exists) == 0){
                    Vendorables::create(['invitation_id' =>$single->id,'title' =>$request->title, 'vendorable_type' => "App\Models\Vendor\Service\Accommodation", 'vendorable_id' => (int)$request->accomodation]);
                }
            }
            return;
        }

        $this->requestValidate($request);

        if($request->all()['contentType'] == 'details'){
            $data = json_decode($request->data, true);
            //dd($request->all());
            $name = str_replace(' ', '', $data['name']);
            $added = Accommodation::create($data+['slug' => Str::slug($name, '-', 'en') . '-' . rand(1, 10000), 'accommodatable_type' => 'App\Models\Vendor\Vendor', 'accommodatable_id' => $request->vendorId,'category_id' => $request->catId, 'district' => LocationMaster::where('id' , $data['location_id'])->pluck('id')[0] ]);
            $added->services()->attach(json_decode($request->services, true),['vendor_id' => auth()->guard('vendor')->user()->id]);
            return $added->id;
        }
        if($request->all()['contentType'] == 'room'){
            $accid = (int)$request->all()['accid'];

            $vendor  =  Accommodation::where('id' , $accid)->first()->accommodatable->slug;
            $images = [];
            $videos = [];
            $index = 0;
            //dd($request->all());
            $jsonData =json_decode( $request->all()['data'], true) ;
            $name = str_replace(' ', '', $jsonData['room_type']);
            //dd($jsonData);
            $added = AccomodationRooms::create($jsonData+['slug' => Str::slug($name, '-', 'en') . '-' . rand(1, 10000), 'accomodation_id' => $request->all()['accid']]);
            $roomList = Accommodation::where('id' , $accid)->first();
            if($request->has('files')){
                foreach($request->files->all()['files'] as $single){
                    $mime =  $single->getClientMimeType();
                    $name  = $vendor.'/'.Accommodation::where('id' , $accid)->first()->slug.'/'.'rooms/'.AccomodationRooms::where('id' , $added->id)->first()->slug.'/'.time().'-'. $index++ .'-'. AccomodationRooms::where('id' , $added->id)->first()->name.'.'.$single->getClientOriginalExtension();
                    //dd($name);

                    $single->move(public_path('assets/vendors/uploads/'.$vendor.'/'.Accommodation::where('id' , $accid)->first()->slug.'/rooms/'.AccomodationRooms::where('id' , $added->id)->first()->slug. '/'), $name);
                    if(strstr($mime, "video/")){
                        array_push($videos, $name);
                    }
                    if(strstr($mime, "image/")){
                        array_push($images, $name);
                    }
                }
                AccomodationRooms::where('id' , $added->id)->first()->update(['images' => $images, "videos" => $videos]);
            }
            return [$added->accomodation_id, $roomList->rooms->all()];
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        if($request->accid){
            $host = Host::where('id', (int)$id)->first();
            $invi = $host->invitations;
            $finalInvi = [];
            foreach($invi as $single){
                $exists  = Vendorables::where('invitation_id', (int)$single->id)->where('vendorable_type', 'App\Models\Vendor\Service\Accommodation')->where('vendorable_id', (int)$request->accid)->get();
                if(count($exists) != 0){
                    array_push($finalInvi, $single->id);
                }
            }
            // /dd($finalInvi);
            return $finalInvi;
        }
        if($request->id){
            $room = AccomodationRooms::where('id' , $request->id)->first();
            return $room;
        }
        $roomList = Accommodation::where('id' , $id)->first()->rooms->all();

        return [Accommodation::where('id' , $id)->with('services')->first(), $roomList];
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
        //dd($id, $request->all());
        $this->requestValidate($request);

        if($request->all()['contentType'] == 'details'){
            Accommodation::where('id' , $id)->first()->update(json_decode($request->data, true));
            return $id;
        }
        if($request->all()['contentType'] == 'room'){
            //dd($request);
            $accid = (int)$request->all()['accid'];
            $vendor  =  Accommodation::where('id' , request()->all()['accid'])->first()->accommodatable->slug;
            $images = [];
            $videos = [];
            $index = 0;
            $added =  AccomodationRooms::where('id' , (int)$request->all()['id'])->first()->update(json_decode( $request->all()['data'], true));
            $roomList = Accommodation::where('id' , $accid)->first();

            if($request->has('uploadimg')){
                if($request->all()['uploadimg'] == 'uploadimg'){
                    $images = AccomodationRooms::where('id' , (int)request()->all()['id'])->first()->images;
                    if($images == null){
                        $images = [];
                    }
                    $videos =  AccomodationRooms::where('id' , (int)request()->all()['id'])->first()->videos;
                    if($videos == null){
                        $videos = [];
                    }
                }
            }

            if($request->has('files')){
                foreach($request->files->all()['files'] as $single){
                    $mime =  $single->getClientMimeType();
                    //dd($accid);
                    $name  = $vendor.'/'.Accommodation::where('id' , (int)$accid)->first()->slug.'/'.'rooms/'.AccomodationRooms::where('id' , (int)$request->all()['id'])->first()->slug.'/'.time().'.-'. $index++ .'-'. AccomodationRooms::where('id' , (int)$request->all()['id'])->first()->name.'.'.$single->getClientOriginalExtension();
                    //dd($name);

                    $single->move(public_path('assets/vendors/uploads/'.$vendor.'/'.Accommodation::where('id' , $accid)->first()->slug.'/rooms/'.AccomodationRooms::where('id' , (int)$request->all()['id'])->first()->slug. '/'), $name);
                    if(strstr($mime, "video/")){
                        array_push($videos, $name);
                    }
                    if(strstr($mime, "image/")){
                        array_push($images, $name);
                    }
                }
                AccomodationRooms::where('id' , (int)$request->all()['id'])->first()->update(['images' => $images, "videos" => $videos]);
            }
            //dd($request->all()['accid'], $roomList->rooms->all());
            return [$request->all()['accid'], $roomList->rooms->all()];
            //return $id;
        }
        if($request->all()['contentType'] == 'json'){
            //dd(json_decode($request->data));
            Accommodation::where('id' , $id)->first()->update(['accom_facilities'=>json_decode($request->data, true)]);
            return $id;
        }
        if($request->all()['contentType'] == 'image'){
            $vendor  =  Accommodation::where('id' , $id)->first()->accommodatable->slug;
            $images = [];
            $videos = [];
            $index = 0;

            if($request->has('uploadimg')){
                if($request->all()['uploadimg'] == 'uploadimg'){
                    $images = Accommodation::where('id' , $id)->first()->images;
                    if($images == null){
                        $images = [];
                    }
                    $videos =  Accommodation::where('id' , $id)->first()->videos;
                    if($videos == null){
                        $videos = [];
                    }
                }
            }

           //dd($
            if($request->has('files')){
                foreach($request->files->all()['files'] as $single){
                    $mime =  $single->getClientMimeType();
                    $name  = $vendor.'/'.Accommodation::where('id' , $id)->first()->slug.'/'.time().'.-'. $index++ .'-'. Accommodation::where('id' , $id)->first()->name.'.'.$single->getClientOriginalExtension();

                    $single->move(public_path('assets/vendors/uploads/'.$vendor.'/'.Accommodation::where('id' , $id)->first()->slug.'/'), $name);
                    if(strstr($mime, "video/")){
                        array_push($videos, $name);
                    }
                    if(strstr($mime, "image/")){
                        array_push($images, $name);
                    }
                }
                Accommodation::where('id' , $id)->first()->update(['images' => $images, "videos" => $videos]);
            }
            Accommodation::where('id' , $id)->first()->update(json_decode($request->data, true));
            // Accommodation::where('id' , $id)->first()->update(['images' => $images, "videos" => $videos]);
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
        //dd($id);
        $myArray = explode(',', $id);
        
        if($myArray[0] == 'room'){
            $acc = AccomodationRooms::where('id', $myArray[1])->first()->accomodation;
            $owner = $acc->accommodatable;
            if($myArray[4] == 'image'){
                $files  = AccomodationRooms::where('id', $myArray[1])->first()->images;
            }
            if($myArray[4] == 'video'){
                $files  = AccomodationRooms::where('id', $myArray[1])->first()->videos;
            }
            $index = array_search($owner->slug."/".$acc->slug."/rooms/".AccomodationRooms::where('id', $myArray[1])->first()->slug."/".$myArray[2], $files);
            array_splice($files, $index, 1);
            if(file_exists(public_path("/assets/vendors/uploads/".$owner->slug."/".$acc->slug."/rooms/".AccomodationRooms::where('id', $myArray[1])->first()->slug."/". $myArray[2]))){
                unlink(public_path("/assets/vendors/uploads/".$owner->slug."/".$acc->slug."/rooms/".AccomodationRooms::where('id', $myArray[1])->first()->slug."/". $myArray[2]));
            }
            if($myArray[4] == 'image'){
                AccomodationRooms::where('id', $myArray[1])->first()->update(['images' => $files]);
            return true;
            }
            if($myArray[4] == 'video'){
                AccomodationRooms::where('id', $myArray[1])->first()->update(['videos' => $files]);
            return true;
            }
            //dd($myArray, $images, $index);
        }
        if($myArray[0] == 'hotel'){
            //dd($myArray);
            $acc = Accommodation::where('id', $myArray[1])->first();
            //dd($acc);
            $owner = $acc->accommodatable;
            if($myArray[4] == 'image'){
                $files  = Accommodation::where('id', $myArray[1])->first()->images;
            }
            if($myArray[4] == 'video'){
                $files  = Accommodation::where('id', $myArray[1])->first()->videos;
            }
            $index = array_search($owner->slug."/".$acc->slug."/".$myArray[2], $files);
            array_splice($files, $index, 1);
            if(file_exists(public_path("/assets/vendors/uploads/".$owner->slug."/".$acc->slug."/".$myArray[2]))){
                unlink(public_path("/assets/vendors/uploads/".$owner->slug."/".$acc->slug."/".$myArray[2]));
            }
            if($myArray[4] == 'image'){
                Accommodation::where('id', $myArray[1])->first()->update(['images' => $files]);
            return true;
            }
            if($myArray[4] == 'video'){
                Accommodation::where('id', $myArray[1])->first()->update(['videos' => $files]);
            return true;
            }
        }
        if($myArray[1] == 'delete'){
            AccomodationRooms::where('id', $myArray[0])->first()->delete();
            return true;
        }
        //dd(Accommodation::where('id' , $id)->first()->rooms);
        // Accommodation::where('id' , $id)->first()->delete();
        // return true;
    }
    private function requestValidate($request)
    {

        //dd($request);

        $data =  [];
        if($request->has('data')){
        $data =json_decode($request->data, true);
        }
        //dd($data);
        if($request->has('services')){
            $services = json_decode($request->services, true);
            $data['services'] = $services;
        }
        //dd('aaa'); 
        $filevideos = [];
        $fileimages = [];
        
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
        //dd($data);
        Validator::make($data, [
                // first form
                'name'    => ['sometimes','required', 'string', 'min:3', 'max:255'],
                'number_1'    => ['sometimes','required','digits:10'],
                'number_2'    => ['sometimes','required','digits:10'],
                'stars'    => ['sometimes','required'],
                //'type'    => ['sometimes','required'],
                'address1'    => ['sometimes','required','string', 'min:3', 'max:50'],
                'address2'    => ['sometimes','required','string', 'min:3', 'max:50'],
                'email'    => ['sometimes','required','email'],
                'category_id'    => ['sometimes','required'],
                'services'    => ['sometimes','required'],             
                'state'    => ['sometimes', 'required','string', 'min:3', 'max:50'],
                //'country'    => ['sometimes','required','string', 'min:3', 'max:50'],
                'location_id'    => ['sometimes','required'],
                'zipcode'    => ['sometimes','required','digits_between:2,8'],
                'latitude'    => ['sometimes','required','regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
                'longitude'    => ['sometimes','required','regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
                'map'    => ['sometimes','required','string', 'url'],

                //second form
                'room_type'    => ['sometimes','required'],
                'sleeps'    => ['sometimes','required'],
                'beds_available'    => ['sometimes','required'],
                'total_rooms'    => ['sometimes','required'],
                'price_per_room'    => ['sometimes','required'],
                'tax_per_room'    => ['sometimes','required'],

                //second form
                // 'data.Seating' => ['sometimes','required', 'numeric'],
                // 'data.Maximum capacity' => ['sometimes','required', 'numeric'],
                // 'data.uploadimg.*' => ['sometimes','required','image','mimes:jpeg,png,jpg,gif,svg','file','max:10000'],
                // 'data.uploadvid.*' => ['sometimes','required','mimetypes:video/avi,video/mpeg,video/mp4','max:10000'],

                //third form
                'img.*' => ['sometimes','required','image','mimes:jpeg,png,jpg,gif,svg','file','max:100000'],
                'vid.*' => ['sometimes','required','mimetypes:video/avi,video/mpeg,video/mp4','max:100000'],
                'snapchat_link'    => ['sometimes','required', 'url'],
                'twitter_link'    => ['sometimes','required', 'url'],
                'instagram_link'    => ['sometimes','required', 'url'],
                'facebook_link'    => ['sometimes','required', 'url'],
                'veg_plate'    => ['sometimes','required', 'numeric'],
                'non_veg_plate'    => ['sometimes','required', 'numeric'],
                'about'    => ['sometimes','required', 'string', 'min:100'],
                'features'   => ['sometimes','required'],

                //fourth form
                'policy.*.facilities.*' => ['sometimes','required', 'string', 'min:1', 'max:100'],
                'amenities.*.facilities.*' => ['sometimes','required', 'string', 'min:1', 'max:100'],




        ],[], [
                'name'    => 'Venue Name',
                'number_1'    => 'Number',
                'number_2'    => 'Number',
                'category_id'    => 'Venue Tyoe',
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
                'data.uploadvid.*' => 'Video',
                //'amenities.*.facilities.*' => 'Accommodation Facilities',
        ])->validate();
    }
}

