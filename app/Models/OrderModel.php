<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OrderModel extends Model
{
    use HasFactory;
    protected $table = 'orders';

    //get total order
    public function totalOrders()
    {
        $data = DB::table('orders')
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->count();
        return $data;
    }
    // get All order
    public function getAllOders($params)
    {
        $data = DB::table('orders')
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->join('order_statuses', 'order_statuses.id', '=', 'orders.order_status_id')
            ->select(
                'orders.id',
                'users.username',
                'users.phone',
                'orders.source',
                'orders.total_price',
                'orders.total_price_order',
                'orders.global_shipping_fee',
                'order_statuses.status_name',
                'orders.created_at'
            )
            ->orderBy('orders.created_at', 'desc');
        if ($params['from']) {
            $data->orWhereDate('orders.created_at', '>=', $params['from']);
        }
        if ($params['to']) {
            $data->orWhereDate('orders.created_at', '>=', $params['to']);
        }
        if ($params['username']) {
            $data->orWhere('users.username', 'like', "%{$params['username']}%");
        }
        if ($params['phone']) {
            $data->orWhere('users.phone', '=', $params['phone']);
        }
        $orders = $data->paginate(10);
        return $orders;
    }

    //get order
    public function getOrders($params)
    {
        $total_status_orders = DB::table('order_statuses')->select(
            'id as status_id',
            'status_name'
        )
            ->get()
            ->map(function ($count_status) {
                $count_status->total_status = DB::table('orders')
                    ->where('order_status_id', $count_status->status_id)
                    ->where('is_delete', 0)
                    ->get()->count();
                return $count_status;
            });
        $orders = DB::table('orders')
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->leftJoin('packets', 'packets.order_id', 'orders.id')
            ->join('order_statuses', 'order_statuses.id', '=', 'orders.order_status_id')
            ->select(
                'orders.id',
                'orders.created_at',
                'users.username',
                'orders.source',
                'packets.code',
                'orders.total_price',
                'orders.total_price_order',
                'orders.global_shipping_fee',
                'order_statuses.status_name',
                'orders.order_code'
            );


        if ($params['from']) {
            $orders->orWhereDate('orders.created_at', '>=', $params['from']);
        }
        if ($params['to']) {
            $orders->orWhereDate('orders.created_at', '<=', $params['to']);
        }
        if ($params['username']) {
            $orders->Where('users.username', 'like', '%' . $params['username'] . '%');
        }
        if ($params['status']) {
            $orders->Where('order_statuses.id', '=', $params['status']);
        }
        $orders->orderBy('orders.created_at', 'Desc');
        $data = [
            "total_status" => $total_status_orders,
            "orders" => $orders->paginate(15),
        ];
        return $data;
    }

    //update order
    public function updateStatusOrder($params)
    {
        $resp = DB::table('orders')
            ->where('id', $params['id'])
            ->update(['order_status_id' => $params['status_id']]);
        return $resp;
    }

    public function detailOrder($params)
    {
        $order = DB::table('orders')
            ->leftJoin('order_products', 'order_products.order_id', '=', 'orders.id')
            ->leftJoin('users', 'users.id', '=', 'order_products.user_id')
            ->leftJoin("user_addresses", "user_addresses.id", "=", "orders.address_id")
            ->leftJoin('packets', 'packets.order_id', 'orders.id')
            ->leftJoin('order_statuses', 'order_statuses.id', '=', 'orders.order_status_id')
            ->leftJoin("checking_orders", "checking_orders.order_id", '=', 'orders.id')
            ->select(
                'orders.*',
                "checking_orders.order_code as shippingcode",
                "checking_orders.required_note as required",
                "checking_orders.status_name as shippingStatus",
                "checking_orders.cod_amount as codAmount",
                "user_addresses.province",
                "user_addresses.district",
                "user_addresses.ward",
                "user_addresses.note as addressdetail",
                "user_addresses.phone",
                'order_products.*',
                'orders.created_at as created_at',
                'users.username',
                'users.phone',
                'packets.code',
                'order_statuses.id as status_id',
                'order_statuses.status_name'
            )
            ->where('orders.order_code', '=', $params['id'])
            ->get();
        // dd($order[0]);

        return $order;
    }
    public function getdetailOrderUpdate($params)
    {
        $order = DB::table('orders')
            ->leftJoin('order_products', 'order_products.order_id', '=', 'orders.id')
            ->leftJoin('users', 'users.id', '=', 'order_products.user_id')
            ->leftJoin("user_addresses", "user_addresses.id", "=", "orders.address_id")
            ->leftJoin('packets', 'packets.order_id', 'orders.id')
            ->leftJoin('order_statuses', 'order_statuses.id', '=', 'orders.order_status_id')
            ->leftJoin("checking_orders", "checking_orders.order_id", '=', 'orders.id')
            ->select(
                'orders.*',
                "checking_orders.order_code as shippingcode",
                "checking_orders.required_note as required",
                "checking_orders.status_name as shippingStatus",
                "checking_orders.cod_amount as codAmount",
                "user_addresses.province",
                "user_addresses.district",
                "user_addresses.ward",
                "user_addresses.note",
                "user_addresses.phone",
                'order_products.*',
                'orders.created_at as created_at',
                'users.username',
                'users.phone',
                'orders.id as orderid',
                'packets.code',
                'order_statuses.id as status_id',
                'order_statuses.status_name',
                'packets.status as statusPackage',
                'packets.opt_order_checking as opt_order_checking',
                'packets.opt_auto_shipping as opt_auto_shipping',
                'packets.opt_saving_shipping as opt_saving_shipping',
                'packets.opt_express_shipping as opt_express_shipping',
                'packets.opt_inventory as opt_inventory',
                'packets.opt_wood_packing as opt_wood_packing',
                'packets.opt_separate_wood_packing as opt_separate_wood_packing',
                'packets.weight as weight',
                'packets.volume as volume',
                'packets.quantity_buy as quantitybuy',
                'packets.quantity_receive as quantityreceive',
                'order_products.product_name as ProductName',
                'order_products.id as ProductId',
                'order_products.quantity_bought as quantity_bought',
                'order_products.quantity_received as quantity_received',
                'order_products.shop_id as ShopIdProduct',
            )
            ->where('orders.order_code', '=', $params['id'])
            ->get();
        $orderShop = DB::table("order_detail")->where("order_id", $order[0]->orderid)->get();
        $feeGlobalShip = DB::table("configs")->where("key", "FEE_ORDER")->first();

        return [$order, $orderShop, $feeGlobalShip];
    }

    public function updateStatusOrderWithPacket($orderId, $statusId)
    {
        DB::table('orders')
            ->where('id', $orderId)
            ->update(['order_status_id' => $statusId]);

        // Update time change status
        if ($statusId == 6) {
            $this->updateTimeChangeStatus($orderId, 'time_receive');
        }
        if ($statusId == 7) {
            $this->updateTimeChangeStatus($orderId, 'time_transport');
        }
    }

    public function updateTimeChangeStatus($orderId, $param)
    {
        $dateNow = date("Y-m-d H:i:s");
        DB::table('packets')
            ->where('order_id', $orderId)
            ->update([$param => $dateNow]);
    }
    public function updatePacketOrder($params)
    {

        $itemOrder = DB::table("orders")->where("order_code", $params["order_id"])->first();
        $order_detail = DB::table("order_detail")->where("order_id", $itemOrder->id)->get();
        $checkCode = DB::table("packets")->where("code", $params["code"])->first();
        // if()
        if ($checkCode && $checkCode->order_id != $itemOrder->id) {
            return ["message" => "Mã $checkCode->code đã tồn tại trong hệ thống", "status" => false];
        }
        $resp =  DB::table("packets")->where("order_id", $itemOrder->id)->update([
            'weight' => $params['weight'],
            'volume' => $params['volume'],
            'quantity_buy' => $params['quantity_buy'],
            'quantity_receive' => $params['quantity_receive'],
            'opt_order_checking' => $params['opt_order_checking'],
            'opt_auto_shipping' => $params['opt_auto_shipping'],
            'opt_saving_shipping' => $params['opt_saving_shipping'],
            'opt_express_shipping' => $params['opt_express_shipping'],
            'opt_inventory' => $params['opt_inventory'],
            'opt_wood_packing' => $params['opt_wood_packing'],
            'opt_separate_wood_packing' => $params['opt_separate_wood_packing'],
            'code' => $params['code']
        ]);
        $totalShip = 0;
        foreach ($order_detail as $index => $item) {
            $totalShip += $params["fee_ship"][$index];
            DB::table("order_detail")->where("id", $item->id)->update([
                'fee_ship' => $params["fee_ship"][$index],
                'note' => $params['noteShop'][$index]
            ]);
        }
        $quantity_received = 0;
        $totalPriceShop = 0;
        foreach ($params['products'] as $item) {
            $quantity_received += +$item["quantity_received"];
            $totalPriceShop += $item['price'] * $item['quantity_received'];

            DB::table("order_products")->where("id", $item["id"])->update(["quantity_received" => $item["quantity_received"]]);
        }
        // Lấy ra tổng tiền của sản phẩm 


        $totalPrice =  $itemOrder->total_price;
        $totalPuchaseFee = $this->getFeePurchase(
            'PURCHASE_FEE',
            $totalPriceShop
        ) *  $totalPriceShop / 100;

        if ($quantity_received == 0) {
            $totalPriceOrder = $totalPrice + $totalShip + $params['global_shipping_fee'] + $itemOrder->inventory_fee + $totalPuchaseFee;
        } else {
            $totalPriceOrder = $totalPriceShop + $totalShip + $params['global_shipping_fee'] + $itemOrder->inventory_fee + $totalPuchaseFee + $params['seperately_wood_packing_fee'] + $params["wood_packing_fee"];
        }
        DB::table("orders")->where("order_code", $params["order_id"])->update([
            "china_shipping_fee" => $totalShip, 'global_shipping_fee' => $params['global_shipping_fee'],
            "total_price" => $quantity_received == 0 ? $totalPrice : $totalPriceShop,
            "total_price_order" => $totalPriceOrder,
            "purchase_fee" => $totalPuchaseFee,
            "separately_wood_packing_fee" => $params['seperately_wood_packing_fee'],
            "wood_packing_fee" => $params["wood_packing_fee"]
        ]);

        return ["data" => $resp, "status" => true];
    }

    public function getOrderCreate($from = null, $to = null)
    {
        $q = DB::table('orders')
            ->select(
                DB::raw("COUNT(orders.id) as total"),
                DB::raw("ABS(SUM(orders.deposit_amount)) as total_deposite")
            );

        if ($from) {
            $q->where('created_at', '>=', $from);
        }
        if ($to) {
            $q->where('created_at', '<=', $to);
        }
        return $q->first();
    }
    public function configFeePayTqVn($num, $warehouse, $wood_packing)
    {
        // dd($warehouse);
        if ($num == 0) {
            return 0;
        }
        $stock = $warehouse == 1 ? 'HN' : 'SG';
        $fee_check = DB::table('configs')->where('key', 'TRANSPORT_CN_VN_FEE')
            ->pluck('value')
            ->first();
        $fee_check = json_decode($fee_check, true);
        $fee_config_woodpacking = 0;
        if ($wood_packing == "WOOD_FEE") {
            $fee_config_woodpacking = $this->getFeeConfigNumber('WOOD_FEE');
        }
        if ($wood_packing == "OWN_WOOD_FEE") {
            $fee_config_woodpacking = $this->getFeeConfigNumber('OWN_WOOD_FEE');
        }
        // dd($fee_config_woodpacking);
        $fee_wood_packing = $fee_config_woodpacking * $num;
        foreach ($fee_check as $key => $value) {
            if ($num <= $value['min']) {
                return [
                    $fee_check[$key - 1][$stock],
                    $fee_check[$key - 1],
                    $fee_wood_packing
                ];
            }
            if ($key == sizeof($fee_check) - 1) {
                return [
                    $fee_check[$key][$stock],
                    $fee_check[$key - 1],
                    $fee_wood_packing
                ];
            }
        }
    }


    public function getFeePurchase($opt_fee, $num)
    {
        if ($num == 0) {
            return 0;
        }
        $fee_check = DB::table('configs')->where('key', $opt_fee)
            ->pluck('value')
            ->first();
        $fee_check = json_decode($fee_check, true);

        foreach ($fee_check as $key => $value) {
            if ($value['min'] >= $num) {
                return $fee_check[$key - 1]['value'];
            }
            if ($key == sizeof($fee_check) - 1) {
                return $fee_check[$key]['value'];
            }
        }
    }

    public  function getFeeConfig($opt_fee, $quantity)
    {
        if ($quantity == 0) {
            return 0;
        }
        $fee_check = DB::table('configs')->where('key', $opt_fee)
            ->pluck('value')
            ->first();
        $fee_check = json_decode($fee_check, true);
        foreach ($fee_check as $key => $value) {
            if ($value['min'] >= $quantity) {
                return $fee_check[$key - 1]['value_1'];
            }
            if ($key == sizeof($fee_check) - 1) {
                return $fee_check[$key]['value_1'];
            }
        }
    }
    public function getFeeConfigNumber($opt_fee)
    {
        $fee_check = DB::table('configs')->where('key', $opt_fee)
            ->pluck('value')
            ->first();
        return $fee_check;
    }
}
