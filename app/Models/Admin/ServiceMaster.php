<?php

namespace App\Models\Admin;

use App\Models\Admin\Admin;
use App\Models\Vendor\Vendor;
use App\Models\Admin\LocationMaster;
use App\Models\Vendor\Service\Accommodation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ServiceMaster extends Model
{
    use HasFactory;
    protected $table = 'servicemaster';

    protected $fillable =  ['name', 'description', 'status', 'priority', 'parent_id', 'icon', 'slug', 'relation', 'path', 'admin_id', 'imageOne'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id', 'id');
    }

    public function scopeRoot($query)
    {
        return $query->whereNull('parent_id');
    }

    public function scopeService($query, $search)
    {
        return $query->where('name', 'like', "%{$search}%");
    }

    public function child()
    {
        return $this->hasMany(ServiceMaster::class, 'parent_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(ServiceMaster::class, 'parent_id', 'id')->with('children');
    }

    public function parent()
    {
        return $this->belongsTo(ServiceMaster::class, 'parent_id', 'id');
    }

    public function parents()
    {
        return $this->belongsTo(ServiceMaster::class, 'parent_id', 'id')->with('parent');
    }


    public function path()
    {
        return route('admin.service.show', $this);
    }

    public function vendorcategories()
    {
        return $this->belongsToMany(Vendor::class, 'vendor_category', 'category_id', 'vendor_id')->withTimestamps();
    }

    public function venues()
    {
        return $this->hasMany(Venue::class, 'category_id', 'id');
    }

     public function accommodation()
    {
        return $this->hasMany(Accommodation::class, 'category_id', 'id');
    }

    public function vendors()
    {
        return $this->belongsToMany(Vendor::class, 'vendor_service', 'service_id', 'vendor_id');
    }

    // public function venues()
    // {
    //     return $this->morphedByMany(Post::class, 'taggable');
    // }
}
