<?php

namespace App\Http\Controllers\api\Transport;

use App\Http\Controllers\Controller;
use App\Models\TransportGhnModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class TransportVietnamController extends Controller
{
    public function createOrderGhn(Request $request)
    {
        $get_order_by_id = DB::table('orders')
        ->where('id','=', 199)->first();
        $get_user_by_id = DB::table('users')
        ->join('user_addresses', 'user_addresses.user_id', '=', 'users.id')
        ->select(
            'users.*',
            'user_addresses.name as name_user',
        )->where('users.id', '=', $get_order_by_id->user_id)->first();
        $data = [
            "payment_type_id" => $request->payment_type_id,
            "required_note" => $request->required_note,
            "client_order_code" => $request->client_order_code,
            "to_name" => $get_user_by_id->name_user,
            "to_phone" => $get_user_by_id->phone,
            "to_address" => "Streaming house",
            "to_ward_name" => "Phường 14",
            "to_district_name" => "Quận 10",
            "to_province_name" => "TP Hồ Chí Minh",
            "cod_amount" => $request->cod_amount,
            "content" => $request->content,
            "weight" => $request->weight,
            "length" => $request->length,
            "width" => $request->width,
            "height" => $request->height,
            "service_id" => $request->service_id,
            "service_type_id" => $request->service_type_id,
        ];
        $response = Http::withHeaders([
            'token' => '989b92f1-59ed-11ed-9ad7-269dd9db11fd',
            'ShopId' => 120473,
            'Content-Type'=> 'application/json',
        ])->post('https://dev-online-gateway.ghn.vn/shiip/public-api/v2/shipping-order/create', $data);
        // if ($response) {
        //     $data['order_code'] = $response['data']['order_code'];
        // }
        // $model = new TransportGhnModel();
        // $resp = $model->createCheckingOrder($data);
        // var_dump($response);
        return response()->json($response);
    }
}
