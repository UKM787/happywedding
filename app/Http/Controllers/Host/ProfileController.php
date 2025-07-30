<?php

namespace App\Http\Controllers\Host;

use Exception;
use App\Models\Host\Home;
use App\Models\Host\Host;
use App\Models\Host\Office;
use App\Traits\ImageUpload;
use Illuminate\Support\Str;
use App\Models\Host\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class ProfileController extends Controller
{

    use ImageUpload;

    public function __construct()
    {
        //$this->middleware('auth:host');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()  {

        if (Auth::guard('host')->check()) {
            $host= auth()->guard('host')->user();
            $host = Host::where('id', $host->id)->with('profile')->first();
            $hostID = $host->id;
            $profile = $host->profile;
            $subscription = $host->activeSubscription();
            //dd($host->activeSubscription());
            if(isset($host->profile)){
                $cexists =1;
                $exists = 0;
                $oexists = 0;
                if(isset($host->home)){
                    $exists = 1;               
                }
                if(isset($host->office)){
                    $oexists = 1;               
                }
                return view('host.profile.index', compact('host', 'profile', 'hostID', 'exists', 'cexists', 'oexists', 'subscription')) ;
            }elseif($host->home){
                $exists = 1;
                $cexists = 0;
                $oexists = 0;
                if(isset($host->office)){
                    $oexists = 1;               
                }
                return view('host.profile.index', compact('host', 'profile', 'hostID', 'exists', 'cexists', 'oexists', 'subscription')) ;
            }else{
                $exists = 0;
                $cexists = 0;
                $oexists = 0;
                if(isset($host->office)){
                    $oexists = 1;               
                }
                return view('host.profile.index', compact('host', 'profile', 'hostID', 'exists', 'cexists', 'oexists', 'subscription')) ;
            }


        } else {
            return redirect()->route('login')
                ->with([
                    'status' => 'failure',
                    'message' =>  'Login to create your profile'
                ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        // if (Auth::guard('host')->check()) {
        //     $host = auth()->guard('host')->user();
        //     return view('host.profile.create', ['host' => $host, 'profile' => $host->profile, 'hosthome' => $host->home, 'hostoffice' => $host->office]);
        // }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Profile $currentProfile)  {
        
        // $data =  $this->requestValidate($request);

        // if (request()->file('imageOne') == null) {
        //     $data['imageOne'] = '\defaultsv1\avatar.png';
        // }
        // $destImgPath = '\/hosts/' . $data['name'];

        // if (auth()->guard('host')->check()) {
        //     $host = auth()->guard('host')->user();
        //     try {
        //         $profile = Profile::create($data + ['host_id' => auth()->guard('host')->user()->id, 'slug' => Str::slug($request->name)]);

        //         if ($profile) {
        //              if ($request->file('imageOne') != null) {
        //                 $this->storeImage($profile, $destImgPath, 'imageOne', $currentProfile);
        //             }
        //         }
        //         return redirect()->route('hostprofile.index')
        //             ->with([
        //                 'tab' => 'profile',
        //                 'status' => 'success',
        //                 'message' => $host->name . ' Profile created, Proceed for Adding Home Address'
        //             ]);
        //     } catch (Exception $e) {
        //         return redirect()->back()->with([
        //             'status' => 'failure',
        //             'message' => $host->name . ' Profile creation failed, Try Again',
        //         ]);
        //     }
        // }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( Profile $profile)    {
        // $host = auth()->guard('host')->user();
        // $hosthome = new Home();
        // $hostoffice = new Office();
        // return view('host.profile.show', compact('host', 'profile', 'hosthome', 'hostoffice'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)   {
        // $host = auth()->guard('host')->user();
        // $route = Route::currentRouteName();
        // return view('host.profile.edit', compact('host', 'profile', 'route'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Profile $profile, Request $request)  {
        // $data =  $this->requestValidate($request);
        // $currentInvitation = $profile->imageOne;

        // $destImgPath = '\/hosts/' . $data['name'] ;

        // if (auth()->guard('host')->check()) {
        //     $host = auth()->guard('host')->user();
        //         try {
        //             $newprofile = $profile->update($this->requestValidate($request) + ['host_id' => $host->id, 'slug' => Str::slug($request->name)]);

        //                 if ($newprofile) {
        //                     if ($request->file('imageOne') != null) {
        //                         $this->storeImage($profile, $destImgPath, 'imageOne', $currentInvitation);
        //                     }
        //                     return redirect()->route('hostprofile.index', [$profile])
        //                         ->with([
        //                             'tab' => 'profile',
        //                             'status' => 'success',
        //                             'message' => $host->name . ' profile updated  successfully'
        //                         ]);
        //                 }
        //         }
        //         catch (Exception $e) {
        //             return redirect()->back()->with([
        //                 'status' => 'failure',
        //                 'message' => $e->getMessage(),
        //             ]);
        //         }
        // }
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

    /**
     * Validatating the form data.
     *
     * @param  App\Models\Guest\GuestProfile
     * @return \Illuminate\Http\Response
     */

    /**
     * Storing and updating the guest_image
     *
     * @param  App\Models\Guest\GuestProfile
     * @return \Illuminate\Http\Response
     */

    private function requestValidate($request)
    {

        return $request->validate([
            'name'          => ['required', 'string', 'min:3', 'max:100'],
            'fatherName'   =>  ['required', 'string', 'min:3', 'max:100'],
            'surname'       => ['required', 'string', 'min:2', 'max:50'],
            'age'           => ['required', 'string'],
            'gender'        => ['required', 'string'],
            'relation'      => ['required', 'string'],
            'email'         => ['required', 'string', 'email', 'min:2', 'max:100'],
            'phone'         => ['required', 'string'],
            'mobile'       => ['required', 'string', 'min:10', 'max:13'],
            'mobile1'       => ['sometimes', 'string', 'min:10', 'max:13'],
            'whatsup'       => ['required', 'string', 'min:10', 'max:13'],
            'imageOne'      => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
    }

    // private function storeImage($data, $folder, $image)
    // {

    //     if (request()->has($image)) {
    //         // resizing image using intrvention/image
    //         if ($data->update([$image => request()->$image->store($folder, 'public')])) {
    //             $guest_image = Image::make(public_path('storage/' . $data->$image))->fit(100, 100);
    //             $guest_image->save();
    //         }
    //     }
    // }
}
