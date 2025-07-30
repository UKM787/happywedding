<?php

namespace App\Models\Host;

use App\Models\Host\Host;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profile extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'host_profiles';
    
    protected $fillable = ['name', 'fatherName', 'surname', 'age', 'gender', 'relation', 'email', 'phone', 'mobile', 'mobile1', 'whatsup', 'imageOne', 'host_id', 'slug'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'invitation_id',
        'slug'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        // 'ceramoneyStartDate' => 'datetime',
        // 'ceramoneyEndDate' => 'datetime',
    ];

    public function getRouteKeyName() {
        return 'slug';
    }

    public function host() {
        return $this->belongsTo(Host::class, 'host_id', 'id');
    }
}
