<?php

namespace App\Models\Vendor;

use App\Models\Vendor\Vendor;
use App\Models\Admin\LocationMaster;
use App\Models\Admin\VendorMaster;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CompanyProfile extends Model
{
    use HasFactory;
    protected $table = 'vendor_cprofiles';
    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function vendor(){
        return $this->belongsTo(Vendor::class, 'vendor_id','id');
    }

    public function category(){
        return $this->belongsTo(VendorMaster::class, 'vendormaster_id','id');
    }

    public function location(){
        return $this->belongsTo(LocationMaster::class, 'locationmaster_id','id');
    }
}
