<?php

namespace App\Http\Controllers\Host;

use PDO;
use Exception;
use App\Models\User;
use App\Models\Host\Host;
use App\Models\Host\Guest;
use App\Mail\NewInvitation;
use GuzzleHttp\Client;


use Illuminate\Support\Str;
use App\Exports\UsersExport;
use App\Imports\GuestImport;
use App\Models\Guest\Family;
use Illuminate\Http\Request;

use App\Exports\GuestAllExport;
use App\Imports\GuestAllImport;
use App\Models\Host\Invitation;
use Illuminate\Validation\Rule;
use App\Exports\GuestHomeExport;
use App\Imports\GuestHomeImport;


use App\Mail\WeddingInvitations;
use App\Models\PushNotification;
use App\Jobs\SendNotificationJob;
use App\Exports\GuestFamilyExport;
use App\Exports\GuestOfficeExport;
use App\Imports\GuestFamilyImport;
use App\Imports\GuestOfficeImport;
use App\Exports\GuestFamilyExport1;

use App\Exports\GuestProfileExport;
use App\Exports\WatsappExport;
use App\Imports\GuestProfileImport;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Guest\GuestInvitation;
use App\Models\Guest\Profile;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\HeadingRowImport;
use App\Notifications\GlobalNotification;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Notification;
use App\Notifications\Host\InvitationNotifications;

class GuestInvitationController extends Controller {

    public function __construct(){
          //$this->middleware('auth');
        //   $this->middleware('auth:host');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($invi = null){
        if($invi == null){
            return redirect(route('hostinvitations.index'));
        }
        $host = auth()->guard('host')->user();
        $host = Host::where('id', $host->id)->with('profile')->first();
        $invitation = Invitation::where('slug', $invi)->first();
            $users = $invitation->guestlist($invitation)->get();
            $ceremonyList = $invitation->ceramonies;

            foreach ($users as $user) {
                $user['profile'] = $user->profile;
                $user['home'] = $user->home;
                $user['office'] = $user->office;
                $user['family'] = $user->family;
                $user->pivot->ceremony_invite = json_decode($user->pivot->ceremony_invite);

            }
            $active = 'guests';
            return view('host.invitation.guests.index', ['host' => $host, 'invitation' => $invitation, 'users' => $users, 'ceremonyList' => $ceremonyList, 'active' => $active]);
    }


    /**
     * @return \Illuminate\Support\Collection
     */
    public function export(Invitation $invitation)
    {
        //$users = $invitation->guests;
        return Excel::download(new UsersExport($invitation), 'Guest.xlsx');
    }
    public function allexport(Invitation $invitation)
    {   
        //$users = $invitation->guests;
        return Excel::download(new GuestAllExport($invitation), 'GuestAll.xlsx');
    }
    public function family1(Invitation $invitation)
    {
        //$users = $invitation->guests;
        return Excel::download(new GuestFamilyExport1($invitation), 'GuestFamily.xlsx');
    }


    // public function exportGuestprofile(Host $host,Invitation $invitation){

        //     return Excel::download(new GuestProfileExport($invitation), 'GuestProfile.xlsx');
    // }

    // public function exportGuesthome(Host $host,Invitation $invitation){  
        //     return Excel::download(new GuestHomeExport($invitation), 'GuestHome.xlsx');
    // }

    // public function exportGuestoffice(Host $host,Invitation $invitation) {     
        //     return Excel::download(new GuestOfficeExport($invitation), 'GuestOffice.xlsx');
    // }

    // public function exportGuestfamily(Host $host,Invitation $invitation){
        
    //         return Excel::download(new GuestFamilyExport($invitation), 'family.xlsx');
    // }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function store(Invitation $invitation, Request $request) {

