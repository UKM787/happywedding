<?php

namespace App\Exports;

use App\Models\User;
use App\Models\GuestProfile;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class GuestProfileExport implements FromCollection,WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public $invitation;

    public function __construct($invitation) {
        $this->invitation = $invitation;
      }
    
      public function collection()
      {
          return $this->invitation->guests;
      }

      public function map($guests): array
      {
          //return [$guests->name];
          if(isset($guests->profile)){
            return[   
                $guests->profile->name,
                $guests->profile->fatherName,
                $guests->profile->surname,
                $guests->profile->age,
                $guests->profile->gender,
                $guests->profile->relation,
                $guests->profile->email,
                $guests->profile->phone,
                $guests->profile->mobile,
                $guests->profile->mobile1,
                $guests->profile->whatsup,
                ];
          }
          else{
              return [];
          }
                 
      }
  
      public function headings(): array
      {
          return [
              'Name',
              'Father Name',
              'Surname',
              'Age',
              'Gender',
              'Relation',
              'Email',
              'Phone',
              'Mobile',
              'Mobile2',
              'Whatsapp',

          ];
      }
}
