<?php

namespace App\Models\Admin;

use App\Models\Host\Host;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CeramonyMaster extends Model
{

    use HasFactory;

    protected $table = 'ceramonymaster';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'type', 'imageOne', 'imageFile', 'image_path', 'status', 'parent_id', 'priority', 'ion', 'slug', 'admin_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'admin_id', 'parent_id', 'slug'
    ];


    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected $casts = [
        'imageOne' => 'array'
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id', 'id');
    }
}
