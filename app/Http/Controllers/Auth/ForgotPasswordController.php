<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Mail\ForgotPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Host\Host;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;
    /*
        *showLinkRequestForm - show email forgot password form - actual
    */
    public function showLinkRequestForm(Request $request) {

        $url = explode('/', $request->getRequestUri())[1];
        return view('auth.passwords.email', compact('url'));
    }

     /*
        *sendResendLinkEmail - sending email links through email - actual
    */
    public function sendResetLinkEmail(Request $request)  {
        //dd('s');

        $url = explode('/', $request->headers->get('referer'))[3];
        $user = null;
       // $url = 'host';
        switch ($url) {
            case 'vendor':
                $request->validate([
                    'email' => "required|email|exists:vendors,email",
                ]);
                $token = Str::random(64);
                DB::table('password_resets')->insert([
                    'email' => $request->email,
                    'token' => $token,
                    'created_at' => Carbon::now(),
                ]);
                $action_link = route('vendorpassword.reset', ['token' => $token, 'email' => $request->email]);
                break;
            case 'host':
                $request->validate([
                    'email' => "required|email|exists:hosts,email",
                ]);
                $token = Str::random(64);
                DB::table('password_resets')->insert([
                    'email' => $request->email,
                    'token' => $token,
                    'created_at' => Carbon::now(),
                ]);
                $user = Host::where('email', $request->email)->first();
                $action_link = route('hostpassword.reset', ['token' => $token, 'email' => $request->email]);
                break;
            case 'bride':
                $request->validate([
                    'email' => "required|email|exists:hosts,email",
                ]);
                $token = Str::random(64);
                DB::table('password_resets')->insert([
                    'email' => $request->email,
                    'token' => $token,
                    'created_at' => Carbon::now(),
                ]);
                $action_link = route('bridepassword.reset', ['token' => $token, 'email' => $request->email]);
                break;
            case 'groom':
                $request->validate([
                    'email' => "required|email|exists:hosts,email",
                ]);
                $token = Str::random(64);
                DB::table('password_resets')->insert([
                    'email' => $request->email,
                    'token' => $token,
                    'created_at' => Carbon::now(),
                ]);
                $action_link = route('groompassword.reset', ['token' => $token, 'email' => $request->email]);
                break;
            case 'member':
                $request->validate([
                    'email' => "required|email|exists:hosts,email",
                ]);
                $token = Str::random(64);
                DB::table('password_resets')->insert([
                    'email' => $request->email,
                    'token' => $token,
                    'created_at' => Carbon::now(),
                ]);
                $action_link = route('memberpassword.reset', ['token' => $token, 'email' => $request->email]);
                break;
            case 'company':
                $request->validate([
                    'email' => "required|email|exists:companies,email",
                ]);
                $token = Str::random(64);
                DB::table('password_resets')->insert([
                    'email' => $request->email,
                    'token' => $token,
                    'created_at' => Carbon::now(),
                ]);
                $action_link = route('companypassword.reset', ['token' => $token, 'email' => $request->email]);
                break;
            default:
                $request->validate([
                    'email' => "required|email|exists:users,email",
                ]);
                $token = Str::random(64);
                DB::table('password_resets')->insert([
                    'email' => $request->email,
                    'token' => $token,
                    'created_at' => Carbon::now(),
                ]);
                $action_link = route('guestpassword.reset', ['token' => $token, 'email' => $request->email]);

                break;
        }
        //dd('db created');
        $body = 'We have received a request to reset the password for (a) your appname (b) youraccount associated with".$request->email". you can reset your password by clicking the link given below"';
        //dd($body);
        //dd('ss');
        // Mail::mailer('msg91')->send('auth.host.email-forgot', ['action_link' => $action_link, 'body' => $body], function ($message) use ($request, $action_link) {
        //     $message->from('trustrajeshg@gmail.com', 'Your App Name');
        //     $message->to([$request->email => 'Your Name', 'email@abc.com' => 'helo'])->subject('Reset Password');
        //     $message->setdata(['action_link' => $action_link]);
        // });
        //dd($user);
        try {
            Mail::to($request->email)->send(new ForgotPassword($action_link, $user));
            return back()->with(['status' => 'success', 'message' => 'We have emailed the password reset link to ' . $request->email]);
        } catch (\Exception $e) {
            dd($e);
            return back()->with(['status' => 'failure', 'message' => 'Something went wrong! Please try again later']);
            // code to handle the exception
        }
        
            //dd($response);
    }



}
