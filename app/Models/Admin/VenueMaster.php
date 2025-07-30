<?php

namespace App\Models\Admin;

use App\Models\Admin\Admin;

use App\Models\Admin\LocationMaster;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VenueMaster extends Model
{
    use HasFactory;
    protected $table = 'venuemaster';

    protected $fillable = ['name', 'description','address', 'status', 'priority',  'map', 'parent_id', 'icon' , 'slug', 'admin_id', 'locationmaster_id', 'imageOne'];

    public function getRouteKeyName()  {
        return 'slug';
    }

    public function location(){
        return $this->belongsTo(LocationMaster::class,'locationmaster_id','id');
    }

    public function admin()  {
        return $this->belongsTo(Admin::class, 'admin_id', 'id');
    }

    public function categories() {
        return $this->hasMany(VenueMaster::class, 'parent_id', 'id');
    }

    public function children()    {
        return $this->hasMany(VenueMaster::class, 'parent_id', 'id')->with('categories');
    }

    public function venues(){
        return $this->hasMany(Venue::class,'venuemaster_id','id');
    }



}
