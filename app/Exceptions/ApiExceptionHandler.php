<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class ApiExceptionHandler
{
    public static function render(\Throwable $e)
    {
        if ($e instanceof HttpResponseException) {
            return $e->getResponse();
        }

        if ($e instanceof ValidationException) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $e->errors(),
            ], 422);
        }

        if ($e instanceof AuthenticationException) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        if ($e instanceof ModelNotFoundException) {
            return response()->json(['message' => 'Resource not found.'], 404);
        }

        if ($e instanceof HttpExceptionInterface) {
            return response()->json(['message' => $e->getMessage() ?: 'HTTP error.'], $e->getStatusCode());
        }

        report($e);

        return response()->json(['message' => 'Server error.'], 500);
    }
}

