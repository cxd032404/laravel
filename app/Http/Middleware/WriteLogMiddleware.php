<?php

namespace App\Http\Middleware;

use Closure;

class WriteLogMiddleware
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
        $response = $next($request);
        $endTime = microtime(true);
        $processTime = $endTime - $request->startTime;
        $logBody = [
            date("Y-m-d H:i:s"),
            $request->sign,
            $processTime,
            $response->getContent(),
        ];
        file_put_contents(__DIR__.'/../../../storage/logs/response.log',implode("|",$logBody),FILE_APPEND);

        //file_put_contents(__DIR__.'/../../../storage/logs/request.log',$request->path(),FILE_APPEND);
        return $next($request);
    }
}
