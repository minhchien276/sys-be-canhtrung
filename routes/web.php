<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\admin\BlogController;
use App\Http\Controllers\admin\ChartController;
use App\Http\Controllers\admin\ClickLinkController;
use App\Http\Controllers\admin\DanhGiaController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\ErrorController;
use App\Http\Controllers\admin\LinkController;
use App\Http\Controllers\admin\NotificationController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\QrSuaController;
use App\Http\Controllers\admin\QuangCaoController;
use App\Http\Controllers\admin\QuanLyHopTestController;
use App\Http\Controllers\admin\SlideController;
use App\Http\Controllers\admin\TaiLieuKichSuaController;
use App\Http\Controllers\admin\TestResultController;
use App\Http\Controllers\admin\Tvv_NguoiDungController;
use App\Http\Controllers\admin\TvvController;
use App\Http\Controllers\admin\TypeBlogController;
use App\Http\Controllers\admin\VersionController;
use App\Http\Controllers\admin\VideoController;
use App\Http\Controllers\Api\ApiAuthv2Controller;
use App\Http\Controllers\store\DashboardStoreController;
use App\Http\Controllers\store\OrderStoreController;
use App\Http\Controllers\store\VoucherController;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// use Illuminate\Support\Str;

// route::get('/qr', function() {
//     for($i = 9001; $i < 10000 ; $i++)
//     {
//         $x = Str::random(10) . $i . Str::random(10);
//         echo $x."\n";
//     }
// });

