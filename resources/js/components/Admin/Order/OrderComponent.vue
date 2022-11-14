<template>
    <div class="pt-6 relative duration-300">
        <loading v-model:active="isLoading" :color="backGroundcolor" />
        <div>
            <div class="order">
                <div class="head-order flex justify-between items-center">
                    <div class="title-order">
                        <h1 class="text-[#566a7f] text-[28px] font-[700]">
                            Đơn Hàng
                        </h1>
                    </div>
                    <div class="filter-order">
                        <span
                            class="text-[23px] cursor-pointer hover:bg-white px-4 rounded-full"
                            @click="open_filter()"
                        >
                            <button>
                                <font-awesome-icon icon="fas fa-sliders-h" />
                            </button>
                        </span>
                    </div>
                </div>
                <div class="main-order">
                    <div
                        class="status-table flex items-center bg-red-600 rounded-t-[10px]"
                    >
                        <div
                            v-for="data in dataStatus"
                            :key="data.id"
                            class="w-full flex items-center hover:underline text-white hover:text-white py-1 px-[10px] text-[13px] cursor-pointer"
                        >
                            <button>
                                {{ data.status_name }}
                            </button>
                            <div class="bg-white text-black rounded-xl w-[25px] text-center ml-1">{{ data.total_status }}</div>
                        </div>
                    </div>
                    <table
                        class="table-auto w-full border text-center bg-white"
                    >
                        <thead>
                            <tr>
                                <th
                                    v-for="(dataTable, index) in nameTable"
                                    :key="index"
                                    class="border-b bg-gray-200 text-[15px]"
                                >
                                    {{ dataTable.name }}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="(item, index) in data"
                                :key="index"
                                class="hover:bg-gray-100 border-b"
                            >
                                <td>{{ index + 1 + (this.page - 1) * 20 }}</td>
                                <td>
                                    <router-link :to="{path: 'orderdetail/'+item.id}" class="hover:underline text-red-600">#{{ item.id }}</router-link>
                                </td>
                                <td>{{ item.created_at }}</td>
                                <td>{{ item.username }}</td>
                                <td>{{ item.code }}</td>
                                <td>{{ formatPrice(item.total_price) }}</td>
                                <td>{{ item.status_name }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <Pagination
                        v-if="dataPagination.last_page > 1"
                        class="mx-3 my-3"
                        :pagination="dataPagination"
                        :offset="5"
                        @pagination-change-page="getListOrder"
                    ></Pagination>
                </div>
            </div>
        </div>
        <Filter
            v-on:filter_action="updateOpenFilter($event)"
            v-on:values_filter="searchOrders($event)"
            :filter="this.openFilter"
            :styleFilter="this.styleFilter"
        />
    </div>
</template>
<script>
import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/vue-loading.css";
import Pagination from "../../pagination/Pagination.vue";
import Filter from "../Filter/FilterComponent.vue";
import { getAll } from "../../../services/order/order.js";
export default {
    props: ["values_filter"],
    components: {
        Loading,
        Filter,
        Pagination,
    },
    data() {
        return {
            openFilter: true,
            styleFilter: "",
            isLoading: true,
            dataPagination: {},
            backGroundcolor: "#E93B3B",
            page: 1,
            form: null,
            to: null,
            data: [],
            dataStatus: [],
            params: [],
            status: [
                {
                    name: "Đã đặt cọc",
                },
                {
                    name: "Đã mua hàng",
                },
                {
                    name: "Shop giao hàng",
                },
                {
                    name: "Kho nhận hàng",
                },
                {
                    name: "Vận chuyển",
                },
                {
                    name: "Chờ giao",
                },
                {
                    name: "Chờ giao yêu cầu",
                },
                {
                    name: "Đang yêu cầu",
                },
            ],
            nameTable: [
                {
                    name: "STT",
                },
                {
                    name: "ĐƠN HÀNG",
                },
                {
                    name: "NGÀY",
                },
                {
                    name: "TÀI KHOẢN",
                },

                {
                    name: "MÃ VẬN ĐƠN",
                },
                {
                    name: "TỔNG",
                },
                {
                    name: "TÌNH TRẠNG",
                },
            ],
        };
    },
    mounted() {
        this.getListOrder();
    },
    methods: {
        getListOrder(page = 1) {
            this.page = page;
            this.isLoading = true;
            this.params = {...this.params, page: page}
            getAll(this.params)
                .then((res) => {
                    const { data } = res;
                    this.data = data.orders.data;
                    this.dataPagination = data.orders;
                    this.dataStatus = data.total_status
                })
                .finally(() => {
                    this.isLoading = false;
                });
        },
        open_filter() {
            this.openFilter = !this.openFilter;
            this.styleFilter = "right-[-18px] duration-300 ";
        },
        updateOpenFilter(newVal) {
            this.styleFilter = newVal;
            console.log(newVal)
        },
        searchOrders(data){
            this.params = data
            this.getListOrder()
        },
        formatPrice(value) {
            return new Intl.NumberFormat("en-US", {
                style: "currency",
                currency: "VND",
            }).format(value);
        },
    },
};
</script>
<style></style>