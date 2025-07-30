<?php

namespace App\Models\Vendor;

use App\Models\Vendor\Vendor;
use App\Models\Admin\LocationMaster;
use App\Models\Admin\VendorMaster;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profile extends Model
{
    use HasFactory;
    protected $table = 'vendor_pprofiles';
    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function vendor(){
        return $this->belongsTo(Vendor::class, 'vendor_id','id');
    }

    public function location(){
        return $this->belongsTo(LocationMaster::class, 'locationmaster_id','id');
    }
}
