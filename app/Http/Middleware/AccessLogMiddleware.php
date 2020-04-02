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
        /*
        1,请求方法的获取

        $method = $request->method();
        2,检测请求方法

        $res = $request->isMethod('post')
        3,获取请求的路径

        $path = $request->path()

        4,获取完整的url

        $url = $request->url();

        5,获取请求的ip

        $ip = $request->ip()

        6,获取端口

        $port = $request->getPort();

        7,参数的获取

        $name = $request->input('name')

        8,设置默认值

        $res = $request->input('name','10')

        9,检测请求参数

        $res = $request->has('name')

        10,获取所有请求参数

        $res = $request->all()

        11,提取部分参数

        $res = $request->only(['username','password'])

        12,剔除不需要的参数

        $res = $request->except(['username','password'])

        13,获取请求头信息

        $res = $request->header('Connection')

        14,检测文件是否有上传

        $res = $request->hasFile('cover')

        15,提取上传的文件

        $res = $request->file('file');

        16,获取cookie

        $cookies = $request->cookie();
        */
        $startTime = microtime(true);
        $sign = md5(sprintf("%04d",rand(0,9999))."-".$startTime);
        $logBody = [
                date("Y-m-d H:i:s"),
                $sign,
                $request->method(),
                $request->url(),
                json_encode($request->all()),
            ];
        $request->sign = $sign;
        $request->startTime = $startTime;
        file_put_contents(__DIR__.'/../../../storage/logs/request.log',implode("|",$logBody)."\n",FILE_APPEND);
        //file_put_contents(__DIR__.'/../../../storage/logs/request.log',$request->path(),FILE_APPEND);
        return $next($request);
    }
}
