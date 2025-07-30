<?php

namespace App\Imports;

use Throwable;
use App\Models\User;
use App\Models\Host\Guest;
use Illuminate\Support\Str;
use App\Models\Guest\Profile;
use App\Models\Host\Invitation;
use Illuminate\Validation\Rule;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use App\Models\Guest\GuestInvitation;
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

class GuestImport implements ToModel, WithHeadingRow,SkipsEmptyRows, SkipsOnError, WithValidation,WithBatchInserts
{

    use Importable, SkipsErrors;





    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
    */

    private $invitation;
    private $users;
    private $userInvi;
    private $userID;
    private $currEmail;
    private $allMobile;
    private $emailRows=[];
    private $mobileRows=[];
    private $index = 0;

     private $mobileIndex = 0;
    public function __construct($invi, $id){
        $this->invitation=$invi->id;
        $this->userID=$id;
        $this->users=User::select('name','mobile','id')->get();
        $this->userInvi = GuestInvitation::get();
        $this->allMobile = User::pluck('mobile')->all();

    }

    public function model(array $row)
    {

        //dd($row);
        if(isset($row['name']) AND isset($row['mobile'])AND isset($row['password']))
            {   
                //dd($row['email']);
                $row['email'] = strtolower($row['email']);
                $userPresent=$this->users->where('mobile',$row['mobile'])->first();
                //dd($userPresent);
                $userPresentInvitations= null;
                if(isset($userPresent)){
                    $userPresentInvitations = $this->userInvi
                    ->where('user_id', '=',$userPresent->id)
                    ->where('invitation_id', '=', $this->invitation)
                    ->pluck('invitation_id')
                    ->first();
                    //$userPresentInvitations =  $userPresentInvitations;
                }
                //dd($userPresentInvitations);
                //dd($this->userInvi, $this->users, $this->invitation, $userPresent,$userPresentInvitations, $row);


                if(isset($userPresent) && $userPresentInvitations != $this->invitation){

                    //dd($userPresent->id);
                    $guestInvitation= new GuestInvitation([
                        'user_id'=>$userPresent->id,
                        'invitation_id'=>$this->invitation,
                        ]);
                        return $guestInvitation;
                }
                else if($userPresentInvitations == $this->invitation){
                    return;
                }
                else
                {
                    //dd('ss');
                    $this->userID = $this->userID +1;
                    $user = new  User([
                        'name'      => $row['name'], //index name to be passed with WithHeadingRow or use 0
                        'email'     => $row['email'],
                        'mobile'    => $row['mobile'],
                        // 'password'  => Hash::make($row['password']),
                        'password'  => Hash::make(123),
                        'slug'      => Str::slug($row['name'], '-', 'en').'-'.rand(1, 10000),
                    ]);

                    $guests = new   Guest([
                        'name'      => $row['name'],
                        'email'     => $row['email'],
                        'mobile'    => $row['mobile'],
                        //'password'  => Hash::make($row['password']),
                        'password'  => Hash::make(123),
                        'slug'      => Str::slug($row['name'], '-', 'en').'-'.rand(1, 10000),
                    ]);
                    $guest_profile= new Profile([
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
                        'guest_id'=>$this->userID,
                    ]);
                    $guestInvitation=new GuestInvitation([
                        'user_id'=>$this->userID,
                        'invitation_id'=>$this->invitation,
                        ]);
                    //dd($user, $guests, $guest_profile,$guestInvitation);
                    return [$user,$guests,$guest_profile,$guestInvitation];
                }
           }else{
               throw ValidationException::withMessages(['Kindly Use the same format as used in the sample file']);
           }
    }

        public function headingRow(): int
    {
        return 3;
    }




    public function rules(): array
    {
        // $bool = isset($row['name']) AND isset($row['email'])AND isset($row['mobile'])AND isset($row['password'] );
        // dd($bool, isset($row['email']));
        // if($bool == false){
        //     throw ValidationException::withMessages(['Kindly Use the same format as used in the sample file']);
        //     return ['error' => "Feilds do not match"];
        // }
        return [

            'name' => ['required','max:35'],
            'email' => [
            //     function($attribute, $value, $onFailure) {
                
            //         array_push($this->emailRows, ['email' => strtolower($value), 'index' => $this->index]);
            //         //print_r($this->emailRows);
            //         $this->currEmail = $value;
            //   },function($attribute, $value, $onFailure) {
            //       $exists = array_search(strtolower($value), array_column($this->emailRows, 'email'));
            //       $index = $this->index;
            //       $this->index = ($this->index + 1);
            //         //var_dump(if ($exists != $index ));
            //       if ($exists != $index ) {
            //            $onFailure('The email already exists on row' .' '. (($this->emailRows[$exists]['index']) + 4));
            //       }
            //   }
            ],
            //'email' => ['required','email','unique:users,email'],
            'mobile' => [function($attribute, $value, $onFailure) {

                    //dd($value, $this->currEmail, $this->allMobile, $this->emailRows);
                    //dd('aa');
                   array_push($this->mobileRows, ['mobile' => $value, 'index' => $this->mobileIndex]);

                //    if (in_array($value, $this->allMobile)){
                //         $checkUserMobile = User::where('mobile', $value)->pluck('email')->first();
                //         $emailCheck = $this->emailRows[array_search($this->mobileIndex, array_column($this->emailRows, 'index'))]['email'];
                //        // dd($value, $checkUserMobile, $this->currEmail , $this->emailRows, $emailCheck);
                //         if($checkUserMobile != $emailCheck){
                //             //dd('ss');
                //             $onFailure('The mobile is assocated with another id');
                //         }
                //         //dd('ssss', $checkUserMobile);
                //     }
                    //print_r($this->emailRows);
              },function($attribute, $value, $onFailure) {
                  $exists = array_search($value, array_column($this->mobileRows, 'mobile'));
                  $index = $this->mobileIndex;
                  $this->mobileIndex = $this->mobileIndex +1;
                    //var_dump(if ($exists != $index ));
                  if ($exists != $index ) {
                       $onFailure('The mobile already exists on row' .' '. $this->mobileRows[$exists]['index']+4);
                  }
              } ,'required','regex:/^([0-9\s\-\+\(\)]*)$/','max:10','min:10'],
            //'password' => ['required'],
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
