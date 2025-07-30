<?php

namespace App\Models\Guest;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Host\Invitation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Arrival extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'guest_arrivals';

    protected $casts = [
        'date'  => 'datetime:Y-m-d\TH:i',
        'memberCount' => 'array',
    ];

    protected $attributes = [
        'memberCount' => '{}'
    ];

    public function getArrDateAttribute($value)    {
        return Carbon::parse($value)->format('Y-m-d\TH:i');
    }

    public function getRouteKeyName() {
        return $this->slug;
    }

    public function guest() {
        return $this->belongsTo(User::class, 'guest_id','id');
    }

    public function invitation()    {
        return $this->belongsTo(Invitation::class, 'invitation_id', 'id');
    }

}
