<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\OrderModel;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function createLogTrackingCn(Request $request)
    {
        try {
            $data = DB::table('admin_packets')
                ->join('admin_packet_items', 'admin_packet_items.admin_packet_id', '=', 'admin_packets.id')
                ->select(
                    'admin_packet_items.order_id'
                )
                ->where('admin_packets.code', '=', $request->shipping_code)
                ->get();

            foreach ($data as $key) {
                $obj_data = [
                    'order_id' => $key->order_id,
                    'name' => $request->status_name,
                    'tracking_status_name' => $request->tracking_status_name . ' (China)',
                    'created_at' => Carbon::now('Asia/Ho_Chi_Minh')
                ];
                DB::table('tracking_statuses')->insert($obj_data);
            }
            if ($request->tracking_status_name == "Gói hàng được giao thành công") {
                $paid = 1;
            } else {
                $paid = 0;
            }
            DB::table('admin_packets')
                ->where('code', '=', $request->shipping_code)
                ->update([
                    'tracking_status_name' => $request->tracking_status_name . ' (China)',
                    'paid' => $paid
                ]);
            $bag_id = DB::table('admin_packets')
                ->select(
                    'id'
                )
                ->where('code', '=', $request->shipping_code)->first();
            $order_id = DB::table('admin_packet_items')->select(
                'order_id'
            )->where('admin_packet_id', '=', $bag_id->id)->get();
            foreach ($order_id as $key) {
                if ((int)$request->delivery_status === 4) {
                    DB::table('orders')->where('id', '=', $key->order_id)->update(['order_status_id' => 7]);
                } else if ((int)$request->delivery_status === 3) {
                    DB::table('orders')->where('id', '=', $key->order_id)->update(['order_status_id' => 14]);
                } else if ((int)$request->delivery_status === 2) {
                    DB::table('orders')->where('id', '=', $key->order_id)->update(['order_status_id' => 11]);
                } else if ((int)$request->delivery_status === 1) {
                    DB::table('orders')->where('id', '=', $key->order_id)->update(['order_status_id' => 10]);
                }
            }
            return response()->json(['success' => "Cập nhật thành công"], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => "Hệ thống đang lỗi vui lòng thử lại sau!"], 400);
        }
    }
    public function updatePriceOrder(Request $request)
    {
        try {
            DB::table('orders')->where('id', '=', $request->id_order)
                ->update([
                    'remaining_amount' => $request->remaining_amount,
                    'express_shipping_fee' => $request->express_shipping_fee,
                    'total_price_order' => $request->total_order_price
                ]);
            return response()->json(['success' => "Cập nhật thành công"], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => "Hệ thống đang lỗi vui lòng thử lại sau!"], 400);
        }
    }
    public function getOrders(Request $request)
    {
        try {
            $search = [
                'from' => $request->from ? $request->from : null,
                'to' => $request->to ? $request->to : null,
                'username' => $request->username ? $request->username : null,
                'status' => $request->status ? $request->status : null,
            ];
            $model = new OrderModel();
            $orders = $model->getOrders($search);
            return response()->json($orders, 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => "Hệ thống đang lỗi vui lòng thử lại sau!"], 400);
        }
    }

    public function updateStatusOrder(Request $request)
    {
        try {
            $params = [
                'id' => $request->id,
                'status_id' => $request->status_id
            ];
            $model = new OrderModel();
            $model->updateStatusOrder($params);
            return response()->json(['success' => "Update status order success"], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => "Update status order failed, Please try again!"], 400);
        }
    }
    public function updateOrder(Request $request)
    {
    }

    public function detailOrder(Request $request)
    {
        try {
            $params = [
                'id' => $request->id
            ];
            $model = new OrderModel();
            $data = $model->detailOrder($params);
            return response()->json($data, Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json(['error' => "Hệ thống đang lỗi vui lòng thử lại sau!"], 400);
            $model = new OrderModel();
            $params = explode(',', rtrim($request->id, ','));
            $data = [];
            if (count($params) > 1) {
                for ($i = 0; $i < count($params); $i++) {
                    $item = DB::table('order_products')->where('order_products.order_id', '=', $params[$i])->get();
                    foreach ($item as $key) {
                        array_push($data, $key);
                    }
                }
                return response()->json($data, Response::HTTP_OK);
            } else {

                $params = [
                    'id' => $request->id
                ];
                $data = $model->detailOrder($params);
                return response()->json($data, Response::HTTP_OK);
            }
        }
    }
    public function getDetailOrderUpdate(Request $request)
    {
        // try {
        $params = [
            'id' => $request->id
        ];
        $order = DB::table("orders")->where("order_code", $request->id)->first();
        $checkPacket = DB::table('admin_packet_items')->where("order_id", $order->id)->first();
        $model = new OrderModel();
        if ($checkPacket) {
            return response()->json([
                "message" => "Đã tồn tại bao hàng không thể sửa"
            ], 400);
        }
        $data = $model->getDetailOrderUpdate($params);

        return response()->json($data, Response::HTTP_OK);
        // } catch (\Throwable $th) {
        // }
    }
    public function updateOrderPacking(Request $request)
    {
        $model = new OrderModel();
        $result =  $model->updatePacketOrder($request->all());
        if ($result['status'] == false) {
            return response()->json(["failed" => $result["message"], "status" => $result['status']], 422);
        }
        return response()->json(['success' => "Update status order success"], 200);
    }
    public function orderPricecaculation(Request $request)
    {
        $model = new OrderModel();
        $kg = $request->kg;
        $warehouse = $request->warehouse_id;
        $wood = $request->wood_packing;
        $result = $model->configFeePayTqVn($kg, $warehouse, $wood);

        return response()->json([
            'data' => $result
        ], 200);
    }
}
