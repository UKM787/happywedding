<?php

namespace App\Models\Member;

use App\Models\Host\Host;
use App\Models\Host\Invitation;
use App\Models\Host\InvitationTask;
use App\Models\Host\MemberTask;
use App\Models\Member\MemberInvitation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Members extends Authenticatable
{
    use HasFactory;
    protected $table = 'members';
    protected $fillable = [
        'name', 'email', 'mobile', 'status', 'parent_id', 'password', 'slug', 'google_id', 'google_token', 'google_refresh_token', 'facebook_id', 'facebook_token', 'facebook_refresh_token', 'email_verified_at'
    ];

    public function invitations() {
        return $this->belongsToMany(Invitation::class, 'member_invitations', 'member_id', 'invitation_id');
    }

    

    public function host() {
        return $this->belongsToMany(Host::class, 'host_member', 'member_id', 'host_id');
    }

    public function tasksAll(){
        return $this->morphMany(MemberTask::class,'assignable');
    }


    public function defaultTasksAll(){
        return $this->morphMany(InvitationTask::class,'assignable');
    }

    public function defaultTasksCompleted(){
        return $this->morphMany(InvitationTask::class,'completeable');
    }
}
