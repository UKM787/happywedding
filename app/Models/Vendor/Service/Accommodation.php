<?php

namespace App\Models\Vendor\Service;

use App\Models\Vendor\Lead;
use App\Models\Vendor\Review;
use App\Models\Admin\VendorMaster;
use App\Models\Admin\ServiceMaster;
use App\Models\Admin\LocationMaster;
use Illuminate\Database\Eloquent\Model;
use App\Models\Vendor\Service\AccomodationRooms;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Accommodation extends Model
{
    use HasFactory;
    protected $table = 'accommodations';
    protected $guarded = [];
    protected $casts = [
        'accom_facilities' => 'array',
        'images' => 'array',
        'videos' => 'array',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function location()
    {
        return $this->belongsTo(LocationMaster::class, 'location_id', 'id');
    }
    public function rooms()
    {
        return $this->hasMany(AccomodationRooms::class, 'accomodation_id', 'id');
    }

    public function reviews()  {
        return $this->morphMany(Review::class, 'productable');
    }

    public function leads()  {
        return $this->morphMany(Lead::class, 'productable');
    }
    
    public function category()
    {
        return $this->belongsTo(VendorMaster::class, 'category_id', 'id');
    }

    public function accommodatable()    {
        return $this->morphTo();
    }
    public function allInvitations()
    {
        return $this->morphToMany(Invitation::class, 'vendorable');
    }
    public function services()  {
        return $this->morphToMany(ServiceMaster::class,'productable', 'vendor_service');
    }
}
