<?php

namespace App\Http\Controllers\api\Transport;

use App\Http\Controllers\Controller;
use App\Models\TransportGhnModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class TransportVietnamController extends Controller
{
    public function createOrderGhn(Request $request)
    {
        $data = [
            'payment_type_id' => $request->payment_type_id,
            'note' => $request->note,
            'order_id' => $request->order_id,
            'required_note' => $request->required_note,
            'client_order_code' => $request->client_order_code,
            'to_name' => $request->to_name,
            'to_phone' => $request->to_phone,
            'to_address' => $request->to_address,
            'to_ward_name' => $request->to_ward_name,
            'to_district_name' => $request->to_district_name,
            'to_province_name' => $request->to_province_name,
            'cod_amount' => $request->cod_amount,
            'content' => $request->content,
            'weight' => $request->weight,
            'length' => $request->length,
            'width' => $request->width,
            'height' => $request->height,
            'service_id' => $request->service_id,
            'service_type_id' => $request->service_type_id,
            'order_code' => $request->order_code,
            'user_id' => $request->user_id,
            'status_name' => $request->status_name

        ];
        $model = new TransportGhnModel();
        $resp = $model->createCheckingOrder($data);
        return response()->json($resp);
    }

    public function getOrderById(Request $request)
    {
        $data = DB::table('orders')->where("id", $request->id)->get();
        return response()->json($data);
    }
    public function getAddressById(Request $request)
    {
        $data = DB::table('user_addresses')
            ->join('users', 'users.id', '=', 'user_addresses.user_id')
            ->select(
                "users.phone",
                "user_addresses.*"
            )
            ->where('user_addresses.id', $request->address_id)->get();
        return response()->json($data);
    }

    public function createLogTracking(Request $request)
    {
        $data = [
            'order_id' => $request->order_id,
            'tracking_status_name' => $request->tracking_status_name,
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh')
        ];
        $resp = DB::table('tracking_statuses')->insert($data);
        return response()->json($resp);
    }
}