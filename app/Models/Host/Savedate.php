<?php

namespace App\Models\Host;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Savedate extends Model
{
    use HasFactory;
    protected $table = 'savedate';

    protected $fillable = ['startDate','imageOne','counter','slug','invitation_id'];

    protected $casts = [
        'startDate'  => 'datetime:Y-m-d\TH:i'
    ];

    public function getStartDateAttribute($value) {
        return Carbon::parse($value)->format('Y-m-d\TH:i');
    }

    public function getRouteKeyName() {
        return 'slug';
    }

    public function invitation() {
        return $this->hasOne(Invitation::class, 'invitation_id', 'id');
    }
    
}
