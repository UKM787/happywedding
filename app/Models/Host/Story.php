<?php

namespace App\Models\Host;

use Carbon\Carbon;
use App\Models\Host\Invitation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Story extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'story';

    protected $fillable = ['groom_image','groom_desc','bride_image','bride_desc','first_meet_image','first_meet','first_meet_date','relation_start_image','relation_start','relation_start_date','marriage_decide_image','marriage_decide','marriage_decide_date', 'images','slug','invitation_id'];

    protected $casts = [
        'images' => 'array',
    ];
    protected $attributes = [
        'images' => '[]'
    ];

    public function getRouteKeyName()    {
        return 'slug';
    }

    public function invitation() {
        return $this->hasOne(Invitation::class, 'invitation_id', 'id');
    }
}
