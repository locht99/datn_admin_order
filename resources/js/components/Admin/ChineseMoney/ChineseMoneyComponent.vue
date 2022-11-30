<template>
    <div class="pt-6 relative duration-300">
        <loading v-model:active="isLoading" :color="backGroundcolor" />
        <div class="flex justify-between">
            <div class="title">
                <h1 class="text-[#566a7f] text-[28px] font-[700]">
                    Tiền Trung
                </h1>
            </div>
            <div class="flex justify-between items-center mx-5">
                <div class="p-3">
                    <button @click="open_modal()"
                        class="bg-[#E93B3B] hover:bg-orange-800 duration-300 text-white py-1 px-8 rounded">
                        + Giao dịch mới
                    </button>
                </div>
                <div>
                    <span class="text-[23px] cursor-pointer hover:bg-white px-4 rounded-full" @click="open_filter()">
                        <button>
                            <font-awesome-icon icon="fas fa-sliders-h" />
                        </button>
                    </span>
                </div>
            </div>
        </div>
        <div class="main mt-6 bg-white">
            <table class="w-full rounded-t-md overflow-hidden bg-white">
                <thead class="bg-[#FF3F3A] text-white h-[40px] font-bold text-[16px]">
                    <tr class="px-2 text-left">
                        <th class="text-center">STT</th>
                        <th class="pl-5">NGÀY</th>
                        <!-- <th class="">TÀI KHOẢN</th>
                        <th>ĐƠN HÀNG</th> -->
                        <th>LOẠI</th>
                        <th>NỘI DUNG</th>
                        <th>SỐ TIỀN</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-solid border-b-[1px] border-[#E2E2E2] h-[52px] font-[16px]"
                        v-for="(item,index) in this.chinese.data.data" :key="index">
                        <td class="font-bold text-center">
                            {{ index + 1 + (this.page - 1) * 10 }}
                        </td>
                        <td class="pl-5">{{item.date}}</td>
                        <!-- <td class="">{{item.username}}</td>

                        <td>{{item.order_code}}</td> -->
                        <td>{{item.type_name}}</td>
                        <td>{{item.content}}</td>
                        <td >{{item.point_cn}}</td>
                        
                    </tr>

                </tbody>
            </table>
            <Pagination class="mx-3 my-3" v-if="pagination.last_page > 1" :pagination="pagination" :offset="5"
                @pagination-change-page="getAllChinese"></Pagination>
        </div>
        <Filter v-on:filter_action="updateOpenFilter($event)" :filter="this.openFilter" :styleFilter="this.styleFilter"
            v-on:action_search="getAllChinese" v-on:values_filter="getValueFilter" />
    </div>
    <div :class="isLoading == false ? 'block' : 'hidden'">
        <AddMoneyChinaComponent v-on:showModal="updateOpenModal($event)" @foobar="getAllChinese"
            v-on:isLoadingAll="updateIsLoading($event)" :showModalAction="this.showModals"
            :dataTypeChina="chinese.type">
        </AddMoneyChinaComponent>
    </div>
</template>

<script>
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';
import Filter from '../../Admin/Filter/FilterComponent.vue';
import AddMoneyChinaComponent from './AddMoneyChinaComponent.vue';
import { getAll, getTypeMoneyChina } from '../../../services/ChinaMoney/ChinaMoney.js';
import Pagination from '../../pagination/Pagination.vue';
export default {
    watch: {
        $route: {
            immediate: true,
            handler(to, from) {
                document.title ='Danh sách tiền trung';
            }
        },
  },
    data() {
        return {
            openFilter: true,
            styleFilter: "",
            isLoading: true,
            backGroundcolor: '#E93B3B',
            showModals: false,
            pagination: {},
            chinese: {
                data: [],
                type: Array
            },
            arrFilter: [],
            phone: null,
            name: null,
            form: {},
            to: null,
            is_running: null,
            is_delete: null,
            page: 1,
        };
    },
    components: {
        Loading,
        Filter,
        AddMoneyChinaComponent,
        Pagination
    },

    created() {
        this.getAllChinese();
    },
    methods: {
        open_filter() {
            this.openFilter = !this.openFilter;
            getTypeMoneyChina().then((response) => {
                const { data } = response;
                this.chinese.type = data.admin_type_transactions_chinese;

            }).finally(() => {
                this.isLoading = false;
            })
            this.styleFilter = "translate-x-[-360px] duration-300 ";
        },
        updateOpenFilter(newVal) {
            this.styleFilter = newVal;
        },
        getValueFilter($event){
              this.arrFilter = $event;
        },
        open_modal() {
            this.isLoading = true;
            getTypeMoneyChina().then((response) => {
                const { data } = response;
                console.log(data);
                this.chinese.type = data.admin_type_transactions_chinese;
            }).finally(() => {
                this.isLoading = false;
            })
            this.showModals = !this.showModals;
        },
        updateOpenModal(event) {
            this.showModals = !event;
        },
        updateIsLoading(event) {
            this.isLoading = false;
        },
        getAllChinese(page = 1, formData = null) {
            this.isLoading = true;
            this.page = page;
            
            getAll({
                params: {
                    phone: this.phone,
                    username: this.arrFilter.username,
                    from: this.arrFilter.from,
                    to: this.arrFilter.to,
                    type: this.arrFilter.status,
                    page: this.page,
                },
            }).then((response) => {
                const { data } = response;
                this.chinese.data = data;
                this.pagination = data.meta
                this.isLoading = false;

            }).catch((error) => {
                console.log(error);
            }).finally(() => {
                this.isLoading = false;

            });
        },

    },
};
</script>
