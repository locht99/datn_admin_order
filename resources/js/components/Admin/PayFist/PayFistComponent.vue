<template>
    <div class="pt-6 relative duration-300">
        <loading v-model:active="isLoading" :color="backGroundcolor" />
        <div class="flex justify-between">
            <div class="title">
                <h1 class="text-[#566a7f] text-[28px] font-[700]">
                    Tiền Hàng
                </h1>
            </div>
            <div class="flex justify-between items-center mx-5">
                <div>
                    <span class="text-[23px] cursor-pointer hover:bg-white px-4 rounded-full" @click="open_filter()">
                        <button>
                            <font-awesome-icon icon="fas fa-sliders-h" />
                        </button>
                    </span>
                </div>
            </div>
        </div>
        <div class="main mt-6">
            <table class="w-full rounded-t-md overflow-hidden bg-white">
                <thead class="bg-[#FF3F3A] text-white h-[40px] font-bold text-[16px]">
                    <tr class="px-2 text-left">
                        <th class="text-center">STT</th>
                        <th>USER</th>
                        <th>ĐƠN HÀNG</th>
                        <th>LOẠI</th>
                        <th>NỘI DUNG</th>
                        <th>SỐ TIỀN</th>
                        <th class="pl-5">NGÀY</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in this.list_money" :key="index"
                        class="item border-solid border-b-[1px] border-[#E2E2E2] h-[52px] font-[16px]">
                        <td class="font-bold text-center">#{{ index + 1 }}</td>
                        <td>{{ item.username }}</td>
                        <td>##{{ item.code_transaction }}</td>
                        <td>{{ item.type_name }}</td>
                        <td>{{ item.content }}</td>
                        <td>{{ item.point }}</td>
                        <td class="pl-5">{{ item.created_at }}</td>

                    </tr>
                </tbody>
            </table>
            <Pagination class="mx-3 my-3" v-if="pagination.last_page > 1" :pagination="pagination"
                :offset="5" @pagination-change-page="actionMoney"></Pagination>
        </div>
        <Filter v-on:filter_action="updateOpenFilter($event)" v-on:values_filter="getValueFilter($event)"
            v-on:action_search="actionMoney()" :filter="this.openFilter" :styleFilter="this.styleFilter" />
    </div>
</template>
<script>
import Filter from "../Filter/FilterComponent";
import { getAllMoney } from "../../../services/Money/money";
import Loading from 'vue-loading-overlay';
import Pagination from '../../pagination/Pagination.vue';
import 'vue-loading-overlay/dist/vue-loading.css';
export default {
    data() {
        return {
            openFilter: true,
            styleFilter: "",
            pagination: {},
            page: 1,
            params: [],
            list_money: [],
            isLoading: true,

        };
    },

    components: {
        Loading,
        Filter,
        Pagination
    },
    created() {
        this.actionMoney()
    },
    methods: {
        open_filter() {
            this.openFilter = !this.openFilter;
            this.styleFilter = "translate-x-[-360px] duration-300 ";
        },
        updateOpenFilter(newVal) {
            this.styleFilter = newVal;
        },
        getValueFilter(data) {
            this.params = data
        },
        actionMoney: function (page = 1) {
            this.isLoading = true
            getAllMoney({
                params: {
                    status: this.params.status,
                    username: this.params.username,
                    from: this.params.from,
                    to: this.params.to,
                    page: page
                }
            }).then((resp) => {
                this.list_money = resp.data.data
                this.pagination = resp.data
                console.log(this.params.from)
            }).finally(() => {
                this.isLoading = false;

            });
        }
    },
};
</script>
