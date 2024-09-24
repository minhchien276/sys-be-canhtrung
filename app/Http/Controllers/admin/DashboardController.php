<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\blog;
use App\Models\hoptest;
use App\Models\ketquatest;
use App\Models\nguoidung;
use App\Models\thaiki;
use App\Models\typeblog;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // tính số lượng người dùng
        $countUsers = nguoidung::where('maPhanQuyen', 4)->count();

        // tính số tổng lượng hộp test
        $hopTests = Hoptest::whereRaw('LENGTH(maHoptest) > 5')->get();
        $countHopTest = $hopTests->count();

        // tính số lượng hộp test đã dùng
        $HopTestDaDung = hoptest::whereNotNull('maNguoiDung')->whereRaw('LENGTH(maHoptest) > 5')->get();
        $countHopTestDaDung = $HopTestDaDung->count();

        // tính số lượng hôp test còn lại
        $conLai = $countHopTest - $countHopTestDaDung;

        // tính số lượng khách hàng có ngày dự sinh
        $countNgayDuSinh = thaiki::whereNotNull('ngayDuSinh')->count();

        // tính số lượng loại bài viết
        $countTypeBlog = typeblog::count();

        // tính số lượng bài viết
        $countBlog = blog::count();

        // Chi tiết 
        $countDatDinhDetails = DB::table('ketquatest')
            ->join(
                DB::raw("(SELECT maQuanLyQueTest, MAX(lanTest) AS max_ngay_test FROM ketquatest GROUP BY maQuanLyQueTest) latest_ket_qua_test"),
                function ($join) {
                    $join->on('ketquatest.maQuanLyQueTest', '=', 'latest_ket_qua_test.maQuanLyQueTest');
                    $join->on('ketquatest.lanTest', '=', 'latest_ket_qua_test.max_ngay_test');
                }
            )
            ->whereBetween('ketquatest.ketQua', [46, 80])
            ->count();

        $countDatDinhforCao = DB::table('ketquatest')
            ->join(
                DB::raw("(SELECT maQuanLyQueTest, MAX(lanTest) AS max_ngay_test FROM ketquatest GROUP BY maQuanLyQueTest) latest_ket_qua_test"),
                function ($join) {
                    $join->on('ketquatest.maQuanLyQueTest', '=', 'latest_ket_qua_test.maQuanLyQueTest');
                    $join->on('ketquatest.lanTest', '=', 'latest_ket_qua_test.max_ngay_test');
                }
            )
            ->whereBetween('ketquatest.ketQua', [46, 80])
            ->pluck('ketquatest.maQuanLyQueTest');

        $countCaoDetails = DB::table('ketquatest')
            ->join(
                DB::raw("(SELECT maQuanLyQueTest, MAX(lanTest) AS max_ngay_test FROM ketquatest GROUP BY maQuanLyQueTest) latest_ket_qua_test"),
                function ($join) {
                    $join->on('ketquatest.maQuanLyQueTest', '=', 'latest_ket_qua_test.maQuanLyQueTest');
                    $join->on('ketquatest.lanTest', '=', 'latest_ket_qua_test.max_ngay_test');
                }
            )
            ->whereBetween('ketquatest.ketQua', [35, 45])
            ->whereNotIn('ketquatest.maQuanLyQueTest', $countDatDinhforCao->unique()->toArray())
            ->count();

        $countCaoforThap = DB::table('ketquatest')
            ->join(
                DB::raw("(SELECT maQuanLyQueTest, MAX(lanTest) AS max_ngay_test FROM ketquatest GROUP BY maQuanLyQueTest) latest_ket_qua_test"),
                function ($join) {
                    $join->on('ketquatest.maQuanLyQueTest', '=', 'latest_ket_qua_test.maQuanLyQueTest');
                    $join->on('ketquatest.lanTest', '=', 'latest_ket_qua_test.max_ngay_test');
                }
            )
            ->whereBetween('ketquatest.ketQua', [35, 45])
            ->whereNotIn('ketquatest.maQuanLyQueTest', $countDatDinhforCao->unique()->toArray())
            ->pluck('ketquatest.maQuanLyQueTest');

        $countThapDetails = DB::table('ketquatest')
            ->join(
                DB::raw("(SELECT maQuanLyQueTest, MAX(lanTest) AS max_ngay_test FROM ketquatest GROUP BY maQuanLyQueTest) latest_ket_qua_test"),
                function ($join) {
                    $join->on('ketquatest.maQuanLyQueTest', '=', 'latest_ket_qua_test.maQuanLyQueTest');
                    $join->on('ketquatest.lanTest', '=', 'latest_ket_qua_test.max_ngay_test');
                }
            )
            ->whereBetween('ketquatest.ketQua', [0, 34])
            ->whereNotIn('ketquatest.maQuanLyQueTest', $countDatDinhforCao->unique()->toArray())
            ->whereNotIn('ketquatest.maQuanLyQueTest', $countCaoforThap->unique()->toArray())
            ->count();

        //show popup
        $DatDinhDetails = DB::table('nguoidung')
            ->join('quanlyquetest', 'nguoidung.maNguoiDung', '=', 'quanlyquetest.maNguoiDung')
            ->join('ketquatest', 'quanlyquetest.maQuanLyQueTest', '=', 'ketquatest.maQuanLyQueTest')
            ->select('nguoidung.maNguoiDung', 'nguoidung.taiKhoan', 'nguoidung.tenNguoiDung', DB::raw('MAX(ketquatest.lanTest) as lanTest'), DB::raw('MAX(ketquatest.ketQua) as ketQua'))
            ->where('ketquatest.ketQua', '>=', 46)
            ->groupBy('nguoidung.maNguoiDung', 'nguoidung.taiKhoan', 'nguoidung.tenNguoiDung')
            ->get();

        $DatDinhDetailsForCao = DB::table('nguoidung')
            ->join('quanlyquetest', 'nguoidung.maNguoiDung', '=', 'quanlyquetest.maNguoiDung')
            ->join('ketquatest', 'quanlyquetest.maQuanLyQueTest', '=', 'ketquatest.maQuanLyQueTest')
            ->select('quanlyquetest.maQuanLyQueTest')
            ->where('ketquatest.ketQua', '>=', 46)
            ->pluck('maQuanLyQueTest')
            ->toArray();

        $CaoDetails = DB::table('nguoidung')
            ->join('quanlyquetest', 'nguoidung.maNguoiDung', '=', 'quanlyquetest.maNguoiDung')
            ->join('ketquatest', 'quanlyquetest.maQuanLyQueTest', '=', 'ketquatest.maQuanLyQueTest')
            ->select('nguoidung.maNguoiDung', 'nguoidung.taiKhoan', 'quanlyquetest.maQuanLyQueTest', DB::raw('MAX(ketquatest.ketQua) as max_ket_qua'), DB::raw('COUNT(*) as count'), DB::raw('SUBSTRING_INDEX(GROUP_CONCAT(nguoidung.tenNguoiDung), ",", 1) as tenNguoiDung'))
            ->whereBetween('ketquatest.ketQua', [35, 45])
            ->groupBy('quanlyquetest.maQuanLyQueTest', 'nguoidung.taiKhoan', 'nguoidung.maNguoiDung')
            ->whereNotIn('quanlyquetest.maQuanLyQueTest', $DatDinhDetailsForCao)
            ->get();


        $CaoDetailsForThap = DB::table('nguoidung')
            ->join('quanlyquetest', 'nguoidung.maNguoiDung', '=', 'quanlyquetest.maNguoiDung')
            ->join('ketquatest', 'quanlyquetest.maQuanLyQueTest', '=', 'ketquatest.maQuanLyQueTest')
            ->select('quanlyquetest.maQuanLyQueTest', DB::raw('MAX(ketquatest.ketQua) as max_ket_qua'), DB::raw('COUNT(*) as count'), DB::raw('SUBSTRING_INDEX(GROUP_CONCAT(nguoidung.tenNguoiDung), ",", 1) as tenNguoiDung'))
            ->whereBetween('ketquatest.ketQua', [35, 45])
            ->groupBy('quanlyquetest.maQuanLyQueTest')
            ->whereNotIn('quanlyquetest.maQuanLyQueTest', $DatDinhDetailsForCao)
            ->pluck('maQuanLyQueTest')
            ->toArray();

        $ThapDetails = DB::table('nguoidung')
            ->join('quanlyquetest', 'nguoidung.maNguoiDung', '=', 'quanlyquetest.maNguoiDung')
            ->join('ketquatest', 'quanlyquetest.maQuanLyQueTest', '=', 'ketquatest.maQuanLyQueTest')
            ->select('nguoidung.maNguoiDung', 'nguoidung.taiKhoan', 'quanlyquetest.maQuanLyQueTest', DB::raw('MAX(ketquatest.ketQua) as max_ket_qua'), DB::raw('COUNT(*) as count'), DB::raw('SUBSTRING_INDEX(GROUP_CONCAT(nguoidung.tenNguoiDung), ",", 1) as tenNguoiDung'))
            ->whereBetween('ketquatest.ketQua', [0, 34])
            ->groupBy('quanlyquetest.maQuanLyQueTest', 'nguoidung.taiKhoan', 'nguoidung.maNguoiDung')
            ->whereNotIn('quanlyquetest.maQuanLyQueTest', $DatDinhDetailsForCao)
            ->whereNotIn('quanlyquetest.maQuanLyQueTest', $CaoDetailsForThap)
            ->get();

        // pie chart
        $results = ketquatest::where('maLoaiQue', 1)->select('ketQua')->get();

        $countDatDinh = $results->whereBetween('ketQua', [46, 80])->count();
        $countCao = $results->whereBetween('ketQua', [35, 45])->count();
        $countThap = $results->where('ketQua', '<', 35)->count();

        $labels = ['Đạt đỉnh', 'Cao', 'Thấp'];

        $counts = [$countDatDinh, $countCao, $countThap];

        return view('admin.dashboard.dashboard')->with([
            'count' => $countUsers,
            'countHopTest' => $countHopTest,
            'countHopTestDaDung' => $countHopTestDaDung,
            'countNgayDuSinh' => $countNgayDuSinh,
            'labels' => $labels,
            'counts' => $counts,
            'countDatDinhDetails' => $countDatDinhDetails,
            'countCaoDetails' => $countCaoDetails,
            'countThapDetails' => $countThapDetails,
            'DatDinhDetails' => $DatDinhDetails,
            'CaoDetails' => $CaoDetails,
            'ThapDetails' => $ThapDetails,
            'countTypeBlog' => $countTypeBlog,
            'countBlog' => $countBlog,
            'conLai' => $conLai,
        ]);
    }
}
