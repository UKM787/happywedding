<?php

namespace App\Imports\Admin;

use App\Models\Admin\TaskMaster;
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

class TaskMasterImport implements ToModel, WithHeadingRow,SkipsEmptyRows, SkipsOnError, WithValidation,WithBatchInserts
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
                foreach($row as $key => $single){
                    $row[$key] = trim($row[$key]);
                }
                
                $task = new  TaskMaster([
                    'name'          => $row['name'] ?? " ", 
                    'description'   => $row['description'],
                    'status'        => empty($row['status']) ? 0 : $row['status'],
                    'priority'      => empty($row['priority']) ? 0 : $row['priority'],
                    'parent_id'     => empty($row['parent_id']) ? null : $row['parent_id'],
                    'imageOne'      => empty($row['imageOne']) ? 'vendorDefault.png' : $row['imageOne'],
                    'icon'          => empty($row['icon']) ? '<i class="material-icons">place</i>' : $row['icon'],
                    'admin_id'      => empty($row['admin_id']) ? 1 : $row['admin_id'],
                    'slug'          => Str::slug($row['name'], '-', 'en').'-'.rand(1, 10000),  
                ]);
                //dd($category, VendorMaster::all());
                return [$task];

           }else{
                //  dd('ddd');
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
            'name' => ['required'],
            'description' => ['required'],
            // 'status' => ['required'],
            // 'priority' => ['required'],
            // 'parent_id' => ['required'],
            // 'image' => ['required'],
            // 'icon' => ['required'],
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
}
