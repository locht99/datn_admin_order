<template>
    <div class="relative duration-300">
        <loading v-model:active="isLoading" :color="backGroundcolor" />
        <div class="">
            <div class="flex justify-between items-center">
                <div class="title mx-5">
                    <h1 class="text-[#566a7f] text-[28px] font-[700]">
                        Bao Hàng
                    </h1>
                </div>
                <div>
                    <div class="flex justify-between items-center mx-5">
                        <div class="p-3">
                            <router-link
                                to="/bag/add"
                                data-modal-toggle="large-modal"
                                class="bg-[#E93B3B] hover:bg-orange-800 duration-300 text-white py-1 px-8 rounded"
                                >+ Tạo mới bao hàng</router-link
                            >
                        </div>
                        <div>
                            <span
                                class="text-[23px] cursor-pointer hover:bg-white px-4 rounded-full"
                                @click="open_filter()"
                            >
                                <button>
                                    <font-awesome-icon
                                        icon="fas fa-sliders-h"
                                    />
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="py-2 inline-block">
                <div
                    class="overflow-hidden rounded-t-[13px] bg-white w-[1250px]"
                >
                    <table class="w-[100%] table-auto border text-center">
                        <thead class="">
                            <tr class="bg-[#FF3F3A] uppercase leading-normal">
                                <th
                                    class="text-[14px] font-bold text-white py-2"
                                >
                                    STT
                                </th>
                                <th
                                    class="text-[14px] font-bold text-white py-2"
                                >
                                    MÃ BAO HÀNG
                                </th>
                                <th
                                    class="text-[14px] font-bold text-white py-2"
                                >
                                    ĐÓNG GỖ
                                </th>
                                <th
                                    class="text-[14px] font-bold text-white py-2"
                                >
                                    GHI CHÚ
                                </th>
                                <th
                                    class="text-[14px] font-bold text-white py-2"
                                >
                                    TỔNG TIỀN
                                </th>
                                <th
                                    class="text-[14px] font-bold text-white py-2"
                                >
                                    TÌNH TRẠNG
                                </th>
                                <th
                                    class="text-[14px] font-bold text-white py-2"
                                >
                                    THANH TOÁN
                                </th>
                                <th
                                    class="text-[14px] font-bold text-white py-2"
                                >
                                    KHÁC
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                class="border-b hover:bg-gray-50 dark:hover:bg-gray-600"
                                v-for="(item, index) in Parkets"
                                :key="index"

                                :id="'row_'+item.id"
                            >
                                <td
                                    class="px-6 py-2 whitespace-nowrap text-sm font-bold text-gray-900"
                                >
                                    {{ index + 1 }}
                                </td>
                                <td
                                    class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap"
                                >
                                    {{ item.code }}
                                </td>
                                <td
                                    class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap"
                                    v-if="item.wood_packing === 1"
                                >
                                    có
                                </td>
                                <td
                                    class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap"
                                    v-if="item.wood_packing === 0"
                                >
                                    không
                                </td>
                                <td
                                    class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap"
                                >
                                    {{ item.note }}
                                </td>
                                <td
                                    class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap"
                                >
                                    <a href="" class="hover:text-blue-900">
                                        {{ item.total_price }}
                                    </a>
                                </td>
                                <td
                                    class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap"
                                >
                                    {{ item.status_name }}
                                </td>
                                <td
                                    class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap"
                                    v-if="item.paid === 1"
                                >
                                    đã thanh toán
                                </td>
                                <td
                                    class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap"
                                    v-if="item.paid === 0"
                                >
                                    chưa thanh toán
                                </td>
                                <td
                                    class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap"
                                >
                                    <a
                                        href=""
                                        class="hover:text-blue-900 font-bold hover:underline"
                                        > <router-link :to="{ name: 'BagUpdate', params: { IdBag: item.id } }">Sửa</router-link></a
                                    >
                                    /
                                    <a
                                        href="#"
                                        class="hover:text-blue-900 font-bold hover:underline"
                                        @click="DeleteParket(item.id)"
                                        > Xóa</a
                                    >
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <Pagination class="mx-3 my-3" v-if="pagination.last_page > 1" :pagination="pagination" :offset="5"
                @pagination-change-page="GetParkets"></Pagination>
                </div>
            </div>
            <Filter
                v-on:filter_action="updateOpenFilter($event)"
                :filter="this.openFilter"
                :styleFilter="this.styleFilter"
            />
        </div>
    </div>
</template>
<script>
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';
import Filter from "../Filter/FilterComponent.vue";
import { getAll,destroy } from "../../../services/Packets/Packets";
import Pagination from '../../pagination/Pagination.vue';

export default {
    data() {
        return {
            openFilter: true,
            styleFilter: "",
            isLoading: true,
            backGroundcolor: '#E93B3B',
            Parkets: [],
            pagination: {},
            form: null,
            to: null,
            is_running: null,
            is_delete: null,
            page: 1,
        };
    },

    components: {
        Filter,
        Loading,
        Pagination
    },
    created() {
        this.GetParkets();
    },
    methods: {
        open_filter() {
            this.openFilter = !this.openFilter;
            this.styleFilter = "translate-x-[-360px] duration-300 ";
        },
        updateOpenFilter(newVal) {
            this.styleFilter = newVal;
        },
        GetParkets(page = 1) {
            this.isLoading = true;
            this.page = page
            getAll({
                params: {
                    from: this.from,
                    to: this.to,
                    is_running: this.is_running,
                    is_delete: this.is_delete,
                    page: page,
                },
            }).then((response) => {
                const { data } = response;
                this.Parkets = data.data;
                this.pagination = data.meta;
            })
            .finally(() => {
                this.isLoading = false;
            })
        },
        DeleteParket(id){
          if(confirm('Xác nhận xóa bao hàng nay khỏi bao hàng ?')){
            this.isLoading = true;
             destroy(id).then((response)=>{
                this.$swal(response.data.message);
                this.$router.push("/bag");
             }).finally(()=>{
                document.getElementById('row_'+id).style.display = 'none'
                this.isLoading = false;
             })
          }
        }
    },
};
</script>
<style></style>