Route::prefix('admin')->group(function () {

    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/sign-in', [AuthController::class, 'signIn'])->name('signIn');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('admin.auth');

    //auth
    Route::prefix('auth')->middleware(['admin.auth', 'admin:1'])->group(function () {
        Route::get('/list-accounts', [AuthController::class, 'index'])->name('auth.index');
        Route::post('/create-quyen', [AuthController::class, 'createQuyen'])->name('quyen.create');
        Route::post('/create-account', [AuthController::class, 'createAccount'])->name('account.create');
        Route::get('/get-phanquyen', [AuthController::class, 'getPhanQuyen'])->name('quyen.get');
        Route::get('/load-list-acc', [AuthController::class, 'loadListAcc'])->name('load-list-acc');
        Route::get('/change-password/{id}', [AuthController::class, 'changePassword']);
        Route::post('/change-password/{id}', [AuthController::class, 'updatePassword'])->name('update.password');
        Route::get('/type-accounts/{id}', [AuthController::class, 'typeAccounts']);
        Route::post('/delete/{id}', [AuthController::class, 'delete']);
    });

    //dashboard
    Route::prefix('dashboard')->middleware('admin.auth')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('admin.index');
    });

    //error
    Route::prefix('error')->middleware('admin.auth')->group(function () {
        Route::get('/error-403', [ErrorController::class, 'Error403'])->name('error-403');
    });

    // Quan ly hop test
    Route::prefix('quan-ly-hop-test')->middleware(['admin.auth', 'admin:1,5'])->group(function () {
        Route::get('/index', [QuanLyHopTestController::class, 'index']);
        Route::get('/show-hop-test-da-dung', [QuanLyHopTestController::class, 'showHopTestDaDung'])->name('quan-ly-hop-test.show-hop-test-da-dung');
        Route::get('/show-hop-test-moi', [QuanLyHopTestController::class, 'showHopTestMoi'])->name('quan-ly-hop-test.show-hop-test-moi');
        Route::post('/create', [QuanLyHopTestController::class, 'create'])->name('quan-ly-hop-test.create');
        Route::get('/load-hop-test-list', [QuanLyHopTestController::class, 'loadHopTestList'])->name('load-hop-test-list');

        Route::get('/count-hoptest', [QuanLyHopTestController::class, 'countHopTest'])->name('count-hoptest');
        Route::get('/add-luot-test/{maQuanLyQueTest}', [QuanLyHopTestController::class, 'addLuotTest'])->name('add-luot-test');
        Route::post('/post-add-luot-test/{maQuanLyQueTest}', [QuanLyHopTestController::class, 'postThemQueTrung'])->name('post-add-luot-test');
    });

    // Quan ly QR sua
    Route::prefix('qrsua')->middleware(['admin.auth', 'admin:1,5'])->group(function () {
        Route::get('/show-qrsua', [QrSuaController::class, 'showQrSua'])->name('showQrSua');
        Route::post('/create', [QrSuaController::class, 'create'])->name('qrsua.create');
        Route::get('/load-list-qrsua', [QrSuaController::class, 'loadListQrSua'])->name('load-list-qrsua');
    });

    // Charts
    Route::prefix('chart')->middleware('admin.auth')->group(function () {
        Route::get('/index', [ChartController::class, 'listUsers'])->name('chart.index')->middleware('admin:1');
        Route::get('/details-user/{id}', [ChartController::class, 'detailsUser'])->name('chart.details-user');
        Route::get('/answers/{id}', [ChartController::class, 'answers'])->name('chart.answers')->middleware('admin:1');
        Route::post('/filter-age', [ChartController::class, 'filterAge'])->name('chart.filter-age');
        Route::post('/filter-phase', [ChartController::class, 'filterPhase'])->name('chart.filter-phase');
        Route::post('/filter-create-at', [ChartController::class, 'filterCreateAt'])->name('chart.filter-create-at');
        Route::get('/show-con/{maNguoiDung}', [ChartController::class, 'showCon'])->name('chart.show-con');

        Route::post('/send-notification', [ChartController::class, 'sendNotification'])->name('send-notification');
        Route::post('/update-ketquatest', [ChartController::class, 'updateKetQuaTest'])->name('update-ketquatest');

        Route::get('/export-users', [ChartController::class, 'exportUsers'])->name('export-users');
        Route::get('/search-user', [ChartController::class, 'searchUser'])->name('search-user');

        Route::get('/breast-milk/{id}', [ChartController::class, 'breastMilk'])->name('chart.breast-milk');
    });

    //links
    Route::prefix('link')->middleware(['admin.auth', 'admin:1,3'])->group(function () {
        Route::get('/show', [LinkController::class, 'show'])->name('link.index');
        Route::post('/create', [LinkController::class, 'create'])->name('link.create');
        Route::get('/load-link-list', [LinkController::class, 'loadLinkList'])->name('load-link-list');

        Route::get('/edit-link/{id}', [LinkController::class, 'edit'])->name('edit.link');
        Route::post('/update/{id}', [LinkController::class, 'update'])->name('update.link');
    });

    //blogs
    Route::prefix('blog')->middleware(['admin.auth', 'admin:1,3'])->group(function () {
        Route::get('/find-by-type/{id}', [BlogController::class, 'findByType'])->name('blog.findByType');
        Route::post('/create', [BlogController::class, 'create'])->name('blog.create');
        Route::post('/delete/{id}', [BlogController::class, 'delete'])->name('delete-blog');
        Route::post('/update/{id}', [BlogController::class, 'update'])->name('blog.update');
    });

    //type-blog
    Route::prefix('type-blog')->middleware(['admin.auth', 'admin:1,3'])->group(function () {
        Route::get('/index', [TypeBlogController::class, 'index'])->name('blog.index');
        Route::post('/create', [TypeBlogController::class, 'create'])->name('type-blog.create');
        Route::post('/delete/{id}', [TypeBlogController::class, 'delete'])->name('delete-type-blog');
        Route::put('/update/{id}', [TypeBlogController::class, 'update'])->name('type-blog-update');
    });

    //quangcao
    Route::prefix('quangcao')->middleware(['admin.auth', 'admin:1,3'])->group(function () {
        Route::get('/index', [QuangCaoController::class, 'index'])->name('quangcao.index');
        Route::post('/create', [QuangCaoController::class, 'create'])->name('quangcao.create');
        Route::get('/load-quang-cao-list', [QuangCaoController::class, 'loadQuangCaoList'])->name('load-quang-cao-list');
        Route::get('/edit/{id}', [QuangCaoController::class, 'edit'])->name('quangcao.edit');
        Route::post('/update/{id}', [QuangCaoController::class, 'update'])->name('quangcao.update');
    });

    //clicklink
    Route::prefix('clicklink')->middleware(['admin.auth', 'admin:1,3'])->group(function () {
        Route::get('/index', [ClickLinkController::class, 'index'])->name('clicklink.index');
        Route::post('/check-clicks', [ClickLinkController::class, 'checkClicks'])->name('check.clicks');
        Route::post('/check-clicks-month', [ClickLinkController::class, 'checkClicksMonth'])->name('check.clicks-month');

        Route::get('/export-click-link', [ClickLinkController::class, 'exportClickLink'])->name('export-click-link');
    });

    //tuvanvien
    Route::prefix('tuvanvien')->middleware(['admin.auth', 'admin:1,2'])->group(function () {
        Route::get('/index', [TvvController::class, 'index'])->name('tvv.index');
        Route::get('/edit/{id}', [TvvController::class, 'edit'])->name('tvv.edit');
        Route::post('/update/{id}', [TvvController::class, 'update'])->name('tvv.update');
        Route::get('/create', [TvvController::class, 'create'])->name('tvv.create');
        Route::post('/store', [TvvController::class, 'store'])->name('tvv.store');

        //loaitvv
        Route::post('/create-type-tvv', [TvvController::class, 'createTypeTvv'])->name('loaitvv.create');
        Route::get('/load-type-tvv-list', [TvvController::class, 'loadTypeTvvList'])->name('load-type-tvv-list');
        Route::post('/delete-type-tvv/{id}', [TvvController::class, 'deleteTypeTvv']);

        //tvv_nguoidung
        Route::get('/tvv-nguoidung/{id}', [TvvController::class, 'tvv_nguoidung'])->name('tvv-nguoidung');
        Route::post('/find-user', [TvvController::class, 'findUserByPhoneNumber'])->name('find-user');
        Route::get('/add-user/{id}', [TvvController::class, 'AddUser'])->name('add-user');
    });

    //danhgia
    Route::prefix('danhgia')->middleware(['admin.auth', 'admin:1'])->group(function () {
        Route::get('/index', [DanhGiaController::class, 'index'])->name('danhgia.index');
        Route::get('/show-danh-gia/{id}', [DanhGiaController::class, 'showDanhGia'])->name('danhgia.show');
        Route::get('/edit-sao/{id}', [DanhGiaController::class, 'editSao'])->name('edit.sao');
        Route::post('/update-sao/{id}', [DanhGiaController::class, 'updateSao'])->name('update.sao');
    });

    //version
    Route::prefix('version')->middleware(['admin.auth', 'admin:1'])->group(function () {
        Route::get('/index', [VersionController::class, 'index'])->name('version.index');
        Route::get('/create', [VersionController::class, 'create'])->name('version.create');
        Route::post('/store', [VersionController::class, 'store'])->name('version.store');
    });

    //tailieukichsua
    Route::prefix('tailieukichsua')->middleware(['admin.auth', 'admin:1'])->group(function () {
        Route::get('/', [TaiLieuKichSuaController::class, 'index'])->name('tailieukichsua.index');
        Route::get('/create', [TaiLieuKichSuaController::class, 'create'])->name('tailieukichsua.create');
        Route::post('/store', [TaiLieuKichSuaController::class, 'store'])->name('tailieukichsua.store');
        Route::get('/edit/{id}', [TaiLieuKichSuaController::class, 'edit'])->name('tailieukichsua.edit');
        Route::post('/update/{id}', [TaiLieuKichSuaController::class, 'update'])->name('tailieukichsua.update');
    });

    //video
    Route::prefix('video')->middleware(['admin.auth', 'admin:1'])->group(function () {
        Route::get('/index', [VideoController::class, 'index'])->name('video.index');
        Route::get('/create', [VideoController::class, 'create'])->name('video.create');
        Route::post('/store', [VideoController::class, 'store'])->name('video.store');
        Route::get('/edit/{id}', [VideoController::class, 'edit'])->name('video.edit');
        Route::post('/update/{id}', [VideoController::class, 'update'])->name('video.update');
    });

    //product
    Route::prefix('product')->middleware(['admin.auth', 'admin:1'])->group(function () {
        Route::get('/index', [ProductController::class, 'index'])->name('product.index');
        Route::get('/create', [ProductController::class, 'create'])->name('product.create');
        Route::post('/store', [ProductController::class, 'store'])->name('product.store');
        Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
        Route::post('/update/{id}', [ProductController::class, 'update'])->name('product.update');

        Route::get('/nam-gioi', [ProductController::class, 'namGioi'])->name('product.nam-gioi');
        Route::get('/nu-gioi', [ProductController::class, 'nuGioi'])->name('product.nu-gioi');
        Route::get('/da-va-lam-dep', [ProductController::class, 'daVaLamDep'])->name('product.da-va-lam-dep');
        Route::get('/me-va-be', [ProductController::class, 'meVaBe'])->name('product.me-va-be');
        Route::get('/tuoi-day-thi', [ProductController::class, 'tuoiDayThi'])->name('product.tuoi-day-thi');
        Route::get('/dang-giam-gia', [ProductController::class, 'discounting'])->name('product.dang-giam-gia');

        // detalis
        Route::get('/product-details/{id}', [ProductController::class, 'productDetails'])->name('product.product-details');
        Route::get('/edit-product-details/{id}', [ProductController::class, 'editProductDetails'])->name('product.edit-product-details');
        Route::get('/create-details/{id}', [ProductController::class, 'createProductDetails'])->name('product.create-details');
        Route::post('/create-product-details/{id}', [ProductController::class, 'updateOrInsert'])->name('product.create-product-details');
        Route::post('/store-product-details', [ProductController::class, 'storeDetail'])->name('product.store-product-details');

        // categories
        Route::get('/create-category', [ProductController::class, 'createCategory'])->name('product.create-category');
        Route::post('/store-category', [ProductController::class, 'storeCategory'])->name('product.store-category');

        Route::get('/list-categories', [ProductController::class, 'listCategories'])->name('product.list-categories');
        Route::get('/edit-category/{id}', [ProductController::class, 'editCategory'])->name('product.edit-category');
        Route::post('/update-category/{id}', [ProductController::class, 'updateCategory'])->name('product.update-category');
    });

    //slide
    Route::prefix('slide')->middleware(['admin.auth', 'admin:1'])->group(function () {
        Route::get('/index', [SlideController::class, 'index'])->name('slide.index');
        Route::get('/create', [SlideController::class, 'create'])->name('slide.create');
        Route::post('/store', [SlideController::class, 'store'])->name('slide.store');
        Route::get('/edit/{id}', [SlideController::class, 'edit'])->name('slide.edit');
        Route::post('/update/{id}', [SlideController::class, 'update'])->name('slide.update');
    });

    //notification
    Route::prefix('notification')->middleware(['admin.auth', 'admin:1'])->group(function () {
        Route::get('/', [NotificationController::class, 'index'])->name('notification.index');
        Route::post('/send-notification', [NotificationController::class, 'sendNotification'])->name('notification.send');
    });

    //test-result
    Route::prefix('test-result')->middleware(['admin.auth', 'admin:1'])->group(function () {
        Route::get('/index', [TestResultController::class, 'index'])->name('test-result.index');
        Route::get('/create', [TestResultController::class, 'create'])->name('test-result.create');
        Route::post('/store', [TestResultController::class, 'store'])->name('test-result.store');
        Route::get('/edit/{id}', [TestResultController::class, 'edit'])->name('test-result.edit');
        Route::post('/update/{id}', [TestResultController::class, 'update'])->name('test-result.update');
    });
});

