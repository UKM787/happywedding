<?php

namespace App\Models\Admin;

use App\Models\Admin\Admin;
use App\Models\Vendor\Vendor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategoryMaster extends Model
{
    use HasFactory;
    protected $table = 'categorymaster';

    protected $fillable =  ['name', 'description', 'status', 'priority', 'parent_id', 'icon', 'slug', 'relation', 'path', 'admin_id', 'imageOne'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    // public function location(){
    //     return $this->belongsTo(LocationMaster::class,'locationmaster_id','id');
    // }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id', 'id');
    }

    public function categories()
    {
        return $this->hasMany(CategoryMaster::class, 'parent_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(CategoryMaster::class, 'parent_id', 'id')->with('categories');
    }

    public function parent()
    {
        return $this->belongsTo(CategoryMaster::class, 'parent_id', 'id')->with('categories');
    }

    public function vendors()
    {
        return $this->belongsToMany(Vendor::class, 'vendor_category', 'category_id', 'vendor_id')->withTimestamps();
    }

    public function venues()
    {
        return $this->hasMany(Venue::class, 'category_id', 'id');
    }

    public function articles()
    {
        return $this->hasMany(Article::class, 'category_id', 'id');
    }
}
