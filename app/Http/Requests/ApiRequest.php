<?php

namespace App\Http\Requests;

use App\Traits\ApiResponse;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

abstract class ApiRequest extends FormRequest
{
    use ApiResponse;

    abstract public function rules();

    protected function failedValidation(ValidationValidator $validator)
    {
        throw new HttpResponseException(
            $this->apiError(
                $validator->errors(),
                Response::HTTP_UNPROCESSABLE_ENTITY
            )
        );
    }

    protected function failedAuthorization()
    {
        throw new HttpResponseException(
            $this->apiError(null, Response::HTTP_UNAUTHORIZED)
        );
    }
}
