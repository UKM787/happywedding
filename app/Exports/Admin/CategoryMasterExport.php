<?php

namespace App\Exports\Admin;

use App\Models\Admin\VendorMaster;
use App\Models\User;
use App\Models\GuestProfile;
use App\Traits\AdminExportSettings;
use Illuminate\Support\Facades\Crypt;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class CategoryMasterExport implements FromCollection,WithMapping, WithHeadings,WithEvents
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
          return VendorMaster::all();
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
            $Catlist->description,
            $Catlist->status?? 'z',
            $Catlist->priority?? 'z',
            $Catlist->parent_id?? " ",
            $Catlist->imageOne?? " ",
            $Catlist->icon?? " ",
            $Catlist->relation?? " ",
            $Catlist->path?? " ",
            $Catlist->admin_id?? " ",
        ];


    }

    public function registerEvents(): array
    {
        return $this->settings();
    }

    public function headings(): array
    {
        return [
            ['CATEGORY MASTER UPLOAD SHEET'],
            ['Name', 'Description', 'Status', 'Priority', 'Parent_id', 'Image', 'Icon', 'Relation', 'Path', 'Admin_id'],
        ];
    }


    
}
