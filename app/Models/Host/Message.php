<?php

namespace App\Models\Host;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Host\Host;
use App\Models\Member\Members;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['contact_for','slug','host_id', 'invitation_id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['updated_at','created_at'];

    public function getRouteKeyName()    {
        return 'slug';
    }
   

    public function member()    {
        return $this->belongsTo(Members::class, 'host_id', 'id');
    }

    public function invitation()    {
        return $this->belongsTo(Invitation::class, 'invitation_id', 'id');
    }

}
