<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Order\cancelOrder;
use App\Services\Order\createOrder;
use App\Services\Order\deleteOrder;
use App\Services\Order\getOrder;
use App\Services\Order\getOrderDetails;
use App\Services\Order\getOrderHistory;
use App\Services\Order\getOrderStatus;
use App\Services\Order\updateOrder;
use App\Supports\Responder;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiOrderController extends Controller
{
    private $createOrder;
    private $updateOrder;
    private $deleteOrder;
    private $getOrder;
    private $getOrderDetails;
    private $getOrderStatus;
    private $getOrderHistory;
    private $cancelOrder;

    public function __construct(
        createOrder $createOrder,
        updateOrder $updateOrder,
        deleteOrder $deleteOrder,
        getOrder $getOrder,
        getOrderDetails $getOrderDetails,
        getOrderStatus $getOrderStatus,
        getOrderHistory $getOrderHistory,
        cancelOrder $cancelOrder,
    ) {
        $this->middleware('auth:api');
        $this->createOrder = $createOrder;
        $this->updateOrder = $updateOrder;
        $this->deleteOrder = $deleteOrder;
        $this->getOrder = $getOrder;
        $this->getOrderDetails = $getOrderDetails;
        $this->getOrderStatus = $getOrderStatus;
        $this->getOrderHistory = $getOrderHistory;
        $this->cancelOrder = $cancelOrder;
    }

    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'maNguoiDung' => 'required',
            'address' => 'required',
            'payment_method' => 'required',
            'status' => 'required',
            'total_price' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'status' => false
            ], 400);
        }

        try {
            $order = $this->createOrder->handle($request);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return $order;
    }

    public function update($id)
    {
        try {
            $order = $this->updateOrder->handle($id);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($order, 'Order updated successfully');
    }

    public function delete($id)
    {
        try {
            $order = $this->deleteOrder->handle($id);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }
        
        return Responder::success($order, 'Order deleted successfully');
    }

    public function get($id)
    {
        try {
            $order = $this->getOrder->handle($id);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }
        
        return Responder::success($order, 'Order get successfully');
    }

    public function getOrderDetails($id)
    {
        try {
            $order = $this->getOrderDetails->handle($id);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }
        
        return Responder::success($order, 'Order get successfully');
    }

    public function getOrderStatus($maNguoiDung)
    {
        try {
            $order = $this->getOrderStatus->handle($maNguoiDung);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }
        
        return Responder::success($order, 'Order get successfully');
    }

    public function getOrderHistory($maNguoiDung)
    {
        try {
            $order = $this->getOrderHistory->handle($maNguoiDung);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }
        
        return Responder::success($order, 'Order get successfully');
    }

    public function cancelOrder($id)
    {
        try {
            $order = $this->cancelOrder->handle($id);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }
        
        return Responder::success($order, 'Order cancel successfully');
    }
}
