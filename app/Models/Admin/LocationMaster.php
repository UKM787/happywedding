<?php

namespace App\Models\Admin;

use App\Models\Host\Host;
use App\Models\Admin\VenueMaster;
use App\Models\Admin\CategoryMaster;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LocationMaster extends Model
{
    use HasFactory;
    protected $table = 'locationmaster';
    protected $fillable = ['name', 'latitude', 'longitude', 'status', 'priority', 'parent_id', 'icon', 'slug', 'imageOne', 'admin_id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'admin_id', 'slug'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function venues()
    {
        return $this->hasMany(VenueMaster::class, 'location_id', 'id');
    }

    public function vendors()
    {
        return $this->hasMany(CategoryMaster::class, 'location_id', 'id');
    }

    public function hosts()
    {
        return $this->hasMany(Host::class, 'location_id', 'id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id', 'id');
    }

    public function state()
    {
        return $this->belongsTo(LocationMaster::class, 'parent_id', 'id');
    }

    public function states()
    {
        return $this->hasMany(LocationMaster::class, 'parent_id', 'id')->whereNull('parent_id');
    }

    public function cities()
    {
        return $this->hasMany(LocationMaster::class, 'parent_id', 'id')->whereNotNull('parent_id');
    }

    public function children()
    {
        return $this->hasMany(LocationMaster::class, 'parent_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(LocationMaster::class, 'parent_id', 'id');
    }
}
