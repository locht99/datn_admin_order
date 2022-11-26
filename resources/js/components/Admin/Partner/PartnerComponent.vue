<template>
    <div class=" pt-6 relative duration-300">
        <loading v-model:active="isLoading" :color="backGroundcolor" />
        <div class="flex justify-between">
            <div class="title">
                <h1 class="text-[#566a7f] text-[28px] font-[700]">
                    Đối Tác
                </h1>
            </div>
            <div class="flex justify-between items-center mx-5">
                <div class="p-3">
                    <button @click="open_modal()" data-modal-toggle="large-modal"
                        class="bg-[#E93B3B] hover:bg-orange-800 duration-300 text-white py-1 px-8 rounded">
                        + Tạo đối tác mới
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
                        <th class="pl-5">TÊN</th>
                        <th>ĐIỆN THOẠI</th>
                        <th>ĐIỂM</th>
                        <th>ĐÃ KÍCH HOẠT</th>
                        <th>KHÓA</th>
                        <th>NGÀY TẠO</th>
                        <th class="w-1/10"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="item border-solid border-b-[1px] border-[#E2E2E2] h-[52px] font-[16px]"
                        v-for="(item,index) in  this.data" :key="index">
                        <td class="font-bold text-center">  {{ index + 1 + (this.page - 1) * 10 }}</td>
                        <td class="pl-5">{{item.name}}</td>
                        <td>{{item.phone}}</td>
                        <td>{{item.point}}</td>
                        <td>{{item.is_running ==1 ? 'Đã kích hoạt' : 'Chưa kích hoạt'}}</td>
                        <td>{{item.is_delete==0 ?'Hoạt động': 'Đã khóa'}}</td>
                        <td>{{item.created_at}}</td>
                        <td class="">
                            <button @click="getPartner(item.id)">
                                <font-awesome-icon icon="fa-regular fa-pen-to-square "
                                    class="mt-1 text-[#FF3F3A] text-[20px] cursor-pointer" />
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <Pagination class="mx-3 my-3" v-if="pagination.last_page > 1" :pagination="pagination" :offset="5"
                @pagination-change-page="getListPartner"></Pagination>
        </div>
        <Filter v-on:filter_action="updateOpenFilter($event)" :filter="this.openFilter"
            :styleFilter="this.styleFilter" />

    </div>
    <AddPartnerComponent v-on:showModal="updateOpenModal($event)" :showModalAction="this.showModals"
        @foobar="getListPartner">
    </AddPartnerComponent>
    <EditPartnerComponent v-on:showModal="updateOpenModalEdit($event)" :showModalAction="this.showModalsUpdate"
        @foobar="getListPartner" :isLoadingEdit="this.isLoadingEdit" :item="this.item" @interface="getChildPartner">
    </EditPartnerComponent>
</template>
<script>
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';
import Filter from '../Filter/FilterComponent';
import AddPartnerComponent from './AddPartnerComponent.vue';
import EditPartnerComponent from './EditPartnerComponent.vue';
import { getAll, get } from '../../../services/partner/partner.js';
import Pagination from '../../pagination/Pagination.vue';
export default {
    watch: {
        $route: {
            immediate: true,
            handler(to, from) {
                document.title ='Danh sách đối tác';
            }
        },
  },
    childInterface: {
        getPartner: (item) => { }
    },
    data() {
        return {
            openFilter: true,
            styleFilter: '',
            showModals: false,
            showModalsUpdate: false,
            isLoading: true,
            isLoadingEdit: true,
            backGroundcolor: '#E93B3B',
            data: [],
            id_Partner: '',
            item: Object,
            pagination: {},
            phone: null,
            name: null,
            form: null,
            to: null,
            is_running: null,
            is_delete: null,
            page: 1,
        }
    },

    components: {
        Filter,
        AddPartnerComponent,
        EditPartnerComponent,
        Loading,
        Pagination
    },
    created() {
        this.getListPartner();
    },
    methods: {
        open_filter() {
            this.openFilter = !this.openFilter;
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
        getListPartner(page = 1) {
            this.isLoading = true;
            this.isLoadingEdit = true;
            this.page = page
            getAll({
                params: {
                    phone: this.phone,
                    name: this.name,
                    from: this.from,
                    to: this.to,
                    is_running: this.is_running,
                    is_delete: this.is_delete,
                    page: page,
                },
            }).then((response) => {
                const { data } = response;
                this.pagination = data.meta;
                this.data = data.data;
            }).finally(() => {
                this.isLoadingEdit = false;
                this.isLoading = false;
            })
        },
        updateOpenModalEdit(event) {
            this.showModalsUpdate = !event;
        },
        getChildPartner(childInterface) {
            this.$options.childInterface = childInterface;

        },
        getPartner(id) {
            const data = this.data.find((item) => item.id == id);
            this.item = data;
            this.isLoading = true;
            get(id).then((response) => {
                const { data } = response;
                this.showModalsUpdate = !this.showModalsUpdate;
            }).catch((error) => {

            }).finally(() => {
                this.isLoading = false;
            });
            this.$options.childInterface.getPartner(this.item);
        }

    }
};
</script>
