<?php

namespace App\Models\Host;

use App\Models\Host\Host;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Home extends Model
{
    use HasFactory;

    protected $table = 'host_homes';

    protected $fillable = ['complexName', 'floor', 'doorNo', 'streetNo', 'area', 'district', 'pin', 'state', 'zone', 'country', 'reachus', 'slug', 'host_id'];

    public function getRouteKeyName()  {
        return 'slug';
    }

    public function host(){
        return $this->belongsTo(Host::class, 'host_id','id');
    }
}
