<?php

namespace App\Imports;

use Throwable;
use App\Models\User;
use App\Models\Guest\Family;
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
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class GuestFamilyImport implements ToModel, WithHeadingRow, SkipsOnError,WithValidation, SkipsOnFailure {

    use Importable;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    private $users;

    public function __construct(){
        $this->users=User::select('name','email','id')->get();
    }



    public function model(array $row) {
        $user=$this->users->where('name',$row['guestname'])->where('email',$row['guestemail'])->first();

        return $family = new Family([
            'name' => $row['name'],
            'age' => $row['age'],
            'gender' => $row['gender'],
            'relation' => $row['relation'],
            'mobile' => $row['mobile'],
            //'imageOne' => $row['imageOne'],
            //'imageTwo' => $row['imagetwo'],
            'share' => $row['share'],
            'slug'  => Str::slug($row['name'], '-', 'en').'-'.rand(1, 10000),
            'guest_id'=>$user->id,
        ]);


    }

    public function rules(): array
    {
        return [
            'mobile' => ['required','digits:10','unique:guest_families,mobile'],
        ];
    }



    public function onError(Throwable $error) {
        // handle errors here using SkipsOnError for duplicate records and it skips duplicate records to add
        // SkipsError trait help us to access those errors
    }

    public function onFailure(Failure ...$failure){
        //handle vaidation errors
    }


}
