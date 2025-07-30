<?php

namespace App\Http\Controllers\Bride;

use Exception;
use App\Models\Host\Home;
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
        //$this->middleware('auth:bride');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()  {

        if (Auth::guard('host')->check()) {
            $bride= auth()->guard('host')->user();
            $brideID = $bride->id;
            $profile = $bride->profile;
            if(isset($bride->profile)){
                $cexists =1;
                $exists = 0;
                $oexists = 0;
                if(isset($bride->home)){
                    $exists = 1;               
                }
                if(isset($bride->office)){
                    $oexists = 1;               
                }
                return view('bride.profile.index', compact('bride', 'profile', 'brideID', 'exists', 'cexists', 'oexists')) ;
            }elseif($bride->home){
                $exists = 1;
                $cexists = 0;
                $oexists = 0;
                if(isset($bride->office)){
                    $oexists = 1;               
                }
                return view('bride.profile.index', compact('bride', 'profile', 'brideID', 'exists', 'cexists', 'oexists')) ;
            }else{
                $exists = 0;
                $cexists = 0;
                $oexists = 0;
                if(isset($bride->office)){
                    $oexists = 1;               
                }
                return view('bride.profile.index', compact('bride', 'profile', 'brideID', 'exists', 'cexists', 'oexists')) ;
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

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Profile $currentProfile)  {
        
       
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( Profile $profile)    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)   {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Profile $profile, Request $request)  {
        
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

}
