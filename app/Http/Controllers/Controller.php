<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function test(Request $request)
    {
        $var = $request->ip();
        $var = $request->getAcceptableContentTypes();
        $var = $request->collect();

        return response()->json($var);
    }
}
