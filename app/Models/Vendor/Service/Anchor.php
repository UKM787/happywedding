<?php

namespace App\Models\Vendor\Service;

use App\Models\Admin\LocationMaster;
use App\Models\Admin\VendorMaster;
use App\Models\Vendor\Vendor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Anchor extends Model
{
    use HasFactory;
    protected $table = 'anchors';
    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function location()
    {
        return $this->belongsTo(LocationMaster::class, 'location_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(VendorMaster::class, 'category_id', 'id');
    }

    public function anchorable()
    {
        return $this->morphTo();
    }
}
