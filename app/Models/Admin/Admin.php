<?php

namespace App\Models\Admin;

use App\Models\Admin\Tag;
use App\Models\Vendor\Service\Venue;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use App\Models\Vendor\Service\Accommodation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $table = 'admins';
    protected $guard = 'admin';

    protected $fillable = [
        'name', 'email', 'mobile', 'city', 'active', 'parent_id', 'password', 'slug',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'slug'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'mobile_verified_at' => 'datetime',
        // 'role'  => 'array'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function locations()
    {
        return $this->hasMany(LocationMaster::class, 'admin_id', 'id');
    }

    public function venues()
    {
        return $this->morphMany(Venue::class, 'venueable');
    }

    public function accommodations()
    {
        return $this->morphMany(Accommodation::class, 'accommodatable');
    }

    public function articles()
    {
        return $this->morphMany(Article::class, 'articable');
    }

    public function testimonials()
    {
        return $this->morphMany(Testimonial::class, 'testimoniable');
    }

    public function tags()
    {
        return $this->hasMany(Tag::class, 'admin_id', 'id');
    }

    public function tasks()
    {
        return $this->hasMany(TaskMaster::class, 'admin_id', 'id');
    }
}
