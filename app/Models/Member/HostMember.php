<?php

namespace App\Models\Member;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class HostMember extends Pivot
{
    use HasFactory;
    protected $table = 'host_member';

    protected $guarded = [];

    public function department($id = null)
    {
        return MemberDepartment::where('id', (int)$id)->first();
    }
    public function leader($id = null)
    {
        return Members::where('id', (int)$id)->first();
    }

}
