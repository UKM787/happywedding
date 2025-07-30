<?php

namespace App\Imports;

use Throwable;
use App\Models\User;
use App\Models\Guest\Home;
use App\Models\Host\Guest;
use Illuminate\Support\Str;
use App\Models\Guest\Family;
use App\Models\Guest\Office;
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
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Illuminate\Validation\ValidationException;

class GuestAllImport implements ToModel, WithHeadingRow,SkipsEmptyRows, SkipsOnError, WithValidation, WithBatchInserts {

    use Importable, SkipsErrors;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    // private $users;

    // public function __construct(){
    //     $this->users=User::select('name','email','id')->get();
    // }

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
    
    public function model(array $row){
        //dd($rows);
        // foreach ($rows as $row)
        // {


            if(isset($row['name']) AND isset($row['mobile'])AND isset($row['password']))
            {
                 $row['email'] = strtolower($row['email']);
                
                //dd('inside Import');
                $userPresent=$this->users->where('mobile',$row['mobile'])->first();
                $userPresentInvitations= null;
                if(isset($userPresent)){
                    $userPresentInvitations = $this->userInvi
                    ->where('user_id', '=',$userPresent->id)
                    ->where('invitation_id', '=', $this->invitation)
                    ->pluck('invitation_id')
                    ->first(); 
                    //$userPresentInvitations =  $userPresentInvitations;
                }
                //dd($this->userInvi, $this->users, $this->invitation, $userPresent,$userPresentInvitations, $row);

                
                if(isset($userPresent) && $userPresentInvitations != $this->invitation){
                    
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
                    $this->userID = $this->userID +1;
                    $user = new  User([
                        'name'      => $row['name'], //index name to be passed with WithHeadingRow or use 0
                        'email'     => $row['email'],
                        'mobile'    => $row['mobile'],
                        //'password'  => Hash::make($row['password']),
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
                    $guest_homes= new Home([
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
                        'guest_id'=>$this->userID,
                    ]);
                    $family = new Family([
                        'familyname' => $row['relationname'],
                        'familyage' => $row['relationage'],
                        'familygender' => $row['relationgender'],
                        'familyrelation' => $row['relation'],
                        'familymobile' => $row['relationmobile'],
                        //'imageOne' => $row['imageOne'],
                        //'imageTwo' => $row['imagetwo'],
                        'slug'  => Str::slug($row['relationname'], '-', 'en').'-'.rand(1, 10000),
                        'guest_id'=>$this->userID,
                    ]);
                    $guestsOffices= new Office([
                        'officecompanyName' => $row['companyname'],
                        'officecomplexName' => $row['companycomplexname'],
                        'officefloor' => $row['companyfloor'],
                        'officedoorNo' => $row['companydoorno'],
                        'officestreetNo' => $row['companystreetno'],
                        'officearea' => $row['companyarea'],
                        'officedistrict' => $row['companydistrict'],
                        'officepin' => $row['companypin'],
                        'officestate' => $row['companystate'],
                        'officezone' => $row['companyzone'],
                        'officecountry' => $row['companycountry'] ?? "India",
                        'officereachus' => $row['companyreachus'],
                        'slug'      => Str::slug($row['companyname'], '-', 'en').'-'.rand(1, 10000),
                        'guest_id'=>$this->userID,
                    ]);
                    $guestInvitation=new GuestInvitation([
                        'user_id'=>$this->userID,
                        'invitation_id'=>$this->invitation,
                        ]);
                    //dd($user, $guests, $guest_profile, $guest_homes, $guestsOffices, $row, $family, $guestInvitation);
                    return [$user,$guests,$family,$guestsOffices,$guest_profile,$guest_homes,$guestInvitation];
                }
           }else{
               throw ValidationException::withMessages(['Kindly Use the same format as used in the sample file']);
           }

        //}

    }

    public function headingRow(): int
    {
        return 3;
    }
   

   
   

    public function rules(): array
    {
        // $bool = isset($row['name']) AND isset($row['email'])AND isset($row['mobile'])AND isset($row['password'] );

        // if($bool == false){
        //     throw ValidationException::withMessages(['Kindly Use the same format as used in the sample file']);
        //     return ['error' => "Feilds do not match"];
        // }
            return [
            'name' => ['required','max:35'],
            // 'mobile' => ['required','regex:/^([0-9\s\-\+\(\)]*)$/','max:10','min:10',],
            'email' => [
            //     function($attribute, $value, $onFailure) {
            //         array_push($this->emailRows, ['email' => strtolower($value), 'index' => $this->index]);
            //         //print_r($this->emailRows);
            //   },function($attribute, $value, $onFailure) {
            //       $exists = array_search(strtolower($value), array_column($this->emailRows, 'email'));
            //       $index = $this->index;
            //       $this->index = $this->index +1;
            //         //var_dump(if ($exists != $index ));
            //       if ($exists != $index ) {
            //            $onFailure('The email already exists on row' .' '. $this->emailRows[$exists]['index']+4);
            //       }
            //   },
            ],
            'mobile' => [
                function($attribute, $value, $onFailure) {
                    array_push($this->mobileRows, ['mobile' => $value, 'index' => $this->mobileIndex]);

            //         if (in_array($value, $this->allMobile)){
            //             $checkUserMobile = User::where('mobile', $value)->pluck('email')->first();
            //             $emailCheck = $this->emailRows[array_search($this->mobileIndex, array_column($this->emailRows, 'index'))]['email'];
            //             //dd($value, $checkUserMobile, $this->currEmail , $this->emailRows, $emailCheck);
            //             if($checkUserMobile != $emailCheck){
            //                 //dd('ss');
            //                 $onFailure('The mobile is assocated with another id');
            //             }
            //             //dd('ssss', $checkUserMobile);
            //         }
            //         //print_r($this->emailRows);
              },
              function($attribute, $value, $onFailure) {
                  $exists = array_search($value, array_column($this->mobileRows, 'mobile'));
                  $index = $this->mobileIndex;
                  $this->mobileIndex = $this->mobileIndex +1;
                    //var_dump(if ($exists != $index ));
                  if ($exists != $index ) {
                       $onFailure('The mobile already exists on row' .' '. $this->mobileRows[$exists]['index']+4);
                  }
              },'required','regex:/^([0-9\s\-\+\(\)]*)$/','max:10','min:10'],
            //'email' => ['required','email','unique:users,email'],
            //'password' => ['required'],
            //'unique:users,mobile',
            //'user_id'=>['unique:guest_invitation,user_id,invitation_id'],
            ];
        
    }

    // public function onError(Throwable $error) {
    //     // handle errors here using SkipsOnError for duplicate records and it skips duplicate records to a
    
    
    //     // SkipsError trait help us to access those errors
    // }
    public function batchSize(): int
    {
        return 1000;
    }
    

    // public function onFailure(Failure ...$failure){
    //     //handle vaidation errors
    // }

   
}
