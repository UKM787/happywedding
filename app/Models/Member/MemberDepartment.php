<?php

namespace App\Models\Member;

use App\Models\Host\Host;
use App\Models\Host\Invitation;
use App\Models\Host\MemberTask;
use App\Models\Member\MemberInvitation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class MemberDepartment extends Authenticatable
{
    use HasFactory;
    protected $table = 'member_departments';
    protected $guarded = [];

}
