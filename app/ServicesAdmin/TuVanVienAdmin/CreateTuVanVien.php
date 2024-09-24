<?php

namespace App\ServicesAdmin\TuVanVienAdmin;

use App\Models\loaitvv;
use App\Models\nguoidung;
use App\Models\tuvanvien;
use Exception;
use Illuminate\Support\Facades\DB;

class CreateTuVanVien
{
    public function create()
    {
        $listOfLoaitvv = DB::table('loaitvv')->get();

        return view('admin.tuvanvien.createTvv', compact('listOfLoaitvv'));
    }

    public function store($request)
    {
        $randomNumber = '036';

        for ($i = 0; $i < 7; $i++) {
            $randomNumber .= mt_rand(0, 9);
        }

        DB::beginTransaction();

        try {

            $tvv = tuvanvien::create([
                "tenTvv" => $request->tenTvv,
                "linkZalo" => $request->linkZalo,
                "soDienThoai" => $request->soDienThoai,
                "linkAnh" => $request->linkAnh,
                "kinhnghiem" => $request->kinhnghiem,
                "gioithieu" => $request->gioithieu,
                "linkFb" => $request->linkFb,
                "status" => $request->status,
                "id_loaitvv" => $request->id_loaitvv,
            ]);

            nguoidung::create([
                'maNguoiDung' => $tvv->maTvv,
                'maPhanQuyen' => 2,
                'email' => $request->email,
                'taiKhoan' => $randomNumber,
                'tenNguoiDung' => $request->tenTvv,
                'matKhau' => bcrypt($request->soDienThoai),
            ]);

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }

        $thongbao = '';

        $user = [];

        $tvv = tuvanvien::all();

        $loaitvv = loaitvv::all();

        return view('admin.tuvanvien.listTvv', compact('tvv', 'loaitvv', 'user', 'thongbao'));
    }
}