Route::prefix('store')->group(function () {

    //dashboard
    Route::prefix('dashboard')->middleware('admin.auth')->group(function () {
        Route::get('/', [DashboardStoreController::class, 'indexStore'])->name('store.index');
        Route::get('/order_by_day', [DashboardStoreController::class, 'orderByDay'])->name('store.order_by_day');
    });

    //orders
    Route::prefix('orders')->middleware(['admin.auth', 'admin:1'])->group(function () {
        Route::get('/index', [OrderStoreController::class, 'index'])->name('store.order.index');
        Route::get('/search-orders', [OrderStoreController::class, 'searchOrders'])->name('store.order.search-orders');
        Route::get('/order-details/{id}', [OrderStoreController::class, 'orderDetails'])->name('store.order.order-details');
        Route::get('/edit-status/{id}', [OrderStoreController::class, 'editStatus'])->name('store.order.edit-status');
        Route::post('/update-status/{id}', [OrderStoreController::class, 'updateStatus'])->name('store.order.update-status');
    });

    //vouchers
    Route::prefix('vouchers')->middleware(['admin.auth', 'admin:1'])->group(function () {
        Route::get('/index', [VoucherController::class, 'index'])->name('store.vouchers.index');
        Route::get('/create', [VoucherController::class, 'create'])->name('store.vouchers.create');
        Route::post('/store', [VoucherController::class, 'store'])->name('store.vouchers.store');
        Route::get('/edit/{id}', [VoucherController::class, 'edit'])->name('store.vouchers.edit');
        Route::post('/update/{id}', [VoucherController::class, 'update'])->name('store.vouchers.update');
    });
});

Route::get('redirect-to-app', [ApiAuthv2Controller::class, 'redirectToApp']);
