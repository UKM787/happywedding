<?php

namespace App\Models\Vendor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorService extends Model
{
    use HasFactory;
    protected $table = 'vendor_service';
    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }


    public function productable(){
        return $this->morphTo();
    }
}
