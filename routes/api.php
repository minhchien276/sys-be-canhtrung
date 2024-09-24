<?php

use App\Http\Controllers\Api\ApiAddressController;
use App\Http\Controllers\Api\ApiAnDamController;
use App\Http\Controllers\Api\ApiAuthv2Controller;
use App\Http\Controllers\Api\ApiBenhController;
use App\Http\Controllers\Api\ApiBinhController;
use App\Http\Controllers\Api\ApiBlogController;
use App\Http\Controllers\Api\ApiBuBinhController;
use App\Http\Controllers\Api\ApiBuMeController;
use App\Http\Controllers\Api\ApiChoAnController;
use App\Http\Controllers\Api\ApiClickAdsController;
use App\Http\Controllers\Api\ApiClickLinkController;
use App\Http\Controllers\Api\ApiConnnnnController;
use App\Http\Controllers\Api\ApiDanhGiaController;
use App\Http\Controllers\Api\ApiHutSuaController;
use App\Http\Controllers\Api\ApiLichKhamController;
use App\Http\Controllers\Api\ApiLoaiChoAnController;
use App\Http\Controllers\Api\ApiLoaiSanPhamController;
use App\Http\Controllers\Api\ApiLoaiTvvController;
use App\Http\Controllers\Api\ApiLuongKinhController;
use App\Http\Controllers\Api\ApiNotificationController;
use App\Http\Controllers\Api\ApiOrderController;
use App\Http\Controllers\Api\ApiOrderDetailsController;
use App\Http\Controllers\Api\ApiPhatTrienController;
use App\Http\Controllers\Api\ApiPhongKhamController;
use App\Http\Controllers\Api\ApiProductDetailController;
use App\Http\Controllers\Api\ApiQuangCaoController;
use App\Http\Controllers\Api\ApiSanPhamController;
use App\Http\Controllers\Api\ApiSlideController;
use App\Http\Controllers\Api\ApiSupportController;
use App\Http\Controllers\Api\ApiTrieuChungController;
use App\Http\Controllers\Api\ApiTypeBlogController;
use App\Http\Controllers\Api\ApiTypeVoucherController;
use App\Http\Controllers\Api\ApiVersionController;
use App\Http\Controllers\Api\ApiVideoController;
use App\Http\Controllers\Api\ApiVietNamUnitsController;
use App\Http\Controllers\Api\ApiVoucherController;
use App\Http\Controllers\Api\ApiVoucherGameController;
use App\Http\Controllers\Api\ApiVoucherUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CauHoiController;
use App\Http\Controllers\Api\CauTraLoiController;
use App\Http\Controllers\Api\HopTestController;
use App\Http\Controllers\Api\KetQuaTestController;
use App\Http\Controllers\Api\NhatKyController;
use App\Http\Controllers\Api\KinhNguyetController;
use App\Http\Controllers\Api\LinkController;
use App\Http\Controllers\Api\MailController;
use App\Http\Controllers\Api\QrSuaController;
use App\Http\Controllers\Api\QuanLyQueTestController;
use App\Http\Controllers\Api\QueTestController;
use App\Http\Controllers\Api\TaiLieuKichSuaController;
use App\Http\Controllers\Api\ThaiKiController;
use App\Http\Controllers\Api\TuVanVienController;
use App\Http\Controllers\ApiTiemChungController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\NotificationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// auth
Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('update/{id}', [AuthController::class, 'update']);
    Route::post('update-phase/{id}', [AuthController::class, 'updatePhase']);
    Route::get('find/{id}', [AuthController::class, 'find']);
    Route::post('reset-password/{id}', [AuthController::class, 'resetPassword']);
    Route::get('logged/{maNguoiDung}', [AuthController::class, 'logged']);
    Route::get('get-all-users', [Controller::class, 'getAllUsers']);
    Route::post('login-v2', [ApiAuthv2Controller::class, 'loginV2']);
    Route::post('update-device-token/{id}', [AuthController::class, 'updateDeviceToken']);
});

