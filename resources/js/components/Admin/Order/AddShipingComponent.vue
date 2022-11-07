<template>
    <div v-if="this.showModalAction"
        class="overflow-x-hidden overflow-y-auto  fade  fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center flex">
        <div class="relative w-auto my-6 mx-auto max-w-6xl">
            <!--content-->
            <div
                class="modal-cart border-0 rounded-lg shadow-lg relative flex flex-col bg-white outline-none focus:outline-none w-[1200px]">
                <!--header-->
                <div class="flex items-start justify-between p-5 border-b border-solid border-slate-200 rounded-t">
                    <h3 class="text-gray-500 text-3xl font-semibold">
                        Tạo vận đơn {{this.data_order_id}}
                    </h3>
                    <button v-on:click="toggleModal()"
                        class="p-1 ml-auto bg-transparent border-0 text-gray-500 float-right text-3xl leading-none font-semibold outline-none focus:outline-none">
                        x
                    </button>
                </div>
                <!--body-->
                <div class="relative p-3 flex-auto">
                    <div class="flex items-center justify-between">
                        <div class="container p-10 mx-auto">
                            <div class="flex flex-col w-full px-0 mx-auto md:flex-row justify-between">

                                <div class="w-[67%]">
                                    <div class="pt-12 md:pt-0 2xl:ps-4">
                                        <h2 class="text-xl font-bold text-gray-500">Chi tiết đơn vận
                                        </h2>
                                        <div class="mt-4">
                                            <div class="space-y-4">
                                                <div
                                                    class=" text-gray-500 flex items-center justify-between w-full text-lg font-semibold border-gray-300 text-heading last:border-b-0 last:text-base last:pb-0">
                                                    <div>
                                                        <h3>| Sản phẩm</h3>
                                                    </div>
                                                </div>
                                                <div class="flex justify-between">
                                                    <div>
                                                        <input type="text" placeholder="Tên sản phẩm"
                                                            class="w-full border-gray-300 rounded px-2 py-1">
                                                    </div>
                                                    <div>
                                                        <input type="text" placeholder="Mã sản phẩm"
                                                            class="w-full border-gray-300 rounded px-2 py-1">
                                                    </div>
                                                    <div>
                                                        <input type="text" placeholder="Số lượng"
                                                            class="w-full border-gray-300 rounded px-2 py-1">
                                                    </div>
                                                </div>
                                                <div
                                                    class=" text-gray-500 flex items-center justify-between w-full text-lg font-semibold border-gray-300 text-heading last:border-b-0 last:text-base last:pb-0">
                                                    <div>
                                                        <h3>| Thông tin gói hàng</h3>
                                                    </div>
                                                </div>
                                                <div class="flex justify-between">
                                                    <div>
                                                        <input type="text" placeholder="Tổng khối lượng"
                                                            class="w-[90%] border-gray-300 rounded px-2 py-1">
                                                    </div>
                                                    <div>
                                                        <input type="text" placeholder="Dài"
                                                            class="w-[90%] border-gray-300 rounded px-2 py-1">
                                                    </div>
                                                    <div>
                                                        <input type="text" placeholder="Rộng"
                                                            class="w-[90%] border-gray-300 rounded px-2 py-1">
                                                    </div>
                                                    <div>
                                                        <input type="text" placeholder="Cao"
                                                            class="w-[90%] border-gray-300 rounded px-2 py-1">
                                                    </div>
                                                </div>
                                                <div class="flex justify-between">
                                                    <div class="">
                                                        <div>
                                                            <label class="text-gray-500" for="">Tổng tiền thu hộ
                                                                COD</label><br>
                                                            <input type="text" placeholder="0đ"
                                                                class=" border-gray-300 rounded px-2 py-1">
                                                        </div>
                                                        <div>
                                                            <label class="text-gray-500" for="">Tổng giá trị hàng
                                                                hoá</label><br>
                                                            <input type="text" placeholder="0đ"
                                                                class=" border-gray-300 rounded px-2 py-1">
                                                        </div>
                                                    </div>
                                                    <div class="w-[50%]">
                                                        <label class="text-gray-500" for="">Lưu ý giao hàng</label>
                                                        <select
                                                            class="text-gray-500 w-full border-gray-300 rounded my-2 px-2 py-1">
                                                            <option value="0"> -- Chọn loại giao dịch -- </option>
                                                            <option value="2">Thanh toán</option>
                                                            <option value="3">Phí kho</option>
                                                            <option value="4">Phí vận chuyển</option>
                                                            <option value="5">Chi phí nhân viên</option>
                                                            <option value="6">Khác</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div>
                                                    <label class="text-gray-500" for="">Ghi chú</label><br>
                                                    <textarea class="text-gray-500 border-gray-300" name="" id=""
                                                        cols="40" rows="4"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-[30%]">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <h2 class="mb-4 font-bold md:text-xl text-heading text-gray-500">Địa chỉ
                                                giao hàng
                                            </h2>
                                        </div>
                                        <div>
                                            <span
                                                class="text-gray-500 font-semibold text-[18px] cursor-pointer hover:underline hover:decoration-1">
                                                <font-awesome-icon icon="fa-solid fa-pen-to-square" />
                                            </span>
                                        </div>
                                    </div>
                                    <div class="justify-center w-full mx-auto">
                                        <div class="">
                                            <div class="space-x-0 lg:flex lg:space-x-4">
                                                <div class="w-full lg:w-1/2">
                                                    <label for="firstName"
                                                        class="block mb-3 text-sm font-semibold text-gray-500">Họ
                                                        tên</label>
                                                    <p class="text-gray-500 w-full px-4 py-3 text-sm border lg:text-sm">
                                                        Bùi Tiến Huy
                                                    </p>
                                                </div>
                                                <div class="w-full lg:w-1/2 ">
                                                    <label for="firstName"
                                                        class="block mb-3 text-sm font-semibold text-gray-500">Điện
                                                        thoại</label>
                                                    <p
                                                        class="text-gray-500 w-full px-4 py-3 text-sm border  lg:text-sm">
                                                        0338898903
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="">
                                                <label class="text-gray-500" for="">Tỉnh thành</label>
                                                <select
                                                    class="text-gray-500 w-full border-gray-300 rounded my-2 px-2 py-1">
                                                    <option value="0"> -- Chọn -- </option>
                                                    <option value="2">Thanh toán</option>
                                                    <option value="3">Phí kho</option>
                                                    <option value="4">Phí vận chuyển</option>
                                                    <option value="5">Chi phí nhân viên</option>
                                                    <option value="6">Khác</option>
                                                </select>
                                            </div>
                                            <div class="">
                                                <label class="text-gray-500" for="">Quận / huyện</label>
                                                <select
                                                    class="text-gray-500 w-full border-gray-300 rounded my-2 px-2 py-1">
                                                    <option value="0"> -- Chọn -- </option>
                                                    <option value="2">Thanh toán</option>
                                                    <option value="3">Phí kho</option>
                                                    <option value="4">Phí vận chuyển</option>
                                                    <option value="5">Chi phí nhân viên</option>
                                                    <option value="6">Khác</option>
                                                </select>
                                            </div>
                                            <div class="">
                                                <label class="text-gray-500" for="">Xã / phuờng</label>
                                                <select
                                                    class="text-gray-500 w-full border-gray-300 rounded my-2 px-2 py-1">
                                                    <option value="0"> -- Chọn -- </option>
                                                    <option value="2">Thanh toán</option>
                                                    <option value="3">Phí kho</option>
                                                    <option value="4">Phí vận chuyển</option>
                                                    <option value="5">Chi phí nhân viên</option>
                                                    <option value="6">Khác</option>
                                                </select>
                                            </div>
                                            <div class="mt-4">
                                                <div class="w-full">
                                                    <label for="Address"
                                                        class="block mb-3 text-sm font-semibold text-gray-500">Ghi
                                                        chú</label>
                                                    <p
                                                        class="text-gray-500 w-full px-4 py-3 text-sm border  lg:text-sm">
                                                        Nghách 63/33/71 nhà số 17 Lê Đức Thọ, Nam Từ Liêm, Hà Nội
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--footer-->
                <div class="flex items-center justify-end p-6 border-t border-solid border-slate-200 rounded-b">

                    <button v-on:click="createShipingOrder()"
                        class="text-white bg-transparent border border-solid border-red-500 hover:bg-red-600 hover:text-white bg-red-500 font-bold uppercase text-sm px-6 py-3 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                        type="button">
                        Tạo
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div v-if="this.showModalAction" class="opacity-25 fixed inset-0 z-40 bg-black"></div>
</template>
<script>
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';
import { createShipingGhn, createShiping } from "../../../services/transport/transport.js";
export default {
    data() {
        return {
            showModal: this.showModalAction,
            data_order_transport: [],
        }
    },
    components: {
        Loading,
    },
    emits: {
        showModal: Boolean,
        isLoadingAll: Boolean,
    },
    props: {
        showModalAction: Boolean,

    },

    methods: {
        toggleModal: function () {
            this.$emit('showModal', this.showModalAction);
        },
        createShipingOrder() {
            this.isLoading = true;
            // createShipingGhn(
            //     {
            //         payment_type_id: 2,
            //         note: "Tintest 123",
            //         required_note: "KHONGCHOXEMHANG",
            //         client_order_code: "",
            //         to_name: "Độ Mixi",
            //         to_phone: "0909998877",
            //         to_address: "Streaming house",
            //         to_ward_name: "Phường 14",
            //         to_district_name: "Quận 10",
            //         to_province_name: "TP Hồ Chí Minh",
            //         cod_amount: 200000,
            //         content: "Theo New York Times",
            //         weight: 200,
            //         length: 1,
            //         width: 19,
            //         height: 10,
            //         pick_station_id: 1444,
            //         service_id: 0,
            //         service_type_id: 2,
            //     }
            // ).then((resp) => {
            //     let data = JSON.parse(resp.config.data)
            //     this.data_order_transport = {
            //         payment_type_id: data.payment_type_id,
            //         note: data.note,
            //         order_id: 11,
            //         required_note: data.required_note,
            //         client_order_code: data.client_order_code,
            //         to_name: data.to_name,
            //         to_phone: data.to_phone,
            //         to_address: data.to_address,
            //         to_ward_name: data.to_ward_name,
            //         to_district_name: data.to_district_name,
            //         to_province_name: data.to_province_name,
            //         cod_amount: data.cod_amount,
            //         content: data.content,
            //         weight: data.weight,
            //         length: data.length,
            //         width: data.width,
            //         height: data.height,
            //         service_id: data.service_id,
            //         service_type_id: data.service_type_id,
            //         order_code: resp.data.data.order_code
            //     }
            //     createShiping(this.data_order_transport).then((response) => {
            //         console.log(response)
            //     }).catch((error) => {
            //         console.log(error)
            //     })
            // }).catch((error) => {
            //     console.log(error)
            // })
        }
    }
}
</script>

<style>
.modal-cart {
    transition: ease-in-out;
    animation-name: modalCart;
    animation-duration: 0.5s;
}

@keyframes modalCart {
    0% {
        transform: translateY(-160px);

    }

    100% {
        transform: translateY(0);
    }
}
</style>