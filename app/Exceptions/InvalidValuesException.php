<?php

/**
 * HTTP status 400 custom exception for invalid values.
 */

namespace App\Exceptions;

use Illuminate\Http\Request;
use App\Helpers\HttpStatus as Status;

class InvalidValuesException extends BaseException
{
    /**
     * Render the exception into a JSON response.
     *
     * @uses   \App\Providers\ResponseServiceProvider
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function render(Request $request)
    {
        return response()->api([
            'error' => $this->getMessage(),
        ], Status::BAD_REQUEST);
    }
}
