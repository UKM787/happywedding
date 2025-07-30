<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Events\AfterSheet;

trait AdminExportSettings {

    public function settings(){
        return [
                AfterSheet::class    => function(AfterSheet $event) {
                    $worksheet =$event->sheet;
                    $highestRow = $worksheet->getHighestRow(); // e.g. 10
                    $highestColumn = $worksheet->getHighestColumn(); // e.g 'F'
                    $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);
                    for ($row = 1; $row <= $highestRow; ++$row) {
                        for ($col = 'A'; $col != $highestColumn; ++$col) {
                            if($row >3 && $col == 'B' )
                            $worksheet->getDelegate()->getStyle($col.$row)->getAlignment()->setWrapText
                            (true);
                        }
                    }
                    //dd($worksheet, $highestRow, $highestColumn, $highestColumnIndex);
                    $event->sheet->getDelegate()->mergeCells('A1:L1');
                    $event->sheet->getDelegate()->getStyle('1')->getFont()->setSize(26);
                    $event->sheet->getDelegate()->getStyle('1')->getFont()   ->getColor()->setARGB('44546a');
                    $event->sheet->getDelegate()->getStyle('1')->getFont()   ->setBold(true);
                    $event->sheet->getDelegate()->getStyle('A1:L1')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                    $event->sheet->getDelegate()->getDefaultColumnDimension()->setWidth(150, 'pt');
                    //$event->sheet->getDelegate()->getDefaultColumnDimension('B')->setAutoSize(true);
                    $event->sheet->getDelegate()->getStyle('A2:L2')
                    ->getFont()->setBold(true);
                    $event->sheet->getDelegate()->getStyle('A2:L2')
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                    // $event->sheet->getDelegate()->getStyle('A3:L3')
                    // ->getFont()->setBold(true);
            },
        ];
    }
}