// nhatky
Route::group(['prefix' => 'nhatky'], function () {
    Route::post('insert', [NhatKyController::class, 'insert']);
    Route::post('delete/{id}', [NhatKyController::class, 'delete']);
    Route::get('find/{id}', [NhatKyController::class, 'find']);
    Route::get('get-nhat-ky/{maNguoiDung}/{thoiGian}', [NhatKyController::class, 'getNhatKy']);
    Route::post('dong-bo-nhat-ky/{maNguoiDung}', [NhatKyController::class, 'dongBoNhatKy']);
});

// kinhnguyet
Route::group(['prefix' => 'kinhnguyet'], function () {
    Route::post('insert', [KinhNguyetController::class, 'insert']);
    Route::get('find/{id}', [KinhNguyetController::class, 'find']);
    Route::delete('delete/{id}', [KinhNguyetController::class, 'delete']);
    Route::post('update/{id}', [KinhNguyetController::class, 'update']);
    Route::post('dong-bo/{id}', [KinhNguyetController::class, 'dongboKinhNguyet']);
    Route::post('delete-by-date/{maNguoiDung}', [KinhNguyetController::class, 'deleteByDate']);
});

//cautraloi
Route::group(['prefix' => 'cautraloi'], function () {
    Route::post('insert', [CauTraLoiController::class, 'insert']);
    Route::post('update/{id}', [CauTraLoiController::class, 'update']);
    Route::get('find/{maNhatKy}', [CauTraLoiController::class, 'find']);
});

//cauhoi
Route::group(['prefix' => 'cauhoi', 'middleware' => 'role:1'], function () {
    Route::post('insert', [CauHoiController::class, 'insert']);
    Route::post('update/{id}', [CauHoiController::class, 'update']);
    Route::delete('delete/{id}', [CauHoiController::class, 'delete']);
});

//hoptest
Route::group(['prefix' => 'hoptest'], function () {
    Route::post('insert', [HopTestController::class, 'insert'])->middleware('role:1');
    Route::post('update/{id}', [HopTestController::class, 'update']);
    Route::delete('delete/{id}', [HopTestController::class, 'delete']);
});

//quetest
Route::group(['prefix' => 'quetest', 'middleware' => 'role:1'], function () {
    Route::post('insert', [QueTestController::class, 'insert']);
    Route::post('update/{id}', [QueTestController::class, 'update']);
});

//ketquatest
Route::group(['prefix' => 'ketquatest'], function () {
    Route::post('insert', [KetQuaTestController::class, 'insert']);
    Route::post('update/{id}', [KetQuaTestController::class, 'update']);
    Route::get('find/{id}', [KetQuaTestController::class, 'find']);
    Route::get('get-dat-dinh/{maQuanLyQueTest}/{from}/{to}', [KetQuaTestController::class, 'getDatDinh']);
});

//quanlyquetest
Route::group(['prefix' => 'quanlyquetest'], function () {
    Route::post('insert', [QuanLyQueTestController::class, 'insert']);
    Route::post('update/{id}', [QuanLyQueTestController::class, 'update']);
    Route::get('find/{id}', [QuanLyQueTestController::class, 'find']);
    Route::get('get/{id}', [QuanLyQueTestController::class, 'get']);
});

//link
Route::group(['prefix' => 'link'], function () {
    Route::post('insert', [LinkController::class, 'insert'])->middleware('role:1');
    Route::post('update/{id}', [LinkController::class, 'update'])->middleware('role:1');
    Route::get('find/{id}', [LinkController::class, 'find']);
    Route::delete('delete/{id}', [LinkController::class, 'delete'])->middleware('role:1');

    Route::get('get-link-con-trai', [LinkController::class, 'getLinkConTrai']);
    Route::get('get-link-con-gai', [LinkController::class, 'getLinkConGai']);
    Route::get('get-link-me-be', [LinkController::class, 'getLinkMeBe']);
    Route::get('get-link-an-toan', [LinkController::class, 'getLinkAnToan']);
});

//mail
Route::group(['prefix' => 'mail'], function () {
    Route::post('send-reset-link-email', [MailController::class, 'sendResetLinkEmail']);
    Route::post('generate-otp', [MailController::class, 'generateOtp']);
    Route::post('verify-otp', [MailController::class, 'verifyOtp']);
});