        //dd($request);
        if($request->type == "single"){
            $data = $request->all();
            $data['email'] = strtolower($data['email']);
            
            //dd($request->email, $data, $request);
            $userExist = User::where('mobile', $data['mobile'])->first();
            if($userExist){
                $userinvi = GuestInvitation::where('user_id', $userExist->id)->where('invitation_id', $invitation->id)->first();
                if($userinvi){
                    $users = $invitation->guestlist($invitation)->get();
                    foreach ($users as $user) {
                            $user['profile'] = $user->profile;
                            $user['home'] = $user->home;
                            $user['office'] = $user->office;
                            $user['family'] = $user->family;
                            $user->pivot->ceremony_invite = json_decode($user->pivot->ceremony_invite);
                        }
                    return $users;
                }else{
                    //dd('create invi');
                    GuestInvitation::create(['user_id' => $userExist->id, 'invitation_id' => $invitation->id]);
                    $users = $invitation->guestlist($invitation)->get();
                    foreach ($users as $user) {
                            $user['profile'] = $user->profile;
                            $user['home'] = $user->home;
                            $user['office'] = $user->office;
                            $user['family'] = $user->family;
                            $user->pivot->ceremony_invite = json_decode($user->pivot->ceremony_invite);
                        }
                    return $users;
                }          
            }else{
                // $mobiles = User::pluck('mobile')->toArray();
                // $mobileExist = array_search($request->mobile,$mobiles);
                // //dd($request->mobile,$mobiles, $mobileExist, $mobileExist !== false);
                // if($mobileExist !== false){
                //     return response([
                //         'message' => 'Mobile Already Associated with another email id!!'
                //     ], 422);
                // }else{
                    //$data['password'] = Hash::make($data['password']);
                    $userAdded = User::create($data+['slug' => Str::slug($request->name, '-', 'en').'-'.rand(1, 10000)]);
                    Profile::create(['name' => $data['name'], 'email' => strtolower($data['email']), 'mobile' => $data['mobile'], 'guest_id' => $userAdded->id]);
                    GuestInvitation::create(['user_id' => $userAdded->id, 'invitation_id' => $invitation->id]);
                    $users = $invitation->guestlist($invitation)->get();
                    foreach ($users as $user) {
                            $user['profile'] = $user->profile;
                            $user['home'] = $user->home;
                            $user['office'] = $user->office;
                            $user['family'] = $user->family;
                            $user->pivot->ceremony_invite = json_decode($user->pivot->ceremony_invite);
                        }
                    return $users;
                //}
                //dd('create USer', $mobileExist ,$mobiles);
            }
        }
        //dd('excel', $request->file('guests')->getClientMimeType());
        $request->validate([
            'guests'=>'required|mimes:csv,xlsx,xls',
        ]);
        // $import = new GuestImport($invitation->id);
        // $data = $request->file('guests');
        // $import->import($data);
        $records = User::select('name','email','id')->get();
        $lastInsertedID = null;
        if($records->count() == 0){
            User::create([
                        'name'      => 'dummyData',
                        'email'     => 'dummy@email.com',
                        'mobile'    => '123123123',
                        'password'  => 'dummy',
                        'slug'      => 'dummy',  
                    ]);
            $lastInsertedID = User::select('name','email','id')->orderBy('id', 'desc')->first();      
            User::destroy($lastInsertedID->id);
            //dd($lastInsertedID->id);
        }
        if($records->count() != 0){
            $lastInsertedID = User::select('name','email','id')->orderBy('id', 'desc')->first(); 
        }

        $headings = (new HeadingRowImport(3))->toArray(request()->file('guests'));
        $columns = $headings[0][0];
        // /dd($columns);
        
