<?php

namespace App\Models\Host;

use App\Models\Host\Ceramony;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GuestCeramony extends Pivot {

    use HasFactory;

    protected $table = 'ceramony_guest';
    protected $guarded = [];



}
