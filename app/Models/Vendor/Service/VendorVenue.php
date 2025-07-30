<?php

namespace App\Models\Vendor\Service;

use App\Models\Admin\VenueMaster;
use App\Models\Admin\VendorMaster;
use App\Models\Admin\LocationMaster;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VendorVenue extends Model
{

    use HasFactory;
    protected $table = 'vendorvenues';
    protected $guarded = [];
        protected $casts = [
        'venue_facilities' => 'array',
        'party_area' => 'array',
        'venue_policies' => 'array',
        'features' => 'array',
        'images' => 'array',  
        'videos' => 'array', 
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function master()
    {
        return $this->belongsTo(VenueMaster::class,'venuemaster_id','id');
    }

    public function location()
    {
        return $this->belongsTo(LocationMaster::class, 'location_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(VendorMaster::class, 'category_id', 'id');
    }

    public function vendorvenueable()
    {
        return $this->morphTo();
    }


    public function ceramonies()
    {
        return $this->belongsToMany(Ceramony::class, 'ceramony_venue', 'venue_id', 'ceramony_id')->withPivot(['venue_id', 'ceramony_id'])->withTimestamps();
    }


    public function invitations()
    {
        return $this->belongsToMany(Venue::class, 'invitation_venue', 'venue_id', 'invitation_id')->withPivot(['venue_id', 'invittation_id'])->withTimestamps();
    }


}
