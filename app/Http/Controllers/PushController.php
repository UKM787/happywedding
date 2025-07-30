<?php

namespace App\Http\Controllers;

use App\Models\NewUsers;
use App\Models\PushNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class PushController extends Controller
{
        /**
     * Store the PushSubscription.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request){
        $this->validate($request,[
            'endpoint'    => 'required',
            'keys.auth'   => 'required',
            'keys.p256dh' => 'required'
        ]);
        $endpoint = $request->endpoint;
        $token = $request->keys['auth'];
        $key = $request->keys['p256dh'];
        $guards = ['host', 'vendor', 'company', 'web'];
        $loggedin = null;
        $currentGuard = null;
        foreach ($guards as $guard) {
            if ($loggedin = Auth::guard($guard)->user()) {
                $loggedin = Auth::guard($guard)->user();
                $currentGuard = $guard;
                break;
            }
        }
        $existingEndpoint = PushNotification::where('endpoint', $endpoint)->first();
        $existingNewUser = NewUsers::where('endpoint', $endpoint)->first();

        // $user = Auth::user();
        if($loggedin){
            if($existingEndpoint){
                $ownerCheck = $loggedin->ownsPushSubscription($existingEndpoint);
                if($existingNewUser){
                    if($existingEndpoint->subscribable_type == get_class($existingNewUser)){
                        $existingEndpoint->update([
                            'endpoint' => $endpoint,
                            'public_key' => $key,
                            'auth_token' => $token,
                            'subscribable_type' => get_class($loggedin),
                            'subscribable_id' => $loggedin->id,
                        ]);
                        $existingNewUser->delete();
                    }else{
                        $loggedin->updatePushSubscription($endpoint, $key, $token);
                    }
                }else{
                    $loggedin->updatePushSubscription($endpoint, $key, $token);
                }
            }else{
                $loggedin->updatePushSubscription($endpoint, $key, $token);
            }   
        }else{
            if(!$existingEndpoint && !$existingNewUser){
                $created = NewUsers::create([
                    'endpoint' => $endpoint,
                    'public_key' => $key,
                    'auth_token' => $token,
                ]);
                $created->updatePushSubscription($endpoint, $key, $token);
            }
        }        
        return response()->json(['success' => true],200);
    }

    public function checkUser(Request $request){
        //dd($request);
        $client = PushNotification::where('endpoint', $request->id)->first();
        //dd($client->subscribable);
        if(Auth::guard('web')->check()){
            if(Auth::guard('web')->user()->id == $client->subscribable->id){
                return response(true,200);
            }
        }
        return response(false,422);
    }
}
