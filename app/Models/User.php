<?php

namespace App\Models;

use App\Models\Guest\Home;
use App\Models\Guest\Family;
use App\Models\Guest\Office;
use App\Models\Guest\Arrival;
use App\Models\Guest\Profile;
use App\Models\Host\Ceramony;
use App\Models\Vendor\Review;
use App\Models\Vendor\Vendor;
use App\Models\Guest\Departure;
use App\Models\Guest\Privilege;
use App\Models\Host\Invitation;
use App\Models\Admin\Testimonial;
use App\Models\Guest\Accommodation;
use App\Models\Guest\GuestInvitation;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use NotificationChannels\WebPush\HasPushSubscriptions;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, HasPushSubscriptions;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'mobile',
        'password',
        'parent_id',
        'status',
        'slug'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'mobile_verified_at' => 'datetime',
    ];

    public function getRouteKeyName()  {
        return 'slug';
    }

    public function profile(){
        return $this->hasOne(Profile::class,'guest_id','id')->withDefault(array_fill_keys(Schema::getColumnListing('guest_profiles'),null));
    }

    public function home(){
        return $this->hasOne(Home::class,'guest_id','id')->withDefault(array_fill_keys(Schema::getColumnListing('guest_homes'),null));
    }

    public function office() {
        return $this->hasOne(Office::class, 'guest_id','id')->withDefault(array_fill_keys(Schema::getColumnListing('guest_offices'),null));
    }

    public function family() {
        return $this->hasMany(Family::class, 'guest_id','id');
    }

    // public function single(){
    //     return $this->invitations()->limit(1);
    // }


   public function invitations(){
       return $this->belongsToMany(Invitation::class,'guest_invitation','user_id','invitation_id')->withTimestamps()->as('guest_invitation')->withPivot(['invite','inviteStatus','logistics','hostAccommodationStatus','accommodation', 'accommodationStatus', 'hostLogisticsArrivalStatus','hostLogisticsDepartureStatus','logisticsArrivalStatus','logisticsDepartureStatus','ceremony_invite']);
    }

    public function inviteNew()    {
        return $this->belongsToMany(Invitation::class, 'guest_invitation', 'user_id', 'invitation_id')->withTimestamps()->withPivot('invite','inviteStatus','logistics','hostAccommodationStatus','accommodation', 'accommodationStatus', 'hostLogisticsArrivalStatus','hostLogisticsDepartureStatus','logisticsArrivalStatus','logisticsDepartureStatus','ceremony_invite')->as('guest_invitation')->wherePivotIn('inviteStatus', [1,2,3] );
    }

    public function inviteAccepted()  {
            return $this->belongsToMany(Invitation::class, 'guest_invitation', 'user_id', 'invitation_id')->withTimestamps()->withPivot('invite','inviteStatus','logistics','hostAccommodationStatus','accommodation', 'accommodationStatus', 'hostLogisticsArrivalStatus','hostLogisticsDepartureStatus','logisticsArrivalStatus','logisticsDepartureStatus','ceremony_invite')->as('guest_invitation')->wherePivot('inviteStatus', '=', 6);
        }

    public function inviteRejected()  {
        return $this->belongsToMany(Invitation::class, 'guest_invitation', 'user_id', 'invitation_id')->withTimestamps()->withPivot('invite','inviteStatus','logistics','hostAccommodationStatus','accommodation', 'accommodationStatus', 'hostLogisticsArrivalStatus','hostLogisticsDepartureStatus','logisticsArrivalStatus','logisticsDepartureStatus','ceremony_invite')->as('guest_invitation')->wherePivot('inviteStatus','=', 5);
    }

    public function invitePending()  {
        return $this->belongsToMany(Invitation::class, 'guest_invitation', 'user_id', 'invitation_id')->withTimestamps()->withPivot('invite','inviteStatus','logistics','hostAccommodationStatus','accommodation', 'accommodationStatus', 'hostLogisticsArrivalStatus','hostLogisticsDepartureStatus','logisticsArrivalStatus','logisticsDepartureStatus','ceremony_invite')->as('guest_invitation')->wherePivot('inviteStatus', 4);
    }

    public function arrivals() {
        return $this->hasManyThrough(Arrival::class, GuestInvitation::class, 'user_id', 'invitation_id', 'id', 'invitation_id');
    }

    // public function arrival()    {
    //     return $this->hasOneThrough(Arrival::class, GuestInvitation::class, 'user_id', 'invitation_id', 'id', 'invitation_id');
    // }
    public function arrival($id = null)    {
        return $this->hasOne(Arrival::class, 'guest_id', 'id')->where('invitation_id', (int)$id);
    }
    
    public function departure($id = null) {
        return $this->hasOne(Departure::class, 'guest_id', 'id')->where('invitation_id', (int)$id);
    }

    public function departures() {
        return $this->hasManyThrough(Departure::class, GuestInvitation::class, 'user_id', 'invitation_id', 'id', 'invitation_id');
    }

    public function accommodations()  {
        return $this->hasManyThrough(Accommodation::class, GuestInvitation::class, 'user_id', 'invitation_id', 'id', 'invitation_id');
    }

    public function accommodation($id = null)    {
        return $this->hasOne(Accommodation::class, 'guest_id', 'id')->where('invitation_id', (int)$id);
    }

    public function privilege($id = null) {
        return $this->hasMany(Privilege::class, 'user_id','id')->where('invitation_id', (int)$id);
    }

    // public function ceramonies()  {
    //     return $this->belongsToMany(Ceramony::class, 'guest_ceramony', 'user_id', 'ceramony_id')->withTimestamps()->withPivot(['invitation_id', 'invitationStatus']);
    // }

    public function ceramonies()  {
        return $this->belongsToMany(Ceramony::class, 'guest_ceramony', 'user_id', 'ceramony_id')->withTimestamps()->withPivot(['invitation_id', 'invitationStatus']);
    }

    public function reviews()  {
        return $this->morphMany(Review::class, 'reviewable');
    }
    public function testimonials()
    {
        return $this->morphMany(Testimonial::class, 'testimoniable');
    }

}
