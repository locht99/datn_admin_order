<template>

    <div class="relative duration-300   ">
        <loading v-model:active="isLoading" :color="backGroundcolor" />
        <div class="">
            <div class="flex justify-between items-center ">
                <div class="title mx-5">
                    <h1 class="text-[#566a7f] text-[28px] font-[700]">Tiền Việt</h1>
                </div>
                <div>
                    <div class="flex justify-between items-center mx-5">
                        <div class="p-3">
                            <button @click="open_modal()"
                                class="bg-[#E93B3B] hover:bg-orange-800 duration-300 text-white py-1 px-8 rounded ">+
                                Giao dịch mới</button>
                        </div>
                        <div>
                            <span class="text-[23px] cursor-pointer hover:bg-white px-4  rounded-full"
                                @click="open_filter()">
                                <button>
                                    <font-awesome-icon icon="fas fa-sliders-h" />
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="py-2  ">
                <div class="py-5">
                    <div class='overflow-x-auto w-full'>
                        <table
                            class='  w-full whitespace-nowrap rounded-lg bg-white divide-y divide-gray-300 overflow-hidden'>
                            <thead class="bg-[#FF3F3A]  ">
                                <tr class="  uppercase leading-normal ">
                                <th class="text-[14px] font-bold text-white  py-2 ">
                                    STT
                                </th>
                                <th class="text-[14px] font-bold text-white  py-2 ">
                                    NGÀY
                                </th>
                                <th class="text-[14px] font-bold text-white  py-2 ">
                                    LOẠI
                                </th>
                                <th class="text-[14px] font-bold text-white  py-2">
                                    TÀI KHOẢN
                                </th>
                                <th class="text-[14px] font-bold text-white  py-2">
                                    ĐƠN HÀNG
                                </th>
                                <th class="text-[14px] font-bold text-white  py-2">
                                    GÓI HÀNG
                                </th>
                                <th class="text-[14px] font-bold text-white  py-2">
                                    SỐ TIỀN
                                </th>
                               
                                <th class="text-[14px] font-bold text-white  py-2">
                                    NỘI DUNG
                                </th>
                                <th class="text-[14px] font-bold text-white  py-2">
                                    NGÀY TẠO
                                </th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                            <tr class="border-b hover:bg-gray-50 dark:hover:bg-gray-600"
                                v-for="(item,index) in this.dataListVietNam" :key="index">
                                <td class="px-6 py-2 whitespace-nowrap text-sm font-bold text-gray-900 ">{{index+1}}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap ">
                                    {{item.date}}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap ">
                                    {{item.type_name}}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap">
                                    {{item.username}}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap">
                                    <a href="" class="hover:text-blue-900">{{item.order_code}}</a>

                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap">
                                    0
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap">
                                    {{item.point_vn}}
                                </td>
                             
                                <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap">
                                    {{item.content}}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap">
                                    {{item.created_at}}
                                </td>

                            </tr>


                          
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <Filter v-on:filter_action="updateOpenFilter($event)" :filter="this.openFilter"
            :styleFilter="this.styleFilter" />
    </div>

    <AddMoneyVietNam v-on:showModal="updateOpenModal($event)" :showModalAction="this.showModals" @foobar="getListVietNamese()" />
</template>
<script>
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';
import AddMoneyVietNam from './AddMoneyVietNamComponent.vue';
import Filter from '../Filter/FilterComponent.vue';
import { getAll } from '../../../services/VietNamese';

export default {
    components: {
        AddMoneyVietNam,
        Filter,
        Loading
    },
    data() {
        return {
            openFilter: true,
            styleFilter: '',
            isLoading: true,
            backGroundcolor: '#E93B3B',
            showModals: false,
            dataListVietNam: [],

        }
    },

    created() {
        this.getListVietNamese();
    },

    methods: {
        open_filter() {
            this.openFiter = !this.openFilter;
            this.styleFilter = 'translate-x-[-360px] duration-300 ';
        },
        updateOpenFilter(newVal) {
            this.styleFilter = newVal;
        },
        open_modal() {
            this.showModals = !this.showModals;
        },
        updateOpenModal(event) {
            this.showModals = !event;
        },
        getListVietNamese() {
            getAll().then((response) => {
                const { data } = response;
                this.dataListVietNam = data.data;

            }).finally(() => {
                this.isLoading = false;
            })
        }

    },

}
</script>
<style  scoped>

</style>