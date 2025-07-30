<?php

namespace App\Models\Admin;


use App\Models\Admin\Admin;
use App\Models\Host\Invitation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TaskMaster extends Model
{
    use HasFactory;
    protected $table = 'taskmaster';
    protected $fillable = [
        'name', 'description', 'status', 'priority', 'parent_id', 'icon', 'slug', 'imageOne', 'admin_id', 'timeline_id'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function timeline()
    {
        return $this->belongsTo(TaskTimeline::class, 'timeline_id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'taskmaster_id', 'id');
    }

    public function categories()
    {
        return $this->hasMany(TaskMaster::class, 'parent_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(TaskMaster::class, 'parent_id', 'id')->with('categories');
    }
    public function taskmaster()
    {
        return $this->belongsToMany(Invitation::class, 'invitation_task', 'task_id', 'invitation_id')->withTimestamps();
    }
}
