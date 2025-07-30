<?php

namespace App\Models\Guest;

use App\Models\Host\Invitation;
use Laravel\Socialite\One\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Accommodation extends Model
{
    use HasFactory;
    protected $table = 'guest_accommodations';
    protected $guarded = [];

    public function guest(){
        return $this->belongsTo(User::class, 'guest_id','id');
    }

    public function invitation()    {
        return $this->belongsTo(Invitation::class, 'invitation_id', 'id');
    }
}
