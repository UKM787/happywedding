<?php

namespace App\Models\Vendor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorCategory extends Model
{
    use HasFactory;
    protected $table = 'vendor_category';
    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
