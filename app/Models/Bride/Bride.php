<?php

namespace App\Models\Bride;

use App\Models\Host\Invitation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Bride extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'mobile', 'department', 'role',
        'imageOne', 'invitation_id', 'slug'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'slug', 'invitation_id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function invitation()
    {
        return $this->belongsToMany(Invitation::class, 'invitation_id', 'id');
    }
}
