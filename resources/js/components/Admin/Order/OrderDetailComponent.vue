<template>
    <div>
        <div class="order-detail">
            <div class="head-detail">
                <div class="title-order-detail flex items-center justify-between">
                    <p class="text-gray-800 font-medium py-3">
                        Chi tiết đơn hàng #{{ order_id }}
                    </p>
                    <div class="flex items-center justify-center">
                        <p class="mx-5">Trạng thái:</p>
                        <select class="h-10 rounded cursor-pointer" v-model="status_id" @change="updateStatus($event)">
                            <option value="1">Đã đặt cọc</option>
                            <option value="4">Đã mua hàng</option>
                            <option value="5">Shop giao hàng</option>
                            <option value="6">Kho nhận hàng</option>
                            <option value="7">Vận chuyển</option>
                            <option value="8">Chờ giao hàng</option>
                            <option value="9">Chờ yêu cầu giao</option>
                            <option value="10">Đang giao hàng</option>
                            <option value="11">Khách hàng nhận hàng</option>
                            <option value="13">Hủy bỏ</option>
                            <option value="14">Thất lạc</option>
                        </select>
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
                                    Địa chỉ chi tiết: {{address.note}}
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
                                <!-- <div class="mb-3">
                                    Shop đặt hàng:
                                    <span v-for="item in listShop" :key="item.id">{{ item }}.
                                    </span>
                                </div> -->
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
                                                    <div>Mô tả</div>
                                                    <div class="bg-blue-500 rounded text-white p-1 text-[10px] m-2">
                                                        Xem chi tiết
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
                                                                        value.price
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
                                    <div class="font-bold">Phí dịch vụ (tạm tính)</div>
                                    <div>{{ formatPrice(feeOrder) }}</div>
                                </div>
                                <div class="price1 p-3 flex items-center border-b justify-between">
                                    <div class="font-bold">Đã trả</div>
                                    <div>
                                        {{
                                                formatPrice(data[0]?.deposit_amount)
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
import { get, update } from "../../../services/order/order.js";
export default {
    data() {
        return {
            data: [],
            order_id: 0,
            status_id: 0,
            price: 0,
            feeOrder: 0,
            total_price: 0,
            listShop: [],
            listWebsite: [],
            address: {
                district:"",
                province:"",
                ward:"",
                note:""
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
            let express_shipping_fee = 0;
            let inventory_fee = 0;
            let purchase_fee = 0;
            get({
                id: this.order_id,
            }).then((res) => {
                this.data = res.data;
                this.address.district = res.data[0].district;
                this.address.province = res.data[0].province;
                this.address.ward = res.data[0].ward;
                this.address.note = res.data[0].note;

                this.data.forEach((item) => {
                    this.total_price = item.total_price;
                    this.price = item.total_price_order;
                    // this.feeOrder =item.express_shipping_fee+item.global_shipping_fee+item.inventory_fee+item.purchase_fee
                    express_shipping_fee = item.express_shipping_fee;
                    inventory_fee = item.global_shipping_fee;
                    purchase_fee = item.purchase_fee;
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
                this.feeOrder = +express_shipping_fee + +inventory_fee + +purchase_fee;
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