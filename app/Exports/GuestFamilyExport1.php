<?php

namespace App\Exports;

use App\Models\User;
use App\Models\Guest\Family;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\Exportable;

class GuestFamilyExport1 implements FromView, WithEvents, ShouldAutoSize
{
    use Exportable;
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
        return view('familyMembersExportDesign', [
            'guests' => $this->invitation->guests->all(),
            'famTotal' => Family::get()
        ]);
    }
    // public function collection()
    // {
    //     return $this->invitation->guests;
    // }

    public function registerEvents(): array
    {
        return [
                AfterSheet::class => function(AfterSheet $event) {
                $styleArray = [
                    'borders' => [
                        'outline' => [
                            'color' => ['argb' => '000080'],
                        ],
                    ],
                ]; 
                    $event->sheet->getDelegate()->getDefaultColumnDimension()->setWidth(120, 'pt');
                    foreach ($event->sheet->getDelegate()->getRowIterator() as $row) {
                    $cellIterator = $row->getCellIterator();
                    $cellIterator->setIterateOnlyExistingCells(true);
                        foreach ($cellIterator as $cell) {
                            if ($cell->getValue() == 'Name') {
                                $cellStart = $cell->getCoordinate();
                                $cellEnd = 'E'.substr($cellStart, 1)-1;
                                $cellStart = 'A'.substr($cellStart, 1)-1;
                                $event->sheet->getDelegate()->mergeCells($cellStart.':'.$cellEnd); 
                                $event->sheet->getDelegate()->getRowDimension(substr($cellStart, 1))->setRowHeight(30);
                                $event->sheet->getDelegate()->getColumnDimension('A')->setWidth(30);
                                $event->sheet->getDelegate()->getColumnDimension('B')->setWidth(30);
                                $event->sheet->getDelegate()->getColumnDimension('C')->setWidth(30);
                                $event->sheet->getDelegate()->getColumnDimension('D')->setWidth(30);
                                $event->sheet->getDelegate()->getColumnDimension('E')->setWidth(30);
                                $event->sheet->getDelegate()->getStyle($cellStart.':'.$cellEnd)
                                ->getAlignment()
                                ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                                $event->sheet->getDelegate()->getStyle($cellStart.':'.$cellEnd)->getBorders()
                                ->getBottom()
                                ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                // $event->sheet->getDelegate()->getStyle($cellStart.':'.$cellEnd)->getBorders()
                                // ->getBottom()
                                // ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                $event->sheet->getDelegate()->getStyle($cellStart.':'.$cellEnd)->applyFromArray($styleArray);
                            }
                        }   
                    }

                    $event->sheet->getDelegate()->mergeCells('A1:E1'); 
                    $event->sheet->getDelegate()->getStyle('A1:E1')->getBorders()
                                ->getBottom()
                                ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                    $event->sheet->getDelegate()->getStyle('A1:E1')->applyFromArray($styleArray);
                    $event->sheet->getDelegate()->getStyle('1')->getFont()->setSize(26);
                    $event->sheet->getDelegate()->getStyle('1')->getFont()   ->getColor()->setARGB('44546a');
                    $event->sheet->getDelegate()->getStyle('1')->getFont()   ->setBold(true);
            },
        ];
    }
}
