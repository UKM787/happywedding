<?php

namespace App\Models\Admin;

use App\Models\Admin\CategoryMaster;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VendorMaster extends Model
{
    use HasFactory;
    protected $table = 'vendors';
    protected $guarded = [];

    public function master()
    {
        return $this->belongsTo(CategoryMaster::class, 'categorymaster_id', 'id');
    }
    public function location()
    {
        return $this->belongsTo(LocationMaster::class, 'locationmaster_id', 'id');
    }
}
