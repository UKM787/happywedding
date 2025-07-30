<?php

namespace App\Models\Vendor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;
    protected $table = 'leads';
    protected $guarded = [];
    protected $casts = [
        'rooms_selected' => 'array',
        'no_of_guests' => 'array'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function leadable(){
        return $this->morphTo();
    }

    public function reviewable(){
        return $this->morphTo();
    }
    public function productable(){
        return $this->morphTo();
    }
}
