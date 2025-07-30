<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use NotificationChannels\WebPush\HasPushSubscriptions;


class NewUsers extends Model
{
    use HasFactory, Notifiable, HasPushSubscriptions;

    protected $table = 'new_users';
    protected $fillable = ['endpoint', 'public_key', 'auth_token', 'content_encoding'];
}
