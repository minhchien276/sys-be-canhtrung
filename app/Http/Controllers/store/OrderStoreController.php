<?php

namespace App\Http\Controllers\store;

use App\Enums\TypeNotificationEnum;
use App\Http\Controllers\Controller;
use App\Models\nguoidung;
use App\Models\notification;
use App\Models\order;
use App\ServicesAdmin\Notification\PushNotificationSpecific;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderStoreController extends Controller
{
    private $push_noti;

    public function __construct(
        PushNotificationSpecific $push_noti
    ) {
        $this->push_noti = $push_noti;
    }

    public function index()
    {
        $orders = DB::table('orders')
            ->leftJoin('nguoidung', 'orders.maNguoiDung', '=', 'nguoidung.maNguoiDung')
            ->leftJoin('order_status', 'orders.status', '=', 'order_status.id')
            ->select('nguoidung.tenNguoiDung', 'orders.*', 'order_status.name as name_status')
            ->orderBy('orders.created_at', 'desc')
            ->get();

        $orders->map(function ($item) {
            $item->created_at = Carbon::createFromTimestamp($item->created_at / 1000)->toDateTimeString();
            return $item;
        });

        return view('store.order.order_index',  compact('orders'));
    }

    public function searchOrders(Request $request)
    {
        $search = '%' . $request->search . '%';

        $orders =  DB::table('orders')
            ->leftJoin('nguoidung', 'orders.maNguoiDung', '=', 'nguoidung.maNguoiDung')
            ->leftJoin('order_status', 'orders.status', '=', 'order_status.id')
            ->select('nguoidung.tenNguoiDung', 'orders.*', 'order_status.name as name_status')
            ->where('orders.content', 'like', $search)
            ->orWhere('orders.name', 'like', $search)
            ->orderBy('orders.created_at', 'desc')
            ->get();

        $orders->map(function ($item) {
            $item->created_at = Carbon::createFromTimestamp($item->created_at / 1000)->toDateTimeString();
            return $item;
        });

        return view('store.order.order_index',  compact('orders'));
    }

    public function orderDetails($id)
    {
        $orders = DB::table('orders')
            ->leftJoin('nguoidung', 'orders.maNguoiDung', '=', 'nguoidung.maNguoiDung')
            ->leftJoin('order_status', 'orders.status', '=', 'order_status.id')
            ->select('nguoidung.tenNguoiDung', 'orders.*', 'order_status.name as name_status')
            ->where('orders.id', $id)
            ->first();

        if ($orders) {
            $orders->created_at = Carbon::createFromTimestamp($orders->created_at / 1000)->toDateTimeString();
        }

        $order_details = DB::table('order_detail')
            ->leftJoin('product_detail', 'product_detail.id', '=', 'order_detail.id_product_detail')
            ->leftJoin('sanpham', 'sanpham.id', '=', 'product_detail.product_id')
            ->where('order_detail.id_order', $id)
            ->select('sanpham.name', 'sanpham.image', 'product_detail.sale', 'order_detail.quantity')
            ->get();

        return view('store.order.order_details',  compact('orders', 'order_details'));
    }

    public function editStatus($id)
    {
        $order = DB::table('orders')
            ->leftJoin('nguoidung', 'orders.maNguoiDung', '=', 'nguoidung.maNguoiDung')
            ->leftJoin('order_status', 'orders.status', '=', 'order_status.id')
            ->select('nguoidung.tenNguoiDung', 'orders.*', 'order_status.name as name_status')
            ->where('orders.id', $id)
            ->first();

        return view('store.order.update_status_order',  compact('order'));
    }

    public function updateStatus(Request $request, $id)
    {
        try {
            $now = Carbon::now()->timestamp * 1000;

            $status = $request->status;
            $text = '';

            switch ($status) {
                case 1:
                    $text = 'đang được xử lý';
                    break;
                case 2:
                    $text = 'đã được xác nhận';
                    break;
                case 3:
                    $text = 'đã được vận chuyển';
                    break;
                case 4:
                    $text = 'đã được giao thành công';
                    break;
                case 5:
                    $text = 'đã hủy';
                    break;
                default:
                    $text = 'Trạng thái không xác định';
                    break;
            }

            order::where('id', $id)->update(['status' => $status]);

            $order = order::findOrFail($id);
            $maNguoiDung = $order->maNguoiDung;
            $content = $order->content;

            $device_token = nguoidung::where('maNguoiDung', $maNguoiDung)->value('device_token');

            notification::create([
                'title' => 'OVUMB THÔNG BÁO',
                'content' => 'Đơn hàng #' . $content . 'của bạn ' . $text,
                'receiverId' => $maNguoiDung,
                'senderId' => 0,
                'applicationId' => $order->id,
                'type' => TypeNotificationEnum::OrderNotification,
                'seen' => 0,
                'createdAt' => $now,
            ]);

            $this->push_noti->sendNotification($device_token, 'OVUMB THÔNG BÁO', 'Đơn hàng #' . $content . ' của bạn ' . $text, TypeNotificationEnum::OrderNotification, $order->id);
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Đã có lỗi xảy ra!' . $e->getMessage());
        } finally {
            return $this->index();
        }
    }
}
