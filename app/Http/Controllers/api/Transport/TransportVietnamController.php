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
        ->where('id','=', 1)->get();
        // $data = [
        //     "payment_type_id" => 2,
        //     "required_note" => "KHONGCHOXEMHANG",
        //     "client_order_code" => "",
        //     "to_name" => "Độ Mixi",
        //     "to_phone" => "0909998877",
        //     "to_address" => "Streaming house",
        //     "to_ward_name" => "Phường 14",
        //     "to_district_name" => "Quận 10",
        //     "to_province_name" => "TP Hồ Chí Minh",
        //     "cod_amount" => 200000,
        //     "content" => "Theo New York Times",
        //     "weight" => 200,
        //     "length" => 1,
        //     "width" => 19,
        //     "height" => 10,
        //     "service_id" => 0,
        //     "service_type_id" => 2,

        // ];
        // $response = Http::withHeaders([
        //     'token' => '989b92f1-59ed-11ed-9ad7-269dd9db11fd',
        //     'ShopId' => 120427
        // ])->post('https://dev-online-gateway.ghn.vn/shiip/public-api/v2/shipping-order/create', $data);
        // if ($response) {
        //     $data['order_code'] = $response['data']['order_code'];
        // }
        // $model = new TransportGhnModel();
        // $resp = $model->createCheckingOrder($data);
        var_dump($get_order_by_id[0]);
        // return response()->json($get_order_by_id[0]);
    }
}
