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
            'order_code' => $request->order_code

        ];
        $model = new TransportGhnModel();
        $resp = $model->createCheckingOrder($data);
        return response()->json($resp);
    }
}
