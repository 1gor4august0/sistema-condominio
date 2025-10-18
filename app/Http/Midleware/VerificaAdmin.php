<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerificaAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->tipo_usuario_id !== 1) {
            abort(403, 'Acesso negado');
        }

        return $next($request);
    }
}
