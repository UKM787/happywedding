<?php

namespace App\Models\Company;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Company extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $table = 'companies';
    protected $guard = 'company';

    protected $fillable = [
        'name', 'email', 'mobile', 'location_id', 'active', 'priority','password', 'slug',
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

    public function profile(){
        return $this->hasOne(Profile::class, 'company_id', 'id');
    }
        public function companyProfile(){
        return $this->hasOne(CompanyProfile::class, 'company_id', 'id');
    }
    public function location(){
        return $this->belongsTo(LocationMaster::class, 'location_id', 'id');
    }
}
