<?php

namespace App\Exports\Admin;

use App\Models\Admin\LocationMaster;
use App\Traits\AdminExportSettings;
use Illuminate\Support\Facades\Crypt;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class LocationMasterExport implements FromCollection,WithMapping, WithHeadings,WithEvents
{
    use AdminExportSettings;
    /**
    * @return \Illuminate\Support\Collection
    */
    public $invitation;

    // public function __construct($invitation) {
    //     $this->invitation = $invitation;
    //   }
    
      public function collection()
      {
          //dd(VendorMaster::all());
          return LocationMaster::all();
      }
    
    public function map($Catlist): array
    {
        //dd($Catlist);
        // $Cat = $Catlist;
        if($Catlist->status == 0){
            $Catlist->status = "0";
        }
        if($Catlist->priority == 0){
            $Catlist->priority = "0";
        }
        return [
            $Catlist->name,
            $Catlist->parent_id ?? " ",
            $Catlist->latitude ?? " ",
            $Catlist->longitude ?? " ",
            $Catlist->priority ?? " ",
            $Catlist->status ?? " ",
            $Catlist->icon ?? " ",
            $Catlist->slug ?? " ",
            $Catlist->imageOne ?? " ",
            $Catlist->path ?? " ",
            $Catlist->relation ?? " ",
            $Catlist->admin_id ?? " ",
            $Catlist->created_at ?? " ",
            $Catlist->updated_at ?? " ",
            $Catlist->deleted_at ?? " ",
        ];


    }

    public function registerEvents(): array
    {
        return $this->settings();
    }

    public function headings(): array
    {
        return [
            ['LOCATION MASTER UPLOAD SHEET'],
            ['Name', 'parent_id', 'latitude', 'longitude', 'priority', 'status', 'icon', 'slug', 'imageOne', 'path', 'relation', 'admin_id', 'created_at', 'updated_at', 'deleted_at'],
        ];
    }


    
}
