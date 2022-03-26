<?php

namespace App\Http\Requests;

use Illuminate\Http\JsonResponse;

class FormRequest extends \Illuminate\Foundation\Http\FormRequest
{
    /**
     * Get the proper failed validation response for the request.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function response(array $errors)
    {
        if ($this->expectsJson()) {
            return new JsonResponse([
                'data' => $errors,
            ], 422);
        }

        parent::response($errors);
    }
}
