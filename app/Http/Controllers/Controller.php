<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function redirectTo()
    {
        return 'dashboard';
    }

    public function validationError($errors)
    {
        $errorCnt = $errors->count();
        $message = $errors->first();
        $message .= ($errorCnt > 1) ? ' (and ' . $errorCnt - 1 . ' more error)' : '' ;
        return response()->json([
            'message'  => $message,
            'errors' => $errors,
        ], 422);
    }
}
