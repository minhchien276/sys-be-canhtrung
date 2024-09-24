<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

class ErrorController extends Controller
{
    public function Error403()
    {
        return view('error.403');
    }
}