//tuvanvien
Route::group(['prefix' => 'tuvanvien'], function () {
    Route::post('insert', [TuVanVienController::class, 'insert'])->middleware('role:1');
    Route::post('update/{id}', [TuVanVienController::class, 'update'])->middleware('role:1');
    Route::get('get/{id_loaitvv}', [TuVanVienController::class, 'get']);
    Route::get('find/{id}', [TuVanVienController::class, 'find']);
    Route::delete('delete/{id}', [TuVanVienController::class, 'delete'])->middleware('role:1');
    Route::get('get-tvv-by-iduser/{id}/{id_loaitvv}', [TuVanVienController::class, 'getTvvByIdUser']);
    Route::get('redirect-to-zalo/{maTvv}', [TuVanVienController::class, 'redirectToZalo']);
});

//thaiki
Route::group(['prefix' => 'thaiki'], function () {
    Route::post('insert', [ThaiKiController::class, 'insert']);
    Route::post('update/{id}', [ThaiKiController::class, 'update']);
    Route::get('find/{id}', [ThaiKiController::class, 'find']);
    Route::get('delete-ngay-du-sinh/{id}', [ThaiKiController::class, 'deleteNgayDuSinh']);
});

//blog
Route::group(['prefix' => 'blog'], function () {
    Route::post('insert', [ApiBlogController::class, 'insert']);
    Route::get('get-blog-by-type/{id}', [ApiBlogController::class, 'getBlogByType']);
    Route::get('get-blog-by-type-v2/{id}', [ApiBlogController::class, 'getBlogByTypeV2']);
    Route::post('update/{id}', [ApiBlogController::class, 'update']);
    Route::delete('delete/{id}', [ApiBlogController::class, 'delete']);
});

//type-blog
Route::group(['prefix' => 'type-blog'], function () {
    Route::post('insert', [ApiTypeBlogController::class, 'insert']);
    Route::post('update/{id}', [ApiTypeBlogController::class, 'update']);
    Route::delete('delete/{id}', [ApiTypeBlogController::class, 'delete']);
    Route::get('get/{phase}', [ApiTypeBlogController::class, 'get']);
});

// luongkinh
Route::group(['prefix' => 'luongkinh'], function () {
    Route::post('insert', [ApiLuongKinhController::class, 'insert']);
    Route::delete('delete/{id}', [ApiLuongKinhController::class, 'delete']);
    Route::get('find/{id}', [ApiLuongKinhController::class, 'find']);
    Route::get('get-luong-kinh/{maNguoiDung}/{thoiGian}', [ApiLuongKinhController::class, 'getLuongKinh']);
    Route::post('dong-bo-luong-kinh/{maNguoiDung}', [ApiLuongKinhController::class, 'dongBoLuongKinh']);
});

// quangcao
Route::group(['prefix' => 'quangcao'], function () {
    Route::post('insert', [ApiQuangCaoController::class, 'insert']);
    Route::post('update/{id}', [ApiQuangCaoController::class, 'update']);
    Route::get('find/{phase}/{type}', [ApiQuangCaoController::class, 'find']);
    Route::delete('delete/{id}', [ApiQuangCaoController::class, 'delete']);
});

// clicklink
Route::group(['prefix' => 'clicklink'], function () {
    Route::post('insert', [ApiClickLinkController::class, 'insert']);
});

// clickads
Route::group(['prefix' => 'clickads'], function () {
    Route::post('insert', [ApiClickAdsController::class, 'insert']);
});

// support
Route::group(['prefix' => 'support'], function () {
    Route::get('index', [ApiSupportController::class, 'index']);
});

// loaitvv
Route::group(['prefix' => 'loaitvv'], function () {
    Route::post('insert', [ApiLoaiTvvController::class, 'insert']);
});

// loaisanpham
Route::group(['prefix' => 'loaisanpham'], function () {
    Route::post('insert', [ApiLoaiSanPhamController::class, 'insert']);
    Route::post('update/{id}', [ApiLoaiSanPhamController::class, 'update']);
    Route::post('delete/{id}', [ApiLoaiSanPhamController::class, 'delete']);
});

