<?php

namespace App\Imports\Admin;

use App\Models\Admin\LocationMaster;
use Throwable;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;



use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithBatchInserts;

class LocationMasterImport implements ToModel, WithHeadingRow,SkipsEmptyRows, SkipsOnError, WithValidation,WithBatchInserts
{

    use Importable, SkipsErrors;





    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
    */

    // private $invitation;
    // private $users;
    // private $userInvi;
    // private $userID;
    private $nameRows=[];
    private $index = 0;
    public function __construct(){
        // $this->invitation=$invi->id;
        // $this->userID=$id;
        // $this->users=User::select('name','email','id')->get();
        // $this->userInvi = GuestInvitation::get();

    }

    public function model(array $row)
    {

        if(isset($row['name']))
            {
                
                $category = new  LocationMaster([
                    'name'          => $row['name'] ?? " ", 
                    'status'        => $row['status'],
                    'priority'      => $row['priority'],
                    'latitude'        => $row['status'],
                    'longitude'      => $row['priority'],
                    'parent_id'     => $row['parent_id']?? null,
                    'imageOne'      => $row['image']?? "vendorDefault.png",
                    'icon'          => $row['icon']?? null,
                    'relation'      => $row['relation']?? null,
                    'path'          => $row['path']?? null,
                    'admin_id'      =>$row['admin_id'],
                    'slug'          => Str::slug($row['name'], '-', 'en').'-'.rand(1, 10000),  
                ]);
                //dd($category, VendorMaster::all());
                return [$category];

           }else{
               throw ValidationException::withMessages(['Kindly Fill in all the required feilds']);
           }
    }

        public function headingRow(): int
    {
        return 3;
    }




    public function rules(): array
    {
        //dd('ss');
        return [
            // 'name' => ['required'],
            // 'state' => ['required'],
            // // 'status' => ['required'],
            // // 'priority' => ['required'],
            // 'latitude' => ['required'],
            // 'longitude' => ['required'],
            // // 'parent_id' => ['required'],
            // // 'image' => ['required'],
            // // 'icon' => ['required'],
            // // 'relation' => ['required'],
            // // 'path' => ['required'],
            // 'admin_id' => ['required'],
        ];
    }
    // public function onError(Throwable $error) {
    //     // handle errors here using SkipsOnError for duplicate records and it skips duplicate records to add
    //     // SkipsError trait help us to access those errors
    // }
        public function batchSize(): int
    {
        return 1000;
    }

    // public function onFailure(Failure ...$failure)
    // {
    //     //handle vaidation errors
    // }



   // validation to check if row same name exists in excel sheet or in the database. The updated version of the validation is located in GuestImport.php

    // 'name' => [function($attribute, $value, $onFailure) {
    //                 array_push($this->nameRows, ['name' => $value, 'index' => $this->index]);
    //                 //print_r($this->nameRows);
    //           },function($attribute, $value, $onFailure) {
    //               $exists = array_search($value, array_column($this->nameRows, 'name'));
    //               $index = $this->index;
    //               $this->index = $this->index +1;
    //                 //var_dump(if ($exists != $index ));
    //               if ($exists != $index ) {
    //                    $onFailure('The name already exists on row' .' '. $this->nameRows[$exists]['index']+4);
    //               }
    //           },'required','max:50', 'unique:locationmaster,name'],
}
