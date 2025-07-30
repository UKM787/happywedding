<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Memory extends Model
{
    use HasFactory;

    protected $fillable = [
        'invitation_id',
        'image_name',
        'original_name',
        'mime_type',
        'size'
    ];

    public function invitation()
    {
        return $this->belongsTo(Invitation::class);
    }
} 