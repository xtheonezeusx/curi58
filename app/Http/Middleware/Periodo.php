<?php

namespace App\Http\Middleware;

use Closure;

class Periodo
{

    public function handle($request, Closure $next)
    {
        if (!$request->session()->has('ciclo_id') OR !$request->session()->has('ciclo_nombre')) {
            return redirect()->route('preview.index');
        }
        return $next($request);
    }
}
