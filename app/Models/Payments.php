<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    use HasFactory;

    protected $table = 'subscriptions_payments';
    protected $guarded = [];

    protected $casts = [
        'error' => 'array',
    ];

    public function order(){
        //dd($this-);
        return SubscriptionOrders::where('id', (int)$this->order_id)->first();

        //return $this->belongsTo(SubscriptionOrders::class);
    }
}
