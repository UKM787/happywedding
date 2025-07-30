<?php

namespace App\Exports;

use App\Models\User;
use App\Models\GuestProfile;
use Illuminate\Support\Facades\Crypt;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection,WithMapping, WithHeadings,WithEvents
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
        return [
            $guests->name,
            $guests->email,
            $guests->mobile,
            $guests->profile->fatherName?? " ",
            $guests->profile->surname?? " ",
            $guests->profile->age?? " ",
            $guests->profile->gender?? " ",
            $guests->profile->relation?? " ",
            $guests->profile->phone?? " ",
            $guests->profile->mobile1?? " ",
            $guests->profile->whatsup?? " ",

        ];


    }

    public function registerEvents(): array
    {
        return [
                AfterSheet::class    => function(AfterSheet $event) {
                    $event->sheet->getDelegate()->mergeCells('A1:L1');
                    $event->sheet->getDelegate()->getStyle('1')->getFont()->setSize(26);
                    $event->sheet->getDelegate()->getStyle('1')->getFont()   ->getColor()->setARGB('44546a');
                    $event->sheet->getDelegate()->getStyle('1')->getFont()   ->setBold(true);
                    $event->sheet->getDelegate()->getStyle('A1:L1')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                    $event->sheet->getDelegate()->getDefaultColumnDimension()->setWidth(120, 'pt');
                    $event->sheet->getDelegate()->getStyle('A2:L2')
                    ->getFont()->setBold(true);
                    $event->sheet->getDelegate()->getStyle('A2:L2')
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                    $event->sheet->getDelegate()->getStyle('A3:L3')
                    ->getFont()->setBold(true);
            },
        ];
    }

    public function headings(): array
    {
        return [
            ['GUEST LOGIN CREDENTIALS AND GUEST PROFILE SHEET'],
            ['(REQUIRED)','(REQUIRED)','(REQUIRED)','(OPTIONAL)','(OPTIONAL)','(OPTIONAL)','(OPTIONAL)','(OPTIONAL)','(OPTIONAL)','(OPTIONAL)','(OPTIONAL)'],
            ['Name', 'Email', 'Mobile', 'Father Name', 'Surname', 'Age', 'Gender', 'Relation', 'Phone', 'Mobile2', 'Watsapp'],
        ];
    }


    
}
