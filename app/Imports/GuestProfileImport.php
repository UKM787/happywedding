<?php

namespace App\Imports;

use Throwable;
use App\Models\User;
use App\Models\Guest\Profile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\WithValidation;


class GuestProfileImport implements ToModel, WithHeadingRow, SkipsOnError,WithValidation,SkipsOnFailure {

    use Importable;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    private $user ;

    public function __construct(){
        $this->users=User::select('id','name','email')->get();

    }
    public function model(array $row)
    {
        $user=$this->users->where('name',$row['name'])->where('email',$row['email'])->first();

        return new Profile([
            'name'      => $row['name'], //index name to be passed with WithHeadingRow or use 0
            'fatherName'     => $row['fathername'],
            'surname' => $row['surname'],
            'age' => $row['age'],
            'gender' => $row['gender'],
            'relation' => $row['relation'],
            'email' => $row['email'],
            'phone' => $row['phone'],
            'mobile' => $row['mobile'],
            'mobile1' => $row['mobile1'],
            'whatsup' => $row['whatsup'],
            'slug'      => Str::slug($row['name'], '-', 'en').'-'.rand(1, 10000),
            'guest_id'=>$user->id??NULL,
        ]);

    }

    public function rules(): array
    {
        return [

            'email' => 'required|unique:guest_profiles,email',
            'mobile' => 'required|unique:guest_profiles,mobile|digits:10',
        ];
    }
    public function customValidationMessages()
        {
            return [
                'email.in' => 'Custom message for :email.',
                'mobile.in' =>'Custom message for :mobile.',
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
