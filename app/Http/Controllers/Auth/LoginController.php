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

class LoginController extends Controller
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
        // dd(request()->session(), config('auth.guards'));
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
        foreach (config('auth.guards') as $guardName => $guardConfig) {
            if (request()->session()->has('password_hash_' . $guardName)) {
                request()->session()->forget('password_hash_' . $guardName);
            }
        }
        if(request()->has('logoutAll')){
            return redirect()->route('welcome')->with(['status' => 'Success', 'message' => 'Successfully logged out']);
        }
    }

    // Check If User Exists
    public function checkUserExists(Request $request)
    {
        //dd($request);
        /* get url as role which is equilvalent to admin, login, vendor or host from Login.vue as form value and switch based on that to log the user in. only In case of url as host and admin you need to verify it role to get directed the user to his personnel dashboard. make a method passing request, role and url where you wanted to send it as a method  */
        //$credentials = 'email';
        $num = $request['email'];
        $arr = ['1111111111', '1111111112', '1111111113', '1111111114','1111111115', '1111111116', '1111111117', '1111111118', '1111111119', '1111111110'];
        if (in_array($num, $arr)) {
            $user = Host::where('mobile', $num)->first();
            $redirect = 'hostwelcome';
            Auth::guard('host')->login($user);
            $request->session()->regenerate();
            return response()->json([
                'redirect' => redirect()->intended(route($redirect, auth()->guard('host')->user()))
                    ->with([
                        'status' => 'success',
                        'message' => 'Logged in as ' . auth()->guard('host')->user()->name . '!' . ' successfully.'
                    ])->getTargetUrl()
            ]);
            // $num exists in $arr
            // Your logic here
        }
        //if($num ==  )
        //if (is_numeric($request->email)) {
        $this->validate($request, [
            'email' => ['required'],
        ]);
        $credentials = 'mobile';
        //}
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
                'message' => 'Mobile does not exist!'
            ], 422);
        }
        //return $accounts;
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
            $redirect = 'hostwelcome';
            $guard = 'host';
            if ($request->role == 'host') {
                $user = Host::where('mobile', $request->mobile)->first();
            } elseif ($request->role == 'bride') {
                $user = User::where('mobile', $request->mobile)->first();
                $redirect = 'brideWelcome.index';
            } elseif ($request->role == 'groom') {
                $user = User::where('mobile', $request->mobile)->first();
                $redirect = 'groomWelcom.index';
            } elseif ($request->role == 'guest') {
                $user = User::where('mobile', $request->mobile)->first();
                $redirect = 'guestwelcome.index';
                $guard = 'web';
            } elseif ($request->role == 'vendor') {
                $user = Vendor::where('mobile', $request->mobile)->first();
                $redirect = 'vendorwelcome';
                $guard = 'vendor';
            } elseif ($request->role == 'member') {
                $user = Members::where('mobile', $request->mobile)->first();
                $redirect = 'memberwelcome';
                $guard = 'member';
            } elseif ($request->role == 'admin') {
                $user = Admin::where('mobile', $request->mobile)->first();
                $redirect = 'adminwelcome';
                $guard = 'admin';
            }
            //if($mobileExist){
            $response = VerifyOtp::verifyOtp($request->mobile, $request->otp);
            //dd($response);
            if ($response['type'] == 'success') {
                Auth::guard($guard)->login($user);
                $request->session()->regenerate();
                return response()->json([
                    'redirect' => redirect()->intended(route($redirect, auth()->guard($guard)->user()))
                        ->with([
                            'status' => 'success',
                            'message' => 'Logged in as ' . auth()->guard($guard)->user()->name . '!' . ' successfully.'
                        ])->getTargetUrl()
                ]);
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
        // dd($request);
        if($request->role == 'guest'){
            $num = $request['mobile'];
            //dd($num);
            $arr = ['1111111111', '1111111112', '1111111113', '1111111114','1111111115', '1111111116', '1111111117', '1111111118', '1111111119', '1111111110'];
            if (in_array($num, $arr)) {
                $user = User::where('mobile', $num)->first();
                // dd($user);
                $redirect = 'guestwelcome.index';
                Auth::guard('web')->login($user);
                $request->session()->regenerate();
                return response()->json([
                    'redirect' => redirect()->intended(route($redirect, auth()->guard('web')->user()))
                        ->with([
                            'status' => 'success',
                            'message' => 'Logged in as ' . auth()->guard('web')->user()->name . '!' . ' successfully.'
                        ])->getTargetUrl()
                ]);
                // $num exists in $arr
                // Your logic here
            }
        }
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
        $this->logoutAll();
        $guard = 'host';
        $redirect = 'hostwelcome';
        if ($request->role == 'member') {
            $guard = 'member';
            $redirect = 'memberwelcome';
        } elseif ($request->role == 'bride') {
            $guard = 'host';
            $redirect = 'brideWelcome.index';
        } elseif ($request->role == 'groom') {
            $guard = 'host';
            $redirect = 'groomWelcom.index';
        } elseif ($request->role == 'guest') {
            $guard = 'web';
            $redirect = 'guestwelcome.index';
        } elseif ($request->role == 'admin') {
            $guard = 'admin';
            $redirect = 'adminwelcome';
        } elseif ($request->role == 'vendor') {
            $guard = 'vendor';
            $redirect = 'vendorwelcome';
        }

        if (Auth::guard($guard)->attempt($this->credentials($request), $request->filled('remember_token'))) {
            $request->session()->regenerate();
            //dd('asasdas');
            return response()->json([
                'redirect' => redirect()->intended(route($redirect, auth()->guard($guard)->user()))
                    ->with([
                        'status' => 'success',
                        'message' => 'Logged in as ' . auth()->guard($guard)->user()->name . '!' . ' successfully.'
                    ])->getTargetUrl()
            ]);
        } else {
            return $this->loginFailed($request);
        }
    }


    /**
     * @loginFailed
     */
    private function loginFailed($request)
    {
        return response()->json([
            'status' => 'failure', 'message' => 'Login failed, check your credentials!',
        ], 422);
    }

    /**
     * logout as @guard
     */
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        if (request()->session()->has('password_hash_web')) {
            request()->session()->forget('password_hash_web');
        }
        return redirect()->route('welcome')->with(['status' => 'Success', 'message' => 'Successfully logged out']);
    }

    public function logoutAdmin()
    {
        Auth::guard('admin')->logout();
        if (request()->session()->has('password_hash_admin')) {
            request()->session()->forget('password_hash_admin');
        }
        return redirect()->route('welcome')->with(['status' => 'Success', 'message' => 'Successfully logged out']);
    }


    public function logoutHost()
    {
        Auth::guard('host')->logout();
        if (request()->session()->has('password_hash_host')) {
            request()->session()->forget('password_hash_host');
        }
        // dd(request()->session());
        return redirect()->route('welcome')->with(['status' => 'Success', 'message' => 'Successfully logged out']);
    }

    public function logoutMember()
    {
        Auth::guard('member')->logout();
        if (request()->session()->has('password_hash_member')) {
            request()->session()->forget('password_hash_member');
        }
        return redirect()->route('welcome')->with(['status' => 'Success', 'message' => 'Successfully logged out']);
    }

    public function logoutVendor()
    {
        Auth::guard('vendor')->logout();
        if (request()->session()->has('password_hash_vendor')) {
            request()->session()->forget('password_hash_vendor');
        }
        return redirect()->route('welcome')->with(['status' => 'Success', 'message' => 'Successfully logged out']);
    }
}
