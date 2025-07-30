<?php

namespace App\Exports\Admin;

use App\Models\Admin\TaskMaster;
use App\Traits\AdminExportSettings;
use Illuminate\Support\Facades\Crypt;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class TaskMasterExport implements FromCollection,WithMapping, WithHeadings,WithEvents
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
          return TaskMaster::all();
      }
    
    public function map($Tasklist): array
    {
        //dd($Tasklist->status);
        // $Cat = $Tasklist;
        if($Tasklist->status == 0){
            $Tasklist->status = "0";
        }
        if($Tasklist->priority == 0){
            $Tasklist->priority = "0";
        }
        return [
            $Tasklist->name,
            $Tasklist->description,
            $Tasklist->status?? '0',
            $Tasklist->priority?? '0',
            $Tasklist->parent_id?? " ",
            $Tasklist->imageOne?? " ",
            $Tasklist->icon?? " ",
            $Tasklist->admin_id?? " ",
        ];


    }

    public function registerEvents(): array
    {
        return $this->settings();
    }

    public function headings(): array
    {
        return [
            ['TASK MASTER UPLOAD SHEET'],
            ['Name', 'Description', 'Status', 'Priority', 'Parent_id', 'Image', 'Icon', 'Admin_id'],
        ];
    }


    
}
