<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Host\Host;
use App\Models\Host\Guest;
use App\Models\Couple\Couple;
//use App\Models\Groom\Groom;
use Illuminate\Http\Request;
use App\Models\Vendor\Vendor;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;


    public function showResetForm(Request $request, $token = null)  {
        $url = explode('/', $request->getRequestUri())[1];
        return view('auth.passwords.reset', compact('url'))->with(['token' => $token, 'email' => $request->email]);
    }


    public function reset(Request $request)  {
        $url = explode('/', $request->getRequestUri())[1];
        //dd($url);
        switch($url) {
            case 'host':
                //dd('ss');
                $user = $request->validate([
                    'email' => 'required|email|exists:hosts,email',
                    'password' => 'required|min:3|confirmed',
                    'password_confirmation' => 'required'
                ]);
                //dd('gg', $request->email, $request->token);
                $user = DB::table('password_resets')->where([
                    'email' => $request->email,
                    'token' => $request->token,
                ])->first();
                if ($user && $user->token == $request->token
                ) {
                    //dd('ss');
                    Host::where('email', $request->email)->update([
                        'password' => Hash::make($request->password)
                    ]);
                    DB::table('password_resets')->where(['email' => $request->email])->delete();
                } else {
                    return back()->withInput()->with('fail', 'Invalid token passed')->withErrors(['error' => '404']);
                }

                return redirect()->route('hostLogin')->with(['status' => 'success','message' => 'Your password has been changed! your can login with new password'])->with('verified Eamil' . $request->email);
                break;
            case 'bride':
                $user = $request->validate([
                    'email' => 'required|email|exists:hosts,email',
                    'password' => 'required|min:3|confirmed',
                    'password_confirmation' => 'required'
                ]);
                $user = DB::table('password_resets')->where([
                    'email' => $request->email,
                    'token' => $request->token,
                ])->first();

                if ($user && $user->token == $request->token
                ) {
                    Host::where('email', $request->email)->update([
                        'password' => Hash::make($request->password)
                    ]);
                    DB::table('password_resets')->where(['email' => $request->email])->delete();
                } else {
                    return back()->withInput()->with('fail', 'Invalid token passed')->withErrors(['error' => '404']);
                }

                return redirect()->route('brideLogin')->with(['status' => 'success','message' => 'Your password has been changed! your can login with new password'])->with('verified Eamil' . $request->email);
                break;
            case 'groom':
                $user = $request->validate([
                    'email' => 'required|email|exists:hosts,email',
                    'password' => 'required|min:3|confirmed',
                    'password_confirmation' => 'required'
                ]);
                $user = DB::table('password_resets')->where([
                    'email' => $request->email,
                    'token' => $request->token,
                ])->first();

                if ($user && $user->token == $request->token
                ) {
                    Host::where('email', $request->email)->update([
                        'password' => Hash::make($request->password)
                    ]);
                    DB::table('password_resets')->where(['email' => $request->email])->delete();
                } else {
                    return back()->withInput()->with('fail', 'Invalid token passed')->withErrors(['error' => '404']);
                }

                return redirect()->route('groomLogin')->with(['status' => 'success','message' => 'Your password has been changed! your can login with new password'])->with('verified Eamil' . $request->email);
                break;
            case 'member':
                $user = $request->validate([
                    'email' => 'required|email|exists:hosts,email',
                    'password' => 'required|min:3|confirmed',
                    'password_confirmation' => 'required'
                ]);
                $user = DB::table('password_resets')->where([
                    'email' => $request->email,
                    'token' => $request->token,
                ])->first();

                if ($user && $user->token == $request->token
                ) {
                    Host::where('email', $request->email)->update([
                        'password' => Hash::make($request->password)
                    ]);
                    DB::table('password_resets')->where(['email' => $request->email])->delete();
                } else {
                    return back()->withInput()->with('fail', 'Invalid token passed')->withErrors(['error' => '404']);
                }

                return redirect()->route('memberLogin')->with(['status' => 'success','message' => 'Your password has been changed! your can login with new password'])->with('verified Eamil' . $request->email);
                break;
            case 'company':
                $user = $request->validate([
                    'email' => 'required|email|exists:companies,email',
                    'password' => 'required|min:3|confirmed',
                    'password_confirmation' => 'required'
                ]);
                $user = DB::table('password_resets')->where([
                    'email' => $request->email,
                    'token' => $request->token,
                ])->first();

                if ($user && $user->token == $request->token
                ) {
                    Host::where('email', $request->email)->update([
                        'password' => Hash::make($request->password)
                    ]);
                    DB::table('password_resets')->where(['email' => $request->email])->delete();
                } else {
                    return back()->withInput()->with('fail', 'Invalid token passed')->withErrors(['error' => '404']);
                }

                return redirect()->route('companyLogin')->with(['status' => 'success','message' => 'Your password has been changed! your can login with new password'])->with('verified Eamil' . $request->email);
                break;
            case 'vendor':
                $user = $request->validate([
                    'email' => 'required|email|exists:vendors,email',
                    'password' => 'required|min:3|confirmed',
                    'password_confirmation' => 'required'
                ]);
                $user = DB::table('password_resets')->where([
                    'email' => $request->email,
                    'token' => $request->token,
                ])->first();

                if (
                    $user && $user->token == $request->token
                ) {
                    Vendor::where('email', $request->email)->update([
                        'password' => Hash::make($request->password)
                    ]);
                    DB::table('password_resets')->where(['email' => $request->email])->delete();
                } else {
                    return back()->withInput()->with('fail', 'Invalid token passed')->withErrors(['error' => '404']);
                }

                return redirect()->route('vendorLogin')->with(['status' => 'success','message' => 'Your password has been changed! your can login with new password'])->with('verified Eamil' . $request->email);
                break;

            default:
                 $user = $request->validate([
                    'email' => 'required|email|exists:users,email',
                    'password' => 'required|min:8|confirmed',
                    'password_confirmation' => 'required'
                    ]);
                    $user = DB::table('password_resets')->where([
                        'email' => $request->email,
                        'token' => $request->token,
                    ])->first();

                    if (
                        $user && $user->token == $request->token
                    ) {
                        User::where('email', $request->email)->update([
                        'password' => Hash::make($request->password)
                        ]);
                        DB::table('password_resets')->where(['email' => $request->email])->delete();
                    } else {
                    return back()->withInput()->with('fail', 'Invalid token passed')->withErrors(['error' => '404']);
                }

                    return redirect()->route('login')->with('info', 'Your password has been changed! your can login with new password')->with('verified Eamil' . $request->email);
                    break;

        }



        // dd($user);

        // if (!$user || $user->token == $request->token) {
        //    // return redirect()->back()->withErrors(['error' => '404'];

        // } else {
        //     Host::where('email', $request->email)->update([
        //         'password' => Hash::make($request->password)
        //     ]);
        // }


    }



}
