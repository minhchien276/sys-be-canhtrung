<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Supports\Responder;
use Illuminate\Http\Request;

class ApiSupportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $ios = '';
        $android = '';

        $data = [$ios, $android];

        return Responder::success($data, 'link cua ban day nhe');
    }
}
