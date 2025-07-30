<?php

namespace App\Http\Controllers\Api;

use App\Models\Contactus;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SiteTasks;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthcheckController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request)
    {
        //$user = Auth::check()
        //$user  = Auth::guard('host')->user();
        //dd(Auth::guard('api')->user());
        if(auth()->guard('host')->check()){
            return 'host';
        }
        elseif(auth()->guard('vendor')->check()){
            return 'vendor';
        }
        elseif(auth()->guard('company')->check()){
            return 'company';
        }
        elseif(auth()->guard('member')->check()){
            return 'member';
        }
        elseif(auth()->guard('web')->check()){
            $slug =  auth()->guard('web')->user()->slug;
            $full = 'guest/'.$slug;
            return $full;
        }else{
            return "False";
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


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
    }
}

