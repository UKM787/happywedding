<?php

namespace App\Models\Guest;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = ['name','fatherName','surname','age','gender','relation','email','phone','mobile','mobile1','whatsup','imageOne','guest_id','slug'];
    protected $table = 'guest_profiles';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
        'slug'
    ];

    public function getRouteKeyName()    {
        return 'slug';
    }

    public function guest() {
        return $this->belongsTo(User::class, 'guest_id','id');
    }
}
