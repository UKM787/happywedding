<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PushNotification extends Model
{
    use HasFactory;

    protected $table = 'push_subscriptions';
    protected $fillable = ['endpoint', 'public_key', 'auth_token', 'subscribable_type', 'subscribable_id', 'content_encoding'];

    public function subscribable(){
        return $this->morphTo();
    }
}
