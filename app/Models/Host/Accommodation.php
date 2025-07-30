<?php

namespace App\Models\Host;

use App\Models\Host\AccommRoom;
use App\Models\Host\AccommBlock;
use App\Models\Host\AccommFloor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Accommodation extends Model
{
    use HasFactory;

    protected $table = 'host_accommodations';

    protected $fillable=['name','block','floor','invitation_id'];

    public function blocksAll(){   
        return $this->hasMany(AccommBlock::class);
    }

    public function floors(){
        return $this->hasManyThrough(AccommFloor::class,AccommBlock::class,'accommodation_id','block_id','id','id');
    }

    // public function rooms(){
    //     return $this->hasManyThrough(AccommRoom::class, AccommFloor::class,AccommBlock::class,'accommodation_id','block_id','floor_id','id','id','id');
    // }
}
