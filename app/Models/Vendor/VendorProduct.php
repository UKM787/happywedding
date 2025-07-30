<?php

namespace App\Models\Vendor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorProduct extends Model
{
    use HasFactory;
    protected $table = 'vendors_products';
    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
