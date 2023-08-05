<?php

namespace App\Http\Middleware;

use App\Helpers\Extensions\Tool;
use Closure;

class CheckStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $status = Tool::config('site_status');
        // 判断是否关站
        if ($status == 0) {
            return response()->view('home.close');
        }

        return $next($request);
    }
}
