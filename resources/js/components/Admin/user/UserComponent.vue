<template>
    <div class="pt-6 relative duration-300">
        <loading v-model:active="isLoading" :color="backGroundcolor" />
        <div class="flex justify-between">
            <h1 class="text-[#566a7f] text-[28px] font-[700]">Khách Hàng</h1>
            <div class="flex justify-between items-center mx-5">
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
                        <th>ĐỊA CHỈ</th>
                        <th>EMAIL</th>
                        <th>SỐ DIỆN THOẠI</th>
                        <th>SỐ TIỀN</th>
                        <th>NGÀY TẠO</th>
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
                        <td class="pl-5">{{ item.username }}</td>
                        <td style="max-width: 220px;">{{ (item.address_note == null ? "" : item.address_note + ", ") + item.ward +", "+ item.district +", "+ item.province}}</td>
                        <td>{{ item.email }}</td>
                        <td>{{ item.phone }}</td>
                        <td>{{ formatPrice(item.point) }}</td>
                        <td>{{ item.created_at }}</td>
                        <td class="">
                            <button @click="getUser(item.id)">
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
                        @pagination-change-page="getAllUsers"
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
    <EditUserComponent v-if="showModalsUpdate" v-on:showModal="updateOpenModalEdit($event)" :showModalAction="showModalsUpdate"
        @foobar="getAllUsers" :isLoadingEdit="isLoadingEdit" :item="item" @interface="getChildUser">
    </EditUserComponent>
</template>

<script>
import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/vue-loading.css";
import Filter from "../Filter/FilterComponent";
import { getAll, get } from "../../../services/user/user.js";
import Pagination from "../../pagination/Pagination.vue";
import EditUserComponent from './EditUserComponent.vue';
export default {
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
            showModalsUpdate: false,
        };
    },

    components: {
        Loading,
        Filter,
        Pagination,
        EditUserComponent
    },
    mounted(){
        this.getAllUsers()
    },  

    methods: {
        open_filter() {
            this.openFilter = !this.openFilter;
            this.styleFilter = "translate-x-[-360px] duration-300 ";
        },
        updateOpenFilter(newVal) {
            this.styleFilter = newVal;
        },
        updateOpenModalEdit(event) {
            this.showModalsUpdate = !event;
        },
        getAllUsers(page = 1) {
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
        searchUsers(data){
            this.params = data
            this.getAllUsers()
        },
        getChildUser(childInterface) {
            this.$options.childInterface = childInterface;

        },
        getUser(id){
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
            this.$options.childInterface.getUser(this.item);
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
