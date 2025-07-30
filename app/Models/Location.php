<?php

namespace App\Models;

use App\Models\Host\Invitation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getRouteKey()  {
        return 'slug';
    }

    public function invitations(){
        return $this->hasMany(Invitation::class, 'location_id','id');
    }
}
