<?php

namespace App\Models\Host;

use Carbon\Carbon;
use App\Models\Host\Home;
use App\Models\Host\Office;
use App\Models\Vendor\Lead;
use App\Models\Admin\Vendor;
use App\Models\Host\Profile;
use App\Models\Vendor\Review;
use App\Models\Member\Members;
use App\Models\Host\Invitation;
use App\Models\Host\MemberTask;
use App\Models\Admin\Testimonial;
use App\Models\SubscriptionOrders;
use App\Models\Host\CeramonyMaster;
use App\Models\Admin\LocationMaster;
use App\Models\Member\HostMember;
use App\Models\Vendor\Service\Venue;
use App\Models\SubscriptionReccuring;
use App\Models\Vendor\Service\Anchor;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Member\MemberInvitation;
use Illuminate\Notifications\Notifiable;
use App\Models\Vendor\Service\Accommodation;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class Host extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasRoles;

    protected $table = 'hosts';
    protected $guard = 'host';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'mobile', 'location_id', 'status', 'parent_id', 'priority', 'password', 'slug', 'google_id', 'google_token', 'google_refresh_token', 'facebook_id', 'facebook_token', 'facebook_refresh_token', 'email_verified_at', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'mobile_verified_at' => 'datetime',
        'role'  => 'array'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    // public function setRoleAttribute($value){
    //     $this->attributes['role'] = json_encode($value);
    // }

    // public function getRoleAttribute($value){
    //     return $this->attributes['role'] = json_decode($value);
    // }


    public function profile()
    {
        return $this->hasOne(Profile::class, 'host_id', 'id');
    }

    public function home()
    {
        return $this->hasOne(Home::class, 'host_id', 'id');
    }

    public function office()
    {
        return $this->hasOne(Office::class, 'host_id', 'id');
    }


    public function messages()
    {
        return $this->hasMany(Message::class, 'host_id', 'id');
    }


    public function invitations()
    {
        return $this->hasMany(Invitation::class);
    }

    public function ceramonies()
    {
        return $this->hasMany(CeramonyMaster::class, 'host_id', 'id');
    }

    public function tasks()
    {
        return $this->hasMany(MemberTask::class, 'member_id', 'id');
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class, 'host_id', 'id');
    }

    public function allmembers()
    {
        return $this->belongsToMany(Members::class, 'host_member', 'host_id', 'member_id')->using(HostMember::class)->withPivot('is_leader', 'leader_id', 'departnment_id');
    }

    public function members($id=null)
    {
        return $this->belongsToMany(Members::class, 'host_member', 'host_id', 'member_id')->using(HostMember::class)->wherePivot('invitation_id', (int)$id)->withPivot('is_leader', 'leader_id', 'departnment_id');
    }
    public function leaderMembers($id=null)
    {
        return $this->belongsToMany(Members::class, 'host_member', 'host_id', 'member_id')->using(HostMember::class)->wherePivot('invitation_id', (int)$id)->wherePivot('is_leader', 'true')->withPivot('is_leader', 'leader_id', 'departnment_id');
    }

    public function tasksAll()
    {
        return $this->morphMany(MemberTask::class, 'assignable');
    }

    /*  public function location(){
        return $this->belongsTo(Location::class, 'location_id','id');
    } */

    // public function invitations(){
    //     return $this->morphToMany(Invitation::class, 'invitable')->withTimestamps();
    // }

    // public function guestinvitaitons(){
    //     return $this->belongsToMany(GuestInvitation::class,'guest_invitation','host_id','guestinvitation_id')->withTimestamps()->using(GuestInvitation::class);
    // }

    public function venues()
    {
        return $this->morphMany(\App\Models\Vendor\Service\Venue::class, 'venueable');
    }

    public function anchors()
    {
        return $this->morphMany(Anchor::class, 'anchorable');
    }

    public function accommodations()
    {
        return $this->morphMany(Accommodation::class, 'accommodatable');
    }
    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }

    public function leads()
    {
        return $this->morphMany(Lead::class, 'leadable');
    }

    public function orders()
    {
        return $this->morphMany(SubscriptionOrders::class, 'ownerable');
    }

    public function activeSubscription()
    {
        $active = $this->morphMany(SubscriptionOrders::class, 'ownerable')->where('payment_done', 1)->whereNotNull('expiry_at')
            ->orderBy('expiry_at', 'desc')->with('subscribeable')->first();
         //dd($active, $this);
        return $active;
        // return $this->morphMany(SubscriptionOrders::class,'ownerable')->where('payment_done', 1)->sortByDesc('created_at')->first();
    }

    public function allRecSubscription()
    {
        return $this->morphMany(SubscriptionReccuring::class, 'ownerable');
    }
    public function activeRecSubscription()
    {
        $single = $this->morphMany(SubscriptionReccuring::class, 'ownerable')->where('status', 'active')->orderBy('created_at', 'desc')->first();
        //dd($all);
        return $single;
    }
    public function createdRecSubscription()
    {
        $single = $this->morphMany(SubscriptionReccuring::class, 'ownerable')->where('status', 'created')->orderBy('created_at', 'desc')->first();
        //dd($all);
        return $single;
    }

    public function SubscriptionCreated()
    {
        $single = $this->morphMany(SubscriptionReccuring::class, 'ownerable')->where('status', '!=', 'cancelled')->first();
        //dd($all);
        return $single;
    }
    public function testimonials()
    {
        return $this->morphMany(Testimonial::class, 'testimoniable');
    }
}

