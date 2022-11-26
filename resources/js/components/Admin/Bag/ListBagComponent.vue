<template>
    <div class="relative duration-300">
        <loading v-model:active="is_loading" :color="backGroundcolor" />
        <div class="">
            <div class="flex justify-between items-center ">
                <div class="title mx-5">
                    <h1 class="text-[#566a7f] text-[28px] font-[700]">Bao Hàng</h1>
                </div>
                <div>
                    <div class="flex justify-between items-center mx-5">
                        <div class="p-3">
                            <router-link to="/bag/add" data-modal-toggle="large-modal"
                                class="bg-[#E93B3B] hover:bg-orange-800 duration-300 text-white py-1 px-8 rounded ">+
                                Tạo mới bao hàng</router-link>
                        </div>
                    </div>
                </div>
            </div>
            <div class="py-2 inline-block ">
                <form class="form-fillter" @submit="formSubmit($event)">
                    <div class="packet-fillter grid grid-cols-12 gap-4">
                        <div class="col-span-2">
                            <label for="">Mã bao hàng</label>
                            <input type="text" name="code" v-model="code"
                                class="w-full border-gray-300 rounded my-2 px-2 py-0.5" />
                        </div>
                        <div class="col-span-2">
                            <label for="">Mã đơn hàng</label>
                            <input type="text" name="order" v-model="order_id"
                                class="w-full border-gray-300 rounded my-2 px-2 py-0.5" />
                        </div>
                        <div class="col-span-2">
                            <label for="">Mã vận đơn</label>
                            <input type="text" v-model="waybill_code"
                                class="w-full border-gray-300 rounded my-2 px-2 py-0.5" />
                        </div>
                        <div>
                            <label for="">Từ ngày</label>
                            <input type="date" name="from" v-model="from"
                                class="w-full border-gray-300 rounded my-2 px-2 py-0.5" />
                        </div>
                        <div>
                            <label for="">Đến ngày</label>
                            <input type="date" name="to" v-model="to"
                                class="w-full border-gray-300 rounded my-2 px-2 py-0.5" />
                        </div>
                        <div>
                            <label for="">Đóng gỗ</label>
                            <select name="wood_packing" class="w-full border-gray-300 rounded my-2 px-2 py-0.5"
                                v-model="is_wood_packing">
                                <option value="">Tất cả</option>
                                <option value="1">Có</option>
                                <option value="0">Không</option>
                            </select>
                        </div>
                        <div>
                            <label for="">Thanh toán</label>
                            <select name="wood_packing" class="w-full border-gray-300 rounded my-2 px-2 py-0.5"
                                v-model="is_paid">
                                <option value="">Tất cả</option>
                                <option value="1">Đã thanh toán</option>
                                <option value="0">Chưa thanh toán</option>
                            </select>
                        </div>
                        <div class="col-span-2">
                            <label for="">&nbsp;</label>
                            <button type="submit"
                                class="w-full bg-[#E93B3B] hover:bg-orange-800 duration-300 text-white rounded my-2 px-2 py-0.5">
                                Tìm kiếm
                            </button>
                        </div>
                    </div>
                </form>
                <div class="overflow-hidden rounded-t-[13px] bg-white" v-if="packets.length > 0">
                    <table class="w-[100%] table-auto  border text-center">
                        <thead class="">
                            <tr class="bg-[#FF3F3A] uppercase leading-normal text-white">
                                <th scope="col" class="px-2 py-2">STT</th>
                                <th scope="col" class="px-2 py-2">Mã bao hàng</th>
                                <th scope="col" class="px-2 py-2">Đóng gỗ</th>
                                <th scope="col" class="px-2 py-2">Ghi chú</th>
                                <th scope="col" class="px-2 py-2">Kho</th>
                                <th scope="col" class="px-2 py-2">Tình trạng</th>
                                <th scope="col" class="px-2 py-2">Thanh toán</th>
                                <th scope="col" class="px-2 py-2">Phí vận chuyển</th>
                                <th scope="col" class="px-2 py-2">Tổng tiền</th>
                                <th scope="col" class="px-2 py-2">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b dark:bg-gray-800 dark:border-gray-700 odd:bg-white even:bg-gray-100 odd:dark:bg-gray-800 even:dark:bg-gray-700"
                                v-for="(item, index) in packets" :key="index">
                                <th scope="row" class="px-2 py-2">{{ index + 1 }}</th>
                                <td class="px-2 py-2 hover:text-blue-700">
                                    <router-link :to="'detail-bag/' + item.id">{{ item.code }}</router-link>
                                </td>
                                <td class="px-2 py-2">
                                    {{ item.wood_packing ? "có" : "không" }}
                                </td>
                                <td class="px-2 py-2">{{ item.note }}</td>

                                <td class="px-2 py-2">{{ item.warehouse_id == 1 ? "Hà Nội" : "Sài Gòn" }}</td>
                                <td class="px-2 py-2">{{ item.tracking_status_name }}</td>
                                <td class="px-2 py-2">
                                    {{
                                            item.paid ? "Đã thanh toán" : "Chưa thanh toán"
                                    }}
                                </td>
                                <td class="px-2 py-2">
                                    {{ formatPrice(item.fee_service) }}
                                </td>
                                <td class="px-2 py-2">
                                    {{ formatPrice(parseInt(item.total_price) + parseInt(item.fee_service)) }}
                                </td>

                                <td class="px-2 py-2">
                                    <a-button type="primary" class="mx-2" danger>
                                        <router-link :to="'bag/' + item.id + '/edit'">
                                            <font-awesome-icon icon="far fa-edit" />
                                        </router-link>
                                    </a-button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <Pagination class="mx-3 my-3" v-if="pagination.last_page > 1" :pagination="pagination" :offset="5"
                        @pagination-change-page="getPackets"></Pagination>
                </div>
                <div v-else class="m-2">
                    <i class="text-gray-500">Không tồn tại bao hàng bạn cần tìm!</i>
                </div>
            </div>
        </div>

    </div>
</template>
<script>

import Loading from 'vue-loading-overlay';
import Pagination from '../../pagination/Pagination.vue';
import { getBagPackets } from '../../../services/Bag/bag.js'
export default {
    watch: {
        $route: {
            immediate: true,
            handler(to, from) {
                document.title = 'Danh sách bao hàng';
            }
        },
    },
    data() {
        return {
            openFilter: true,
            styleFilter: '',
            is_loading: false,
            backGroundcolor: '#E93B3B',
            waybill_code: null,
            order_id: null,
            code: null,
            from: null,
            to: null,
            is_wood_packing: "",
            is_paid: "",
            pagination: {},
            packets: {},
        }
    },

    components: {
        Loading,
        Pagination
    },

    methods: {
        formatPrice(value) {
            return new Intl.NumberFormat("en-US", {
                style: "currency",
                currency: "VND",
            }).format(value);
        },
        formSubmit(e) {
            e.preventDefault();
            this.getPackets();
        },
        getPackets(page = 1) {
            this.is_loading = true;
            getBagPackets({
                params: {
                    code: this.code,
                    order_id: this.order_id,
                    waybill_code: this.waybill_code,
                    from: this.from,
                    to: this.to,
                    is_wood_packing: this.is_wood_packing,
                    is_paid: this.is_paid,
                    page: page,
                },
            }).then((res) => {
                this.packets = res.data.data;
                this.pagination = res.data.meta;
            })
                .catch((error) => console.log(error))
                .finally(() => (this.is_loading = false));
        },
    },
    created() {
        this.getPackets();
    },
}

</script>
<style>

</style>