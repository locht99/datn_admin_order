<template>
    <div class="pt-6 relative duration-300">
        <loading v-model:active="isLoading" :color="backGroundcolor" />
        <div class="flex justify-between">
            <div class="title">
                <h1 class="text-[#566a7f] text-[28px] font-[700]">
                    Chi tiết bao hàng
                </h1>
                <div class="text-gray-500">
                    <router-link class="text-gray-700" to="/bag">Back</router-link>
                </div>
            </div>
        </div>
        <div class="main mt-6 bg-white">
            <table class="w-full rounded-t-md overflow-hidden bg-white">
                <thead class="bg-[#FF3F3A] text-white h-[40px] font-bold text-[16px]">
                    <tr class="px-2 text-center">
                        <th class="">ID</th>
                        <th>MÃ ĐƠN HÀNG</th>
                        <th class="pl-5">TÀI KHOẢN</th>
                        <th>TỔNG TIỀN</th>
                        <th>NGÀY ĐẶT HÀNG</th>
                        <th>THAO TÁC</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in this.data_bag_detail" :key="index"
                        class="border-solid text-center border-b-[1px] border-[#E2E2E2] h-[52px] font-[16px]">
                        <td class="font-bold">#{{ index += 1 }}</td>
                        <td>{{ item.order_code }}</td>
                        <td class="pl-5">{{ item.username }}</td>
                        <td>{{ formatPrice(item.total_price) }}</td>
                        <td>{{ item.created_at }}</td>
                        <td  v-if="this.status_bag === 'Gói hàng được giao thành công (China)'">
                            <a-button type="primary" class="mx-2" danger @click="actionShipping(item.order_id)">
                                    <font-awesome-icon icon="fa-solid fa-truck-fast" />
                            </a-button>
                        </td>
                        <td class="text-red-600" v-if="this.status_bag !== 'Gói hàng được giao thành công (China)'">Đơn
                            hàng chưa về đến kho Việt Nam</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <AddShipingComponent v-if="this.showModal == true" :showModalAction="this.showModals" :item="this.item"
        @interface="getChildOrder" v-on:showModal="updateOpenModal($event)"></AddShipingComponent>
</template>

<script>
import AddShipingComponent from "../Bag/AddShipingComponent.vue";
import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/vue-loading.css";
import { getDetailBag, checkStatusTrackingBag } from '../../../services/Bag/bag.js'
export default {
    components: {
        AddShipingComponent,
        Loading,
    },
    childInterface: {
        getIdOrder: (item) => { }
    },
    data() {
        return {
            item: Number,
            showModals: false,
            showModal: false,
            isLoading: true,
            backGroundcolor: "#E93B3B",
            data_bag_detail: [],
            status_bag: []
        }
    },
    created() {
        this.actionGetDetailBag();
        this.actionCheckStatusBag();
    },
    methods: {
        actionGetDetailBag(page = 1) {
            this.page = page;
            getDetailBag(this.$route.params.id).then((resp) => {
                this.isLoading = false;
                this.data_bag_detail = resp.data.data
            })
        },
        getChildOrder(childInterface) {
            this.$options.childInterface = childInterface;

        },
        actionCheckStatusBag() {
            checkStatusTrackingBag(this.$route.params.id).then((resp) => {
                this.status_bag = resp.data.tracking_status_name
            })
        },
        updateOpenModal(event) {
            this.showModals = !event;
        },
        actionShipping(order_id) {
            this.item = order_id
            this.showModal = true;
            this.showModals = !this.showModals;
            this.$options.childInterface.getIdOrder(this.item);
        },
        formatPrice(value) {
            return new Intl.NumberFormat("en-US", {
                style: "currency",
                currency: "VND",
            }).format(value);
        },

    }
}
</script>