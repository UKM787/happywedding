<?php

namespace App\Models\Member;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberInvitation extends Model
{
    use HasFactory;
    protected $table = 'member_invitation';

    protected $fillable = [
        'member_id', 'invitation_id'
    ];
}
