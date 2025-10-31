<?php

namespace App\Http\Middleware;

use App\Models\Language;
use Closure;
use Illuminate\Http\Request;

class APISetting
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->header('logged-in-as')){
            $logged_in_as = $request->header('logged-in-as');
            $request->session()->put('logged_in_as', $logged_in_as);
            if($logged_in_as == 'teacher'){
                config(['cashier.model' => 'App\Models\Teacher']);
            }else if($logged_in_as == 'academy'){
                config(['cashier.model' => 'App\Models\Teacher']);
            }else{
                config(['cashier.model' => 'App\Models\Teacher']);
            }

        }
        app()->setLocale(config('app.locale'));
        $default_language = Language::where('is_default', 1)->first();
        // dd($default_language);
        if ($request->header('locale')) {
            app()->setLocale($request->header('locale'));
        } else {
            app()->setLocale($default_language->code);
        }

        return $next($request);
    }
}
