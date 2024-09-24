<?php

namespace App\Http\Controllers\store;

use App\Http\Controllers\Controller;
use App\Models\nguoidung;
use App\Models\order;
use App\Models\sanpham;
use App\Models\slide;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardStoreController extends Controller
{
    public function indexStore()
    {
        $countVouchers = DB::table('vouchers')->where('status', 0)->count();

        $countProducts = sanpham::count();

        $countOrders = order::count();

        $countSlides = slide::count();

        $dangXuLy = DB::table('orders')->where('status', 1)->count();

        $daXacNhan = DB::table('orders')->where('status', 2)->count();

        $dangVanChuyen = DB::table('orders')->where('status', 3)->count();

        $daGiaoHang = DB::table('orders')->where('status', 4)->count();

        $daHuy = DB::table('orders')->where('status', 5)->count();


        // pie chart orders date
        $today = Carbon::now()->startOfDay()->timestamp * 1000;

        $date_dangXuLy = DB::table('orders')->where('status', 1)->where('created_at', 'like', $today . '%')->count();
        $date_daXacNhan = DB::table('orders')->where('status', 2)->where('created_at', 'like', $today . '%')->count();
        $date_dangVanChuyen = DB::table('orders')->where('status', 3)->where('created_at', 'like', $today . '%')->count();
        $date_daGiaoHang = DB::table('orders')->where('status', 4)->where('created_at', 'like', $today . '%')->count();
        $date_daHuy = DB::table('orders')->where('status', 5)->where('created_at', 'like', $today . '%')->count();

        $labels_day = ['Đang xử lý', 'Đã xác nhận', 'Đang vận chuyển', 'Đã giao hàng', 'Đã hủy'];

        $counts_day = [$date_dangXuLy, $date_daXacNhan, $date_dangVanChuyen, $date_daGiaoHang, $date_daHuy];

        // pie chart orders month
        // Lấy ngày đầu tiên của tháng hiện tại
        $firstDayOfMonth = Carbon::now()->startOfMonth()->timestamp * 1000;

        // Lấy ngày cuối cùng của tháng hiện tại
        $lastDayOfMonth = Carbon::now()->endOfMonth()->timestamp * 1000;

        $month_dangXuLy = DB::table('orders')
            ->where('status', 1)
            ->where('created_at', '>=', $firstDayOfMonth)
            ->where('created_at', '<=', $lastDayOfMonth)
            ->count();
        $month_daXacNhan = DB::table('orders')
            ->where('status', 2)
            ->where('created_at', '>=', $firstDayOfMonth)
            ->where('created_at', '<=', $lastDayOfMonth)
            ->count();
        $month_dangVanChuyen = DB::table('orders')
            ->where('status', 3)
            ->where('created_at', '>=', $firstDayOfMonth)
            ->where('created_at', '<=', $lastDayOfMonth)
            ->count();
        $month_daGiaoHang = DB::table('orders')
            ->where('status', 4)
            ->where('created_at', '>=', $firstDayOfMonth)
            ->where('created_at', '<=', $lastDayOfMonth)
            ->count();
        $month_daHuy = DB::table('orders')
            ->where('status', 5)
            ->where('created_at', '>=', $firstDayOfMonth)
            ->where('created_at', '<=', $lastDayOfMonth)
            ->count();

        $labels_month = ['Đang xử lý', 'Đã xác nhận', 'Đang vận chuyển', 'Đã giao hàng', 'Đã hủy'];

        $counts_month = [$month_dangXuLy, $month_daXacNhan, $month_dangVanChuyen, $month_daGiaoHang, $month_daHuy];

        // pie chart orders year
        // Lấy ngày đầu tiên của năm hiện tại
        $firstDayOfYear = Carbon::now()->startOfYear()->timestamp * 1000;

        // Lấy ngày cuối cùng của năm hiện tại
        $lastDayOfYear = Carbon::now()->endOfYear()->timestamp * 1000;

        $year_dangXuLy = DB::table('orders')
            ->where('status', 1)
            ->where('created_at', '>=', $firstDayOfYear)
            ->where('created_at', '<=', $lastDayOfYear)
            ->count();
        $year_daXacNhan = DB::table('orders')
            ->where('status', 2)
            ->where('created_at', '>=', $firstDayOfYear)
            ->where('created_at', '<=', $lastDayOfYear)
            ->count();
        $year_dangVanChuyen = DB::table('orders')
            ->where('status', 3)
            ->where('created_at', '>=', $firstDayOfYear)
            ->where('created_at', '<=', $lastDayOfYear)
            ->count();
        $year_daGiaoHang = DB::table('orders')
            ->where('status', 4)
            ->where('created_at', '>=', $firstDayOfYear)
            ->where('created_at', '<=', $lastDayOfYear)
            ->count();
        $year_daHuy = DB::table('orders')
            ->where('status', 5)
            ->where('created_at', '>=', $firstDayOfYear)
            ->where('created_at', '<=', $lastDayOfYear)
            ->count();

        $labels_year = ['Đang xử lý', 'Đã xác nhận', 'Đang vận chuyển', 'Đã giao hàng', 'Đã hủy'];

        $counts_year = [$year_dangXuLy, $year_daXacNhan, $year_dangVanChuyen, $year_daGiaoHang, $year_daHuy];

        return view('store.dashboard.dashboard', compact([
            'countVouchers',
            'countOrders',
            'countSlides',
            'countProducts',
            'dangXuLy', 'daXacNhan', 'dangVanChuyen', 'daGiaoHang', 'daHuy',

            // Đơn hàng theo ngày
            'labels_day', 'counts_day',

            // Đơn hàng theo tháng
            'labels_month', 'counts_month',

            // Đơn hàng theo tháng
            'labels_year', 'counts_year',
        ]));
    }
}
