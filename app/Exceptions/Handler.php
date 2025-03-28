<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use ErrorException;
use ReflectionException;
use Symfony\Component\HttpFoundation\Response;

class Handler extends ExceptionHandler
{
    // ...

    public function render($request, Throwable $exception)
    {
        if ($request->wantsJson()) {
            if ($exception instanceof ErrorException || $exception instanceof ReflectionException) {
                return response()->json([
                    'error' => 'Internal Server Error',
                    'message' => 'Class not found or related error.',
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }

        return parent::render($request, $exception);
    }
}