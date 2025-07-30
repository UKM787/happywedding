<?php

namespace App\Models\Host;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Host\Host;
use App\Models\Host\Story;
use App\Models\Guest\Arrival;
use App\Models\Host\Ceramony;
use App\Models\Host\Savedate;
use App\Models\Member\Members;
use App\Models\Guest\Departure;
use App\Models\Host\MemberTask;
use App\Models\Admin\TaskMaster;
use App\Models\Guest\Accommodation;
use App\Models\Admin\LocationMaster;
use App\Models\Vendor\Service\Venue;
use App\Models\Guest\GuestInvitation;
use App\Models\Member\MemberInvitation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invitation extends Model
{
    use HasFactory;

    protected $fillable = [
        'brideName', 'brideMotherName', 'brideFatherName', 'brideEmail', 'brideMobile',
        'groomName', 'groomMotherName', 'groomFatherName', 'groomEmail', 'groomMobile', 'state', 'location_id',
        'startDate',  'endDate', 'imageOne', 'slug', 'host_id', 'side'
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at'
    ];

    protected $casts = [
        'startDate'  => 'datetime:Y-m-d\TH:i', 'endDate'  => 'datetime:Y-m-d\TH:i'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getStartDateAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d\TH:i');
    }

    public function getEndDateAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d\TH:i');
    }

    public function host()
    {
        return $this->belongsTo(Host::class, 'host_id', 'id');
    }

    // public function arrivals(){
    //     return $this->hasManyThrough(Arrival::class, GuestInvitation::class, 'invitation_id','guest_id','id','user_id');
    // }
    public function arrivals()
    {
        return $this->hasMany(Arrival::class, 'invitation_id', 'id');
    }
    public function departures()
    {
        return $this->hasMany(Departure::class, 'invitation_id', 'id');
    }

    // public function departures()    {
    //     return $this->hasManyThrough(Departure::class, GuestInvitation::class, 'invitation_id','guest_id','id','user_id');
    // }

    public function accommodations()
    {
        return $this->hasManyThrough(Accommodation::class, GuestInvitation::class, 'invitation_id', 'guest_id', 'id', 'user_id');
    }

    public function story()
    {
        return $this->hasOne(Story::class, 'invitation_id', 'id');
    }

    public function location()
    {
        return $this->hasOne(LocationMaster::class, 'id', 'location_id');
    }


    public function savedate()
    {
        return $this->hasOne(Savedate::class, 'invitation_id', 'id');
    }

    public function ceramonies()
    {
        return $this->hasMany(Ceramony::class, 'invitation_id', 'id');
    }

    public function tasks()
    {
        return $this->hasMany(MemberTask::class, 'invitation_id', 'id');
    }

    public function venues()
    {
        return $this->belongsToMany(Venue::class, 'invitation_venue', 'invitation_id', 'venue_id')->withTimestamps()->with('location');
    }



    public function contacts()
    {
        return $this->hasMany(Message::class, 'invitation_id', 'id');
    }


    // guest_invitation relations
    public function guests()
    {
        return $this->belongsToMany(User::class, 'guest_invitation', 'invitation_id', 'user_id')->withTimestamps()->withPivot(['invite', 'inviteStatus', 'logistics', 'hostAccommodationStatus', 'accommodation', 'accommodationStatus', 'logisticsArrivalStatus', 'logisticsDepartureStatus', 'hostLogisticsArrivalStatus', 'hostLogisticsDepartureStatus', 'ceremony_invite']);
    }

    public function guestsinvited($invitation)
    {
        return $this->belongsToMany(GuestInvitation::class, 'guest_invitation', 'invitation_id', 'user_id')->withTimestamps()->withPivot(['invite', 'inviteStatus', 'logistics', 'accommodation'])->wherePivot('invitation_id', $invitation->id);
    }

    // public function members() {
    //     return $this->belongsToMany(Members::class, 'member_invitation', 'invitation_id', 'member_id');
    // }

    public function members()
    {
        return $this->morphMany(MemberTask::class, 'memberable');
    }


    public function sendinvitations()
    {
        return $this->belongsToMany(User::class, 'guest_invitation', 'invitation_id', 'user_id')->withTimestamps()->withPivot(['invite', 'inviteStatus', 'logistics', 'accommodation']);
    }

    public function guestlist()
    {
        return $this->belongsToMany(User::class, 'guest_invitation', 'invitation_id', 'user_id')->withTimestamps()->withPivot(['invite', 'inviteStatus', 'logistics', 'hostAccommodationStatus', 'accommodation', 'accommodationStatus', 'logisticsArrivalStatus', 'logisticsDepartureStatus', 'hostLogisticsArrivalStatus', 'hostLogisticsDepartureStatus', 'ceremony_invite', 'sms', 'email', 'post', 'watsapp']);
    }
    // public function guestlist()
    // {
    //     return $this->belongsToMany(User::class, 'guest_invitation', 'invitation_id', 'user_id')->withTimestamps()->withPivot(['invite', 'inviteStatus', 'logistics', 'accommodation']);
    // }

    public function watsappList()
    {
        return $this->belongsToMany(User::class, 'guest_invitation', 'invitation_id', 'user_id')->withTimestamps()->wherePivot('invite','!=', 0)->wherePivot('watsapp', 1)->withPivot(['url_id']);
    }


    public function allVenues()
    {
        return $this->morphedByMany(Venue::class, 'vendorable');
    }

    public function allAccomodations()
    {
        return $this->morphedByMany(Venue::class, 'vendorable');
    }

    public function invitationtasks()
    {
        return $this->belongsToMany(TaskMaster::class, 'invitation_task', 'invitation_id', 'task_id')->using(InvitationTask::class)->withTimestamps()->withPivot(['id','taskStatus', 'started_date', 'complete_date', 'created_at', 'custom_timeline_id', 'assignable_id', 'assignable_type', 'completeable_type', 'completeable_id']);
    }
}
