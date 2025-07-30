<?php

namespace App\Models;

use App\Models\Payments;
use App\Events\RowCreated;
use App\Models\Host\SubscriptionReccuringHost;
use Faker\Provider\ar_EG\Payment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubscriptionReccuring extends Model
{
    use HasFactory;

    protected $table = 'sub_orders_rec';
    protected $guarded = [];

    // protected $dispatchesEvents = [
    //     'created' => RowCreated::class,
    // ];

    protected $casts = [
        'razorpay_success' => 'array',
        'razorpay_error' => 'array'
    ];

    public function ownerable(){
        return $this->morphTo();
    }

    public function plan(){
        return SubscriptionReccuringHost::where('plan_id', $this->plan_id)->first();
        //dd($this);
    }


    // public function payments(){
    //     $payments = collect([]);
    //     foreach ($this->payment_ids as $paymentId) {
    //         $payment = Payments::find($paymentId);
    //         if ($payment) {
    //             $payments->push($payment);
    //         }
    //     }
    //     return $payments;
    // }

}
