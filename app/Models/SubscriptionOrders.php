<?php

namespace App\Models;

use App\Models\Payments;
use App\Events\RowCreated;
use Faker\Provider\ar_EG\Payment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubscriptionOrders extends Model
{
    use HasFactory;

    protected $table = 'subscriptions_orders';
    protected $guarded = [];

    // protected $dispatchesEvents = [
    //     'created' => RowCreated::class,
    // ];

    protected $casts = [
        'payment_ids' => 'array',
    ];

    public function ownerable(){
        return $this->morphTo();
    }

    public function subscribeable(){
        return $this->morphTo();
    }

    public function payments(){
        $payments = collect([]);
        foreach ($this->payment_ids as $paymentId) {
            $payment = Payments::find($paymentId);
            if ($payment) {
                $payments->push($payment);
            }
        }
        return $payments;
    }

}
