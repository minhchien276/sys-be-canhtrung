<?php

namespace App\Services\Order;

use App\Enums\TypeNotificationEnum;
use App\Mail\OrderSuccessNotification;
use App\Models\notification;
use App\Models\order;
use App\Models\order_detail;
use App\Models\voucher_game;
use App\Models\voucher_user;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class createOrder
{
    public function handle($request)
    {
        DB::beginTransaction();

        try {
            $or = order::create([
                "maNguoiDung" => $request->maNguoiDung,
                "address" => $request->address,
                "payment_method" => $request->payment_method,
                "status" => $request->status,
                "total_price" => $request->total_price,
                "ship_price" => $request->ship_price,
                "sale_price" => $request->sale_price,
                "final_price" => $request->final_price,
                "name" => $request->name,
                "phone" => $request->phone,
                "content" => $request->content,
                "created_at" => $request->created_at,
            ]);

            foreach ($request->detail as $item) {
                order_detail::create([
                    "quantity" => $item['quantity'],
                    "price" => $item['price'],
                    "id_order" => $or->id,
                    "id_product_detail" => $item['id_product_detail'],
                    "created_at" => Carbon::now()->timestamp,
                ]);
            }

            if ($request->type_id == 2) {
                $check = DB::table('voucher_user')->where('voucher_id', $request->voucher_id)->where('maNguoiDung', $request->maNguoiDung)->first();

                if ($check) {
                    DB::table('voucher_user')->where('id', $check->id)->update(['status' => 1]);
                } else {
                    DB::table('voucher_user')->insert([
                        "maNguoiDung" => $request->maNguoiDung,
                        "voucher_id" => $request->voucher_id,
                        'status' => 1,
                        "created_at" => Carbon::now()->toDateTimeString(),
                    ]);
                }
            }

            if ($request->type_id == 3) {
                voucher_game::where('voucher_id', $request->voucher_id)->where('maNguoiDung', $request->maNguoiDung)->update(['status' => 1]);
            }

            // $order = [
            //     "content" => $request->content,
            //     "price" => $request->total_price,
            // ];   

            // Mail::to('trantuanhiep.dev@gmail.com')->send(new OrderSuccessNotification($order));

            $or->id = $or->id;

            DB::commit();

            return response()->json([
                'data' => $or,
                'message' => "success",
                'status' => true,
            ], 200);
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}
