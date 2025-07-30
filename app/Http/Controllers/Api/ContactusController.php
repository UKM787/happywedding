<?php

namespace App\Http\Controllers\Api;

use App\Models\Contactus;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ContactusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $errors = $this->requestValidate($request);
        //dd($errors);

            $data = json_decode($request->data, true);
            $added =  Contactus::create($data);
            return $added->id; 
        

    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

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
    public function requestValidate($request)
    {
        //dd($request, json_decode($request, true));
        $bag = json_decode($request->data, true);
        //dd($bag);
        Validator::make($bag, [
            'name'    => ['required', 'string', 'min:3', 'max:255'],
            'reason'    => ['required', 'string', 'min:3', 'max:255'],
            'email'    => [ 'required','email', 'min:3', 'max:255'],
            'companyName'    => ['required', 'string', 'min:3', 'max:255'],
            'mobile'    => [ 'required','digits:10'],
            'message'    => [ 'required','string', 'min:15'],
        ])->validate();

        // if ($validator->fails()) {
        //     return $validator->errors();
        // }

        // return $request->validate(
        //     [
        //         'name'    => ['required', 'string', 'min:3', 'max:255'],
        //         'email'    => [ 'required','email', 'min:3', 'max:255'],
        //         'message'    => [ 'required','string', 'min:15', 'max:255'],
        //     ]
        // );
    }
}

