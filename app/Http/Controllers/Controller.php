<?php

namespace App\Http\Controllers;

use Throwable;
use Illuminate\Support\Facades\Log;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
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
