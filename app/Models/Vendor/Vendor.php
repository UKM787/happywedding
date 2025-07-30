<?php

namespace App\Models\Vendor;

use App\Models\Vendor\Profile;
use App\Models\Admin\VendorMaster;
use App\Models\Admin\CategoryMaster;
use App\Models\Admin\LocationMaster;
use App\Models\Admin\ServiceMaster;
use App\Models\Vendor\Service\Hotel;
use App\Models\Vendor\Service\Venue;
use App\Models\Vendor\CompanyProfile;
use App\Models\Vendor\Service\Anchor;
use App\Models\Vendor\VendorCategory;
use App\Models\Vendor\Service\WVendor;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use App\Models\Vendor\Service\VendorVenue;
use App\Models\Vendor\Service\Accommodation;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Vendor extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;
    protected $table = 'vendors';
    protected $guard = 'vendor';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'mobile', 'active', 'location_id', 'priority','password', 'slug', 'category_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'mobile_verified_at' => 'datetime',
    ];

    public function getRouteKeyName()  {
        return 'slug';
    }

    public function profile(){
        return $this->hasOne(Profile::class, 'vendor_id', 'id');
    }
    public function company(){
        return $this->hasOne(CompanyProfile::class, 'vendor_id', 'id');
    }

    public function mainCategory(){
        return $this->belongsTo(CategoryMaster::class, 'category_id', 'id');
    }

    public function location(){
        return $this->belongsTo(LocationMaster::class, 'location_id', 'id');
    }

    public function categories() {
        return $this->belongsToMany(CategoryMaster::class,'vendor_category', 'vendor_id', 'category_id')->withTimestamps();
    }

    public function services() {
        return $this->belongsToMany(ServiceMaster::class,'vendor_service', 'vendor_id', 'service_master_id')->withTimestamps();
    }

    public function anchors(){
        return $this->morphMany(Anchor::class, 'anchorable');
    }

    public function accommodations() {
        return $this->morphMany(Accommodation::class, 'accommodatable');
    }

    public function venues()    {
        return $this->morphMany(Venue::class, 'venueable');
    }
    public function vendorvenues()    {
        return $this->morphMany(VendorVenue::class, 'vendorvenueable');
    }
    public function wvendors()    {
        return $this->morphMany(WVendor::class, 'wvendorable');
    }
}
