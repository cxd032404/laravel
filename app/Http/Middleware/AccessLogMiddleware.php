<?php

namespace App\Http\Middleware;

use Closure;

class AccessLogMiddleware
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
        file_put_contents(__DIR__.'/../../../storage/logs/request.log',$request,FILE_APPEND);
        //file_put_contents(__DIR__.'/../../../storage/logs/request.log',$request->path(),FILE_APPEND);
        return $next($request);
    }
}
