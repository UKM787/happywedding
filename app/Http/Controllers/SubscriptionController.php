<?php

namespace App\Http\Controllers;

use App\Events\RowCreated;
use Exception;
use Razorpay\Api\Api;
use App\Models\Payments;
use App\Models\Host\Host;
use Illuminate\Http\Request;
use App\Models\Host\Invitation;
use App\Models\Host\MemberTask;
use Faker\Provider\ar_EG\Payment;
use App\Models\SubscriptionOrders;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Host\SubscriptionHost;
use Carbon\Carbon;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Host $host)
    {
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
            $active = 'subscribe';
            $host = auth()->guard('host')->user();
            $host = Host::where('id', $host->id)->with('profile')->first();
            $plans = SubscriptionHost::all();
            //$latestOrder = $host->orders->where('payment_done', 1)->sortByDesc('created_at')->first();
            $latestOrder = $host->activeSubscription();
           // dd($latestOrder);
            //dd($host->activeSubscription());
            if($latestOrder){
                $today = Carbon::now();
                $expiry_date = Carbon::parse($latestOrder->expiry_at);
                if ($today->greaterThanOrEqualTo($expiry_date)) {
                    // plan expired
                    //dd('expired', $today, $expiry_date);
                    return view('host.subscribe', compact('host', 'active', 'plans'));

                }
                else {
                    //plan active
                    //dd('active', $today,$expiry_date);
                    $plan = $latestOrder->subscribeable()->first();
                    return view('host.subscribe', compact('host', 'active', 'plans'));
                }
            }else{
                //dd($latestOrder);
                return view('host.subscribe', compact('host', 'active', 'plans'));
            }
            //$allPayments = $host->orders->where('payment_done', 1)->sortByDesc('created_at')->first()->payments();
        }
    }

    /**
     * Creates the order for subscription.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function createOrder($id)
    {
       // dd($id);
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
        $plan = SubscriptionHost::where('id', (int)$id)->first();
        if($plan->name == 'Free'){
            $test = $loggedin->orders()->create([
                'subscribeable_type' => get_class($plan),
                'subscribeable_id' => $plan->id,
                'payment_done' => 1,
                'expiry_at' => Carbon::parse(now())->addMonths((int)$plan->validity),
            ]);
            //dd($test->with('subscribeable')->first());
            return response()->json([
                'data' => $test->with('subscribeable')->latest()->first(),
                'redirect' => redirect()->intended(route('hostwelcome'))
                    ->with([
                            'status' => 'success',
                            'message' => $loggedin->name . '!' . ' Subscribed Succesfully.'
                    ])->getTargetUrl()
            ]);
        }
    //    / dd($loggedin, $plan);
        $api = new Api('rzp_live_wLIDlEVBFdFkFS', 'KHwXeafFIzPwb8BpludwnyMm');
        if($currentGuard == 'host'){
            $plan = SubscriptionHost::where('id', (int)$id)->first();
        }
        $orderData = [
            'amount'          => (int)$plan->price*100, // 39900 rupees in paise
            'currency'        => 'INR'
        ];
        try {
            $order = $api->order->create($orderData);
            $orderId = $order['id'];
            $test = $loggedin->orders()->create([
                'order_id' => $orderId,
                'subscribeable_type' => get_class($plan),
                'subscribeable_id' => $plan->id,
            ]);
           // dd('order created', $test, $orderId, $plan);
           //dd($test->with('subscribeable')->latest()->first());
            return response()->json([
                'data' => $test->with('subscribeable')->latest()->first(),
            ]);
            //return $test;
        } catch (Exception $e) {
            // There was an error creating the order
            dd($e->getMessage());
        }
    }

    /**
     * Creates the order for subscription.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function verifyPayment(Request $request)
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
        if($loggedin){
            $api = new Api('rzp_live_wLIDlEVBFdFkFS', 'KHwXeafFIzPwb8BpludwnyMm');
            try {
                //dd($request);
                $data = json_decode($request->data, true);
                $currOrder = SubscriptionOrders::where('id', $request->id)->first();
                if(array_key_exists('razorpay_signature', $data)){
                    $payment = Payments::create($data+['order_id' => $currOrder->id]);
                    $attributes = $data;
                    $attributes['razorpay_order_id'] = $currOrder->order_id;
                    //dd($attributes);
                    $api->utility->verifyPaymentSignature($attributes);
                    $order = SubscriptionOrders::where('order_id', $currOrder->order_id)->first();
                    $plan = $order->subscribeable()->first();
                    //dd($plan->validity, Carbon::parse($order->created_at) , Carbon::parse($order->created_at)->addMonths((int)$plan->validity));
                    $ids = $order->payment_ids ?? [];
                    array_push($ids, $payment->id);
                    $order->update(['payment_done' => 1, 'payment_ids' => $ids, 'expiry_at' => Carbon::parse($order->created_at)->addMonths((int)$plan->validity)]);
                    return true;
                    //dd('all done');
                    //dd($data, $attributes);
                }
                if(array_key_exists('error', $data)){
                    //dd('sdsfd', $data, $request);
                    $payment = Payments::create($data+['order_id' => $currOrder->id, 'razorpay_order_id' => $data['error']['metadata']['order_id'], 'razorpay_payment_id' => $data['error']['metadata']['payment_id']]);

                    $order = SubscriptionOrders::where('order_id', $currOrder->order_id)->first();
                    $ids = $order->payment_ids;
                    array_push($ids, $payment->id);
                    $order->update(['payment_ids' => $ids]);
                    return $payment->error['description'];
                }
            } catch (Exception $e) {
                // There was an error creating the order
                dd($e->getMessage());
            }
        }
    }







    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
}
