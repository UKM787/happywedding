<?php

namespace App\Models\Guest;

use App\Models\User;
use App\Models\Guest\Privilege;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Family extends Model
{
    use HasFactory;

    protected $fillable = ['familyname','familyage','familygender','familyrelation','familymobile','familyimageOne','familyimageTwo','share','slug','guest_id'];
    protected $table = 'guest_families';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
        'slug'
    ];

    public function getRouteKeyName()    {
        return 'slug';
    }

    public function guest(){
        return $this->belongsTo(User::class, 'guest_id','id');
    }

    public function privilege($id = null) {
        return $this->hasOne(Privilege::class, 'family_id','id')->where('invitation_id', (int)$id);
    }

    public function privileges() {
        return $this->hasMany(Privilege::class, 'family_id','id');
    }
}
