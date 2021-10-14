<?php

namespace App\Http\Controllers;

use Throwable;
use Illuminate\Support\Facades\Log;
use Laravel\Lumen\Routing\Controller as BaseController;

/**
 * Helper methods.
 *
 * @link https://swagger.io/specification/ OpenAPI 3.0 Specification.
 */
class Controller extends BaseController
{
    /**
     * @OA\Info(
     *     title="Lumen Stripe API",
     *     version="0.0.1",
     *     description="Boilerplate/Starter App for Stripe payment processing",
     *     termsOfService="http://swagger.io/terms/",
     *     @OA\License(name="<License>"),
     *     @OA\Contact(
     *         email="ksenera@yahoo.com",
     *         name="geobas"
     *     )
     * )
     *
     * @OA\Server(
     *     url=LUMEN_APP_URL,
     *     description="Development environment"
     * )
     */

    /**
     * Log error.
     *
     * @param  Throwable  $t
     * @return void
     *
     * @throws \Exception|\Error
     */
    protected function logError(Throwable $t): void
    {
        Log::error("'" . $t->getMessage() . "' - File: '" . $t->getFile() . "' - Method: '" . 
            debug_backtrace()[1]['function'] . "' at line: " . $t->getLine());

        throw $t;
    }
}