        if ($columns[0] == 'name' && $columns[1] == 'email'&& $columns[2] == 'mobile'&& $columns[3] == 'password'&& $columns[4] == 'fathername'&& $columns[5] == 'surname'&& $columns[6] == 'age'&& $columns[7] == 'gender'&& $columns[8] == 'relation'&& $columns[9] == 'phone'&& $columns[10] == 'mobile1'&& $columns[11] == 'whatsup'){
                    $import = new GuestImport($invitation, $lastInsertedID->id);
         //dd('hh');

        try {
            $import->import(request()->file('guests'));
            //dd('passed',$import->errors());
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            //dd('failed',$import->errors(), $failures);
           // dd('s', $e);
        //     return redirect()->route('guestupload', [$invitation])->with(
        //     [
        //     'errorStatus' => $failures,
        //     ],
        //  );
        //dd($failures);
            return response()->json([
                'message'    => 'Kindly correct the feilds with error!',
                'errors' => $failures,
            ], 422);
             //throw  $failures;
        }
        // return redirect()->route('invitedguests.index', [ $invitation])->with([
        //     'status' => 'success',
        //     'message' => 'guestlist imported successfully'
        // ]);
            $users = $invitation->guestlist($invitation)->get();
            foreach ($users as $user) {
                    $user['profile'] = $user->profile;
                    $user['home'] = $user->home;
                    $user['office'] = $user->office;
                    $user['family'] = $user->family;
                    //$user['ceramonies'] = $user->ceramonies;
                    $user->pivot->ceremony_invite = json_decode($user->pivot->ceremony_invite);

                    // if(in_array($user->profile->relation, $relationList)){
                    //     continue;
                    // }else{
                    //     array_push($relationList, $user->profile->relation);
                    // }
                //dd($user->profile->relation);
                }
            return $users;
        }else{
            //dd('error');
        //     return redirect()->route('invitedguests.index', [ $invitation])->with([
        //     'status' => 'Fail',
        //     'message' => ' Kindly select same format'
        // ]);
         return response()->json([
                'message'    => 'Kindly select correct format!',
                'errors' => null,
            ], 422);
        }


