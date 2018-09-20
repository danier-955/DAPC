<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof AuthorizationException)
        {
           return response()->view('errors.403');
        }

        if ($exception instanceof ModelNotFoundException)
        {
            return response()->view('errors.404');
        }

        if ($exception instanceof MethodNotAllowedHttpException)
        {
            return response()->view('errors.405');
        }

        if ($exception instanceof TokenMismatchException)
        {
            return response()->view('errors.419');
        }

        if ($exception instanceof QueryException)
        {
        	$code = isset($exception->errorInfo[1]) ? $exception->errorInfo[1] : 0;

            if ($code == 1451)
            {
                return response()->view('errors.409');
            }
        }

        return parent::render($request, $exception);
    }
}
