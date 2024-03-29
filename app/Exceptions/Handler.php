<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Traits\ApiResponser;
use Illuminate\Http\Response;

class Handler extends ExceptionHandler
{
  use ApiResponser;
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
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
        if ($exception instanceof HttpException) {
          $code = $exception->getStatusCode();
          $mensaje =  Response::$statusTexts[$code];
          return $this->errorResponse($mensaje, $code);
        }
        if ($exception instanceof ModelNotFoundException) {

          $modelo =  strtolower(class_basename($exception->getModel()));
          return $this->errorResponse("No se encuentra {$modelo}", Response::HTTP_NOT_FOUND);
        }
        if ($exception instanceof AuthorizationException) {

          return $this->errorResponse($exception->getMessage(), Response::HTTP_FORBIDDEN);
        }
        if ($exception instanceof AuthorizationException) {

          return $this->errorResponse($exception->getMessage(), Response::HTTP_UNAUTHORIZED);
        }
          // if ($exception instanceof ValidationException) {
          //   $errores = $exception->validator->errors()->getMessages()
          //
          //   return $this->errorResponse($errores, Response::HTTP_UNPROCESSABLE_ENTITY);
          // }

        return parent::render($request, $exception);
    }
}
