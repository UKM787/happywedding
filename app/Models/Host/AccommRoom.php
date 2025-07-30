<?php

namespace App\Models\Host;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccommRoom extends Model
{
    use HasFactory;

            protected $table = 'accomm_rooms';
                protected $fillable=['room','guest_name','guest_id','accomdation_id'];


}
