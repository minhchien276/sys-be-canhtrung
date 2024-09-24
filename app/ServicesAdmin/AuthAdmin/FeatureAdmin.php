<?php

namespace App\ServicesAdmin\AuthAdmin;

use App\Models\loaitvv;
use App\Models\nguoidung;
use App\Models\phanquyen;
use App\Models\tuvanvien;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class FeatureAdmin
{
    public function index()
    {
        $auth = DB::table('nguoidung')
            ->join('phanquyen', 'nguoidung.maPhanQuyen', 'phanquyen.maPhanQuyen')
            ->select('nguoidung.maPhanQuyen', 'phanquyen.loaiQuyen')
            ->where('nguoidung.maPhanQuyen', '!=', '4')
            ->distinct()
            ->get();

        $loaitvv = loaitvv::all();

        return view('admin.auth.typeAccounts', compact('auth', 'loaitvv'));
    }

    public function typeAccounts($id)
    {
        $auth = DB::table('nguoidung')
            ->join('phanquyen', 'nguoidung.maPhanQuyen', 'phanquyen.maPhanQuyen')
            ->select('nguoidung.*', 'phanquyen.loaiQuyen')
            ->where('nguoidung.maPhanQuyen', '=', $id)
            ->get();

        return view('admin.auth.listAccounts', compact('auth'));
    }

    public function createQuyen($request)
    {
        try {
            phanquyen::create([
                'maPhanQuyen' => $request->maPhanQuyen,
                'loaiQuyen' => $request->loaiQuyen,
            ]);

            return response()->json(['success' => 'Thêm mới thành công!']);
        } catch (Exception $e) {
            return response()->json(['error' => 'Thêm mới thất bại: ' . $e->getMessage()]);
        }
    }

    public function createAccount($request)
    {
        try {
            nguoidung::create([
                'maNguoiDung' => Str::random(40),
                'email' => $request->email,
                'taiKhoan' => $request->taiKhoan,
                'tenNguoiDung' => $request->tenNguoiDung,
                'matKhau' => bcrypt($request->matKhau),
                'maPhanQuyen' => $request->maPhanQuyen,
            ]);

            return response()->json(['success' => 'Thêm mới thành công!']);
        } catch (Exception $e) {
            return response()->json(['error' => 'Thêm mới thất bại: ' . $e->getMessage()]);
        }
    }

    public function getPhanQuyen()
    {
        $phanQuyenList = phanquyen::where('maPhanQuyen', '!=', '4')->where('maPhanQuyen', '!=', '2')->get();
        return response()->json($phanQuyenList);
    }

    public function loadListAcc()
    {
        $auth = DB::table('nguoidung')
            ->join('phanquyen', 'nguoidung.maPhanQuyen', 'phanquyen.maPhanQuyen')
            ->select('nguoidung.*', 'phanquyen.loaiQuyen')
            ->where('nguoidung.maPhanQuyen', '!=', '4')
            ->get();

        return view('admin.auth.listAcc', compact('auth'));
    }

    public function changePassword($id)
    {
        return view('admin.auth.changePassword', compact('id'));
    }

    public function updatePassword($request, $id)
    {
        $user = nguoidung::where('maNguoiDung', $id)->first();

        $user->matKhau = Hash::make($request->matKhauMoi);
        $user->save();

        Session::put('message', 'Đổi mật khẩu thành công');
        return redirect()->back();
    }

    public function delete($id)
    {
        try {
            $acc = nguoidung::where('maNguoiDung', $id)->first();

            if ($acc) {
                $acc->delete();
                tuvanvien::where('maTvv', $id)->delete();

                return response()->json(['success' => 'Xóa người dùng thành công']);
            } else {
                return response()->json(['error' => 'Không tìm thấy người dùng']);
            }
        } catch (Exception $e) {
            return response()->json(['error' => 'Xóa người dùng thất bại: ' . $e->getMessage()]);
        }
    }
}
