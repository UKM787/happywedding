<?php

namespace App\Models\Host;

use App\Models\Host\Host;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Office extends Model
{
    use HasFactory;
    protected $table = 'host_offices';
    protected $fillable = ['officecompanyName', 'officecomplexName', 'officefloor', 'officedoorNo', 'officestreetNo', 'officearea', 'officedistrict', 'officepin', 'officestate', 'officezone', 'officecountry', 'officereachus', 'slug', 'host_id'];

    public function getRouteKeyName() {
        return 'slug';
    }

    public function host() {
        return $this->belongsTo(Host::class, 'host_id', 'id');
    }
}
