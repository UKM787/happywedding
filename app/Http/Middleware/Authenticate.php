<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        //dd($request);
        //dd('failed');
        //return route('/');
        if (! $request->expectsJson()) {
            //return redirect()->back()->withInput($request->only('email','remember'))->with(['status' => 'Failure' , 'message'=>'Login failed, check your credentials!']);
            //abort(redirect()->back()->withInput($request->only('email','remember'))->with(['status' => 'Failure' , 'message'=>'Login failed, check your credentials!']));
           return redirect()->back()->withInput($request->only('email','remember'))->with(['status' => 'Failure' , 'message'=>'Login failed, check your credentials!']);
            // abort(redirect()
            //     ->intended(route('hostLogin'))
            //     ->with([
            //         'status' => 'success',
            //         'message' => 'Logged in to continue!!'
            // ]));
            // return redirect()
            // ->back()
            // ->withInput($request->only('email','remember'))
            // ->with(['status' => 'Failure' , 'message'=>'Login failed, check your credentials!']);
        }
    }
}
