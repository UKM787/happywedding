<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $table = 'tasks';
    protected $guarded =  [];

    public function master(){
        return $this->belongsTo(TaskMaster::class, 'taskmaster_id', 'id');
    }
}
