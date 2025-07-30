<?php

namespace App\Models\Vendor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $table = 'reviews';
    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function reviewable(){
        return $this->morphTo();
    }
    public function productable(){
        return $this->morphTo();
    }
}
