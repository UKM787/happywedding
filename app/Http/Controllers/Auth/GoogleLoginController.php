<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Host\Host;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class GoogleLoginController extends Controller
{
   use AuthenticatesUsers;

    public function loginUsingGoogle()
    {
     // dd(Socialite::driver('google')->redirect());
      //dd('aaaa', Socialite::driver('google')->scopes(['phonenumbers.read', 'addresses.read']));
      // /->scopes(['https://www.googleapis.com/auth/user.addresses.read', 'https://www.googleapis.com/auth/user.phonenumbers.read'])
       return Socialite::driver('google')->redirect();
    }

    public function callbackFromGoogle()
      {
         try {
               $user = Socialite::driver('google')->user();
               //dd($user);
               //$slug=Str::slug($user->getName().$user->id);

               if($user){
                  $saveUser =Host::where('email',  $user->getEmail())->first();

                  if ($saveUser) {
                     $saveUser->update([
                           'google_token' => $user->token,
                           'google_refresh_token' => $user->refreshToken,
                           'google_id' => $user->id,
                     ]);
                  } else {
                     return redirect()
                        ->intended(route('hostRegister'))
                        ->with([
                           'status' => 'success',
                           'message' => 'Please register first!!'
                     ]);
                     // $saveUser = Host::create([
                     //       'name' => $user->name,
                     //       'slug' => $user->name.now(),
                     //       'email' => $user->email,
                     //       'google_id' => $user->id,
                     //       'google_token' => $user->token,
                     //       'google_refresh_token' => $user->refreshToken,
                     //       'email_verified_at' => now()
                     // ]);
                  }
                  //dd($saveUser);
                  Auth::guard('host')->login($saveUser);
               }

               

               return redirect()
               ->intended(route('hostwelcome', $saveUser))

               ->with([
                  'status' => 'success',
                  'message' => 'Logged in as ' . $user->getName(). '!' . ' successfully.'
               ]);
               } catch (\Throwable  $th) {
                  throw $th;
               }
      }
}
