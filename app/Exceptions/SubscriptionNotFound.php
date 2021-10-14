<?php

/**
 * HTTP status 404 custom exception for unknown subscription.
 */

namespace App\Exceptions;

use Illuminate\Http\Request;
use App\Helpers\HttpStatus as Status;

class SubscriptionNotFound extends BaseException
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
        ], Status::NOT_FOUND);
    }
}
