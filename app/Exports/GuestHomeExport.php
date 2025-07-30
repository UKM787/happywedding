<?php

namespace App\Exports;

use App\Models\User;
use App\Models\GuestHome;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class GuestHomeExport implements FromCollection,WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    private $invitation;

    public function __construct($invitation) {
        $this->invitation = $invitation;
      }
    
      public function collection()
      {
          return $this->invitation->guests;
      }

      public function map($guests): array
      {
        if(isset($guests->home)){
          return [
              $guests->home->complexName,
              $guests->home->floor,
              $guests->home->doorNo,
              $guests->home->streetNo,
              $guests->home->area,
              $guests->home->district,
              $guests->home->pin,
              $guests->home->state,
              $guests->home->zone,
              $guests->home->country,
              $guests->home->reachus,
          ];
        }
        else{
            return [];
        }
        
  
      }
  
      public function headings(): array
      {
          return [
              'Complex Name',
              'Floor',
              'Door No',
              'Street No',
              'Area',
              'District',
              'Pin',
              'State',
              'Zone',
              'Country',
              'Reach us',
          ];
      }
}
