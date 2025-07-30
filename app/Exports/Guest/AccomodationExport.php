<?php

namespace App\Exports\Guest;

use App\Models\User;
use App\Models\Guest\Family;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithValidation;

class AccomodationExport implements FromView 
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public $invitation;

    public function __construct($invitation) 
    {
        $this->invitation = $invitation;
    }



    public function view(): View
    {
        //dd('ss');
        return view('guestAccommodationExportDesign', [
            'guests' => $this->invitation->guests->all(),
        ]);
    }
    // public function collection()
    // {
    //     return $this->invitation->guests;
    // }

}
