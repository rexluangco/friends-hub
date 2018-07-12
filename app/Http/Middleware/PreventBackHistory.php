<?php

namespace Faf\Http\Middleware;

use Closure;
use Auth;

class PreventBackHistory
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   

        if (Auth::guard('web')->users()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.',401);
            }else{
                return redirect()->guest('home');
            }
        }
        return $next($request);

        return $response->header('Cache-Control','nocache, no-store, max-age=0, must-revalidate')
            ->header('Pragma','no-cache')
            ->header('Expires','Sun, 02 Jan 1990 00:00:00 GMT');
    }
}
