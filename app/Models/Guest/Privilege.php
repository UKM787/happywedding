<?php

namespace App\Models\Guest;

use App\Models\Guest\Family;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Privilege extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'guest_privileges';

    public function family(){
        return $this->belongsTo(Family::class, 'family_id','id');
    }
}
