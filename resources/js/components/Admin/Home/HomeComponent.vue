<template>
    <div class="pt-6">
        <loading v-model:active="isLoading" :color="backGroundcolor" />
        <div class="title">
            <h1 class="text-[#566a7f] text-[28px] font-[700]">Trang Chủ</h1>
        </div>
        <div class="main mt-6">
            <div class="form">
                <div class="head">
                    <div class="title text-white h-10 flex justify-between px-4">
                        <h3 class="text-white">Tổng tiền nạp</h3>
                        <h3 class="text-white">Tổng tiền: {{ formatPrice(this.totalTransactions) }}</h3>
                    </div>
                    <div class="filter px-2">
                        <form>
                            <input type="date" v-model="from_tss" />
                            <input type="date" v-model="to_tss" />
                            <input type="text" placeholder="Tên tài khoản" v-model="username_tss" />
                            <input type="text" placeholder="Điện thoại" v-model="phone_tss" />
                            <button v-on:click="actionTransactions()"
                                class="border border-solid border-red-500 bg-red-500 text-white hover:bg-red-600 font-bold uppercase text-sm px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                type="button">
                                Tìm kiếm
                            </button>
                        </form>
                    </div>
                </div>
                <table class="w-full rounded-t-md overflow-hidden bg-white">
                    <thead class="">
                        <tr class="px-2 text-left">
                            <th class="text-center">ID</th>
                            <th class="pl-5">Tài khoản</th>
                            <th>Số điện thoại</th>
                            <th>Loại giao dịch</th>
                            <th>Số tiền</th>
                            <th>Ngày giao dịch</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in this.transactions" :key="index"
                            class="border-solid border-b-[1px] border-[#E2E2E2] h-[52px] font-[16px]">
                            <td class="font-bold text-center">#{{ index + 1 + (this.page_transaction - 1) * 10 }}</td>
                            <td class="pl-5">{{ item.username }}</td>
                            <td>{{ item.phone }}</td>
                            <td>{{ item.type_name }}</td>
                            <td>{{ formatPrice(item.point) }}</td>
                            <td>{{ item.created_at }}</td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
                <Pagination class="mx-3 my-3" v-if="pagination.last_page > 1" :pagination="pagination" :offset="5"
                    @pagination-change-page="actionTransactions"></Pagination>
            </div>
            <div class="form">
                <div class="head">
                    <div class="title text-white h-10 flex justify-between px-4">
                        <h3 class="text-white">Tổng đơn hàng</h3>
                        <h3 class="text-white">{{ this.totalOrders }} đơn hàng</h3>
                    </div>
                    <div class="filter px-2">
                        <form>
                            <input type="date" v-model="from_od" />
                            <input type="date" v-model="to_od" />
                            <input type="text" placeholder="Tên tài khoản" v-model="username_od" />
                            <input type="text" placeholder="Điện thoại" v-model="phone_od" />
                            <button v-on:click="actionOrders()"
                                class="border border-solid border-red-500 bg-red-500 text-white hover:bg-red-600 font-bold uppercase text-sm px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                type="button">
                                Tìm kiếm
                            </button>
                        </form>
                    </div>
                </div>
                <table class="w-full rounded-t-md overflow-hidden bg-white">
                    <thead class="">
                        <tr class="px-2 text-left">
                            <th class="text-center">ID</th>
                            <th class="pl-5">Tài khoản</th>
                            <th>Số điện thoại</th>
                            <th>Nguồn</th>
                            <th>Số tiền</th>
                            <th>Trạng thái</th>
                            <th>Ngày giao dịch</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in this.orders" :key="index"
                            class="border-solid border-b-[1px] border-[#E2E2E2] h-[52px] font-[16px]">
                            <td class="font-bold text-center">#{{ index + 1 + (this.page - 1) * 10 }}</td>
                            <td class="pl-5">{{ item.username }}</td>
                            <td>{{ item.phone }}</td>
                            <td>{{ item.source }}</td>
                            <td>{{ formatPrice(item.total_price) }}</td>
                            <td>{{ item.status_name }}</td>
                            <td>{{ item.created_at }}</td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
                <Pagination class="mx-3 my-3" v-if="pagination_orders.last_page > 1" :pagination="pagination_orders"
                    :offset="5" @pagination-change-page="actionOrders"></Pagination>

            </div>
        </div>
    </div>
</template>

<script>
import { integer } from '@vuelidate/validators';
import { forEach } from 'lodash';
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';
import { getAllTransactions, getAllOrders } from "../../../services/Home/home.js";
import Pagination from '../../pagination/Pagination.vue';
export default {
    watch: {
        $route: {
            immediate: true,
            handler(to, from) {
                document.title ='Trang chủ';
            }
        },
  },
    data() {
        return {
            transactions: [],
            totalTransactions: [],
            pagination: {},
            isLoading: true,
            page_transaction: 1,
            phone_tss: null,
            username_tss: null,
            from_tss: null,
            to_tss: null,
            phone_od: null,
            username_od: null,
            from_od: null,
            to_od: null,
            totalOrders: [],
            orders: [],
            page: 1,
            pagination_orders: {}
        }
    },
    components: {
        Loading,
        Pagination
    },
    created() {
        this.actionTransactions();
        this.actionOrders();
    },
    methods: {
        actionTransactions: function (page_transaction = 1) {
            this.isLoading = true;
            getAllTransactions(
                {
                    params: {
                        phone: this.phone_tss,
                        username: this.username_tss,
                        from: this.from_tss,
                        to: this.to_tss,
                        page: page_transaction,
                    }
                }
            ).then((resp) => {
                this.transactions = resp.data.transactions.data
                this.totalTransactions = resp.data.totalTransactions
                this.pagination = resp.data.transactions
            }).finally(() => {
                
                this.isLoading = false;
            });
        },
        actionOrders: function (page = 1) {
            this.isLoading = true
            getAllOrders(
                {
                    params: {
                        phone: this.phone_od,
                        username: this.username_od,
                        from: this.from_od,
                        to: this.to_od,
                        page: page,
                    }
                }
            ).then((resp) => {
                this.orders = resp.data.orders.data
                this.totalOrders = resp.data.total_orders
                this.pagination_orders = resp.data.orders
            }).finally(() => {
                this.isLoading = false;

            });
        },
        formatPrice(value) {
            return new Intl.NumberFormat("en-US", {
                style: "currency",
                currency: "VND",
            }).format(value);
        },
    },
}

</script>

<style scoped>
.main {
    display: grid;
    grid-template-columns: 1fr 1fr;
    grid-gap: 35px;
}

.main .form {
    background-color: white;
    border-radius: 10px;
    /* height: 1000px; */
}

.main .form .head {
    box-shadow: rgba(0, 0, 0, 0.1) 0px 10px 10px -10px;
}

.main .form .head .title {
    background-color: #ff3f3a;
    border-top-right-radius: 10px;
    border-top-left-radius: 10px;
    line-height: 40px;
    font-weight: bold;
}

.main .form .head .filter {
    height: auto;
    line-height: 40px;
    text-align: center;
}

.main .form .head .filter input {
    width: 135px;
    height: 25px;
    border-radius: 5px;
    margin: 0px 5px;
    font-size: 15px;
}

.empty {
    color: #6b6b6b;
    font-style: italic;
}
</style>