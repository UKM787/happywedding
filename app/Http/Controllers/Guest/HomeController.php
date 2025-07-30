<?php

namespace App\Http\Controllers\Guest;

use Exception;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Guest\Home;

use App\Models\Guest\Family;
use App\Models\Guest\Office;
use App\Models\Guest\Profile;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            $user = auth()->user();
            if ($user->home  !== null) {
                $profile = $user->profile;
                $home = $user->home;
                $office = $user->office;
                return view('guest.profile.index', compact('user','profile','home', 'office'));
            } else {
                $home = new Home();
                return view('guest.home.create', compact('user', 'home', 'profile'));
            }
        } else {
            die('you are not loggedin yet!');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user)
    {
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
        session(['tab' => 'home']);
        return view('guest.home.create', compact('user', 'profile', 'home', 'office', 'family'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(User $user, Request $request)  {

        $data =  $this->requestValidate($request);

        if (auth()->check()){
            try {
                $home = Home::create($data + ['guest_id' => $user->id, 'slug' => Str::slug($request->id.'-'.$request->area)]);
                if($home){
                    return redirect()->route('guestprofile.index', $user)
                        ->with([
                            'tab' => 'home',
                            'status' => 'success',
                            'message' => 'added home address successfully, add office address'
                        ]);
                }
            }
            catch (Exception $e) {
                return redirect()->back()->with([
                    'status'  => 'failure',
                    'message' => $e->getMessage()
                ]);
            }
        }

        if ( auth()->guard('host')->check()) {
            try {
                $home = Home::create($data + ['guest_id' => $user->id, 'slug' => Str::slug($request->id . '-' . $request->area)]);
                if ($home) {
                    return redirect()->back()
                    ->with([
                        'tab' => 'home',
                        'status' => 'success',
                        'message' => 'added home address successfully, add office address'
                    ]);
                }
            } catch (Exception $e) {
                return redirect()->back()->with([
                    'status'  => 'failure',
                    'message' => $e->getMessage()
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
    public function show(User $user, Home $home)
    {
        //dd('reached profile.show show()');
        //$guesthome = $user->guesthome;
        // dd($user, $user->guesthome);
        return view('guest.home.show', compact('user', 'home'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, Home $home) {
        return view('guest.home.edit', compact('user', 'home'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(User $user, Home $home, Request $request) {

        $data =  $this->requestValidate($request);

        if (auth()->check() ) {
            try {
                // $data['guest_id'] = $user->id;
                // $data['slug'] = Str::slug($request->area . '-' . $request->city . '-' . $request->state);
                // $newhome = $home->update($data);
                $guesthome = $home->update($data + ['guest_id' => $user->id, 'slug' => Str::slug($request->id.'-'.$request->area)]);
                if ($guesthome) {

                    return redirect()->route('guestprofile.index', $user)
                        ->with([
                            'tab' => 'home',
                            'status' => 'success',
                            'message' => 'home address updated, add office address'
                        ]);
                }
            } catch (Exception $e) {
                return redirect()->back()->with([
                    'status'  => 'failure',
                    'message' => $e->getMessage()
                ]);
            }
        }

        if ( auth()->guard('host')->check()) {
            try {
                // $data['guest_id'] = $user->id;
                // $data['slug'] = Str::slug($request->area . '-' . $request->city . '-' . $request->state);
                // $newhome = $home->update($data);
                $guesthome = $home->update($data + ['guest_id' => $user->id, 'slug' => Str::slug($request->id . '-' . $request->area)]);
                if ($guesthome) {

                    return redirect()->back()
                        ->with([
                            'tab' => 'home',
                            'status' => 'success',
                            'message' => 'home address updated, add office address'
                        ]);
                }
            } catch (Exception $e) {
                return redirect()->back()->with([
                    'status'  => 'failure',
                    'message' => $e->getMessage()
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

    private function requestValidate($request)
    {

       return $request->validate([
            'complexName' => ['required', 'string', 'min:3', 'max:100'],
            'floor' => ['required', 'string', 'min:1', 'max:100'],
            'doorNo' => ['required', 'string', 'min:1', 'max:50'],
            'streetNo' => ['required', 'string', 'min:1', 'max:50'],
            'area' => ['required', 'string', 'min:3', 'max:100'],
            'district' => ['required', 'string', 'min:3', 'max:25'],
            'state' => ['required', 'string', 'min:3', 'max:100'],
            'pin' => ['required', 'string', 'min:6', 'max:9'],
            'zone' => ['required', 'string', 'min:3', 'max:50'],
            'reachus' => ['sometimes', 'string', 'min:3', 'max:255']
        ],
        [
            'complexName.required' => 'enter complex number',
            'floor.required' => 'enter  floor number',
            'doorNo.required' => 'enter  door number',
            'streetNo.required'=> 'street number is required',
            'area.required'=> 'enter  area or locality',
            'district.required' => 'enter  city or district name',
            'state.required'  => 'enter  state name',
            'pin.required' => 'enter area pincode',
            'zone.required'  => 'enter  zone in country'
        ]
        );
    }
}
