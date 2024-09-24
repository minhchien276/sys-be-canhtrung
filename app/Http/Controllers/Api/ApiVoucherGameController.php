<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\VoucherGame\checkTurn;
use App\Services\VoucherGame\createVoucherGame;
use App\Supports\Responder;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiVoucherGameController extends Controller
{
    private $createVoucherGame;
    private $checkTurn;
    
    public function __construct(
        createVoucherGame $createVoucherGame,
        checkTurn $checkTurn,
    ){
        $this->middleware('auth:api');
        $this->createVoucherGame = $createVoucherGame;
        $this->checkTurn = $checkTurn;
    }

    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'maNguoiDung' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'status' => false   
            ], 400);
        }

        try {
            $voucher_game = $this->createVoucherGame->handle($request);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return $voucher_game;
    }

    public function checkTurn($maNguoiDung)
    {
        try {
            $voucher_game = $this->checkTurn->handle($maNguoiDung);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return $voucher_game;
    }
}
