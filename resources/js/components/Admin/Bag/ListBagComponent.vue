<template>
    <div class="relative duration-300">
        <loading v-model:active="is_loading" :color="backGroundcolor" />
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
                    </div>
                </div>
            </div>
            <div class="py-2 inline-block">
                <form class="form-fillter" @submit="formSubmit($event)">
                    <div class="packet-fillter grid grid-cols-12 gap-4">
                        <div class="col-span-2">
                            <label for="">Mã bao hàng</label>
                            <input
                                type="text"
                                name="code"
                                v-model="code"
                                class="w-full border-gray-300 rounded my-2 px-2 py-0.5"
                            />
                        </div>
                        <div class="col-span-2">
                            <label for="">Mã đơn hàng</label>
                            <input
                                type="text"
                                name="order"
                                v-model="order_id"
                                class="w-full border-gray-300 rounded my-2 px-2 py-0.5"
                            />
                        </div>
                        <div class="col-span-2">
                            <label for="">Mã vận đơn</label>
                            <input
                                type="text"
                                v-model="waybill_code"
                                class="w-full border-gray-300 rounded my-2 px-2 py-0.5"
                            />
                        </div>
                        <div>
                            <label for="">Từ ngày</label>
                            <input
                                type="date"
                                name="from"
                                v-model="from"
                                class="w-full border-gray-300 rounded my-2 px-2 py-0.5"
                            />
                        </div>
                        <div>
                            <label for="">Đến ngày</label>
                            <input
                                type="date"
                                name="to"
                                v-model="to"
                                class="w-full border-gray-300 rounded my-2 px-2 py-0.5"
                            />
                        </div>
                        <div>
                            <label for="">Đóng gỗ</label>
                            <select
                                name="wood_packing"
                                class="w-full border-gray-300 rounded my-2 px-2 py-0.5"
                                v-model="is_wood_packing"
                            >
                                <option value="">Tất cả</option>
                                <option value="1">Có</option>
                                <option value="0">Không</option>
                            </select>
                        </div>
                        <div>
                            <label for="">Thanh toán</label>
                            <select
                                name="wood_packing"
                                class="w-full border-gray-300 rounded my-2 px-2 py-0.5"
                                v-model="is_paid"
                            >
                                <option value="">Tất cả</option>
                                <option value="1">Đã thanh toán</option>
                                <option value="0">Chưa thanh toán</option>
                            </select>
                        </div>
                        <div class="col-span-2">
                            <label for="">&nbsp;</label>
                            <button
                                type="submit"
                                class="w-full bg-[#E93B3B] hover:bg-orange-800 duration-300 text-white rounded my-2 px-2 py-0.5"
                            >
                                Tìm kiếm
                            </button>
                        </div>
                    </div>
                </form>
                <div
                    class="overflow-hidden rounded-t-[13px] bg-white"
                    v-if="packets.length > 0"
                >
                    <table class="w-[100%] table-auto border text-center">
                        <thead class="">
                            <tr
                                class="bg-[#FF3F3A] uppercase leading-normal text-white"
                            >
                                <th scope="col" class="px-2 py-2">STT</th>
                                <th scope="col" class="px-2 py-2">
                                    Mã bao hàng
                                </th>
                                <th scope="col" class="px-2 py-2">Đóng gỗ</th>
                                <th scope="col" class="px-2 py-2">Ghi chú</th>
                                <th scope="col" class="px-2 py-2">Tổng tiền</th>
                                <th scope="col" class="px-2 py-2">
                                    Tình trạng
                                </th>
                                <th scope="col" class="px-2 py-2">
                                    Thanh toán
                                </th>
                                <th scope="col" class="px-2 py-2">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                class="border-b dark:bg-gray-800 dark:border-gray-700 odd:bg-white even:bg-gray-100 odd:dark:bg-gray-800 even:dark:bg-gray-700"
                                v-for="(item, index) in packets"
                                :key="index"
                            >
                                <th scope="row" class="px-2 py-2">
                                    {{ index + 1 }}
                                </th>
                                <td class="px-2 py-2 code">{{ item.code }}</td>
                                <td class="px-2 py-2">
                                    {{ item.wood_packing ? "có" : "không" }}
                                </td>
                                <td class="px-2 py-2">{{ item.note }}</td>
                                <td class="px-2 py-2">
                                    {{ item.total_price }}
                                </td>
                                <td class="px-2 py-2">
                                    {{ item.delivery_status }}
                                </td>
                                <td class="px-2 py-2">
                                    {{
                                        item.paid
                                            ? "đã thanh toán"
                                            : "chưa thanh toán"
                                    }}
                                </td>
                                <td
                                    class="px-2 py-2 text-blue-700 hover:text-blue-800 hover:underline cursor-pointer"
                                >
                                    <a :href="'bag/' + item.id + '/edit'">
                                        <i
                                            class="fa-solid fa-pen-to-square"
                                        ></i>
                                        Sửa
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <Pagination
                        class="mx-3 my-3"
                        v-if="pagination.last_page > 1"
                        :pagination="pagination"
                        :offset="5"
                        @pagination-change-page="getPackets"
                    ></Pagination>
                </div>
                <div v-else class="m-2">
                    <i class="text-gray-500"
                        >Không tồn tại bao hàng bạn cần tìm!</i
                    >
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Loading from "vue-loading-overlay";
import Pagination from "../../pagination/Pagination.vue";
import axios from "axios";
export default {
    data() {
        return {
            openFilter: true,
            styleFilter: "",
            is_loading: false,
            waybill_code: null,
            order_id: null,
            code: null,
            from: null,
            to: null,
            is_wood_packing: "",
            is_paid: "",
            pagination: {},
            packets: [],
        };
    },

    components: {
        Loading,
        Pagination,
    },

    methods: {
        formSubmit(e) {
            e.preventDefault();
            this.getPackets();
        },
        async getPackets(page = 1) {
            this.is_loading = true;
            this.packets = await axios
                .get("api/packets", {
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
                })
                .then((res) => {
                    this.pagination = res.data.meta;
                    return res.data.data;
                })
                .catch((error) => console.log(error));

            this.packets.forEach((element) => {
                axios
                    .get(
                        "http://127.0.0.1:8001/api/get-shipping?code=" +
                            element.code
                    )
                    .then((res) => {
                        console.log(res);
                        element["delivery_status"] =
                          res.data.delivery_status_name;
                        if (res.data.delivery_status_name === undefined) {
                            element["delivery_status"] =
                                "Package tracking information is no available yet";
                        }
                    })
                    .finally(() => (this.is_loading = false));  
            });
        },
    },
    created() {
        this.getPackets();
    },
    mounted() {},
};
</script>
<style></style>
