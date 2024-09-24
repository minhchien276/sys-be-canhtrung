<?php

namespace App\ServicesAdmin\TuVanVienAdmin;

use App\Models\loaitvv;
use Exception;

class LoaiTuVanVien
{
    public function createTypeTvv($request)
    {
        $loaitvv = $request->input('type');

        try {
            loaitvv::create([
                'type' => $loaitvv,
            ]);

            return redirect()->back()->with('success', 'Thêm mới thành công!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Thêm mới thất bại: ' . $e->getMessage());
        }
    }

    public function loadTypeTvvList()
    {
        $loaitvv = loaitvv::all();

        return view('admin.tuvanvien.listTypeTvv', compact('loaitvv'));
    }


    public function deleteTypeTvv($id)
    {
        try {
            $loaitvv = loaitvv::where('id', $id)->first();

            if ($loaitvv) {
                $loaitvv->delete();
                return response()->json(['success' => 'Xóa người dùng thành công']);
            } else {
                return response()->json(['error' => 'Không tìm thấy người dùng']);
            }
        } catch (Exception $e) {
            return response()->json(['error' => 'Xóa người dùng thất bại: ' . $e->getMessage()]);
        }
    }
}
