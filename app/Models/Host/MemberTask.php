<?php

namespace App\Models\Host;

use App\Models\Host\Host;
use App\Models\Admin\Task;
use App\Models\Host\Invitation;
use App\Models\Vendor\Category;
use App\Models\Admin\TaskMaster;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MemberTask extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $table = 'memberstask';
    protected $fillable = ['title', 'category_id', 'taskPriority','taskStatus','pinned','startDate', 'invitation_id', 'completionDate', 'startTime', 'completionTime'];

    public function getRouteKey()    {
        return 'slug';
    }

    public function invitation(){
        return $this->belongsTo(Invitation::class, 'invitation_id','id');
    }

    public function member()    {
        return $this->belongsTo(Host::class, 'member_id', 'id');
    }

    // public function category()    {
    //     return $this->belongsTo(Category::class, 'category_id', 'id');
    // }

    public function assignable(){
        return $this->morphTo();
    }

    public function category(){
        return $this->belongsTo(TaskMaster::class,'category_id','id');
    }
}