// sanpham
Route::group(['prefix' => 'sanpham'], function () {
    Route::post('insert', [ApiSanPhamController::class, 'insert']);
    Route::post('update/{id}', [ApiSanPhamController::class, 'update']);
    Route::post('delete/{id}', [ApiSanPhamController::class, 'delete']);
    Route::get('get-all/{maloaisp}', [ApiSanPhamController::class, 'getAll']);
    Route::get('get-limit/{phase}', [ApiSanPhamController::class, 'getLimit']);
    Route::get('get-all-details', [ApiSanPhamController::class, 'getAllDetails']);
    Route::get('get-details-by-id-product/{id}', [ApiSanPhamController::class, 'getDetailsByIdProduct']);
    Route::get('search-products/{phase}', [ApiSanPhamController::class, 'searchProducts']);
    Route::get('get-product-discount', [ApiSanPhamController::class, 'getProductDiscount']);
});

// benh
Route::group(['prefix' => 'benh'], function () {
    Route::post('insert', [ApiBenhController::class, 'insert']);
    Route::post('update/{id}', [ApiBenhController::class, 'update']);
    Route::post('delete/{id}', [ApiBenhController::class, 'delete']);
    Route::get('find/{id}', [ApiBenhController::class, 'find']);
});

// phongkham
Route::group(['prefix' => 'phongkham'], function () {
    Route::post('insert', [ApiPhongKhamController::class, 'insert']);
    Route::post('update/{id}', [ApiPhongKhamController::class, 'update']);
    Route::post('delete/{id}', [ApiPhongKhamController::class, 'delete']);
});

// lichkham
Route::group(['prefix' => 'lichkham'], function () {
    Route::post('insert', [ApiLichKhamController::class, 'insert']);
    Route::post('update/{id}', [ApiLichKhamController::class, 'update']);
    Route::post('delete/{id}', [ApiLichKhamController::class, 'delete']);
});

// danhgia
Route::group(['prefix' => 'danhgia'], function () {
    Route::post('insert', [ApiDanhGiaController::class, 'insert']);
});

// tailieukichsua
Route::group(['prefix' => 'tailieukichsua'], function () {
    Route::get('get-video', [TaiLieuKichSuaController::class, 'getVideo']);
    Route::get('get-image', [TaiLieuKichSuaController::class, 'getImage']);
});

// qrsua
Route::group(['prefix' => 'qrsua'], function () {
    Route::get('get-qrsua', [QrSuaController::class, 'getQrSua']);
    Route::post('update-qrsua/{id}', [QrSuaController::class, 'updateQrSua']);
});

// andam
Route::group(['prefix' => 'andam'], function () {
    Route::post('insert', [ApiAnDamController::class, 'insert']);
    Route::post('update/{id}', [ApiAnDamController::class, 'update']);
    Route::get('find/{id}', [ApiAnDamController::class, 'find']);
    Route::post('delete/{id}', [ApiAnDamController::class, 'delete']);
});

// bubinh
Route::group(['prefix' => 'bubinh'], function () {
    Route::post('insert', [ApiBuBinhController::class, 'insert']);
    Route::post('update/{id}', [ApiBuBinhController::class, 'update']);
    Route::get('find/{id}', [ApiBuBinhController::class, 'find']);
});

// bume
Route::group(['prefix' => 'bume'], function () {
    Route::post('insert', [ApiBuMeController::class, 'insert']);
    Route::post('update/{id}', [ApiBuMeController::class, 'update']);
    Route::get('find/{id}', [ApiBuMeController::class, 'find']);
    Route::post('delete/{id}', [ApiBuMeController::class, 'delete']);
});

// binh
Route::group(['prefix' => 'binh'], function () {
    Route::post('insert', [ApiBinhController::class, 'insert']);
    Route::post('update/{id}', [ApiBinhController::class, 'update']);
    Route::get('find/{id}', [ApiBinhController::class, 'find']);
    Route::post('delete/{id}', [ApiBinhController::class, 'delete']);
});

// con
Route::group(['prefix' => 'con'], function () {
    Route::post('insert', [ApiConnnnnController::class, 'insert']);
    Route::post('update/{id}', [ApiConnnnnController::class, 'update']);
    Route::post('update-trang-thai/{id}/{maNguoiDung}', [ApiConnnnnController::class, 'updateTrangThai']);
    Route::get('find/{id}', [ApiConnnnnController::class, 'find']);
    Route::get('get-by-ma-nguoi-dung/{id}', [ApiConnnnnController::class, 'getConByMaNguoiDung']);
    Route::get('get-by-trang-thai/{id}', [ApiConnnnnController::class, 'getConByTrangThai']);
    Route::post('delete/{id}/{maNguoiDung}', [ApiConnnnnController::class, 'delete']);
});

