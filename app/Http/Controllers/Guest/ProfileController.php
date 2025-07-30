<?php

namespace App\Http\Controllers\Guest;

use Exception;
use App\Models\User;
use App\Models\Guest\Home;
use App\Traits\ImageUpload;
use Illuminate\Support\Str;
use App\Models\Guest\Family;
use App\Models\Guest\Office;
use Illuminate\Http\Request;
use App\Models\Guest\Profile;
use App\Http\Controllers\Controller;
use App\Models\Admin\LocationMaster;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller {

    use ImageUpload;

    public function __construct() {
       // $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(User $user, Request $request) {

        if (Auth::guard('web')->check()) {
            $user= auth()->guard('web')->user();
            $guestID = $user->id;
            $profile = $user->profile;
            $states = LocationMaster::all();
            //dd($profile);
            if(isset($user->profile) && $user->profile->id != null){
                $cexists =1;
                $exists = 0;
                $oexists = 0;
                if(isset($user->home) && $user->home->id != null){
                    $exists = 1;               
                }
                if(isset($user->office) && $user->office->id != null){
                    $oexists = 1;               
                }
                return view('guest.profile.index', compact('user', 'profile', 'guestID', 'exists', 'cexists', 'oexists', 'states')) ;
            }elseif(isset($user->home) && $user->home->id != null){
                $exists = 1;
                $cexists = 0;
                $oexists = 0;
                if(isset($user->office) && $user->office->id != null){
                    $oexists = 1;               
                }
                return view('guest.profile.index', compact('user', 'profile', 'guestID', 'exists', 'cexists', 'oexists', 'states')) ;
            }else{
                $exists = 0;
                $cexists = 0;
                $oexists = 0;
                if(isset($user->office) && $user->office->id != null){
                    $oexists = 1;               
                }
                return view('guest.profile.index', compact('user', 'profile', 'guestID', 'exists', 'cexists', 'oexists', 'states')) ;
            }


        } else {
            return redirect()->route('login')
                ->with([
                    'status' => 'failure',
                    'message' =>  'Login to create your profile'
                ]);
        }


    //    if(Auth::check()){
    //         //    dd($this->user->with('home','office','family')->get()->pluck('home')flatten()->count());
    //         $user = auth()->user();
    //         switch(session()->get('tab')){
    //             case 'profile':
    //                 session(['tab' => 'profile']);
    //                 break;
    //             case 'home':
    //                session(['tab' => 'home']);
    //                 break;
    //             case 'office':
    //                 session(['tab' => 'office']);
    //                 break;
    //             case 'family':
    //                 session(['tab' => 'family']);
    //                 break;

    //             default:
    //                 session(['tab' => 'profile']);
    //             break;
    //         }


    //         if($user->profile  != null ) {
    //             //session(['tab' => 'profile']);
    //             return view('guest.profile.index', ['user' => $user, 'profile' => $user->profile, 'home' => $user->home, 'office' => $user->office, 'family' =>  new Family() ]);
    //         }
    //         else {
    //             $profile = new Profile();
    //             $home = new Home();
    //             $office = new Office();
    //             $family = new Family();
    //             return redirect()->route('guestprofile.create', [ $user, $profile, $home, $office,  $family]);
    //         }
    //    } else {
    //        return redirect()->route('login')
    //        ->with([
    //            'status' => 'failure',
    //            'message' =>  'Login to create your profile'
    //        ]);
    //    }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user) {
        if(Auth::check()){
            if (isset($user->profile)) {
                $profile = $user->profile;
            } else {
                $profile = new Profile();
            }
            if (isset($user->home)) {
                $home = $user->home;
            } else {
                $home = new Home();
            }
            if (isset($user->office)) {
                $office = $user->office;
            } else {
                $office = new Office();
            }
            if (isset($user->family)) {
                $family = $user->family;
            } else {
                $family = new Family();
            }
            session(['tab' => 'profile']);
            return view('guest.profile.create', compact('user','home','office','family'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(User $user, Request $request)  {

        $data =  $this->requestValidate($request);
        $destImgPath = '\/guests/' . $data['name'];

        if(auth()->check()){
            if (request()->file('imageOne') == null) {
                $data['imageOne'] = '/guests/guestDefault.png';
            }
            try {                $profile = Profile::create($data + ['guest_id' => $user->id, 'slug' => Str::slug($request->id . '-' . $request->name)]);
                if ($profile) {
                    if ($request->file('imageOne') !== null) {
                        $this->storeImage($profile, $destImgPath, 'imageOne');
                    }
                }
                return redirect()->route('guestprofile.index', [$user])
                    ->with([
                        'tab' => 'profile',
                        'status' => 'success',
                        'message' => ' profile added successfully, Add Home Address'
                    ]);
            } catch (Exception $e) {
                return redirect()->back()->with([
                    'status' => 'failure',
                    'message' => $user->name . ' Profile creation failed, Try Again',
                ]);
            }

        }
        if(auth()->guard('host')->check()){
            if (request()->file('imageOne') == null) {
                $data['imageOne'] = '/guests/guestDefault.png';
            }
            try {

                $profile = Profile::create($data + ['guest_id' => $user->id, 'slug' => Str::slug($request->id . '-' . $request->name)]);
                if ($profile) {
                    if ($request->file('imageOne') !== null) {
                        $this->storeImage($profile, $destImgPath, 'imageOne');
                    }
                }
                return redirect()->back()
                    ->with([
                        'tab' => 'profile',
                        'status' => 'success',
                        'message' => ' profile added successfully, Add Home Address'
                    ]);
            } catch (Exception $e) {
                return redirect()->back()->with([
                    'status' => 'failure',
                    'message' => $user->name . ' Profile creation failed, Try Again',
                ]);
            }
        }

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, Profile $profile)  {
        $home = new Home();
        $office = new Office();
        $family = new Family();
        $profile = $user->profile;
        return view('guest.profile.show', compact('user', 'profile','home','office','family'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)  {
        $route = Route::currentRouteName();
        //dd('ss', $route);
        $profile= $user->profile;
       return view('guest.profile.edit', compact('user', 'profile', 'route'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(User $user, Profile $profile, Request $request) {
        $data =  $this->requestValidate($request);
        //dd($data);
        $destImgPath = '\/guests/' . $data['name'];
        if (auth()->check()) {
            if ($request->file('imageOne') == null) {
                unset($data['imageOne']);
            } else {
                $data['imageOne'] = $request->file('imageOne');
            }

            try {
                $newprofile = $profile->update($this->requestValidate($request) + ['guest_id' => $user->id, 'slug' => Str::slug($request->id . '-' . $request->name)]);

                if ($newprofile) {
                    if ($request->file('imageOne') != null) {
                        $this->storeImage($profile, $destImgPath, 'imageOne');
                    }
                }
                return redirect()->route('guestprofile.index', [$user])
                    ->with([
                        'tab' => 'profile',
                        'status' => 'success',
                        'message' => ' Profile updated  successfully'
                    ]);
            } catch (Exception $e) {
                return redirect()->back()->with([
                    'status' => 'failure',
                    'message' => $e->getMessage(),
                ]);
            }
        }
        if (auth()->guard('host')->check()) {

            if ($request->file('imageOne') == null) {
                unset($data['imageOne']);
            } else {
                $data['imageOne'] = $request->file('imageOne');
            }
            try {
                $newprofile = $profile->update($this->requestValidate($request) + ['guest_id' => $user->id, 'slug' => Str::slug($request->id . '-' . $request->name)]);

                if ($newprofile) {
                    if ($request->file('imageOne') != null) {
                        $this->storeImage($profile, $destImgPath, 'imageOne');
                    }
                }
                return redirect()->back()
                    ->with([
                        'tab' => 'profile',
                        'status' => 'success',
                        'message' => ' Profile updated  successfully'
                    ]);
            } catch (Exception $e) {
                return redirect()->back()->with([
                    'status' => 'failure',
                    'message' => $e->getMessage(),
                ]);
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

    /**
     * Validatating the form data.
     *
     * @param  App\Models\Guest\Profile
     * @return \Illuminate\Http\Response
     */

    /**
     * Storing and updating the guest_image
     *
     * @param  App\Models\Guest\Profile
     * @return \Illuminate\Http\Response
     */

    private function requestValidate($request)  {

            return $request->validate([
            'name'          => ['required','string','min:2','max:255'],
            'fatherName'   => ['required','string','min:2','max:255'],
            'surname'       => ['required','string','min:2','max:255'],
            'age'           => ['required','string'],
            'gender'        => ['required','string'],
            'relation'      => ['required','string'],
            'email'         => ['required','email','min:2','max:100'],
            'phone'         => ['required','string'],
            'mobile'       => ['required', 'string','min:10', 'max:13'],
            'mobile1'       => ['sometimes', 'string', 'min:10', 'max:13'],
            'whatsup'       => ['required','string', 'min:10', 'max:13'],
            'imageOne'      => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ],
        [
            'name.required' => 'name is required',
            'fatherName.required' => 'fathername is required',
            'surname.required' => 'surname is required',
            'age.required' => 'age is required',
            'gender.required'    => 'gender is required',
            'relation.required' => 'relationship is required',
            'phone.required' => 'phone is required',
            'email.required' => 'email id is required',
            'mobile.required' => 'mobile number is required',
            'mobile1.required'    => 'alternate mobile number is required',
            'whatsup.required'  => 'what\'s up number is required'

        ]

        );
    }

        private function storeImage($data, $folder, $image) {

            if (request()->has($image)) {
                // resizing image using intrvention/image
                if ($data->update([$image => request()->$image->store($folder , 'public')])) {
                    $guest_image = Image::make(public_path('storage/' . $data->$image))->fit(100, 100);
                    $guest_image->save();
                }

            }
        }

}
