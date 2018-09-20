<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Exceptions\PostTooLargeException;
use Illuminate\Foundation\Http\Middleware\ValidatePostSize as MaxPostSize;

class ValidatePostSize extends MaxPostSize
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     *
     * @throws \Illuminate\Http\Exceptions\PostTooLargeException
     */
    public function handle($request, Closure $next)
    {
        $max = $this->getPostMaxSize();

        if ($max > 0 && $request->server('CONTENT_LENGTH') > $max)
        {
            toast('¡El archivo seleccionado supera el tamaño máximo permitido de 1 megabytes!', 'error', 'top-right');

            return redirect()->back()->withInput();
        }

        return $next($request);
    }

}
