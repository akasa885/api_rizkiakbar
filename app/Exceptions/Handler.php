<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Validation\ValidationException::class,
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
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
       if($request->expectsJson()) //jika request menerima permintaan berupa JSON
       {
         //jika terdapat error pada otorisasi maka
         if ($exception instanceof \Illuminate\Auth\Access\AuthorizationException)
         {
           return response()->json([
             'error' => 'Unauthorized',
           ], 401);
         }

         //jika ada alamat route yang tidak tersedia
         if($exception instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException)
         {
           return response()->json([
             'error' => 'Not Found',
           ], 404);
         }

         //penangkap error pada request ke Database
         if ($exception instanceof \Illuminate\Database\Eloquent\ModelNotFoundException)
         {
           //mendapatkan model yang error berdasar request, lalu di explode
           $modelClass = explode('\\', $exception->getModel());

           return response()->json([
             'error' => end($modelClass) . ' Not Found',
           ], 404);
         }
       }
        return parent::render($request, $exception);
    }
}
