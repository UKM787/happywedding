<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Support\Str;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    protected function unauthenticated($request, AuthenticationException $exception)    {
       // dd($exception);
        // dd($request->is('host'), $request->is('host/welcome'), $request->path());
        $currentPath = $request->path();
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        if (Str::contains($currentPath, ['host'])) {
            return redirect()->guest('/host/login');
        }

        if (Str::contains($currentPath, ['host'])) {
            return redirect()->guest('/host/login');
        }
        if (Str::contains($currentPath, ['bride'])) {
            return redirect()->guest('/host/login');
        }
        if (Str::contains($currentPath, ['groom'])) {
            return redirect()->guest('/host/login');
        }
        if (Str::contains($currentPath, ['member'])) {
            return redirect()->guest('/host/login');
        }
        if (Str::contains($currentPath, ['vendor'])) {
            return redirect()->guest('/vendor/login');
        }
        if (Str::contains($currentPath, ['emanager'])) {
            return redirect()->guest('/login/emanager');
        }
        if (Str::contains($currentPath, ['admin'])) {
            return redirect()->guest('/admin/login');
        }
        if (Str::contains($currentPath, ['company'])) {
            return redirect()->guest('/login/company');
        }
       // dd('ssss');

        // $guard = array_get($exception->guards(),0);

        // switch($guard) {
        //     case 'admin':
        //         $login = 'adminLogin';
        //         break;

        //     case 'host':
        //         $login = 'hostLogin';
        //         break;

        //     case 'host':
        //         $login = 'companyLogin';
        //         break;

        //     case 'vendor':
        //         $login = 'vendorLogin';
        //         break;

        //     default:
        //         $login = 'login';
        //     break;
        // }
       // happywed@happywed-350203.iam.gserviceaccount.com

        //return redirect()->guest(route($login));

        return redirect()->guest(route('welcome'));
    }
}
