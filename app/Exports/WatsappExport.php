<?php

namespace App\Exports;

use App\Models\User;
use App\Models\GuestProfile;
use App\Models\ShortUrl;
use App\Traits\UrlShort;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Crypt;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class WatsappExport implements FromCollection,WithMapping, WithHeadings,WithEvents
{
    use UrlShort;
    /**
    * @return \Illuminate\Support\Collection
    */
    public $invitation;
    public $existingUrl;
    public $brideGroom;
    public $weddingDate;

    public function __construct($invitation) {
        $this->invitation = $invitation;
        $this->existingUrl = optional(ShortUrl::orderBy('id', 'desc')->first())->short_url;
        $this->brideGroom = $invitation->side == 'bride' ? $this->invitation->brideName .' & '.$this->invitation->groomName : $this->invitation->groomName .' & '.$this->invitation->brideName;
        $this->weddingDate = Carbon::parse($this->invitation->startDate)->format('j F, Y');
        // dd($this->existingUrl);
        // dd($this->generateUniqueShortCode($this->existingUrl));
      }
    
      public function collection()
      {
        //dd($this->invitation->watsappList);
        return $this->invitation->watsappList;
      }
    
    public function map($guests): array
    {
        try{
            //dd($guests->pivot->url_id);
            if($guests->pivot->url_id == null){
                $invi = Crypt::encrypt($this->invitation->slug);
                $mob = Crypt::encrypt($guests->mobile);
                $route =  route('view-invitation', ['id' => $this->invitation->id, 'slug' => $invi, 'num' => $mob]);
                $shortUrl = $this->generateUniqueShortCode($this->existingUrl);
                $this->existingUrl = $shortUrl;
                $id = ShortUrl::create(['short_url' => $shortUrl, 'long_url' => $route]);
                $guests->pivot->update(['url_id' => $id->id]);
            }else{
                $shortUrl = ShortUrl::where('id', $guests->pivot->url_id)->first()->short_url;
            }
            return [
                $guests->name,
                $guests->mobile,
                'We cordially invite you for the wedding ceremony of '.$this->brideGroom.' on '.$this->weddingDate.' , You can view your invitation by visiting -- '.route('view-invite', ['route' => $shortUrl]).' and login using your mobile number.
                From HappyWed',
            ];
        }catch(Exception $e){
            //dd($e);
            return [];
        }
    }

    public function registerEvents(): array
    {
        return [
                AfterSheet::class    => function(AfterSheet $event) {
                    $event->sheet->getDelegate()->mergeCells('A1:C1');
                    $event->sheet->getDelegate()->getStyle('1')->getFont()->setSize(26);
                    $event->sheet->getDelegate()->getStyle('1')->getFont()   ->getColor()->setARGB('44546a');
                    $event->sheet->getDelegate()->getStyle('1')->getFont()   ->setBold(true);
                    $event->sheet->getDelegate()->getStyle('A1:C1')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                    $event->sheet->getDelegate()->getDefaultColumnDimension()->setWidth(120, 'pt');
                    $columnC = 3;
                    $lastRow = $event->sheet->getDelegate()->getHighestRow();
                    $event->sheet->getDelegate()->getStyleByColumnAndRow($columnC, 2, $columnC, $lastRow)
                        ->getAlignment()
                        ->setWrapText(true);
                    $event->sheet->getDelegate()->getColumnDimensionByColumn($columnC)->setWidth(300, 'pt');   
                    $columnA = 1;
                    $columnB = 2;
                    $event->sheet->getDelegate()->getStyleByColumnAndRow($columnA, 2, $columnB, $lastRow)
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);                     
                    $event->sheet->getDelegate()->getStyle('A2:C2')
                    ->getFont()->setBold(true);
            },
        ];
    }

    public function headings(): array
    {
        return [
            ['GUEST WATSAPP LINKS'],
            ['Name', 'Mobile', 'Message'],
        ];
    }


    
}
