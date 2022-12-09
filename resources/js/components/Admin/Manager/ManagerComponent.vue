<template>
    <div class="pt-6 relative duration-300">
        <loading v-model:active="isLoading" :color="backGroundcolor" />
        <div class="flex justify-between">
            <h1 class="text-[#566a7f] text-[28px] font-[700]">Quản trị viên</h1>
            <div class="flex justify-between items-center mx-5">
                <div class="p-3">
                    <button @click="open_modal()"
                        class="bg-[#E93B3B] hover:bg-orange-800 duration-300 text-white py-1 px-8 rounded">
                        + Quản trị viên mới
                    </button>
                </div>
                <div>
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
        </div>
        <div class="main mt-6">
            <table class="w-full rounded-t-md overflow-hidden bg-white">
                <thead
                    class="bg-[#FF3F3A] text-white h-[40px] font-bold text-[16px]"
                >
                    <tr class="px-2 text-left">
                        <th class="text-center">STT</th>
                        <th class="pl-5">TÊN ĐĂNG NHẬP</th>
                        <th>SỐ DIỆN THOẠI</th>
                        <th>Vai trò</th>
                        <th>TÁC VỤ</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                    v-for="(item, index) in data"
                        :key="index"
                        class="border-solid py-10 border-b-[1px] border-[#E2E2E2] h-[60px] font-[16px]"
                    >
                        <td class="font-bold text-center">{{ index + 1 + (this.page - 1) * 8 }}</td>
                        <td class="pl-5">
                            {{ item.username }}
                        </td>
                        <td>{{ item.phone }}</td>
                        <td>{{ item.role == 1 ? 'Admin tổng'  : ((item.role == 2) ? 'Admin' : 'Nhân viên') }}</td>
                        <td class="">
                            <button @click="getManager(item.id)">
                                <font-awesome-icon icon="fa-regular fa-pen-to-square "
                                    class="mt-1 text-[#FF3F3A] text-[20px] cursor-pointer" />
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <Pagination
                        v-if="dataPagination.last_page > 1"
                        class="mx-3 my-3"
                        :pagination="dataPagination"
                        :offset="5"
                        @pagination-change-page="getAllManager"
                    ></Pagination>
        </div>
        <Filter
            v-on:filter_action="updateOpenFilter($event)"
            v-on:values_filter="searchUsers($event)"
            :filter="this.openFilter"
            :styleFilter="this.styleFilter"
            :userModule="true"
        />
    </div>
    <EditManagerComponent v-if="showModalsUpdate" v-on:showModal="updateOpenModalEdit($event)" :showModalAction="showModalsUpdate"
        @foobar="getAllManager" :isLoadingEdit="isLoadingEdit" :item="item" @interface="getChildManager">
    </EditManagerComponent>
    <div :class="isLoading == false ? 'block' : 'hidden'">
        <AddManagerComponent v-on:showModal="updateOpenModal($event)" @foobar="getAllManager"
            v-on:isLoadingAll="updateIsLoading($event)" :showModalAction="this.showModals"
            >
        </AddManagerComponent>
    </div>
</template>

<script>
import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/vue-loading.css";
import Filter from "../Filter/FilterComponent";
import { getAll, get } from "../../../services/Manager/manager.js";
import Pagination from "../../pagination/Pagination.vue";
import EditManagerComponent from './EditManagerComponent.vue';
import AddManagerComponent from './AddManagerComponent.vue'
export default {
    watch: {
        $route: {
            immediate: true,
            handler(to, from) {
                document.title ='Danh sách tài khoản';
            }
        },
  },
    props: ["values_filter"],
    childInterface: {
        getUser: (item) => { }
    },
    data() {
        return {
            openFilter: true,
            styleFilter: "",
            page: 1,
            isLoading: false,
            isLoadingEdit: true,
            data: [],
            dataPagination: [],
            backGroundcolor: "#E93B3B",
            params: {},
            item: {},
            showModals: false,
            showModalsUpdate: false,
        };
    },

    components: {
        Loading,
        Filter,
        Pagination,
        EditManagerComponent,
        AddManagerComponent
    },
    mounted(){
        this.getAllManager()
    },  

    methods: {
        open_filter() {
            this.openFilter = !this.openFilter;
            this.styleFilter = "translate-x-[-360px] duration-300 ";
        },
        open_modal() {
            this.showModals = !this.showModals;
        },
        updateOpenFilter(newVal) {
            this.styleFilter = newVal;
        },
        updateOpenModalEdit(event) {
            this.showModalsUpdate = !event;
        },
        getAllManager(page = 1) {
            this.page = page;
            this.isLoading = true;
            this.params = { ...this.params, page: page };
            getAll(this.params)
                .then((res) => {
                    const { data } = res;
                    this.data = data.data;
                    this.dataPagination = data;
                })
                .finally(() => {
                    this.isLoading = false;
                });
        },
        searchManagers(data){
            this.params = data
            this.getAllManager()
        },
        getChildManager(childInterface) {
            this.$options.childInterface = childInterface;

        },
        getManager(id){
            const data = this.data.find((item) => item.id == id);
            this.item = data
            this.isLoading = true;
            this.params = {id}
            get(this.params).then((response) => {
                const { data } = response;
                this.showModalsUpdate = !this.showModalsUpdate;
            }).catch((error) => {

            }).finally(() => {
                this.isLoading = false;
            });
            this.$options.childInterface.getManager(this.item);
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
