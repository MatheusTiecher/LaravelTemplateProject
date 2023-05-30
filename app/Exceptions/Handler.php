<?php

namespace App\Exceptions;

use App\Traits\ResponseCreator;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    use ResponseCreator;
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function render($request, Throwable $exception)
    {
        if ($request->expectsJson()) {
            if ($exception instanceof ValidationException) {
                return $this->createResponse(422, "Erro de validação", [], $exception->errors());
            }

            if ($exception instanceof AuthenticationException) {
                return $this->createResponse(401, "Erro de autenticação", [], $exception->getMessage());
            }

            if ($exception instanceof AuthorizationException) {
                return $this->createResponseForbbiden();
            }

            if ($exception instanceof ModelNotFoundException || NotFoundException::class === get_class($exception)) {
                return $this->createResponseNotFound($exception->getMessage() ?? "Not Found");
            }

            if ($exception instanceof NotFoundException) {
                return $this->createResponseNotFound($exception->message());
            }

            if ($exception instanceof BadRequestException) {
                return $this->createResponseBadRequest($exception->getMessage(), $exception->errors(), $exception->getCode() ?: 500);
            }

            $this->createResponseInternalError($exception);
        }

        return parent::render($request, $exception);
    }

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
