<template>
    <div v-if="this.showModalAction"
        class="overflow-x-hidden  overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center flex	 ease-in-out duration-500">

        <div class="relative  duration-300 delay-100 ease-in w-auto my-6 mx-auto max-w-6xl">
            <!--content-->
            <div
                class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
                <!--header-->
                <div class="flex items-start justify-between p-5 border-b border-solid border-slate-200 rounded-t">
                    <h3 class="text-3xl font-semibold">
                        Nạp tiền, điều chỉnh
                    </h3>
                    <button
                        class="p-1 ml-auto bg-transparent border-0 opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none">
                        <span
                            class="bg-transparent text-black opacity-5 h-6 w-6 text-2xl block outline-none focus:outline-none">
                            X
                        </span>
                    </button>
                </div>
                <!--body-->
                <div class="relative p-6 flex-auto">
                    <div class="form-point my-4 mx-4">
                        <form>
                            <div class="grid grid-cols-2 gap-4 mb-4">
                                <div>
                                    <div><label for="">Loại giao dịch</label><select name="admin_transactions[type_id]"
                                            id="admin_transactions_type"
                                            class="w-full border-gray-300 rounded my-2 px-2 py-1">
                                            <option value="" selected>
                                                -- Chọn loại giao dịch --
                                            </option>
                                            <option>dsdfs</option>
                                        </select>
                                        <div class="input-errors">
                                            <div class="error-msg">fdfdf</div>
                                        </div>
                                        <!--v-if-->
                                    </div>
                                    <div class="relative"><label for="">Ngày</label>
                                        <Datepicker class="w-full border-gray-300 rounded my-2 px-2 py-1 bg-gray-100" />
                                        <div class="input-errors">
                                            <div class="error-msg">sdd</div>
                                        </div>

                                    </div>
                                    <div><label for="">Số tiền</label>

                                        <div class="input-errors">
                                            <div class="error-msg">dssdsd</div>
                                        </div>
                                    </div>
                                    <div>
                                        <label for="">Số dư</label>

                                        <div class="input-errors">
                                            <div class="error-msg">dsdsds</div>
                                        </div>
                                    </div>
                                    <!--v-if-->
                                </div>
                                <div>
                                    <div><label for="">Nội dung</label><textarea name="admin_transactions[content]"
                                            class="w-full border-gray-300 rounded my-2 px-2 py-1"></textarea>
                                        <!--v-if-->
                                        <div class="input-errors">
                                            <div class="error-msg">dsds</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!--footer-->
                <div class="flex items-center justify-end p-6 border-t border-solid border-slate-200 rounded-b">
                    <button
                        class="text-red-500 bg-transparent border border-solid border-red-500 hover:bg-red-500 hover:text-white active:bg-red-600 font-bold uppercase text-sm px-6 py-3 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                        type="button" v-on:click="toggleModal()">
                        Đóng
                    </button>
                    <button v-on:click="createShipingOrder()"
                        class=" bg-transparent border border-solid border-red-500 bg-red-500 text-white active:bg-red-600 font-bold uppercase text-sm px-6 py-3 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">
                        Create Order Shiping
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
import { getAll, createShipingGhn } from "../../../services/order/order.js";
export default {
    data() {
        return {
            showModal: this.showModalAction,
        }
    },
    components: {
        Loading,
    },
    emits: {
        showModal: Boolean,
        isLoadingAll: Boolean
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
            createShipingGhn(
                {
                    payment_type_id: 2,
                    note: "Tintest 123",
                    required_note: "KHONGCHOXEMHANG",
                    return_name: "Tin",
                    return_phone: "0909999999",
                    return_address: "123 Đường 3/2",
                    return_ward_name: "Phường 5",
                    return_district_name: "Quận 11",
                    return_province_name: "TP Hồ Chí Minh",
                    client_order_code: "",
                    to_name: "Độ Mixi",
                    to_phone: "0909998877",
                    to_address: "Streaming house",
                    to_ward_name: "Phường 14",
                    to_district_name: "Quận 10",
                    to_province_name: "TP Hồ Chí Minh",
                    cod_amount: 200000,
                    content: "Theo New York Times",
                    weight: 200,
                    length: 1,
                    width: 19,
                    height: 10,
                    pick_station_id: 1444,
                    deliver_station_id: null,
                    insurance_value: 100000,
                    service_id: 0,
                    service_type_id: 2,
                    coupon: null,
                    pick_shift: null,
                    pickup_time: 1665272576,
                    items: [
                        {
                            name: "Áo Polo",
                            code: "Polo123",
                            quantity: 1,
                            price: 200000,
                            length: 12,
                            width: 12,
                            height: 12,
                            category:
                            {
                                level1: "Áo"
                            }
                        }

                    ]
                }
            ).then((resp) => {
                console.log(resp)
            })
        }
    }
}
</script>