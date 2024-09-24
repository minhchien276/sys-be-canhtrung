<?php

namespace App\ServicesAdmin\ChartAdmin;

use App\Models\ketquatest;
use App\Models\quanlyquetest;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Ladumor\OneSignal\OneSignal;

class AnswerAdmin
{
    public function answers($id)
    {
        $answers = DB::table('cautraloi')
            ->join('nhatky', 'cautraloi.maNhatKy', '=', 'nhatky.maNhatKy')
            ->join('cauhoi', 'cautraloi.maCauHoi', '=', 'cauhoi.maCauHoi')
            ->where('nhatky.maNguoiDung', $id)
            ->select('cautraloi.*', 'nhatky.*', 'cauhoi.*')
            ->get();

        $answers->map(function ($item) {
            $item->thoiGian = Carbon::createFromTimestamp($item->thoiGian / 1000)->toDateTimeString();
            return $item;
        });

        return view('admin.users.answers', compact('answers'));
    }

    public function sendNotification($request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        $title = $request->input('title');
        $content = $request->input('content');
        $userId = $request->input('id');

        $fields['include_player_ids'] = $userId;
        $notificationMsg = $content;
        OneSignal::sendPush($fields, $notificationMsg, $title);

        return redirect()->back()->with('success', 'Đã gửi thông báo thành công!');
    }

    public function updateKetQuaTest($request)
    {
        $request->validate([
            'lanTest' => 'required|numeric',
            'ketQua' => 'required|numeric|min:0|max:80'
        ]);

        $id = $request->input('id');

        $qlqt = quanlyquetest::where('maNguoiDung', $id)->first();

        ketquatest::where('maQuanLyQueTest', $qlqt->maQuanLyQueTest)
            ->where('lanTest', $request->lanTest)
            ->where('maLoaiQue', 1)
            ->update([
                'ketQua' => $request->ketQua
            ]);


        DB::table('quanlyquetest')
            ->join('ketquatest', 'quanlyquetest.maQuanLyQueTest', '=', 'ketquatest.maQuanLyQueTest')
            ->where('quanlyquetest.maNguoiDung', $id)
            ->where('maLoaiQue', 1)
            ->select('quanlyquetest.*', 'ketquatest.*')
            ->get();

        return redirect()->back()->with('success', 'Cập nhật thành công!');
    }

    public function showCon($maNguoiDung)
    {
        $con = DB::table('connnnn')
            ->leftJoin('nguoidung', 'connnnn.maNguoiDung', '=', 'nguoidung.maNguoiDung')
            ->where('connnnn.maNguoiDung', $maNguoiDung)
            ->select('connnnn.ten', 'connnnn.ngaySinh', 'connnnn.gioiTinh')
            ->get();

        $con->map(function ($item) {
            if ($item->ngaySinh) {
                $ngaySinh = Carbon::createFromTimestamp($item->ngaySinh / 1000);
                $item->ngaySinh = $ngaySinh->format('d-m-Y');
            }

            return $item;
        });

        return view('admin.users.showCon', compact('con'));
    }
}
