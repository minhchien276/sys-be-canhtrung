<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\OrderDetails\createOrderDetails;
use App\Services\OrderDetails\deleteOrderDetails;
use App\Services\OrderDetails\updateOrderDetails;
use App\Supports\Responder;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiOrderDetailsController extends Controller
{
    private $createOrderDetails;
    private $updateOrderDetails;
    private $deleteOrderDetails;

    public function __construct(
        createOrderDetails $createOrderDetails,
        updateOrderDetails $updateOrderDetails,
        deleteOrderDetails $deleteOrderDetails,
    ){
        $this->middleware('auth:api');
        $this->createOrderDetails = $createOrderDetails;
        $this->updateOrderDetails = $updateOrderDetails;
        $this->deleteOrderDetails = $deleteOrderDetails;
    }

    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'quantity' => 'required',
            'price' => 'required',
            'id_order' => 'required',
            'id_product_detail' => 'required',
            'created_at' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'status' => false
            ], 400);
        }

        try {
            $order_details = $this->createOrderDetails->handle($request);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($order_details, 'Order details created successfully');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'quantity' => 'required',
            'price' => 'required',
            'id_product_detail' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'status' => false
            ], 400);
        }

        try {
            $order_details = $this->updateOrderDetails->handle($request, $id);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($order_details, 'Order details updated successfully');
    }

    public function delete($id)
    {
        try {
            $order_details = $this->deleteOrderDetails->handle($id);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($order_details, 'Order details deleted successfully');
    }
}
