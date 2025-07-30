<?php

namespace App\Models\Host;

use App\Models\Host\Ceramony;
use App\Models\Host\Invitation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Guest extends Model
{
    use HasFactory, Notifiable;
    protected $fillable = [
        'name',
        'email',
        'mobile',
        'password',
        'parent_id',
        'status',
        'slug'
    ];


    

}
