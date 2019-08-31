<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;

class CustomInvalidTokenException extends Exception
{

    public function render(Request $request)
    {
        return response()->json([
            'error' => $this->getMessage(),
            'status' => 0
        ], 500);
    }
}
