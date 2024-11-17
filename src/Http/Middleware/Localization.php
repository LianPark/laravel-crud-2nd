<?php

namespace Lianpark\Board\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class Localization
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
        $lang = $_COOKIE['locale'];
        session()->put('locale', $lang);

        $locale_cookie = $request->cookie('locale');
        if (isset($locale_cookie)) {
            App::setLocale($locale_cookie);
        } else {
            App::setLocale(config('app.locale'));
        }

        return $next($request);
    }
}
