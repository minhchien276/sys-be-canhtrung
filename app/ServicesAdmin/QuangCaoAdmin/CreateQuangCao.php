<?php

namespace App\ServicesAdmin\QuangCaoAdmin;

use App\Models\quangcao;
use Exception;
use Illuminate\Support\Facades\Validator;

class CreateQuangCao
{
    public function create($request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required',
            'phase' => 'required|numeric',
            'type' => 'required|numeric',
            'link' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
        try {
            quangcao::create([
                'image' => $request->image,
                'phase' => $request->phase,
                'type' => $request->type,
                'status' => 1,
                'link' => $request->link,
            ]);

            return response()->json(['success' => 'Thêm mới thành công!']);
        } catch (Exception $e) {
            return response()->json(['error' => 'Thêm mới thất bại: ' . $e->getMessage()]);
        }
    }
}