// loaichoan
Route::group(['prefix' => 'loaichoan'], function () {
    Route::post('insert', [ApiLoaiChoAnController::class, 'insert']);
    Route::post('update/{id}', [ApiLoaiChoAnController::class, 'update']);
    Route::get('find/{id}', [ApiLoaiChoAnController::class, 'find']);
    Route::post('delete/{id}', [ApiLoaiChoAnController::class, 'delete']);
});

// choan
Route::group(['prefix' => 'choan'], function () {
    Route::post('insert', [ApiChoAnController::class, 'insert']);
    Route::post('update/{id}', [ApiChoAnController::class, 'update']);
    Route::post('update-trong-luong/{id}', [ApiChoAnController::class, 'updateTrongLuong']);
    Route::get('find/{id}', [ApiChoAnController::class, 'find']);
    Route::post('delete/{id}', [ApiChoAnController::class, 'delete']);
    Route::get('get-cho-an/{maCon}/{ngayTao}', [ApiChoAnController::class, 'getChoAn']);
    Route::get('get-cho-an-by-ma-loai-cho-an/{maCon}/{ngayTao}', [ApiChoAnController::class, 'getChoAnByMaLoaiChoAn']);
    Route::get('get-cho-an-by-ngay-tao/{maCon}', [ApiChoAnController::class, 'getChoAnByNgayTao']);
});

// phattrien
Route::group(['prefix' => 'phattrien'], function () {
    Route::post('insert', [ApiPhatTrienController::class, 'insert']);
    Route::get('get/{maCon}', [ApiPhatTrienController::class, 'get']);
});

// trieuchung
Route::group(['prefix' => 'trieuchung'], function () {
    Route::post('insert', [ApiTrieuChungController::class, 'insert']);
    Route::get('get/{id_con}', [ApiTrieuChungController::class, 'get']);
});

// hutsua
Route::group(['prefix' => 'hutsua'], function () {
    Route::post('insert', [ApiHutSuaController::class, 'insert']);
    Route::post('update/{id}', [ApiHutSuaController::class, 'update']);
    Route::get('find/{id}', [ApiHutSuaController::class, 'find']);
    Route::post('delete/{id}', [ApiHutSuaController::class, 'delete']);
    Route::get('get-hut-sua-by-ngay-tao/{maNguoiDung}/{ngayTao}', [ApiHutSuaController::class, 'getHutSuaByNgayTao']);
    Route::get('get-hut-sua-7-ngay/{maNguoiDung}', [ApiHutSuaController::class, 'getHutSua7Ngay']);
});

// version
Route::group(['prefix' => 'version'], function () {
    Route::post('insert', [ApiVersionController::class, 'insert']);
    Route::get('get-new-version', [ApiVersionController::class, 'getNewVersion']);
});

// product-details
Route::group(['prefix' => 'product-details'], function () {
    Route::post('insert', [ApiProductDetailController::class, 'insert']);
    Route::post('update/{id}', [ApiProductDetailController::class, 'update']);
    Route::get('get-by-product-id/{product_id}', [ApiProductDetailController::class, 'getByProductId']);
    Route::post('delete/{id}', [ApiProductDetailController::class, 'delete']);
});

// order
Route::group(['prefix' => 'order'], function () {
    Route::post('insert', [ApiOrderController::class, 'insert']);
    Route::post('update/{id}', [ApiOrderController::class, 'update']);
    Route::post('delete/{id}', [ApiOrderController::class, 'delete']);
    Route::get('get/{id}', [ApiOrderController::class, 'get']);
    Route::get('get-order-details/{id}', [ApiOrderController::class, 'getOrderDetails']);
    Route::get('get-order-status/{maNguoiDung}', [ApiOrderController::class, 'getOrderStatus']);
    Route::get('get-order-history/{maNguoiDung}', [ApiOrderController::class, 'getOrderHistory']);
    Route::get('cancel-order/{id}', [ApiOrderController::class, 'cancelOrder']);
});

