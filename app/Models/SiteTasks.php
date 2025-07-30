<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteTasks extends Model
{
    use HasFactory;

    protected $table = 'site_tasks';


    protected $guarded = [];
}
