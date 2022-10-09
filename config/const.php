<?php
return [
    'transaction_type' => [
        'top_up' => 2,
        'adjust' => 6
    ],
    'pagination' => [
        'per_page' => 10,
    ],
    'admin_transaction_type' => [
        'currency_exchange' => 1,
        'payment' => 2,
        'warehouse_fee' => 3,
        'transport_fee' => 4,
        'staff_fee' => 5,
        'orther_fee' => 6,
        'order' => 7,
        'package_fee' => 8,
        'cancel_purchase' => 9
    ],
    'config' => [
        'EXCHANGE_RATE' => 'EXCHANGE_RATE',
        'CHECKING_FEE' => 'CHECKING_FEE',
        'WOOD_FEE' => 'WOOD_FEE',
        'OWN_WOOD_FEE' => 'OWN_WOOD_FEE',
        'DEPOSIT_FEE' => 'DEPOSIT_FEE',
        'AUTO_DELIVERY_FEE' => 'AUTO_DELIVERY_FEE',
        'SAVINGS_DELIVERY_FEE' => 'SAVINGS_DELIVERY_FEE',
        'FAST_DELIVERY_FEE' => 'FAST_DELIVERY_FEE',
        'PURCHASE_FEE' => 'PURCHASE_FEE',
        'TRANSPORT_CN_VN_FEE' => 'TRANSPORT_CN_VN_FEE',
    ],
    'order_status' => [
        'deposited' => 1,
        'purchased' => 4,
        'shop_delivery' => 5,
        'received_warehouse' => 6,
        'transport' => 7,
        'wait_delivery' => 8,
        'wait_delivery_request' => 9,
        'delivering' => 10,
        'customers_received' => 11,
        'cancel' => 13,
        'lost' => 14,
    ],
    'admin_packet_status' => [
        1 => 'Kho nhận hàng',
        2 => 'Vận chuyển',
        3 => 'Chờ giao',
        4 => 'Chờ yêu cầu giao',
        5 => 'Đang giao',
        6 => 'Đã giao'
    ],
    'admin_role' => [
        'admin' => 1,
        'admin_warehouse' => 2,
        'admin_buyer' => 3
    ]
];
