<?php

namespace App\Models\Vendor;

use App\Models\Vendor\Vendor;
use App\Models\Admin\VendorMaster;
use App\Models\Admin\LocationMaster;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';

    protected $fillable =    ['name', 'status', 'priority', 'slug', 'icon', 'imageOne', 'product_id', 'location_id', 'vendor_id'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function products()
    {
        return $this->belongsTo(VendorMaster::class, 'product_id', 'id');
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id', 'id');
    }

    public function location()
    {
        return $this->belongsTo(LocationMaster::class, 'location_id', 'id');
    }

}
