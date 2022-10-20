<template>
    <loading v-model:active="isLoading" :color="backGroundcolor" />

    <div class="container m-auto mt-6">
        <div class="flex justify-between items-center">
            <div class="title w-[30%]">
                <p class="font-bold text-[24px] text-gray-600">
                    Tạo mới bao hàng
                </p>
            </div>
            <div class="search w-[70%]">
                <form action="" class="relative" method="post" @submit.prevent="Search" >
                    <input
                        name="code"
                        type="text"
                        class="w-[100%] rounded border-gray-400 focus:border-gray-400 focus:ring-red-500 block outline-none p-1 duration-300"
                        placeholder="Tìm kiếm"
                    />
                    <button
                        type="submit"
                        class="absolute top-[2px] right-[20px] text-[21px]"
                    >
                        <font-awesome-icon
                            icon="fa-solid fa-magnifying-glass"
                            class="mt-1"
                        />
                    </button>
                </form>
            </div>
        </div>
        <div class="md:flex justify-between mt-5 pb-10">
            <div class="bg-white w-[30%] rounded">
                <form action="" @submit.prevent="Add_bag">
                    <div
                        class="flex justify-between mx-auto items-center p-3 border-b-2 w-[95%]"
                    >
                        <div clas="w-[40%]">
                            <p class="text-gray-600 text-[19px]">Kho hàng</p>
                        </div>
                        <div class="w-[60%]">
                            <select
                                name="warehouse_id"
                                id=""
                                class="w-full p-1 rounded border-gray-400 focus:border-gray-400 focus:ring-gray-400"
                            >
                                <option value="1">Hà Nội</option>
                                <option value="2">Sài Gòn</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-1">
                        <div
                            class="flex justify-between mx-auto items-center p-3"
                        >
                            <div class="w-[40%]">
                                <label for="kg" class="text-gray-600"
                                    >Trọng lượng</label
                                >
                            </div>
                            <div class="w-[60%]">
                                <div
                                    class="flex flex-wrap items-stretch relative"
                                >
                                    <input
                                        type="text"
                                        name="weight"
                                        class="flex-shrink flex-grow focus:border-gray-400 focus:ring-gray-400 leading-normal w-[90%] flex-1 border h-10 border-gray-300 rounded rounded-r-none px-3 relative"
                                        placeholder=""
                                    />
                                    <div class="flex -mr-px">
                                        <span
                                            class="p-1 flex items-center leading-normal bg-gray-300 rounded rounded-l-none border border-l-0 border-grey-light px-3 whitespace-no-wrap text-white text-sm"
                                            >KG</span
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div
                            class="flex justify-between mx-auto items-center p-3"
                        >
                            <div class="w-[40%]">
                                <label for="kg" class="text-gray-600"
                                    >Thể tích</label
                                >
                            </div>
                            <div class="w-[60%]">
                                <div
                                    class="flex flex-wrap items-stretch relative"
                                >
                                    <input
                                        type="text"
                                        name="volume"
                                        class="flex-shrink flex-grow focus:border-gray-400 focus:ring-gray-400 leading-normal w-[90%] flex-1 border h-10 border-gray-300 rounded rounded-r-none px-3 relative"
                                        placeholder=""
                                    />
                                    <div class="flex -mr-px">
                                        <span
                                            class="p-1 flex items-center leading-normal bg-gray-300 rounded rounded-l-none border border-l-0 border-grey-light px-3 whitespace-no-wrap text-white text-sm"
                                            >cm³</span
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div
                            class="flex justify-between mx-auto items-center p-3"
                        >
                            <div class="w-[40%]">
                                <label for="kg" class="text-gray-600"
                                    >Khối lượng quy đổi</label
                                >
                            </div>
                            <div class="w-[60%]">
                                <div
                                    class="flex flex-wrap items-stretch relative"
                                >
                                    <input
                                        type="text"
                                        name="weight_from_volume"
                                        class="flex-shrink flex-grow focus:border-gray-400 focus:ring-gray-400 leading-normal w-[90%] flex-1 border h-10 border-gray-300 rounded rounded-r-none px-3 relative"
                                        placeholder=""
                                    />
                                    <div class="flex -mr-px">
                                        <span
                                            class="p-1 flex items-center leading-normal bg-gray-300 rounded rounded-l-none border border-l-0 border-grey-light px-3 whitespace-no-wrap text-white text-sm"
                                            >KG</span
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="border-b w-[95%] mx-auto"></div>
                    </div>
                    <div class="form-2">
                        <div
                            class="flex justify-between mx-auto items-center p-3"
                        >
                            <div class="w-[40%]">
                                <label for="kg" class="text-gray-600"
                                    >Đơn giá</label
                                >
                            </div>
                            <div class="w-[60%]">
                                <div
                                    class="flex flex-wrap items-stretch relative"
                                >
                                    <input
                                        type="text"
                                        name="unit_price"
                                        class="flex-shrink flex-grow focus:border-gray-400 focus:ring-gray-400 leading-normal w-[90%] flex-1 border h-10 border-gray-300 rounded rounded-r-none px-3 relative"
                                        placeholder=""
                                    />
                                    <div class="flex -mr-px">
                                        <span
                                            class="p-1 flex items-center leading-normal bg-gray-300 rounded rounded-l-none border border-l-0 border-grey-light px-3 whitespace-no-wrap text-white text-sm"
                                            >VNĐ</span
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div
                            class="flex justify-between mx-auto items-center p-3"
                        >
                            <div class="w-[40%]">
                                <label for="kg" class="text-gray-600"
                                    >Phí đóng gỗ</label
                                >
                            </div>
                            <div class="w-[60%]">
                                <div
                                    class="flex flex-wrap items-stretch relative"
                                >
                                    <input
                                        type="text"
                                        name="wood_packing_price"
                                        class="flex-shrink flex-grow focus:border-gray-400 focus:ring-gray-400 leading-normal w-[90%] flex-1 border h-10 border-gray-300 rounded rounded-r-none px-3 relative"
                                        placeholder=""
                                    />
                                    <div class="flex -mr-px">
                                        <span
                                            class="p-1 flex items-center leading-normal bg-gray-300 rounded rounded-l-none border border-l-0 border-grey-light px-3 whitespace-no-wrap text-white text-sm"
                                            >VNĐ</span
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div
                            class="flex justify-between mx-auto items-center p-3"
                        >
                            <div class="w-[40%]">
                                <label for="kg" class="text-gray-600"
                                    >Phí khác</label
                                >
                            </div>
                            <div class="w-[60%]">
                                <div
                                    class="flex flex-wrap items-stretch relative"
                                >
                                    <input
                                        type="text"
                                        name="other_price"
                                        class="flex-shrink flex-grow focus:border-gray-400 focus:ring-gray-400 leading-normal w-[90%] flex-1 border h-10 border-gray-300 rounded rounded-r-none px-3 relative"
                                        placeholder=""
                                    />
                                    <div class="flex -mr-px">
                                        <span
                                            class="p-1 flex items-center leading-normal bg-gray-300 rounded rounded-l-none border border-l-0 border-grey-light px-3 whitespace-no-wrap text-white text-sm"
                                            >VNĐ</span
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="border-b w-[95%] mx-auto"></div>
                    </div>
                    <div class="form-3">
                        <div
                            class="flex justify-between mx-auto items-center p-3"
                        >
                            <div class="w-[40%]">
                                <label for="kg" class="text-gray-600"
                                    >Đóng gỗ</label
                                >
                            </div>
                            <div class="w-[60%]">
                                <div
                                    class="flex flex-wrap items-stretch relative"
                                >
                                    <input
                                        type="checkbox"
                                        name="wood_packing"
                                        class="flex-shrink flex-grow focus:border-gray-400 focus:ring-gray-400 leading-normal w-[90%] flex-1 border h-10 border-gray-300 rounded rounded-r-none px-3 relative"
                                        placeholder=""
                                    />
                                    <!-- <div class="flex -mr-px">
                                    <span class="p-1 flex items-center leading-normal bg-gray-300 rounded rounded-l-none border border-l-0 border-grey-light px-3 whitespace-no-wrap text-white text-sm ">VNĐ</span>
                                </div> -->
                                </div>
                            </div>
                        </div>
                        <div
                            class="flex justify-between mx-auto items-center p-3"
                        >
                            <div class="w-[40%]">
                                <label for="kg" class="text-gray-600"
                                    >Thanh toán</label
                                >
                            </div>
                            <div class="w-[60%]">
                                <div
                                    class="flex flex-wrap items-stretch relative"
                                >
                                    <input
                                        type="checkbox"
                                        name="paid"
                                        class="flex-shrink flex-grow focus:border-gray-400 focus:ring-gray-400 leading-normal w-[90%] flex-1 border h-10 border-gray-300 rounded rounded-r-none px-3 relative"
                                        placeholder=""
                                    />
                                    <!-- <div class="flex -mr-px">
                                    <span class="p-1 flex items-center leading-normal bg-gray-300 rounded rounded-l-none border border-l-0 border-grey-light px-3 whitespace-no-wrap text-white text-sm ">VNĐ</span>
                                </div> -->
                                </div>
                            </div>
                        </div>
                        <div
                            class="flex justify-between mx-auto items-center p-3"
                        >
                            <div class="w-[40%]">
                                <label for="kg" class="text-gray-600"
                                    >Tình trạng</label
                                >
                            </div>
                            <div class="w-[60%]">
                                <div
                                    class="flex flex-wrap items-stretch relative"
                                >
                                    <select
                                        name="status_id"
                                        id="admin_transactions_type"
                                        class="w-full border-gray-300 rounded my-2 px-2 py-1"
                                    >
                                        <option value="">Tình trạng</option>
                                        <option
                                            v-for="(
                                                item, index
                                            ) in TransportStatus"
                                            :key="index"
                                            :value="index"
                                        >
                                            {{ item }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div
                            class="flex justify-between mx-auto items-center p-3"
                        >
                            <div class="w-[40%]">
                                <label for="kg" class="text-gray-600"
                                    >Ghi chú</label
                                >
                            </div>
                            <div class="w-[60%]">
                                <div
                                    class="flex flex-wrap items-stretch relative"
                                >
                                    <textarea
                                        name="note"
                                        id=""
                                        cols="30"
                                        rows="3"
                                        class="w-full focus:ring-gray-400"
                                    ></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="mx-auto w-[95%] p-1 py-3">
                            <button
                                class="bg-red-600 hover:bg-red-700 duration-300 rounded p-1 w-full text-white"
                            >
                                Tạo mới
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="w-[70%] mx-2">
                <div class="bg-white overflow-hidden">
                    <table class="w-[100%] table-auto border text-center">
                        <thead class="">
                            <tr class="bg-[#FF3F3A] uppercase leading-normal">
                                <th
                                    class="text-[14px] font-bold text-white py-2"
                                >
                                    ĐƠN HÀNG
                                </th>
                                <th
                                    class="text-[14px] font-bold text-white py-2"
                                >
                                    MÃ VẬN ĐƠN
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
                                v-if="SearchData.order_code"
                            >
                                <td
                                    class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap"
                                >
                                    {{ SearchData.code }}
                                </td>
                                <td
                                    class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap"
                                >
                                    {{ SearchData.order_code }}
                                </td>
                                <td
                                    class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap"
                                >
                                    <span
                                        class="cursor-pointer"
                                        @click="add_to_packet()"
                                        >Thêm vào bao hàng</span
                                    >
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="overflow-hidden mt-40">
                    <h1 class="font-bold text-[24px] text-gray-600">
                        Bao hàng gồm:
                    </h1>
                    <table
                        class="w-[100%] table-auto border text-center bg-white"
                    >
                        <thead class="">
                            <tr class="bg-[#FF3F3A] uppercase leading-normal">
                                <th
                                    class="text-[14px] font-bold text-white py-2"
                                >
                                    ĐƠN HÀNG
                                </th>
                                <th
                                    class="text-[14px] font-bold text-white py-2"
                                >
                                    MÃ VẬN ĐƠN
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
                                v-for="(item, index) in parkets"
                                :key="index"
                            >
                                <td
                                    class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap"
                                >
                                    {{ item.code }}
                                </td>
                                <td
                                    class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap"
                                >
                                    {{ item.order_code }}
                                </td>
                                <td
                                    class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap"
                                >
                                    <span
                                        class="cursor-pointer"
                                        @click="remove_from_parket(item)"
                                        >Xóa</span
                                    >
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/vue-loading.css";

import {
    insert,
    search,
    transportStatus,
} from "../../../services/Packets/Packets";
export default {
    data() {
        return {
            isLoading: false,
            backGroundcolor: "#E93B3B",
            SearchData: {
                code: "",
                order_code: "",
            },
            parkets: [],
            TransportStatus: [],
        };
    },
    components: {
        Loading,
    },
    setup() {},
    created() {
        this.GetTransportStatus();
    },
    methods: {
        async GetTransportStatus() {
            this.TransportStatus = await transportStatus().then((response) => {
                return response.data.admin_packet_status;
            });
            console.log(this.TransportStatus);
        },
        add_to_packet() {
            if (this.parkets.indexOf(this.SearchData) === -1) {
                this.parkets.push(this.SearchData);
            } else {
                this.$swal("Đơn hàng đã tồn tại vui lòng chọn đơn hàng khác!");
            }
            console.log(this.parkets);
        },
        remove_from_parket(order) {
            this.parkets = this.parkets.filter(function (el) {
                return el.order_code != order.order_code;
            });
            console.log(this.parkets);
        },
        Add_bag(event) {
            // this.isLoading = true;

            var data = {};
            let target = event.target;
            for (let i = 0; i < target.length; i++) {
                data[target.elements[i].name] = target.elements[i].value;
            }
            if (target.wood_packing.checked) {
                data["wood_packing"] = 1;
            } else {
                data["wood_packing"] = 0;
            }
            if (target.paid.checked) {
                data["paid"] = 1;
            } else {
                data["paid"] = 0;
            }

            data.order_items = this.parkets;
            console.log(data);

            insert(data)
                .then((response) => {
                    if (response.data.errors) {
                        this.$swal("Bạn chưa nhập đủ thông tin !");
                    } else if (response.data.error) {
                        this.$swal(response.data.message);
                    } else {
                        this.$swal("Tạo bao hàng thành công !");
                        this.$router.push("/bag");
                    }
                    console.log(response);
                })
                .catch((error) => {
                    this.$swal(error.data.message);
                    console.log(error);
                })
                .finally(() => {
                    this.isLoading = false;
                });
        },
        async Search(event) {
            var code = event.target.code.value;
            this.isLoading = true;
            if (code) {
                this.SearchData = await search(code)
                    .then(function (response) {
                        return response.data.order;
                    })
                    .finally(() => {
                        this.isLoading = false;
                    });
                if (!this.SearchData.order_code) {
                    this.$swal("Không tìm thấy đơn hàng!");
                }
            } else {
                this.SearchData.code = "";
                this.SearchData.order_code = "";
            }
        },
    },
};
</script>
<style></style>
