<?php

namespace App\Models\Host;

use App\Models\SubscriptionOrders;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubscriptionReccuringHost extends Model
{
    use HasFactory;

    protected $table = 'sub_host_rec';

    // public function orders(){
    //     return $this->morphMany(SubscriptionOrders::class,'subscribeable');
    // }

}