// vn-units
Route::group(['prefix' => 'vn-units'], function () {
    Route::get('get-provinces', [ApiVietNamUnitsController::class, 'getProvinces']);
    Route::get('get-districts/{province_code}', [ApiVietNamUnitsController::class, 'getDistricts']);
    Route::get('get-wards/{district_code}', [ApiVietNamUnitsController::class, 'getWards']);
});

// tiemchung
Route::group(['prefix' => 'tiemchung'], function () {
    Route::post('insert', [ApiTiemChungController::class, 'insert']);
    Route::post('update/{id_con}/{id_vacxin}', [ApiTiemChungController::class, 'update']);
    Route::get('get/{id_con}/{id_vacxin}', [ApiTiemChungController::class, 'get']);
    Route::post('delete/{id}', [ApiTiemChungController::class, 'delete']);
});

// slide
Route::group(['prefix' => 'slide'], function () {
    Route::get('get-all', [ApiSlideController::class, 'getAll']);
});

// order-details
Route::group(['prefix' => 'order-details'], function () {
    Route::post('insert', [ApiOrderDetailsController::class, 'insert']);
    Route::post('update/{id}', [ApiOrderDetailsController::class, 'update']);
    Route::post('delete/{id}', [ApiOrderDetailsController::class, 'delete']);
});

// address
Route::group(['prefix' => 'address'], function () {
    Route::post('insert', [ApiAddressController::class, 'insert']);
    Route::post('update/{id}/{maNguoiDung}', [ApiAddressController::class, 'update']);
    Route::post('delete/{id}/{maNguoiDung}', [ApiAddressController::class, 'delete']);
    Route::get('get-all-address/{maNguoiDung}', [ApiAddressController::class, 'getAllAddress']);
    Route::post('update-status-address/{id}/{maNguoiDung}', [ApiAddressController::class, 'updateStatusAddress']);
});

// video
Route::group(['prefix' => 'videos'], function () {
    Route::get('get-video', [ApiVideoController::class, 'getVideo']);
    Route::get('get-video-test', [ApiVideoController::class, 'getVideoTest']);
    Route::get('get-test-image', [ApiVideoController::class, 'getTestImage']);
    Route::get('get-link-bu-me', [ApiVideoController::class, 'getLinkMusic']);
});

// type-voucher
Route::group(['prefix' => 'type-voucher'], function () {
    Route::post('insert', [ApiTypeVoucherController::class, 'insert']);
    Route::post('update/{id}', [ApiTypeVoucherController::class, 'update']);
    Route::post('delete/{id}', [ApiTypeVoucherController::class, 'delete']);
});

// voucher
Route::group(['prefix' => 'voucher'], function () {
    Route::post('insert', [ApiVoucherController::class, 'insert']);
    Route::post('update/{id}', [ApiVoucherController::class, 'update']);
    Route::post('delete/{id}', [ApiVoucherController::class, 'delete']);
    Route::get('get-free-ship', [ApiVoucherController::class, 'getFreeShip']);
    Route::get('get-voucher/{maNguoiDung}', [ApiVoucherController::class, 'getVoucher']);
});

// voucher-user
Route::group(['prefix' => 'voucher-user'], function () {
    Route::post('insert', [ApiVoucherUserController::class, 'insert']);
    Route::post('update/{id}', [ApiVoucherUserController::class, 'update']);
    Route::post('delete/{id}', [ApiVoucherUserController::class, 'delete']);
});

// voucher-game
Route::group(['prefix' => 'voucher-game'], function () {
    Route::post('insert', [ApiVoucherGameController::class, 'insert']);
    Route::get('check-turn/{maNguoiDung}', [ApiVoucherGameController::class, 'checkTurn']);
});

//notifications
Route::group(['prefix' => 'notification'], function () {
    Route::post('/send-notification', [NotificationController::class, 'sendNotification']);
});

Route::group(['prefix' => 'notification'], function () {
    Route::get('/notification-user', [ApiNotificationController::class, 'getNotificationUser']);
    Route::get('/notification-order', [ApiNotificationController::class, 'getOrderNotification']);
    Route::get('/notification-details', [ApiNotificationController::class, 'getNotificationDetails']);
});
