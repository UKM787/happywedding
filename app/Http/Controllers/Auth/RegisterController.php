<?php

namespace App\Http\Controllers\Auth;

use App\Wed\Happy;
use App\Models\User;
use App\Models\Location;
use App\Mail\EmailVerify;
use App\Models\Host\Host;
use App\Models\Admin\Admin;
use Illuminate\Support\Str;
use App\Models\Host\Profile;
use Illuminate\Http\Request;
use App\Models\Vendor\Vendor;
use Illuminate\Support\Carbon;
use App\Models\Company\Company;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Models\Admin\LocationMaster;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public $cities, $categories;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest')->except('logout');
        // $this->middleware('guest:host')->except('logout');
        // $this->middleware('guest:vendor')->except('logout'); 

        $this->cities = LocationMaster::orderBy('name', 'ASC')->get()->map(function ($city) {
            return ['name' => $city->name, 'code' => $city->id];
        });
        $this->categories = Happy::getActiveCategories()->whereNull('parent_id')->map(function ($item) {
            return ['name' => $item->name, 'code' => $item->id];
        });
    }

    /**
     * Get a validator for an incoming registration request from users
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        //dd('ss');
        //dd($data);
        $table = null;
        switch ($data['role']) {
            case 'vendor':
                $table = 'vendors';
                break;
            case 'admin':
                $table = 'admins';
                break;
            case 'host':
                $table = 'hosts';
                break;
            default:
                return redirect()->back()->with([
                    'status' => 'failure',
                    'message' => 'Not permitted to register'
                ]);
                break;
        }
        if (isset($data['password'])) {
            return Validator::make(
                $data,
                [
                    'name' => ['required', 'string', 'min:3', 'max:255'],
                    //'email' => ['required', 'string', 'email', 'min:3', 'max:255', 'unique:' . $table],
                    'email' => ['sometimes'],
                    'mobile' => ['required', 'string', 'digits:10', 'unique:' . $table],
                    //'location_id' => ['required', 'string'],
                    //'location_id' => 'exclude_if:role,admin|required|string',
                    'city' => 'required',
                    'category' => 'exclude_if:role,admin,host|required',
                    //'state_name' => ['required', 'string'],
                    'policy' => 'accepted',
                    'role'  => ['required'],
                    'password' => ['required', 'string', 'min:8', 'confirmed'],
                ],
                [
                    'name.required' => 'enter your full name',
                    'role.required' => 'role is required',
                    'password.required' => 'password is required',
                    'email.required' => 'enter your emailID',
                    'mobile.required' => 'enter your mobile number.e.g. xxxxxxxxxx only 10 digits',
                    //'location_id.required' => 'select your city of presence',
                    'city.required' => 'select your city of presence',
                    'policy.accepted' => 'Kindly accept the terms and conditions!',
                    //'state_name.required' => 'select your state of presence'
                ]
            );
        }
        return Validator::make($data, [
            'name' => ['required', 'string', 'min:3', 'max:255'],
            //'email' => ['required', 'string', 'email', 'min:3', 'max:255', 'unique:' . $table],
            'email' => ['sometimes'],
            'mobile' => ['required', 'string', 'digits:10', 'unique:' . $table],
            //'location_id' => ['required', 'string'],
            'city' => 'exclude_if:role,admin|required',
            'category' => 'exclude_if:role,admin,host|required',
            // 'state_name' => ['required', 'string'],
            'policy' => 'accepted',
            'role'  => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'name.required' => 'enter your full name',
            'role.required' => 'role is required',
            'password.required' => 'password is required',
            'email.required' => 'enter your emailID',
            'mobile.required' => 'enter your mobile number.e.g. xxxxxxxxxx only 10 digits',
            //'location_id.required' => 'select your city of presence',
            'city.required' => 'select your city of presence',
            'policy.accepted' => 'Kindly accept the terms and conditions!',
            //'state_name.required' => 'select your state of presence'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'mobile' => $data['mobile'],
            'password' => Hash::make($data['password']),
            'slug' => Str::slug(request()->name, '-', 'en') . '-' . rand(1, 10000),
        ]);
    }

    public function logoutAll()
    {
        if (Auth::guard('web')->user()) {
            Auth::guard('web')->logout();
        }
        if (Auth::guard('company')->user()) {
            Auth::guard('company')->logout();
        }
        if (Auth::guard('vendor')->user()) {
            Auth::guard('vendor')->logout();
        }
        if (Auth::guard('host')->user()) {
            Auth::guard('host')->logout();
        }
        if (Auth::guard('member')->user()) {
            Auth::guard('member')->logout();
        }
        foreach (config('auth.guards') as $guardName => $guardConfig) {
            if (request()->session()->has('password_hash_' . $guardName)) {
                request()->session()->forget('password_hash_' . $guardName);
            }
        }
    }

    /**
     * @user registeration form
     */
    public function showRegisterForm(Request $request)
    {
        //dd($this->categories);
        //$request->session()->forget('password_hash_host');
        $url = explode('/', $request->getRequestUri())[1];
        $locations = LocationMaster::where('status', 1)->orderBy('name', 'ASC')->get();
        return view('auth.register', ['url' => $url, 'locations' => $locations, 'cities' => $this->cities, 'categories' => $this->categories]);
    }

    // /**
    //  * @host registeration form
    //  */
    // public function showRegistrationForm(Request $request)
    // {
    //     $url = explode('/', request()->getRequestUri())[1];
    //     $city = LocationMaster::where('status', 1)->orderBy('name', 'ASC')->get();
    //     //dd($city);
    //     return view('auth.register', ['url' => $url, 'city' => $city]);
    // }

    /**
     * @host creation
     */

    protected function createHost(Request $request)
    {
        // dd($request);
        $this->logoutAll();
        $data = $this->validator($request->all())->validate();
        // dd($request->role, $data, $data['category']['code']);
        //    /dd($request);
        switch ($request->role) {
            case 'vendor':
                function createVendor($data, $password)
                {
                    if ($data) {
                        $vendor = Vendor::create([
                            'name' => $data['name'],
                            'email' => strtolower($data['email']),
                            'mobile' => $data['mobile'],
                            'location_id'  => $data['city']['code'],
                            'category_id'  => $data['category']['code'],
                            'role' => $data['role'],
                            'password' => $password,
                            'slug' => Str::slug(request()->name, '-', 'en') . '-' . rand(1, 10000),
                        ]);
                        foreach (Role::all()->pluck('name') as $role) {
                            if ($role == $data['role']) {
                                $vendor->assignRole($role);
                            }
                        }
                        return $vendor;
                    }
                }

                if (isset($data['password'])) {
                    $password = Hash::make($data['password']);
                    $vendor = createVendor($data, $password);
                    return response()->json([
                        'redirect' => redirect()->route('vendorLogin')
                            ->with([
                                'status' => 'success',
                                'message' => 'Login to continue!'
                            ])->getTargetUrl()
                    ]);
                    //dd($vendor);
                   // $vendor->categories()->attach(['category_id' => $data['category']['code']]);
                    //event(new Registered($vendor));
                    // Auth::guard('vendor')->login($vendor);
                    // return response()->json([
                    //         'redirect' => redirect()->intended(route('vendorwelcome'))
                    //             ->with([
                    //                 'status' => 'success',
                    //                 'message' => 'Logged in as ' . auth()->guard('vendor')->user()->name . '!' . ' successfully.'
                    //             ])->getTargetUrl()
                    //     ]);
                    // return redirect()->intended(route('vendorwelcome'))
                    //     ->with([
                    //         'status' => 'success',
                    //         'message' => 'Logged in as ' . $data['name'] . '!' . ' successfully.'
                    //     ]);
                    //return redirect()->intended('login/vendor');
                } else {
                    $password = Hash::make($data['email'] . "#$" . rand(1, 10000));
                    $vendor = createVendor($data, $password);
                    return response()->json([
                        'redirect' => redirect()->route('vendorLogin')
                            ->with([
                                'status' => 'success',
                                'message' => 'Login to continue!'
                            ])->getTargetUrl()
                    ]);
                    //$vendor->categories()->attach(['category_id' => $data['category']['code']]);
                    //event(new Registered($vendor));
                    // Auth::guard('vendor')->login($vendor);
                    // return response()->json([
                    //         'redirect' => redirect()->intended(route('vendorwelcome'))
                    //             ->with([
                    //                 'status' => 'success',
                    //                 'message' => 'Logged in as ' . auth()->guard('vendor')->user()->name . '!' . ' successfully.'
                    //             ])->getTargetUrl()
                    //     ]);
                    // return redirect()->intended(route('vendorwelcome'))
                    //     ->with([
                    //         'status' => 'success',
                    //         'message' => 'Logged in as ' . $data['name'] . '!' . ' successfully.'
                    //     ]);
                }
                break;
            case 'admin':
                function createAdmin($data, $password)
                {
                    if ($data) {
                        $host = Admin::create([
                            'name' => $data['name'],
                            'email' => strtolower($data['email']),
                            'mobile' => $data['mobile'],
                            //'location_id'  => $data['location_id'],
                            'password' => $password,
                            'slug' => Str::slug(request()->name, '-', 'en') . '-' . rand(1, 10000),
                        ]);
                        // foreach (Role::all()->pluck('name') as $role) {
                        //     if ($role == $data['role']) {
                        //         $host->assignRole($role);
                        //     }
                        // }
                        return $host;
                        //return redirect()->intended('login/host');
                    }
                }
                if (isset($data['password'])) {
                    //dd('ss');
                    $password = Hash::make($data['password']);
                    $admin = createAdmin($data, $password);
                    return response()->json([
                        'redirect' => redirect()->route('adminLogin')
                            ->with([
                                'status' => 'success',
                                'message' => 'Login to continue!'
                            ])->getTargetUrl()
                    ]);
                    //event(new Registered($company));
                    // Auth::guard('admin')->login($admin);
                    // return response()->json([
                    //         'redirect' => redirect()->intended(route('adminwelcome'))
                    //             ->with([
                    //                 'status' => 'success',
                    //                 'message' => 'Logged in as ' . auth()->guard('admin')->user()->name . '!' . ' successfully.'
                    //             ])->getTargetUrl()
                    //     ]);
                    // return redirect()->intended(route('adminwelcome'))
                    //     ->with([
                    //         'status' => 'success',
                    //         'message' => 'Logged in as ' . $data['name'] . '!' . ' successfully.'
                    //     ]);
                    //return redirect()->intended('login/company');
                } else {
                    $password = Hash::make($data['email'] . "#$" . rand(1, 10000));
                    $admin = createAdmin($data, $password);
                    return response()->json([
                        'redirect' => redirect()->route('adminLogin')
                            ->with([
                                'status' => 'success',
                                'message' => 'Login to continue!'
                            ])->getTargetUrl()
                    ]);
                    //event(new Registered($company));
                    // Auth::guard('admin')->login($admin);
                    // return response()->json([
                    //         'redirect' => redirect()->intended(route('adminwelcome'))
                    //             ->with([
                    //                 'status' => 'success',
                    //                 'message' => 'Logged in as ' . auth()->guard('admin')->user()->name . '!' . ' successfully.'
                    //             ])->getTargetUrl()
                    //     ]);
                    // return redirect()->intended(route('adminwelcome'))
                    //     ->with([
                    //         'status' => 'success',
                    //         'message' => 'Logged in as ' . $data['name'] . '!' . ' successfully.'
                    //     ]);
                }
                break;

            case 'host':
                function createHost($data, $password)
                {
                    if ($data) {
                        $host = Host::create([
                            'name' => $data['name'],
                            'email' => strtolower($data['email']),
                            'mobile' => $data['mobile'],
                            'location_id'  =>  $data['city']['code'],
                            'password' => $password,
                            'role' => ['host'],
                            'slug' => Str::slug(request()->name, '-', 'en') . '-' . rand(1, 10000),
                        ]);
                        Profile::create(['name' => $data['name'], 'email' => strtolower($data['email']), 'mobile' => $data['mobile'], 'host_id' => $host->id]);
                        // foreach (Role::all()->pluck('name') as $role) {
                        //     if ($role == $data['role']) {
                        //         $host->assignRole($role);
                        //     }
                        // }
                        return $host;
                        //return redirect()->intended('login/host');
                    }
                }
                if (isset($data['password'])) {
                    $password = Hash::make($data['password']);
                    $host = createHost($data, $password);
                    return response()->json([
                        'redirect' => redirect()->route('hostLogin')
                            ->with([
                                'status' => 'success',
                                'message' => 'Login to continue!'
                            ])->getTargetUrl()
                    ]);

                    //verify email sending logic
                    // $token = Str::random(64);
                    // $action_link = route('verification.verify', ['token' => $token, 'email' => $request->email, 'type' => 'host']);
                    // DB::table('email_verification')->insert([
                    //     'email' => $request->email,
                    //     'token' => $token,
                    //     'type' => 'host',
                    //     'created_at' => Carbon::now(),
                    // ]);
                    // Mail::to($request->email)->send(new EmailVerify($action_link, $host));
                    
                    // Auth::guard('host')->login($host);
                    // if (auth()->guard('host')->check()) {
                    //     $request->session()->regenerate();
                    //         return response()->json([
                    //         'redirect' => redirect()->intended(route('hostwelcome', auth()->guard('host')->user()))
                    //             ->with([
                    //                 'status' => 'success',
                    //                 'message' => 'Logged in as ' . auth()->guard('host')->user()->name . '!' . ' successfully.'
                    //             ])->getTargetUrl()
                    //     ]);
                    // } else {
                    //     return $this->loginFailed($request);
                    // }
                } else {
                    $password = Hash::make($data['email'] . "#$" . rand(1, 10000));
                    $host = createHost($data, $password);
                    return response()->json([
                                'redirect' => redirect()->route('hostLogin')
                                    ->with([
                                        'status' => 'success',
                                        'message' => 'Login to continue!'
                                    ])->getTargetUrl()
                            ]);
                    //event(new Registered($host));
                    // Auth::guard('host')->login($host);
                    // if (auth()->guard('host')->check()) {
                    //     $request->session()->regenerate();
                    //     //dd('asasdas');
                    //     return response()->json([
                    //         'redirect' => redirect()->intended(route('hostwelcome', auth()->guard('host')->user()))
                    //             ->with([
                    //                 'status' => 'success',
                    //                 'message' => 'Logged in as ' . auth()->guard('host')->user()->name . '!' . ' successfully.'
                    //             ])->getTargetUrl()
                    //     ]);
                    // } else {
                    //     return $this->loginFailed($request);
                    // }
                }
                break;
            default:
                return redirect()->back()->with([
                    'status' => 'failure',
                    'message' => 'Not permitted to register'
                ]);

                break;
        }
    }
}
