<template>
    <div>
        <loading v-model:active="isLoading" :color="backGroundcolor" />
        <div class="pt-2">
            <router-link to="/order">Back</router-link>

        </div>
        <div class="order-detail">
            <div class="head-detail">
                <div class="title-order-detail flex items-center justify-between">
                    <p class="text-gray-800 font-medium py-3">
                        Chi tiết đơn hàng #{{ order_id }}
                    </p>
                    <div class="flex items-center justify-center">
                        <p class="mx-5 font-semibold">Trạng thái: {{ data[0]?.status_name }}</p>

                    </div>
                </div>
            </div>
            <div class="main-order-detail">
                <div class="info-order-detail bg-white rounded">
                    <HeadOrder :orderId="order_id" :date="data[0]?.created_at" />
                    <div class="border-b w-[95%] mx-auto"></div>
                    <div class="flex">
                        <div class="border-r w-[60%]">
                            <div class="p-4">
                                <div class="flex items-center mb-3">
                                    <p class="font-medium text-gray-800">
                                        Người đặt hàng:
                                    </p>
                                    <p class="text-red-500">
                                        {{ data[0]?.username }}
                                    </p>
                                </div>
                                <div class="mb-3">
                                    <p>Số điện thoại: {{ data[0]?.phone }}</p>
                                </div>
                                <div class="mb-3">
                                    Địa chỉ: {{ address.ward + ", " + address.district + ", " + address.province }}
                                </div>
                                <div class="mb-3">
                                    Địa chỉ chi tiết: {{ address.note }}
                                </div>
                            </div>
                            <div class="border-b w-[95%] mx-auto"></div>
                            <div class="p-3">
                                <div>
                                    <div class="flex mb-3">
                                        <p>Mã đặt hàng:</p>
                                        <p>
                                            {{
        data[0]?.order_code ??
        "Chưa xác định"
}}
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        Mã vận đơn:
                                        {{ data[0]?.code ?? "Chưa xác định" }}
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="w-[40%] p-3">
                            <div class="note-title">Ghi chú</div>
                            <div class="note-descript">
                                <p>{{ data[0]?.note }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="border-b mx-auto w-[95%]"></div>
                    <div class="p-3 flex">
                        Website:
                        <p v-for="item in listShop" :key="item.id" class="text-red-800">
                            {{ item }}.com,
                        </p>
                    </div>
                </div>
                <div class="product-order-detail mt-8">
                    <div class="product-order-head bg-red-700 p-4 rounded-t">
                        <div class="title-product-order">
                            <p class="text-[17px] text-white">Sản phẩm</p>
                        </div>
                    </div>
                    <div class="product-order-main bg-white flex pb-8">
                        <div class="product-list-order pt-3 overflow-auto h-[500px] w-[70%]">
                            <div class="my-5" v-for="(value, index) in data" :key="index">
                                <div class="items-product flex items-center p-2">
                                    <div class="left-product flex">
                                        <div class="img-product w-[100px] h-[100px]">
                                            <img :src="value.image_link" class="w-full h-full" alt="" />
                                        </div>
                                        <div class="content-product flex justify-between ml-5">
                                            <div class="max-w-[60%]">
                                                <p class="max-w-[80%]">
                                                    {{ value.product_name }}
                                                </p>
                                                <div class="flex items-center">
                                                    <div>Thuộc tính</div>
                                                    <div class="p-1 m-2 ">
                                                        {{ value.properties }}
                                                    </div>
                                                </div>
                                                <div class="flex items-center">
                                                    <div>Số lượng</div>
                                                    <div class="p-1 m-2 ">
                                                        {{ value.quantity_bought }}

                                                    </div>
                                                </div>
                                                <div class="flex items-center">
                                                    <div>Mô tả</div>
                                                    <div class="p-1 text-[10px] m-2 bg-blue-500 rounded">
                                                        <a class=" text-white " :href="value.url" target="_blank">
                                                            Xem chi tiết
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="flex items-center">
                                                    <div class="text-gray-800">
                                                        Bảo hành: không
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex">
                                                <div class="ml-10">
                                                    <div class="price">
                                                        <div class="cost border-b-2">
                                                            Giá:
                                                            {{
        formatPrice(
            value.price
        )
}}
                                                        </div>
                                                        <div class="promotion">
                                                            Khuyến mãi:
                                                            {{
        formatPrice(
            value.promotion_price
        )
}}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="ml-10">
                                                    <div class="price">
                                                        <div class="cost border-b-2">
                                                            Tổng
                                                        </div>
                                                        <div class="promotion font-bold">
                                                            {{
        formatPrice(
            value.price_table
        )
}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-[30%]">
                            <div class="border w-full">
                                <div class="price1 p-3 flex items-center border-b justify-between">
                                    <div class="font-bold">Giá tạm tính</div>
                                    <div>{{ formatPrice(this.total_price) }}</div>
                                </div>
                                <div class="price1 p-3 flex items-center border-b justify-between">
                                    <div class="font-bold">Phí mua hàng</div>
                                    <div>{{ formatPrice(this.fee.fee_purchase) }}</div>
                                </div>
                                <div class="price1 p-3 flex items-center border-b justify-between">
                                    <div class="font-bold">Phí kiểm hàng</div>
                                    <div>{{ formatPrice(this.fee.fee_inventory) }}</div>
                                </div>
                                <div class="price1 p-3 flex items-center border-b justify-between"
                                    v-if="this.fee.wood != 0">
                                    <div class="font-bold">Phí đóng gỗ {{ this.fee.name_fee }}</div>
                                    <div>{{ formatPrice(this.fee.wood)
}}</div>
                                </div>
                                <!-- <div class="price1 p-3 flex items-center border-b justify-between">
                                    <div class="font-bold">Phí vận chuyển nội địa TQ</div>
                                    <div>{{ formatPrice(this.fee.china_shipping_fee) }}</div>
                                </div> -->
                                <div class="price1 p-3 flex items-center border-b justify-between">
                                    <div class="font-bold">Phí vận chuyển TQ->VN</div>
                                    <div>{{ formatPrice(this.fee.global_shipping_fee) }}</div>
                                </div>
                                <div class="price1 p-3 flex items-center border-b justify-between">
                                    <div class="font-bold">Đã trả</div>
                                    <div>
                                        {{
        formatPrice(data[0]?.deposit_amount)
}}
                                    </div>
                                </div>
                                <div class="price1 p-3 flex items-center border-b justify-between">
                                    <div class="font-bold">Còn lại</div>
                                    <div>
                                        {{
        formatPrice(data[0]?.remaining_amount)
}}
                                    </div>
                                </div>
                                <div class="price1 p-3 flex items-center bg-red-500 justify-between">
                                    <div class="font-bold text-white">
                                        Tổng tiền
                                    </div>
                                    <div class="text-white">
                                        <div>{{ formatPrice(price) }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style>

</style>
<script>
import HeadOrder from "./HeadOrderComponent.vue";
import { get, update, updateOrderPacket } from "../../../services/order/order.js";
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';
export default {
    watch: {
        $route: {
            immediate: true,
            handler(to, from) {
                document.title = 'Chi tiết đơn hàng';
            }
        },
    },
    components: {
        Loading
    },
    data() {
        return {
            data: [],
            order_id: 0,
            status_id: 0,
            price: 0,
            feeOrder: 0,
            total_price: 0,
            listShop: [],
            isLoading: true,
            listWebsite: [],
            address: {
                district: "",
                province: "",
                ward: "",
                note: ""
            },
            fee: {
                fee_purchase: 0,
                fee_inventory: 0,
                global_shipping_fee: 0,
                china_shipping_fee: 0,
                wood: 0,
                name_fee: null
            }
        };
    },
    created() {
        this.order_id = this.$route.params.id;
        this.getOrderDetail();
    },
    mounted() { },
    methods: {
        getOrderDetail() {
            this.isLoading = true;
            let express_shipping_fee = 0;
            let inventory_fee = 0;
            let purchase_fee = 0;
            get({
                id: this.order_id,
            }).then((res) => {
                // console.log(res.data);
                this.isLoading = false;
                this.data = res.data;
                this.address.district = res.data[0].district;
                this.address.province = res.data[0].province;
                this.address.ward = res.data[0].ward;
                this.address.note = res.data[0].addressdetail;

                this.data.forEach((item) => {
                    this.total_price = item.total_price;
                    this.price = item.total_price_order;
                    // this.feeOrder =item.express_shipping_fee+item.global_shipping_fee+item.inventory_fee+item.purchase_fee
                    // express_shipping_fee = item.express_shipping_fee;
                    // inventory_fee = item.global_shipping_fee;
                    // purchase_fee = item.purchase_fee;
                    this.fee.fee_inventory = item.inventory_fee;
                    this.fee.fee_purchase = item.purchase_fee;
                    this.fee.global_shipping_fee = item.global_shipping_fee;
                    this.fee.china_shipping_fee = item.china_shipping_fee;
                    this.fee.wood = item.separately_wood_packing_fee ? item.separately_wood_packing_fee : item.wood_packing_fee;
                    this.fee.name_fee = item.separately_wood_packing_fee ? "riêng" : "";
                    if (item.source === "TAOBAO") {
                        this.listShop.push("taobao");
                    } else if (item.source === "1688") {
                        this.listShop.push("1688");
                    } else if (item.source === "TMALL") {
                        this.listShop.push("tmall");
                    }
                    this.status_id = item.status_id
                });
                this.listShop = [...new Set(this.listShop)];

            });
        },
        updateStatus(event) {
            update(this.order_id, this.status_id).then(res => {
                //Send email
            })
        },

        formatPrice(value) {
            return new Intl.NumberFormat("en-US", {
                style: "currency",
                currency: "VND",
            }).format(value);
        },
    },

    components: {
        HeadOrder,
    },
};
</script>