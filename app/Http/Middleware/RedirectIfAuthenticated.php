<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;
class RedirectIfAuthenticated
{
    use HasRoles;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle($request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [] : $guards;
        //dd(auth()->guard('host')->user()->getRoleNames());
        foreach ($guards as $guard) {

            if (Auth::guard($guard)->check()) {
               // dd(auth()->guard('host')->user()->getRoleNames());
                switch ($guard) {
                  case 'host':
                        //dd(auth()->guard('host')->user()->getRoleNames());
                        foreach (auth()->guard('host')->user()->getRoleNames() as $role) {
                            switch($role) {

                                case 'emanager':
                                    return redirect(route('emanagerDashboard', auth()->guard('host')->user()));
                                    break;

                                case 'member':
                                    return redirect(route('memberDashboard.index', auth()->guard('host')->user()));
                                    break;

                                case 'groom':
                                    return redirect(route('groomDashboard.index', auth()->guard('host')->user()));
                                    break;

                                case 'bride':
                                    //dd('reachbrideredirect');
                                    return redirect(route('brideDashboard.index', auth()->guard('host')->user()));
                                    break;

                                default:
                                    //dd($role);
                                    return redirect(route('hostwelcome'));
                                    break;
                            }
                        }
                  case 'vendor':
                      return redirect(route('vendorwelcome'));
                    break;

                 case 'admin':
                      return redirect(route('adminwelcome'));
                    break;

                default:
                        return redirect(RouteServiceProvider::HOME);
                        break;
                }
            }
            else {
                return redirect()->route('welcome');
            }
        }
        return $next($request);
    }
}
