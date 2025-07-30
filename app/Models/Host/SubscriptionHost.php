<?php

namespace App\Models\Host;

use App\Models\SubscriptionOrders;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubscriptionHost extends Model
{
    use HasFactory;

    protected $table = 'subscriptions_host';

    public function orders(){
        return $this->morphMany(SubscriptionOrders::class,'subscribeable');
    }

}
