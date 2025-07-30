<?php

namespace App\Http\Controllers\Auth;

//facebooklogin Controller
use App\Http\Controllers\Controller;
use App\Models\Host\Host;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class FaceBookController extends Controller
{
   use AuthenticatesUsers;

    public function loginUsingFacebook()
    {
      //dd(Socialite::driver('facebook'));
       return Socialite::driver('facebook')->redirect();
    }

    public function callbackFromFacebook()
      {
         try {
               $user = Socialite::driver('facebook')->user();
               //dd($user);
               //$slug=Str::slug($user->getName().$user->id);

               if($user){
                  $saveUser =Host::where('email',  $user->getEmail())->first();

                  if ($saveUser) {
                     $saveUser->update([
                           'facebook_token' => $user->token,
                           'facebook_refresh_token' => $user->refreshToken,
                           'facebook_id' => $user->id,
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
                     //       'email' => $user->email,
                     //       'slug' => $user->name.now(),
                     //       'facebook_id' => $user->id,
                     //       'facebook_token' => $user->token,
                     //       'facebook_refresh_token' => $user->refreshToken,
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
