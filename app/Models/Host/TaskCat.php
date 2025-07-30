<?php

namespace App\Models\Host;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskCat extends Model
{
    use HasFactory;
    protected $table = 'task_cats';
    protected $fillable = ['name', 'description','active', 'parent_id', 'priority', 'icon', 'slug' ];

    public function getRouteKey()
    {
        return 'slug';
    }
}
