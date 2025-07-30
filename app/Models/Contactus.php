<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contactus extends Model
{
    use HasFactory;
    protected $table = 'contact_us';
    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }

}
