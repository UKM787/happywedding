<?php

namespace App\Http\Controllers\Auth;

use Exception;
use App\Models\User;
use App\Models\Host\Host;
use Illuminate\Http\Request;
use App\Models\Vendor\Vendor;
use App\Notifications\Otp\SendOtp;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Models\Admin\Admin;
use App\Models\Admin\LocationMaster;
use App\Models\Member\Members;
use App\Notifications\Otp\ResendOtp;
use App\Notifications\Otp\VerifyOtp;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginControllerOLD extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'RouteServiceProvider::HOME';

    /**
     * Login username to be used by the controller.
     *
     * @var string
     */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest')->except('logout');
        //$this->middleware('guest:host')->except('logout');
        //$this->middleware('guest:vendor')->except('logout');
        //$this->middleware('guest', ['except' => ['logout']]);
    }

    // protected function guard(){
    //     return Auth::guard('host');
    // }

    /**
     * @user login form
     */
    public function showLoginForm()
    {
        // dd('sss');
        $url = explode('/', request()->getRequestUri())[1];
        if ($url == 'login') {
            $url = 'guest';
        }
        return view('auth.login', ['url' => $url]);
    }

    //validate credentials
    public function credentials($request)
    {
        if (is_numeric($request->get('email'))) {
            return ['mobile' => $request->get('email'), 'password' => $request->get('password')];
        }
        return $request->only($this->username(), 'password');
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
    }

    // Check If User Exists
    public function checkUserExists(Request $request)
    {
        /* get url as role which is equilvalent to admin, login, vendor or host from Login.vue as form value and switch based on that to log the user in. only In case of url as host and admin you need to verify it role to get directed the user to his personnel dashboard. make a method passing request, role and url where you wanted to send it as a method  */
        $credentials = 'email';
        if (is_numeric($request->email)) {
            $credentials = 'mobile';
        }
        $accounts = [];
        //$guest = User::where($credentials, $request['email'])->first() ? array_push($accounts, 'guest') : false;
        $host = Host::where($credentials, $request['email'])->first();
        if ($host) {
            foreach ($host->role as $role) {
                array_push($accounts, $role);
            }
        }
        $member = Members::where($credentials, $request['email'])->first() ? array_push($accounts, 'member') : false;
        //dd($member, $accounts);

        if (count($accounts) > 0) {
            return response($accounts, 200);
        } else {
            return response([
                'message' => 'Email/Mobile does not exist!'
            ], 422);
        }
        //return $accounts;
    }


    /**
     * login as @host as host, member, bride & groom
     */
    public function login(Request $request)
    {
        //dd('ssss');
        $this->logoutAll();
        //dd($request);
        // $credentials = $this->validate($request, [
        //     'email'   => 'required|email',
        //     'mobile' => ['required', 'string', 'digits:10', 'unique:hosts'],
        //     'password' => 'required|min:3'
        // ]);
        //dd($request->remember_token, $request->filled('remember_token'));
        if (Auth::attempt($this->credentials($request), $request->filled('remember_token'))) {
            //$request->session()->regenerate();
            $user = auth()->user();
            return response()->json([
                'redirect' => redirect()->intended(route('guestwelcome.index', $user))
                    ->with([
                        'status' => 'success',
                        'message' => 'Hello ' . auth()->user()->name . '!' . ' Welcome to Happywed.'
                    ])->getTargetUrl()
            ]);
            // return redirect()->intended(route('guestwelcome.index', $user))
            //     ->with([
            //         'status' => 'success',
            //         'message' => 'Hello ' . auth()->user()->name . '!' . ' Welcome to Happywed.'
            // ]);
        } else {

            return $this->loginFailed($request);
        }
    }

    /**
     * login as guest send otp
     */
    public function verifyOtp(Request $request)
    {
        //dd($request, 'verify');
        $this->validate($request, [
            'mobile' => ['required', 'digits:10'],
            'otp' => ['required'],
        ]);
        $this->logoutAll();
        // dd('ss');
        try {
            if ($request->role == 'host' || $request->role == 'bride' || $request->role == 'groom') {
                $user = Host::where('mobile', $request->mobile)->first();
            } elseif ($request->role == 'guest') {
                $user = User::where('mobile', $request->mobile)->first();
            } elseif ($request->role == 'vendor') {
                $user = Vendor::where('mobile', $request->mobile)->first();
            } elseif ($request->role == 'member') {
                $user = Members::where('mobile', $request->mobile)->first();
            } elseif ($request->role == 'admin') {
                $user = Admin::where('mobile', $request->mobile)->first();
            }
            //if($mobileExist){
            $response = VerifyOtp::verifyOtp($request->mobile, $request->otp);
            //dd($response);
            if ($response['type'] == 'success') {
                if ($request->role == 'guest') {
                    Auth::login($user);
                    //$request->session()->regenerate();
                    return response()->json([
                        'redirect' => redirect()->intended(route('guestwelcome.index', auth()->user()))
                            ->with([
                                'status' => 'success',
                                'message' => 'Hello ' . auth()->user()->name . '!' . ' Welcome to Happywed.'
                            ])->getTargetUrl()
                    ]);
                } elseif ($request->role == 'host') {
                    Auth::guard('host')->login($user);
                    //$request->session()->regenerate();
                    return response()->json([
                        'redirect' => redirect()->intended(route('hostwelcome'))
                            ->with([
                                'status' => 'success',
                                'message' => 'Logged in as ' . auth()->guard('host')->user()->name . '!' . ' successfully.'
                            ])->getTargetUrl()
                    ]);
                } elseif ($request->role == 'bride') {
                    Auth::guard('host')->login($user);
                    //$request->session()->regenerate();
                    return response()->json([
                        'redirect' => redirect()->intended(route('brideWelcome.index'))
                            ->with([
                                'status' => 'success',
                                'message' => 'Logged in as ' . auth()->guard('host')->user()->name . '!' . ' successfully.'
                            ])->getTargetUrl()
                    ]);
                } elseif ($request->role == 'groom') {
                    Auth::guard('host')->login($user);
                    //$request->session()->regenerate();
                    return response()->json([
                        'redirect' => redirect()->intended(route('groomWelcome.index'))
                            ->with([
                                'status' => 'success',
                                'message' => 'Logged in as ' . auth()->guard('host')->user()->name . '!' . ' successfully.'
                            ])->getTargetUrl()
                    ]);
                } elseif ($request->role == 'vendor') {
                    Auth::guard('vendor')->login($user);
                    //$request->session()->regenerate();
                    return response()->json([
                        'redirect' => redirect()->intended(route('vendorwelcome'))
                            ->with([
                                'status' => 'success',
                                'message' => 'Logged in as ' . auth()->guard('vendor')->user()->name . '!' . ' successfully.'
                            ])->getTargetUrl()
                    ]);
                } elseif ($request->role == 'member') {
                    Auth::guard('member')->login($user);
                    //$request->session()->regenerate();
                    return response()->json([
                        'redirect' => redirect()->intended(route('memberwelcome'))
                            ->with([
                                'status' => 'success',
                                'message' => 'Logged in as ' . auth()->guard('member')->user()->name . '!' . ' successfully.'
                            ])->getTargetUrl()
                    ]);
                } elseif ($request->role == 'admin') {
                    Auth::guard('admin')->login($user);
                    //$request->session()->regenerate();
                    return response()->json([
                        'redirect' => redirect()->intended(route('adminwelcome'))
                            ->with([
                                'status' => 'success',
                                'message' => 'Logged in as ' . auth()->guard('admin')->user()->name . '!' . ' successfully.'
                            ])->getTargetUrl()
                    ]);
                }
                //dd(auth()->user());
                // return response()->json([
                //     'redirect' => redirect()->intended(route('guestwelcome.index', auth()->user()))
                //         ->with([
                //                 'status' => 'success',
                //                 'message' => 'Hello ' . auth()->user()->name . '!' . ' Welcome to Happywed.'
                //         ])->getTargetUrl()
                // ]);
            } else {
                //dd($response);
                return ['type' => 'error', 'message' => $response['message']];
            }
            // }else{
            //     throw new Exception(); 
            // }
            //dd($test);
        } catch (Exception $e) {
            dd($e);
            return ['type' => 'error', 'message' => 'Something went wrong!!'];
        }
    }

    /**
     * login as guest send otp
     */
    public function sendOtp(Request $request)
    {
        //dd($request, 'sendOtp');
        $table = 'users';
        if ($request->role == 'host') {
            $table = 'hosts';
        } elseif ($request->role == 'vendor') {
            $table = 'vendors';
        } elseif ($request->role == 'member') {
            $table = 'members';
        } elseif ($request->role == 'admin') {
            $table = 'admins';
        }
        $this->validate($request, [
            'mobile' => ['required', 'digits:10', 'exists:' . $table . ',mobile'],
        ]);
        try {
            //$mobileExist = User::where('mobile', $request->mobile)->first();
            if (true) {
                $response = SendOtp::sendOtp($request->mobile);
                if ($response['type'] == 'success') {
                    return ['type' => 'success', 'message' => 'Otp sent successfully'];
                } else {
                    return ['type' => 'error', 'message' => $response['message']];
                }
            } else {
                throw new Exception();
            }
            //dd($test);
        } catch (Exception $e) {
            // dd($e);
            return ['type' => 'error', 'message' => 'Something went wrong!!'];
        }
    }

    public function retryOtp(Request $request)
    {
        // dd($request, 'sendOtp');
        $this->validate($request, [
            'mobile' => ['required', 'digits:10'],
        ]);
        try {
            //$mobileExist = User::where('mobile', $request->mobile)->first();
            if (true) {
                $response = ResendOtp::retryOtp($request->mobile);
                if ($response['type'] == 'success') {
                    return ['type' => 'success', 'message' => 'Otp sent again successfully'];
                } else {
                    return ['type' => 'error', 'message' => $response['message']];
                }
            } else {
                throw new Exception();
            }
            //dd($test);
        } catch (Exception $e) {
            // dd($e);
            return ['type' => 'error', 'message' => 'Something went wrong!!'];
        }
    }





    /**
     * login as @host as host, member, bride & groom
     */
    public function loginHost(Request $request)
    {
        //dd($request);
        //dd($request->session());
        //dd($request->session()->get('password_hash_host'), $request->user()->getAuthPassword());
        $this->logoutAll();
        //dd($request->session());
        //dd(Auth::guard('host')->attempt($this->credentials($request), $request->filled('remember_token')));
        $guard = 'host';
        if ($request->role == 'member') {
            $guard = 'member';
        } elseif ($request->role == 'guest') {
            $guard = 'web';
        } elseif ($request->role == 'admin') {
            $guard = 'admin';
        } elseif ($request->role == 'vendor') {
            $guard = 'vendor';
        }

        //dd(Auth::guard($guard)->attempt($this->credentials($request), $request->filled('remember_token')));
        if (Auth::guard($guard)->attempt($this->credentials($request), $request->filled('remember_token'))) {
            //dd('asasdas');
            // return response()->json([
            //             'redirect' => redirect()->intended(route('guestwelcome.index', auth()->guard($guard)->user()))
            //                 ->with([
            //                     'status' => 'success',
            //                     'message' => 'Logged in as ' . auth()->guard($guard)->user()->name . '!' . ' successfully.'
            //                 ])->getTargetUrl()
            //         ]);
            switch ($request->role) {
                case 'host':
                    //dd('sssss');
                    //$request->session()->regenerate();
                    return response()->json([
                        'redirect' => redirect()->intended(route('hostwelcome'))
                            ->with([
                                'status' => 'success',
                                'message' => 'Logged in as ' . auth()->guard('host')->user()->name . '!' . ' successfully.'
                            ])->getTargetUrl()
                    ]);
                    // return redirect()
                    //     ->intended(route('hostwelcome'))
                    //     ->with([
                    //         'status' => 'success',
                    //         'message' => 'Logged in as ' . auth()->guard('host')->user()->name . '!' . ' successfully.'
                    //     ]);
                    break;

                case 'member':
                    //$request->session()->regenerate();
                    return response()->json([
                        'redirect' => redirect()->intended(route('memberwelcome'))
                            ->with([
                                'status' => 'success',
                                'message' => 'Logged in as ' . auth()->guard($guard)->user()->name . '!' . ' successfully.'
                            ])->getTargetUrl()
                    ]);
                    // return redirect()
                    //     ->intended(route('memberwelcome'))
                    //     ->with([
                    //         'status' => 'success',
                    //         'message' => 'Logged in as ' . auth()->guard('host')->user()->name . ' !' . ' successfully.']);
                    break;

                case 'bride':
                    //$request->session()->regenerate();
                    return response()->json([
                        'redirect' => redirect()->intended(route('brideWelcome.index', auth()->guard('host')->user()))
                            ->with([
                                'status' => 'success',
                                'message' => 'Logged in as ' . auth()->guard('host')->user()->name . '!' . ' successfully.'
                            ])->getTargetUrl()
                    ]);
                    // return redirect()
                    //     ->intended(route('brideWelcome.index', auth()->guard('host')->user()))
                    //     ->with([
                    //     'status' => 'success',
                    //     'message' => 'Logged in as ' . auth()->guard('host')->user()->name . ' !' . ' successfully.'
                    // ]);
                    break;

                case 'groom':
                    //$request->session()->regenerate();
                    return response()->json([
                        'redirect' => redirect()->intended(route('groomWelcome.index', auth()->guard('host')->user()))
                            ->with([
                                'status' => 'success',
                                'message' => 'Logged in as ' . auth()->guard('host')->user()->name . '!' . ' successfully.'
                            ])->getTargetUrl()
                    ]);
                    // return redirect()
                    //     ->intended(route('groomWelcome.index', auth()->guard('host')->user()))
                    //     ->with([
                    //     'status' => 'success',
                    //     'message' => 'Logged in as ' . auth()->guard('host')->user()->name . ' !' . ' successfully.'
                    // ]);
                    break;
                case 'guest':
                    //$request->session()->regenerate();
                    return response()->json([
                        'redirect' => redirect()->intended(route('guestwelcome.index', auth()->guard($guard)->user()))
                            ->with([
                                'status' => 'success',
                                'message' => 'Logged in as ' . auth()->guard($guard)->user()->name . '!' . ' successfully.'
                            ])->getTargetUrl()
                    ]);
                    break;
                case 'vendor':
                    //$request->session()->regenerate();
                    return response()->json([
                        'redirect' => redirect()->intended(route('vendorwelcome', auth()->guard($guard)->user()))
                            ->with([
                                'status' => 'success',
                                'message' => 'Logged in as ' . auth()->guard($guard)->user()->name . '!' . ' successfully.'
                            ])->getTargetUrl()
                    ]);
                    break;
                case 'admin':
                    //$request->session()->regenerate();
                    return response()->json([
                        'redirect' => redirect()->intended(route('adminwelcome', auth()->guard($guard)->user()))
                            ->with([
                                'status' => 'success',
                                'message' => 'Logged in as ' . auth()->guard($guard)->user()->name . '!' . ' successfully.'
                            ])->getTargetUrl()
                    ]);
                    break;
                default:
                    return response()->json([
                        'status' => 'failure',
                        'message' => "Please check your credentials!!"
                    ], 429);
                    //return redirect()->back()->withInput($request->only('email','remember'));
                    break;
            }
        } else {
            //dd('ff');
            return $this->loginFailed($request);
        }
    }

    /**
     * login as @vendor
     */
    public function loginVendor(Request $request)
    {
        $this->logoutAll();
        // $loginCredentails = $this->validate($request, [
        //     'email'   => 'required|email',
        //     //'mobile' => ['required', 'string', 'digits:10', 'unique:hosts'],
        //     'password' => 'required|min:3'
        // ]);
        // dd($loginCredentails);
        if (Auth::guard('vendor')->attempt($this->credentials($request), $request->filled('remember_token'))) {
            //$request->session()->regenerate();
            return response()->json([
                'redirect' => redirect()->intended(route('vendorwelcome'))
                    ->with([
                        'status' => 'success',
                        'message' => 'Logged in as ' . auth()->guard('vendor')->user()->name . '!' . ' successfully.'
                    ])->getTargetUrl()
            ]);
            // return redirect()
            //     ->intended(route('vendorwelcome'))
            //     ->with([
            //             'status' => 'success',
            //             'message' => 'Logged in as ' . auth()->guard('vendor')->user()->name . ' !' . ' successfully.'

            //     ]);
        } else {
            return $this->loginFailed($request);
        }
    }

    /**
     * login as @vendor
     */
    // public function loginCompany(Request $request)
    // {
    //     $this->logoutAll();
    //     $loginCredentails = $this->validate($request, [
    //         'email'   => 'required|email',
    //         //'mobile' => ['required', 'string', 'digits:10', 'unique:hosts'],
    //         'password' => 'required|min:3'
    //     ]);
    //     // dd($loginCredentails);
    //     if (Auth::guard('company')->attempt($loginCredentails, $request->filled('remember_token'))) {
    //         $request->session()->regenerate();
    //         return redirect()
    //             ->intended(route('companywelcome'))
    //             ->with('status', 'You are Logged in as ' . auth()->guard('company')->user()->name . '!');
    //     } else {
    //         return $this->loginFailed($request);
    //     }
    // }

    /**
     * login as @vendor
     */
    public function loginAdmin(Request $request)
    {
        //dd('ss');
        $this->logoutAll();
        // $loginCredentails = $this->validate($request, [
        //     'email'   => 'required|email',
        //     //'mobile' => ['required', 'string', 'digits:10', 'unique:hosts'],
        //     'password' => 'required|min:3'
        // ]);
        // dd($loginCredentails);
        if (Auth::guard('admin')->attempt($this->credentials($request), $request->filled('remember_token'))) {
            //$request->session()->regenerate();
            return response()->json([
                'redirect' => redirect()->intended(route('adminwelcome'))
                    ->with([
                        'status' => 'success',
                        'message' => 'Logged in as ' . auth()->guard('admin')->user()->name . '!' . ' successfully.'
                    ])->getTargetUrl()
            ]);
            // return redirect()
            // ->intended(route('adminwelcome'))
            // ->with('status', 'You are Logged in as ' . auth()->guard('admin')->user()->name . '!');
        } else {
            return $this->loginFailed($request);
        }
    }


    /**
     * @loginFailed
     */
    private function loginFailed($request)
    {
        //dd($request->only('email','remember'));
        return response()->json([
            'status' => 'failure', 'message' => 'Login failed, check your credentials!',
        ], 422);
        // return redirect()
        //     ->back()
        //     ->withInput($request->only('email','remember'))
        //     ->with(['status' => 'Failure' , 'message'=>'Login failed, check your credentials!']);
    }

    /**
     * logout as @guard
     */
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        return redirect()->route('welcome')->with(['status' => 'Success', 'message' => 'Successfully logged out']);
    }

    public function logoutAdmin()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('welcome')->with(['status' => 'Success', 'message' => 'Successfully logged out']);
    }


    public function logoutHost()
    {
        Auth::guard('host')->logout();
        Auth::guard('member')->logout();
        return redirect()->route('welcome')->with(['status' => 'Success', 'message' => 'Successfully logged out']);
    }

    // public function logoutCompany()
    // {
    //     Auth::guard('company')->logout();
    //     return redirect()->route('welcome')->with(['status' => 'Success', 'message' => 'Successfully logged out']);
    // }

    public function logoutVendor()
    {
        Auth::guard('vendor')->logout();
        return redirect()->route('welcome')->with(['status' => 'Success', 'message' => 'Successfully logged out']);
    }
}
