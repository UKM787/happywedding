<?php

namespace App\Models\Host;

use App\Models\Host\Host;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vendorables extends Pivot
{
    /**
     * its a pivot table for guests-users and invitations
     */
    use HasFactory;
    protected $table = 'vendorables';


    public function getRouteKeyName() {
        return 'slug';
    }

}