        //$import = new GuestImport($invitation, $lastInsertedID->id);
        //$import->import(request()->file('guests'));
        //dd($import->errors());
        //$importFailures = $import->failures();
        //if($importFailures->count() != 0){
        //     return redirect()->route('invitedguests.index', [$invitation])->with(
        //     [
        //     'status' => 'success',
        //     'message' => 'Guest Details uploaded imported successfully',
        //     'errorStatus' => $importFailures,
        //     ],
        //  );
        // }
        // Excel::import(new GuestImport($invitation->id),request()->file('guests'));
        // $guestlist = Guest::pluck('mobile');
        // $users = User::all();
        // $guesttoinvite = $users->whereIn('mobile', $guestlist);
        // $invitation->invitedguests($invitation)->sync($guesttoinvite, ['status' => 0, 'invite' => 0, 'logistics' => 0, 'accomodation' => 0]);
    }

    public function ceremonyUpdate($host,$invitation,$guest, Request $request){
        $data = json_decode($request->data, true);
        $invi = Invitation::where('id', (int)$invitation)->first();
        $guestinvi = GuestInvitation::where([
            ['invitation_id', '=', (int)$invitation],
            ['user_id', '=', (int)$guest]
        ])->first();
        //dd($guestinvi->ceremony_invite, $data);
        if(count($guestinvi->ceremony_invite) == 0){
            $guestinvi->update(['ceremony_invite' => $data]);
        }else{
            $array_keys = array_keys($data);
            $currentData = $guestinvi->ceremony_invite;
            //dd($array_keys, $currentData);
            foreach ($array_keys as $array_key) {
                //dd('ddd');
                // if(isset($currentData[$array_key])){
                    $currentData[$array_key] = $data[$array_key];
                // }else{
                    //dd($currentData);
                    //$currentData[$array_key] = $data[$array_key];
                    //array_push($currentData,[$array_key => $data[$array_key]]);
                // }
            }
            $guestinvi->update(['ceremony_invite' => $currentData]);

        }
        // $users = $invi->guestlist($invi)->get();
        // foreach ($users as $user) {
        //         $user['profile'] = $user->profile;
        //         $user['home'] = $user->home;
        //         $user['office'] = $user->office;
        //         $user['family'] = $user->family;
        //         //$user['ceramonies'] = $user->ceramonies;
        //         $user->pivot->ceremony_invite = json_decode($user->pivot->ceremony_invite);
        //        // dd($user->pivot);
        //     }

       // dd($guestinvi->ceremony_invite);
        return $guestinvi->ceremony_invite;
    }


    public function deleteGuest($host,$invitation,$guest){
       // dd(User::find($guest)->arrival($invitation)->first());
        $invi = Invitation::where('id', (int)$invitation)->first();
        $guest=User::find($guest);
        $guestinvi=GuestInvitation::where('user_id',$guest->id)->where('invitation_id', (int)$invitation)->first();
        $guestinvi->delete();
        //dd($guest->arrival($invitation)->first());
        if($guest->arrival($invitation)->first()){
            //dd('ss', $guest->arrival($invitation)->first(), $guest->arrival($invitation)->first()->delete());
            $guest->arrival($invitation)->first()->delete();
        }
        if($guest->departure($invitation)->first()){
            $guest->departure($invitation)->first()->delete();
        }
        if($guest->accommodation($invitation)->first()){
            $guest->accommodation($invitation)->first()->delete();
        }
        //dd('delete');
        if(count($guest->privilege($invitation)->get()) > 0){
            $guest->privilege($invitation)->delete();
        }
        //dd('sss');
        return $invi->guestlist($invi)->with('profile', 'home', 'office', 'family')->get();
        //$user=Guest::where('email',$guest->email)->first();
        //$user->delete();
        //$guest->delete();
        // return redirect()->route('invitedguests.index', [ $invitation])->with([
        //     'status' => 'success',
        //     'message' => 'Guest Deleted Sucessfully',
        // ]);
    }

    public function guestAll(Host $host, Invitation $invitation, Request $request){
        $request->validate([
            'guestAll'=>'required|mimes:csv,xlsx,xls',
        ]);
        // $test=Rule::unique('guest_invitation','user_id')
        //             ->where('invitation_id',$invitation->id)
        //             ->ignore('id');
        // dd($test);

        // Helps to find the last inserted ID if the table is empty
        $records = User::select('name','email','id')->get();
        $lastInsertedID = null;
        if($records->count() == 0){
            User::create([
                        'name'      => 'dummyData',
                        'email'     => 'dummy@email.com',
                        'mobile'    => '123123123',
                        'password'  => 'dummy',
                        'slug'      => 'dummy',  
                    ]);
            $lastInsertedID = User::select('name','email','id')->orderBy('id', 'desc')->first();      
            User::destroy($lastInsertedID->id);
            //dd($lastInsertedID->id);
        }
        if($records->count() != 0){
            $lastInsertedID = User::select('name','email','id')->orderBy('id', 'desc')->first(); 
        }

        $headings = (new HeadingRowImport(3))->toArray(request()->file('guestAll'));
        $columns = $headings[0][0];

        //dd($columns);
        try{
        if ($columns[0] == 'name' && $columns[1] == 'email'&& $columns[2] == 'mobile'&& $columns[3] == 'password'&& $columns[4] == 'fathername'&& $columns[5] == 'surname'&& $columns[6] == 'age'&& $columns[7] == 'gender'&& $columns[8] == 'relation'&& $columns[9] == 'phone'&& $columns[10] == 'mobile1'&& $columns[11] == 'whatsup'&& $columns[12] == 'complexname'&& $columns[13] == 'floor'&& $columns[14] == 'doorno'&& $columns[15] == 'streetno'&& $columns[16] == 'area'&& $columns[17] == 'district'&& $columns[18] == 'pin'&& $columns[19] == 'state'&& $columns[20] == 'zone'&& $columns[21] == 'country'&& $columns[22] == 'reachus'&& $columns[23] == 'companyname'&& $columns[24] == 'companycomplexname'&& $columns[25] == 'companyfloor'&& $columns[26] == 'companydoorno'&& $columns[27] == 'companystreetno'&& $columns[28] == 'companyarea'&& $columns[29] == 'companydistrict'&& $columns[30] == 'companystate'&& $columns[31] == 'companypin'&& $columns[32] == 'companyzone'&& $columns[33] == 'companycountry'&& $columns[34] == 'companyreachus'&& $columns[35] == 'relationname'&& $columns[36] == 'relationage'&& $columns[37] == 'relationgender'&& $columns[38] == 'relation'&& $columns[39] == 'relationmobile'&& $columns[40] == 'share'){
        
            $import = new GuestAllImport($invitation, $lastInsertedID->id);


        
            try {
            $import->import(request()->file('guestAll'));
            //dd($import->import(request()->file('guestAll')));
        
            } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
                $failures = $e->failures();
                //dd($import->errors(), $failures);
                // return redirect()->route('invitedguests.index', [$invitation])->with(
                //     [
                //     'errorStatus' => $failures,
                //     ],
                // );
                 return response()->json([
                'message'    => 'Kindly correct the feilds with error!',
                'errors' => $failures,
            ], 422);
            }

            // return redirect()->route('invitedguests.index', [$invitation])->with([
            //     'status' => 'success',
            //     'message' => 'Guest Details uploaded imported successfully'
            // ]);
            $users = $invitation->guestlist($invitation)->get();
                foreach ($users as $user) {
                        $user['profile'] = $user->profile;
                        $user['home'] = $user->home;
                        $user['office'] = $user->office;
                        $user['family'] = $user->family;
                        //$user['ceramonies'] = $user->ceramonies;
                        $user->pivot->ceremony_invite = json_decode($user->pivot->ceremony_invite);

                        // if(in_array($user->profile->relation, $relationList)){
                        //     continue;
                        // }else{
                        //     array_push($relationList, $user->profile->relation);
                        // }
                    //dd($user->profile->relation);
                    }
            return $users;
        }else{
        //     return redirect()->route('invitedguests.index', [$invitation])->with([
        //     'status' => 'Fail',
        //     'message' => 'Kindly select same format'
        // ]);
        return response()->json([
                'message'    => 'Kindly select correct format!',
                'errors' => null,
            ], 422);
        }}
        catch(Exception $e){
            return response()->json([
                'message'    => 'Kindly select correct format!',
                'errors' => null,
            ], 422);
        }
        // $import = new GuestAllImport($invitation, $lastInsertedID->id);
        // $import->import(request()->file('guestAll'));
        // $importFailures = $import->failures();
        // //dd($import->failures(), $import->errors());
        // if($importFailures->count() != 0){
        //     return redirect()->route('invitedguests.index', [$invitation])->with(
        //     [
        //     'status' => 'success',
        //     'message' => 'Guest Details uploaded imported successfully',
        //     'errorStatus' => $importFailures,
        //     ],
        //  );
        // }
  
         //Excel::import(new GuestAllImport($invitation, $lastInsertedID->id),request()->file('guestAll'));
        
        
        // $guestlist = Guest::pluck('mobile');
        
        // $users = User::all();
        // $guesttoinvite = $users->whereIn('mobile', $guestlist);
        

        // $invitation->invitedguests($invitation)->sync($guesttoinvite, ['status' => 0, 'invite' => 0, 'logistics' => 0, 'accomodation' => 0]);
    }

    // public function guestprofiles(Host $host, Invitation $invitation, Request $request)
        // {   
        //     $request->validate([
        //         'guestprofile'=>'required|mimes:csv,xlsx,xls',
        //     ]);
        //     Excel::import(new GuestProfileImport, request()->file('guestprofile'));
        //     // $guestlist = Guest::pluck('mobile');
        //     // $users = User::all();
        //     // $guesttoinvite = $users->whereIn('mobile', $guestlist);
        //     // $invitation->invitedguests($invitation)->attach($guesttoinvite, ['status' => random_int(0, 3), 'logistics' => rand(0, 2), 'accomodation' => rand(0, 1), 'host_id' => $invitation->host_id]);
            
        //     return redirect()->route('invitedguests.index', [$invitation])->with([
        //         'status' => 'success',
        //         'message' => 'guestprofile imported successfully'
        //     ]);
    // }

    // public function guesthomes(Host $host, Invitation $invitation, Request $request){
        //     $request->validate([
        //         'homeaddress'=>'required|mimes:csv,xlsx,xls',
        //     ]);
        //     Excel::import(new GuestHomeImport, request()->file('homeaddress'));
        //     return redirect()->route('invitedguests.index', [$invitation])->with([
        //         'status' => 'success',
        //         'message' => 'guest home imported successfully'
        //     ]);
    // }

    // public function guestoffices(Host $host, Invitation $invitation, Request $request)
        // { 
        //     $request->validate([
        //     'officeaddress'=>'required|mimes:csv,xlsx,xls',
        //     ]);
        //     Excel::import(new GuestOfficeImport, request()->file('officeaddress'));
        //     return redirect()->route('invitedguests.index', [$invitation])->with([
        //         'status' => 'success',
        //         'message' => 'guest office imported successfully'
        //     ]);
    // }

    // public function guestFamily(Host $host, Invitation $invitation, Request $request)
        // {
        //     $request->validate([
        //         'familyupload'=>'required|mimes:csv,xlsx,xls',
        //     ]);
        //     Excel::import(new GuestFamilyImport, request()->file('familyupload'));
        //     return redirect()->route('invitedguests.index', [$invitation])->with([
        //         'status' => 'success',
        //         'message' => 'guest family imported successfully'
        //     ]);
    // }

    public function create(Host $host, Invitation $invitation)
    {
        $guest = new Guest();
        return view('host.invitation.guests.create', compact('host', 'invitation', 'guest'));
    }

    public function guestupload( Invitation $invitation)
    {
        $guest = new Guest();
        $host = auth()->guard('host')->user();
        return view('host.invitation.guests.upload', compact('host', 'invitation', 'guest'));
    }

    public function downloadSample($filename){
        // dd('ss');
        if($filename=='guest'){
            $path=public_path('guestlist.xlsx');
        }
        if($filename=='guestall'){
            $path=public_path('guestAll.xlsx');
        }
        return response()->download($path);
    }
    public function exportWatsapp(Invitation $invitation){
        // dd($invitation->watsappList);
        try{
            return Excel::download(new WatsappExport($invitation), 'WatsappList.xlsx');
        }catch(Exception $e){
            dd('errr' , $e);
        }

    }

    // public function sampleDownload($filename)
    // {
    //     dd($filename);
    //     // Storage::download('guestlist1.xlsx');
    //     if($filename=='guest'){
            
    //         $path=public_path('guestlist.xlsx');
    //     }
    //     elseif($filename=='guestProfile'){
            
    //         $path=public_path('guestProfile.xlsx');
    //     }
    //     elseif($filename=='guestHome'){
            
    //         $path=public_path('guestHome.xlsx');
    //     }
    //     elseif($filename=='guestOffice'){
            
    //         $path=public_path('guestOffice.xlsx');
    //     }
    //     elseif($filename=='guestFamily'){
            
    //         $path=public_path('guestFamily.xlsx');
    //     }
    //     elseif($filename=='guestall'){
    //         $path=public_path('guestAll.xlsx');
    //     }
    //     return response()->download($path);
    // }

    public function invite(Host $host, Invitation $invitation){
        $guestlist = $invitation->guestlist($invitation)->get();
        return view('host.invitation.guests.invite', compact('host','invitation','guestlist'));
    }


    public function sendinvite(Invitation $invitation, Request $request)
    {

       

        //dd($invitation->startDate, date("d-m-Y", strtotime($invitation->startDate)));
        $list = json_decode($request->data, true);
        //dd($list);
        $guests = new Collection();
        //dd($list);

        foreach ($list as  $single){
            $item = GuestInvitation::where([
                ['invitation_id', '=', $single['invitation_id']], ['user_id', '=', $single['user_id']]
            ])->first();
            if($item){
                $item->update($single + ['inviteStatus' => $single['invite'],'accommodationStatus' => $single['accommodation'],
                'logisticsArrivalStatus' => $single['logistics'], 'logisticsDepartureStatus' => $single['logistics']]);
            }
            $guests->push(User::where('id', $single['user_id'])->with(['invitations' => function ($query) use($invitation) {
                $query->where('invitation_id', $invitation->id);
            }])->first());
            // dd($single, $item);
        }
        //dd($guests);
        $users = $invitation->guestlist($invitation)->get();
        //$guestlist = $invitation->sendinvitations()->get();
        $guestlist = $guests->filter(function ($guest) {
            return $guest->invitations[0]->getOriginal('pivot_invite') != 0; 
        });
        //dd($guestlist);

        //testing notification without jobs
        // foreach ($guestlist as $guest) {
        //     try {
        //         Notification::send($guest, new InvitationNotifications($invitation->host, $invitation, 'sent you invitation'));
        //         // $guest->notify(new $this->notificationClass($this->invitation->host, $this->invitation, 'sent you invitation'));
        //     } catch (\Exception $e) {
        //         dd($e);
        //         $guest->update('email', 10);
        //         $failedEmails[] = $guest->email;
        //     }
        // }


        // $globalNotifications = PushNotification::all();
        // foreach ($globalNotifications as $guest) {
        //     try {
        //         //dd($guest->subscribable);
        //         Notification::send($guest->subscribable, new GlobalNotification());
        //         // $guest->notify(new $this->notificationClass($this->invitation->host, $this->invitation, 'sent you invitation'));
        //     } catch (\Exception $e) {
        //         dd($e->getMessage());
        //     }
        // }

        //Notification::send($guestlist, new InvitationNotifications($invitation->host, $invitation, 'sent you invitation')); 

        // $client = new Client();
        // // $message = $notification->toMSG91Sms($notifiable)['data'];
        // // $flow_id = $notification->toMSG91Sms($notifiable)['flow_id'];
        // $data = 'helo test message';
        // // $failedUsers =
        // try {
        //     $response = $client->post('https://bulksendpro.com/api/send', [
        //         'headers' => [
        //             'authkey' => '388260A6Kcd8wv5pYU63bd07b3P1',
        //             'Content-Type'     => 'application/json',
        //         ],
        //         'json' => [
        //             "number" => "919877058189",
        //             "type" => "text",
        //             "message" => $data,
        //             "instance_id" => "609ACF283XXXX",
        //             "access_token" => "65322bdd85479"
        //         ]
        //     ]);
        //     dd(json_decode($response->getBody(), true));
        // } catch (\GuzzleHttp\Exception\ClientException $e) {
        //     dd('ss', $e->getResponse()->getBody()->getContents());
        //     $response = $e->getResponse();
        //     $failedUsers =
        //         $responseBodyAsString = $response->getBody()->getContents();
        //     throw new Exception('API call failed: ' . $responseBodyAsString);
        //     // return ['status' => 'error', 'message' => $response->getStatusCode(), 'error' => $responseBodyAsString];
        // }


        // dd('abc');

        $notificationClass = 'App\Notifications\Host\InvitationNotifications';
        dispatch(new SendNotificationJob($guestlist, $invitation, $notificationClass, 'helo'));
        
        //Mail::to($guestlist)->send(new WeddingInvitations('http://wedding.test/login', 'abc', 'def'));

            foreach ($users as $user) {
                    $user['profile'] = $user->profile;
                    $user['home'] = $user->home;
                    $user['office'] = $user->office;
                    $user['family'] = $user->family;
                    //$user['ceramonies'] = $user->ceramonies;
                    $user->pivot->ceremony_invite = json_decode($user->pivot->ceremony_invite);
                }
            return $users;
    }
}