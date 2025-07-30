<?php

namespace App\Models\Guest;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Office extends Model
{
    use HasFactory;

    protected $fillable = ['officecompanyName','officecomplexName', 'officefloor', 'officedoorNo', 'officestreetNo', 'officearea', 'officedistrict', 'officepin', 'officestate', 'officezone', 'officecountry', 'officereachus', 'slug', 'guest_id'];
    protected $table = "guest_offices";

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
        'slug'
    ];

    public function getRouteKeyName()  {
        return 'slug';
    }

    public function guest()  {
        return $this->belongsTo(User::class, 'guest_id','id');
    }
}

