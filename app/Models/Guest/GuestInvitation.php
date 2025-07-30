<?php

namespace App\Models\Guest;

use App\Models\Host\Host;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GuestInvitation extends Pivot
{
    /**
     * its a pivot table for guests-users and invitations
     */
    use HasFactory;
    protected $table = 'guest_invitation';

     protected $casts = [
        'ceremony_invite' => 'array',
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'ceremony_invite' => '{}'
    ];


    public function getRouteKeyName() {
        return 'slug';
    }

}
