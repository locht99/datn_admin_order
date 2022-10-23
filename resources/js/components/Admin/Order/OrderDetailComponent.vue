<template>
    <div>
        <div class="order-detail">
            <div class="head-detail">
                <div class="title-order-detail">
                    <p class="text-gray-800 font-medium py-3">Chi tiết đơn hàng #{{ order_id }}</p>
                </div>
            </div>
            <div class="main-order-detail">
                <div class="info-order-detail bg-white rounded">
                    <HeadOrder />
                    <div class="border-b w-[95%] mx-auto"></div>
                    <div class="flex ">
                        <div class="border-r w-[60%]">
                            <div class="p-4 ">
                                <div class="flex items-center mb-3">
                                    <p class="font-medium text-gray-800">Người đặt hàng:</p>
                                    <p> Customer</p>
                                </div>
                                <div class="mb-3">
                                    <p>Số điện thoại: 0123456789</p>
                                </div>
                                <div class="mb-3">
                                    Địa chỉ: 63/33/71 Lê đức thọ, Nam từ liêm, Hà Nội
                                </div>
                            </div>
                            <div class="border-b w-[95%] mx-auto"></div>
                            <div class="p-3">
                                <div>
                                    <div class="flex mb-3">
                                        <p>Mã đặt hàng (Taobao, 1688) </p>
                                        <p> 001223</p>
                                    </div>
                                    <div class="mb-3">
                                        Mã vận đơn: 08888
                                    </div>
                                </div>
                                <div class="mb-3">
                                    Shop đặt hàng: Taobao.com
                                </div>
                            </div>
                        </div>
                        <div class="w-[40%] p-3">
                            <div class="note-title">Ghi chú</div>
                            <div class="note-descript">
                                <p>Giao hàng cẩn thận giúp em</p>
                            </div>
                        </div>
                    </div>
                    <div class="border-b mx-auto w-[95%]"></div>
                    <div class="p-3 flex">
                        Website:
                        <p class="text-red-800">TAOBAO</p>
                    </div>
                </div>
                <div class="product-order-detail mt-8">
                    <div class="product-order-head bg-red-700 p-4 rounded-t	">
                        <div class="title-product-order">
                            <p class="text-[17px] text-white">Sản phẩm</p>
                        </div>
                    </div>
                    <div class="product-order-main bg-white flex pb-8">
                        <div class="product-list-order pt-3 overflow-auto h-[500px] w-[70%]">
                            <div class="" v-for="value in data">
                                <div class="items-product flex items-center">
                                    <div class="left-product flex">
                                        <div class="img-product w-[100px] h-[100px]">
                                            <img src="https://gw.alicdn.com/bao/uploaded/i2/2143811104/O1CN017P3tMd1K1g17FSkyl_!!2143811104.jpg_220x10000Q75.jpg"
                                                class="w-full h-full" alt="">
                                        </div>
                                        <div class="content-product flex items-center">
                                            <div>
                                                <p>
                                                    Konggeins美式街头麂皮绒短袖t恤设计感字母印花夏季宽
                                                </p>
                                                <div class="flex items-center">
                                                    <div>
                                                        Mô tả
                                                    </div>
                                                    <div class="bg-blue-500 rounded text-white p-1 text-[10px] m-2">
                                                        Xem chi tiết
                                                    </div>
                                                </div>
                                                <div class="flex items-center">
                                                    <div class="text-gray-800">Bảo hành: không</div>
                                                </div>
                                            </div>
                                            <div class="flex">
                                                <div class="ml-10">
                                                    <div class="price">
                                                        <div class="cost border-b-2">
                                                            Giá: 2100.00
                                                        </div>
                                                        <div class="promotion">
                                                            Khuyến mãi: 0.00
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="ml-10">
                                                    <div class="price">
                                                        <div class="cost border-b-2">
                                                            Tổng
                                                        </div>
                                                        <div class="promotion font-bold">
                                                            20,000,000 đ
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
                                    <div class="font-bold">Giá vốn</div>
                                    <div>2.000</div>
                                </div>
                                <div class="price1 p-3 flex items-center border-b justify-between">
                                    <div class="font-bold">Giá vốn</div>
                                    <div>2.000</div>
                                </div>
                                <div class="price1 p-3 flex items-center border-b justify-between">
                                    <div class="font-bold">Đã trả</div>
                                    <div>2.000</div>
                                </div>
                                <div class="price1 p-3 flex items-center bg-red-500 justify-between">
                                    <div class="font-bold text-white">Tổng tiền</div>
                                    <div class="text-white">2.000</div>
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
import axios from 'axios';
import HeadOrder from './HeadOrderComponent.vue';
import { get } from "../../../services/order/order.js";
export default {

    data() {
        return {
            data: [1, 2, 3, 4, 5, 6],
            order_id: ''
        }
    },
    mounted() {
        this.order_id = this.$route.params.id
        this.getOrderDetail()
    },
    methods: {
        getOrderDetail(){
            get({
                id: this.order_id
            }).then(res => console.log(res))
        }
    },

    components: {
        HeadOrder
    }
}
</script>