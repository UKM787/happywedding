<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = ['imageName', 'album_id','invitation_id'];

    public function album(){   
        return $this->belongsTo(Album::class);
    }
    public function invitation(){   
        return $this->belongsTo(Host\Invitation::class);
    }
}
