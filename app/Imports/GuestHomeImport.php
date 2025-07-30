<?php

namespace App\Imports;

use Throwable;
use App\Models\User;
use App\Models\Guest\Home;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
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
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\WithValidation;

class GuestHomeImport implements ToModel, WithHeadingRow, SkipsOnError, WithValidation,SkipsOnFailure {

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

    public function model(array $row)
    {
        $user=$this->users->where('name',$row['name'])->where('email',$row['email'])->first();
        $guest_homes=new Home([
            'complexName' => $row['complexname'],
            'floor' => $row['floor'],
            'doorNo' => $row['doorno'],
            'streetNo' => $row['streetno'],
            'area' => $row['area'],
            'district' => $row['district'],
            'pin' => $row['pin'],
            'state' => $row['state'],
            'zone' => $row['zone'],
            'country' => $row['country'],
            'reachus' => $row['reachus'],
            'slug'      => Str::slug($row['complexname'], '-', 'en').'-'.rand(1, 10000),
            'guest_id'=>$user->id??NULL,
        ]);

        return $guest_homes;

    }

    public function onError(Throwable $error) {
        // handle errors here using SkipsOnError for duplicate records and it skips duplicate records to add
        // SkipsError trait help us to access those errors
    }

    public function rules(): array
    {

        return [
            'guest_id' => 'unique:guest_homes, guest_id',
        ];
    }

    public function onFailure(Failure ...$failure){
        //handle vaidation errors
    }

}
