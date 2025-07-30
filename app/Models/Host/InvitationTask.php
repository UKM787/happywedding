<?php

namespace App\Models\Host;

use App\Models\Host\Host;
use App\Models\Admin\Task;
use App\Models\Host\Invitation;
use App\Models\Vendor\Category;
use App\Models\Admin\TaskMaster;
use App\Models\Admin\TaskTimeline;
use App\Models\Member\Members;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class InvitationTask extends Pivot
{
    use HasFactory;

    public $timestamps = true;

    protected $table = 'invitation_task';
    protected $guarded = [];

    public function getRouteKey()    {
        return 'slug';
    }

    // public function invitation(){
    //     return $this->belongsTo(Invitation::class, 'invitation_id','id');
    // }

    // public function member()    {
    //     return $this->belongsTo(Members::class, 'member_id', 'id');
    // }

    public function timeline($id = null){
        return TaskTimeline::where('id', (int)$id)->first();
    }

    public function assignable(){
        return $this->morphTo();
    }

    public function completeable(){
        return $this->morphTo();
    }


    // public function assignable(){
    //     return $this->morphTo();
    // }

    // public function category(){
    //     return $this->belongsTo(TaskMaster::class,'category_id','id');
    // }
}
