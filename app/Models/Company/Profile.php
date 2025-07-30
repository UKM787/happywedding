<?php

namespace App\Models\Company;

use App\Models\Company\Company;
use App\Models\Admin\LocationMaster;
use App\Models\Admin\VendorMaster;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profile extends Model
{
    use HasFactory;
    protected $table = 'company_pprofiles';
    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function company(){
        return $this->belongsTo(Company::class, 'company_id','id');
    }

    public function location(){
        return $this->belongsTo(LocationMaster::class, 'locationmaster_id','id');
    }
}
