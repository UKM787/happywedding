<?php

namespace App\Models\Host;

use Carbon\Carbon;
use App\Models\Host\Guest;
use App\Models\Vendor\Service\Venue;
use App\Models\Admin\CeramonyMaster;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ceramony extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'ceramonies';
    //protected $dateFormat = 'Y-m-d';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','type','startDate','startTime',
        'imageOne', 'imageTwo', 'imageThree','ladiesDress','menDress','invitation_id','slug','ceremony_invite', 'ceremony_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'invitation_id',
        'ceramonymaster_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        //'startDate' => 'datetime:Y-m-d',
        'endDate' => 'datetime:Y-m-d\TH:i',
        'ceremony_invite' => 'array',
    ];

    // public function getStartDateAttribute($value)    {
    //     return Carbon::parse($value)->format('Y-m-d\TH:i');
    // }

    public function getEndDateAttribute($value) {
        return Carbon::parse($value)->format('Y-m-d\TH:i');
    }

    public function getRouteKeyName() {
        return 'slug';
    }

    public function invitation()    {
        return $this->belongsTo(Invitation::class, 'invitation_id', 'id');
    }

    public function ceramonymaster(){
        return $this->belongsTo(CeramonyMaster::class, 'ceremony_id', 'id');
    }

    // public function venue(){
    //     return $this->belongsTo(Venue::class, 'venue_id','id');
    // }

    public function venues() {
        return $this->belongsToMany(Venue::class, 'ceramony_venue', 'ceramony_id', 'venue_id')->withTimestamps()->withPivot(['venue_id', 'ceramony_id'])->with('location');
    }

    public function guests() {
        return $this->belongsToMany(User::class, 'guest_ceramony', 'ceramony_id', 'user_id')->withTimestamps()->withPivot(['invitation_id', 'invitationStatus', 'invitationType','invitationAccomodation', 'invitationLogistics']);
    }
}
