<?php

namespace App\Models\Vendor\Service;

use App\Models\Vendor\Service\Accommodation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AccomodationRooms extends Model
{
    use HasFactory;
    protected $table = 'accommodations_rooms';
    protected $guarded = [];
    protected $casts = [
        'room_specifications' => 'array',
        'room_facilities' => 'array',
        'images' => 'array',
        'videos' => 'array',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }
        public function accomodation()
    {
        return $this->belongsTo(Accommodation::class, 'accomodation_id', 'id');
    }
}
