<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationMaster extends Model
{
    use HasFactory;

    protected $table = 'location_masters';
    
    protected $fillable = [
        'city',
        'state',
        'slug',
        'status',
        'admin_id',
        'imageOne'
    ];
}
