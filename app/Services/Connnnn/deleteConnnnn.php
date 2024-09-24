<?php

namespace App\Services\Connnnn;

use App\Models\choan;
use App\Models\connnnn;
use App\Models\phattrien;
use App\Models\trieuchung;
use App\Services\AWSS3\deleteImage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class deleteConnnnn
{
    private $delete_image;

    public function __construct(
        deleteImage $delete_image,
    ) {
        $this->delete_image = $delete_image;
    }

    public function handle($id, $maNguoiDung)
    {
        $connnnn = connnnn::where('maNguoiDung', $maNguoiDung)->count();

        if ($connnnn == 1) {
            choan::where('maCon',  $id)->delete();

            phattrien::where('maCon',  $id)->delete();

            trieuchung::where('id_con', $id)->delete();

            phattrien::where('maCon', $id)->delete();

            connnnn::where('id', $id)->delete();

            return response()->json([
                'message' => 'Xóa con thành công',
                'status' => true
            ], 200);
        } else if ($connnnn > 1) {
            choan::where('maCon',  $id)->delete();

            phattrien::where('maCon',  $id)->delete();

            trieuchung::where('id_con', $id)->delete();

            phattrien::where('maCon', $id)->delete();

            connnnn::where('id', $id)->delete();

            $maxNgaySinh = connnnn::where('maNguoiDung', $maNguoiDung)->max(DB::raw('CAST(ngaySinh AS SIGNED)'));

            if ($maxNgaySinh !== null) {
                connnnn::where('ngaySinh', $maxNgaySinh)->update(['trangThai' => 1]);

                connnnn::where('maNguoiDung', $maNguoiDung)
                    ->where('ngaySinh', '<>', $maxNgaySinh)
                    ->update(['trangThai' => 0]);
            }

            return response()->json([
                'message' => 'Xóa con thành công',
                'status' => true
            ], 200);
        } else {
            return response()->json([
                'message' => 'Xóa con thất bại',
                'status' => false
            ], 400);
        }
    }
}
