<?php

namespace App\Http\Controllers\Guest;

use Exception;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Guest\Profile;
use App\Models\Guest\Home;
use App\Models\Guest\Family;
use App\Models\Guest\Office;
use App\Http\Controllers\Controller;
use App\Models\Guest\Privilege;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class FamilyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            $user = auth()->user();
            if ($user->family  !== null) {
                $family = $user->family;
                return view('guest.family.index', compact('user','family'));
            } else {
                $family = new Family();
                return view('guest.family.create', compact('user', 'family'));
            }
        } else {
            die('you are not loggedin yet!');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user)  {
        if (isset($user->profile)) {
            $profile = $user->profile;
        } else {
            $profile = new Profile();
        }
        if (isset($user->home)) {
            $home = $user->home;
        } else {
            $home = new Home();
        }
        if (isset($user->office)) {
            $office = $user->office;
        } else {
            $office = new Office();
        }
        if ($user->family->isNotEmpty()) {
            $family = $user->family;
        } else {
            $family = new Family();
        }
        session(['tab' => 'family']);

       return view('guest.family.create', compact('user','profile','home','office','family'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(user $user, Request $request) {

        $data = $this->requestValidate($request);

        if($request->file('imageOne') == null) {
            $data['imageOne'] = '/family/familyDefault.png';
        }
        // dd($data);

        if (auth()->guard('host')->check()) {
            $destImgPath = '/guests/' . $data['name'] . '/family';
            try {
                $familymember = Family::create(['guest_id' => $user->id, 'slug' => Str::slug($request->name)] + $data);

                if ($familymember) {

                    if ($request->file('imageOne') !== null) {
                        $this->storeImage($familymember, $destImgPath, 'imageOne');
                    }

                    if ($request->file('imageTwo') !== null) {
                        $this->storeImage($familymember, $destImgPath, 'imageTwo');
                    }
                }
                return redirect()->back()
                ->with([
                    'tab'   => 'family',
                    'status' => 'success',
                    'message' => $user->name . ' family member adedd successfully'
                ]);
            } catch (Exception $e) {
                return redirect()->back()->with([
                    'status' => 'failure',
                    'message' => $e->getMessage(),
                ]);
            }
        }

       if(auth()->check()){
            $destImgPath = '/guests/' . $data['name'] . '/family';
           try {
                $familymember = Family::create(['guest_id' => $user->id, 'slug' => Str::slug($request->name)] + $data );

                if ($familymember) {

                    if ($request->file('imageOne') !== null) {
                        $this->storeImage($familymember, $destImgPath , 'imageOne');
                    }

                    if ($request->file('imageTwo') !== null) {
                        $this->storeImage($familymember, $destImgPath, 'imageTwo');
                    }

                    }
                    return redirect()->route('guestprofile.index', $user)
                        ->with([
                            'tab'   => 'family',
                            'status' => 'success',
                            'message' => $user->name . ' family member adedd successfully'
                        ]);
                }

                catch(Exception $e) {
                    return redirect()->back()->with([
                    'status' => 'failure',
                    'message' => $e->getMessage(),
                    ]);
                 }

       }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, Family $family)
    {
        return view('guest.family.show', compact('user','family'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, Family $family)  {
       return view('guest.family.edit', compact('user','family'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(User $user, Family $family, Request $request)  {

    //    if($request->has('attending')){
    //        foreach($family->privileges as $privelge){
    //             $privelge->update(['attending' =>  1 , 'family_id' => $family->id]);
    //             return redirect()->back();
    //        };

    //    } else {
    //         foreach ($family->privileges as $privelge) {
    //             $familymember = Privilege::find($family->id);
    //             $privelge->update(['attending' =>  0, 'family_id' => $family->id]);
    //             return redirect()->back();
    //         };
    //    }
        $data = $this->requestValidate($request);

        if (auth()->check()) {
            $destImgPath = '/guests/' . $data['name'] . '/family';
            try {
                $newmember = $family->update(['guest_id' => $user->id, 'slug' => Str::slug($request->name)] + $data);
                if ($newmember) {
                    if ($request->file('imageOne') !== null) {
                        $this->storeImage($family, $destImgPath, 'imageOne');
                    }

                    if ($request->file('imageTwo') !== null) {
                        $this->storeImage($family, $destImgPath, 'imageTwo');
                    }
                }
                return redirect()->route('guestprofile.index', [$user])
                    ->with([
                        'tab'   => 'family',
                        'status' => 'success',
                        'message' => $user->name . ' family member updated successfully'
                    ]);
            } catch (Exception $e) {
                return redirect()->back()->with([
                    'status' => 'failure',
                    'message' => $e->getMessage(),
                ]);
            }
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function requestValidate(Request $request){
        return $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:100'],
            'age'   => ['required', 'string', 'min:1'],
            'gender' => ['required', 'string'],
            'relation' => ['required', 'string', 'min:3'],
            'mobile'=> ['required', 'min:10', 'max:13'],
            'imageOne' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'imageTwo' => 'sometimes |image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'share' => ['sometimes']

        ],
        [
           'name.required' => 'family member name is required',
           'age.required' => 'family member age is required',
           'gender' => 'family member gender is required',
           'relation' => 'family member relationship with family head required',
           'mobile.required'    => 'family member mobile required'
        ]
        );
    }

    private function storeImage($data, $folder, $image)   {

        if (request()->has($image)) {
            /**
             * resizing image using intrvention/image
             */
            if ($data->update([$image => request()->$image->store($folder, 'public')])) {
                $cover_image = Image::make(public_path('storage/' . $data->$image))->fit(100, 100);
                $cover_image->save();
            }
        }
    }

}
