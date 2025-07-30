<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use Razorpay\Api\Api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\SubscriptionReccuring;
use App\Models\Host\SubscriptionReccuringHost;

class SubscriptionReccuringController extends Controller
{
    public function index(){
        //dd('ss');
        //subscribeReccuring
        $guards = ['host', 'vendor', 'company', 'web'];
        $loggedin = null;
        $currentGuard = null;
        foreach ($guards as $guard) {
            if ($loggedin = Auth::guard($guard)->user()) {
                $currentGuard = $guard;
                break;
            }
        }
         if($guard == 'host'){
            $active = 'subscribeReccuring';
            $host = auth()->guard('host')->user();
            $plans = SubscriptionReccuringHost::all();
            $subCreated = $loggedin->SubscriptionCreated();
            if($subCreated){
                $plan = $subCreated->plan();
                $subPlan = $subCreated;
                // return redirect()->route('hostWelcome')->with([
                //     'status' => 'success',
                //     'message' => 'Subscribed Succesfully!'
                // ]);
                return view('host.subscribedreccuring', compact('host', 'active', 'plans', 'subPlan', 'plan'));
            
            }else{
                return view('host.subscribereccuring', compact('host', 'active', 'plans'));
            }
        }
    }

    public function createSubscription($id)
    {
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
        if($currentGuard == 'host'){
            $plan = SubscriptionReccuringHost::where('id', (int)$id)->first();
            if($plan->plan_id == 'plan_free001'){
                $test = $loggedin->allRecSubscription()->create([
                'plan_id' => $plan['plan_id'],
                'status' => 'active',
                'sub_id' => 'sub_'.$plan['plan_id'].'-'.Carbon::now()->timestamp,
                ]);
                //dd($test);
                return response()->json([
                    'data' => $test,
                    'redirect' => redirect()->intended(route('hostwelcome'))
                        ->with([
                                'status' => 'success',
                                'message' => $loggedin->name . '!' . ' Subscribed SuccesfullY.'
                        ])->getTargetUrl()
                ]);
            }
            //dd($plan->plan_id == 'plan_free001');
        }
        //dd($loggedin, $id);
        $api = new Api('rzp_live_wLIDlEVBFdFkFS', 'KHwXeafFIzPwb8BpludwnyMm');
        try {
            $sub = $api->subscription->create(array('plan_id' => $plan->plan_id, 'customer_notify' => 1, 'total_count' => 1));
            //dd($sub_id);
            $sub_id = $sub->toArray();
            $test = $loggedin->allRecSubscription()->create([
                'plan_id' => $plan['plan_id'],
                'status' => $sub_id['status'],
                'sub_id' => $sub_id['id'],
                'razorpay_success' => array_key_exists('error', $sub_id) ? null : $sub_id,
                'razorpay_error' => array_key_exists('error', $sub_id) ? $sub_id : null
            ]);
            return response()->json([
                'data' => $test,
                'redirect' => redirect()->intended(route('hostwelcome'))
                    ->with([
                            'status' => 'success',
                            'message' => $loggedin->name . '!' . ' Subscribed SuccesfullY.'
                    ])->getTargetUrl()
            ]);
            //return $test;
        } catch (Exception $e) {
            // There was an error creating the order
            dd($e->getMessage());
        }
    }

    public function webhook(Request $request){
    //     $exten =  $request->file('Video_keyword')->extension();
    //    echo $exten;
    //    print_r($request->file('Video_keyword'));
    //     $request->file('Video_keyword')->move(public_path('videos/Ali'), "Test.".$exten); 
    //     echo "uploaded";
    //    return;
       //print_r($request->payload);
       //http://127.0.0.1:8000/subscribe-webhook
       //return 'hrllo';

        try{
            // test if same request is made again
            $api = new Api('rzp_live_wLIDlEVBFdFkFS', 'KHwXeafFIzPwb8BpludwnyMm');
            $webhookBody = $request->getContent();
            $webhookSignature = $request->header('X-Razorpay-Signature');
            $webhookSecret = 'Vidhu@123';
            $api->utility->verifyWebhookSignature($webhookBody, $webhookSignature, $webhookSecret);

            //print_r($request->all());
            $data = $request->payload['subscription']['entity'];
            $subHappy = SubscriptionReccuring::where('sub_id', $data['id'])->first();
            $statusHappy = $subHappy->status;
            $statusRazor = $data['status'];

            // if($statusHappy == 'created'){
                $subHappy->update(['status' => $data['status'], 'razorpay_success' => $data, 'webhook_error' => null]);
                return;
            //}
            //$sub_id = 
            //print_r('sucess');
            //print_r($request->payload);
        }catch(Exception $e){
           // $subHappy->update(['webhook_error' => null]);
            //return;
            echo $e->getMessage();
            return;
        }
    }

    public function cancel($id = null){
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
        $sub = $loggedin->allRecSubscription->where('sub_id', $id)->first();
        //dd($id);
        if($sub->plan_id == "plan_free001"){
            $sub->update([
            'status' => 'cancelled',
            ]);
             return response([
             'message' => 'Subsctiption Cancelled! You will be redirected    automatically!!' 
            ],200);
        }

        if($sub->status == 'cancelled'){
            return response([
                'message' => 'Subsctiption already cancelled! Kindly refresh the page' 
            ],422);
        }

        $api = new Api('rzp_live_wLIDlEVBFdFkFS', 'KHwXeafFIzPwb8BpludwnyMm');

        $response = $api->subscription->fetch($id)->cancel(['cancel_at_cycle_end' => 0]);
        //dd($response);

        $arr =  $response->toArray();

        $sub->update([
            'status' => $arr['status'],
            'razorpay_success' => array_key_exists('error', $arr) ? null : $arr,
            'razorpay_error' => array_key_exists('error', $arr) ? $arr : null
        ]);

        return response([
            'message' => 'Subsctiption Cancelled! You will be redirected automatically!!' 
        ],200);
    }

}
