<?php

namespace App\Http\Middleware;

use App\Models\Language;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
class SetLocale
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
        if (!File::exists(storage_path('installed'))) {
            return $next($request);
        }
        app()->setLocale(config('app.locale'));
        $default_language = Language::where('is_default', 1)->first();
        // dd($default_language);
        if (session()->has('locale')) {
            app()->setLocale(session('locale'));
        } else {
            app()->setLocale($default_language->code);
        }

        return $next($request);
    }
}
