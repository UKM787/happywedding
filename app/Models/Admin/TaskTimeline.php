<?php

namespace App\Models\Admin;


use App\Models\Admin\Admin;
use App\Models\Admin\TaskMaster as AdminTaskMaster;
use App\Models\Host\Invitation;
use App\Models\Host\InvitationTask;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TaskTimeline extends Model
{
    use HasFactory;
    protected $table = 'task_timeline';
    protected $guarded = [];

    public function tasks()
    {
        return $this->hasMany(TaskMaster::class, 'timeline_id', 'id');
    }

    public function invitationTasks()
    {
        return $this->hasMany(InvitationTask::class, 'custom_timeline_id', 'id');
    }

}
