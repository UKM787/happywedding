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

class GuestAllExport implements FromCollection,WithMapping, WithHeadings,WithEvents
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
            $guests->home->complexName ?? " ",
            $guests->home->floor?? " ",
            $guests->home->doorNo?? " ",
            $guests->home->streetNo?? " ",
            $guests->home->area?? " ",
            $guests->home->district?? " ",
            $guests->home->pin?? " ",
            $guests->home->state?? " ",
            $guests->home->zone?? " ",
            $guests->home->country?? " ",
            $guests->home->reachus?? " ",
            $guests->office->officecompanyName ?? " ",
            $guests->office->officecomplexName?? " ",
            $guests->office->officefloor?? " ",
            $guests->office->officedoorNo?? " ",
            $guests->office->officestreetNo?? " ",
            $guests->office->officearea?? " ",
            $guests->office->officedistrict?? " ",
            $guests->office->officepin?? " ",
            $guests->office->officestate?? " ",
            $guests->office->officezone?? " ",
            $guests->office->officecountry?? " ",
            $guests->office->officereachus?? " ",
        ];
        
    }

    public function registerEvents(): array
    {
        return [
                AfterSheet::class    => function(AfterSheet $event) {
                    $event->sheet->getDelegate()->mergeCells('A1:AH1');
                    $event->sheet->getDelegate()->getStyle('1')->getFont()->setSize(26);
                    $event->sheet->getDelegate()->getStyle('1')->getFont()   ->getColor()->setARGB('44546a');
                    $event->sheet->getDelegate()->getStyle('1')->getFont()->setBold(true);
                    $event->sheet->getDelegate()->getDefaultColumnDimension()->setWidth(120, 'pt');
                    $event->sheet->getDelegate()->getStyle('A2:AH2')
                    ->getFont()->setBold(true);
                    $event->sheet->getDelegate()->getStyle('A2:AH2')
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                    $event->sheet->getDelegate()->getStyle('A3:AH3')
                    ->getFont()->setBold(true);
            },
        ];
    }

    public function headings(): array
    {
        return [
            ['GUEST LOGIN CREDENTIALS AND GUEST PROFILE SHEET'],
            ['(REQUIRED)','(REQUIRED)','(REQUIRED)','(OPTIONAL)','(OPTIONAL)','(OPTIONAL)','(OPTIONAL)','(OPTIONAL)','(OPTIONAL)','(OPTIONAL)','(OPTIONAL)','(OPTIONAL)','(OPTIONAL)','(OPTIONAL)','(OPTIONAL)','(OPTIONAL)','(OPTIONAL)','(OPTIONAL)','(OPTIONAL)','(OPTIONAL)','(OPTIONAL)','(OPTIONAL)','(OPTIONAL)','(OPTIONAL)','(OPTIONAL)','(OPTIONAL)','(OPTIONAL)','(OPTIONAL)','(OPTIONAL)','(OPTIONAL)','(OPTIONAL)','(OPTIONAL)','(OPTIONAL)','(OPTIONAL)'],
            ['Name', 'Email', 'Mobile', 'Father Name', 'Surname', 'Age', 'Gender', 'Relation', 'Phone', 'Mobile2', 'Watsapp', 'Complex Name', 'Floor', 'Door No', 'Street No','Area', 'District','Pin','State','Zone','Country','Reach us','companyname', 'companycomplexname', 'companyfloor','companydoorNo','companystreetNo','companyarea','companydistrict','companypin','companystate','companyzone','companycountry','companyreachus'],
        ];
    }


    
}
