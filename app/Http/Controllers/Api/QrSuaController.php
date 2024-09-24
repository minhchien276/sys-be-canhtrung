<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\QrSua\getQrSua;
use App\Services\QrSua\updateQrSua;
use Illuminate\Http\Request;

class QrSuaController extends Controller
{
    private $getQrSua;
    private $updateQrSua;

    public function __construct(
        getQrSua $getQrSua,
        updateQrSua $updateQrSua,
    ) {
        $this->getQrSua = $getQrSua;
        $this->updateQrSua = $updateQrSua;
    }

    public function getQrSua(Request $request)
    {
        return $this->getQrSua->hanlde($request);
    }

    public function updateQrSua(Request $request, $id)
    {
        return $this->updateQrSua->hanlde($request, $id);
    }
}
