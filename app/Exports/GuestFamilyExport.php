<?php

namespace App\Exports;


use App\Models\User;
use App\Models\GuestFamily;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class GuestFamilyExport implements FromCollection,WithMapping, WithHeadings
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
          //dd($guests);
          $rows=[];
            if(isset($guests->family)){

                foreach($guests->family as $familyMembers){
                    array_push($rows,[
                        $familyMembers->name,
                        $familyMembers->age,
                        $familyMembers->gender,
                        $familyMembers->relation,
                        $familyMembers->mobile,
                        $familyMembers->share,
                    ]);  
                }
            }
            return $rows;
      }
  
      public function headings(): array
      {
         return [
             'Name',
             'Age',
             'Gender',
         ];
      }
}
