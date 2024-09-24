<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\TrieuChung\createTrieuChung;
use App\Services\TrieuChung\getTrieuChung;
use App\Supports\Responder;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiTrieuChungController extends Controller
{
    private $createTrieuChung;
    private $getTrieuChung;

    public function __construct(
        createTrieuChung $createTrieuChung,
        getTrieuChung $getTrieuChung,
    ){
        $this->middleware('auth:api');
        $this->createTrieuChung = $createTrieuChung;
        $this->getTrieuChung = $getTrieuChung;
    }

    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'dauHieu' => 'required',
            'id_con' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'status' => false
            ], 400);
        }

        try {
            $trieuchung = $this->createTrieuChung->handle($request);    
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($trieuchung, 'Trieu chung created successfully');
    }

    public function get($id_con)
    {
        try {
            $trieuchung = $this->getTrieuChung->handle($id_con);    
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($trieuchung, 'Trieu chung get successfully');
    }
}
