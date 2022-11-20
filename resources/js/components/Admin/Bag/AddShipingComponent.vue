<template>
    <div v-if="this.showModalAction"
        class="overflow-x-hidden overflow-y-auto  fade  fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center flex">
        <div class="relative w-auto my-6 mx-auto max-w-6xl">
            <!--content-->
            <form @submit="checkForm">
                <div
                    class="modal-cart border-0 rounded-lg shadow-lg relative flex flex-col bg-white outline-none focus:outline-none w-[1200px]">
                    <!--header-->
                    <div class="flex items-start justify-between p-5 border-b border-solid border-slate-200 rounded-t">
                        <h3 class="text-gray-500 text-3xl font-semibold">
                            Tạo vận đơn
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
                                                            <input v-model="data_form.name_product" name="name_product"
                                                                type="text" placeholder="Tên sản phẩm"
                                                                class="w-full border-gray-300 rounded px-2 py-1">
                                                            <div class="text-red-600"
                                                                v-for="error of v$.data_form.name_product.$errors"
                                                                :key="error.$uid">{{ error.$message }}</div>
                                                        </div>
                                                        <div>
                                                            <input v-model="data_form.weight" type="number"
                                                                placeholder="Tổng khối lượng"
                                                                class="w-[90%] border-gray-300 rounded px-2 py-1">
                                                            <div class="text-red-600"
                                                                v-for="error of v$.data_form.weight.$errors"
                                                                :key="error.$uid">{{ error.$message }}</div>
                                                        </div>
                                                        <div>
                                                            <input v-bind="data_form.code_order" type="text" disabled
                                                                :value="this.data_order_transport.id"
                                                                placeholder="Mã sản phẩm"
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
                                                            <input v-model="data_form.length" type="number"
                                                                placeholder="Dài"
                                                                class="w-[90%] border-gray-300 rounded px-2 py-1">
                                                            <div class="text-red-600"
                                                                v-for="error of v$.data_form.length.$errors"
                                                                :key="error.$uid">{{ error.$message }}</div>
                                                        </div>
                                                        <div>
                                                            <input v-model="data_form.width" type="number"
                                                                placeholder="Rộng"
                                                                class="w-[90%] border-gray-300 rounded px-2 py-1">
                                                            <div class="text-red-600"
                                                                v-for="error of v$.data_form.width.$errors"
                                                                :key="error.$uid">{{ error.$message }}</div>
                                                        </div>
                                                        <div>
                                                            <input v-model="data_form.height" type="number"
                                                                placeholder="Cao"
                                                                class="w-[90%] border-gray-300 rounded px-2 py-1">
                                                            <div class="text-red-600"
                                                                v-for="error of v$.data_form.height.$errors"
                                                                :key="error.$uid">{{ error.$message }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="flex justify-between">
                                                        <div class="">
                                                            <div>
                                                                <label class="text-gray-500" for="">Tổng tiền thu hộ
                                                                    COD</label><br>
                                                                <p
                                                                    class="text-gray-500 w-full px-2 py-2 text-sm border  lg:text-sm">
                                                                    {{ formatPrice(this.total_cod_amount) }}
                                                                </p>
                                                            </div>
                                                            <div>
                                                                <label class="text-gray-500" for="">Tổng giá trị hàng
                                                                    hoá</label><br>
                                                                <p
                                                                    class="text-gray-500 w-full px-2 py-2 text-sm border  lg:text-sm">
                                                                    {{
                                                                            formatPrice(this.data_order_transport.total_price)
                                                                    }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="w-[50%]">
                                                            <label class="text-gray-500" for="">Lưu ý giao hàng</label>
                                                            <select v-model="data_form.required_note"
                                                                class="text-gray-500 w-full border-gray-300 rounded my-2 px-2 py-1">
                                                                <option aria-selected="true" value="CHOTHUHANG">Cho thử
                                                                    hàng</option>
                                                                <option value="CHOXEMHANGKHONGTHU">Cho xem hàng không
                                                                    thử
                                                                </option>
                                                                <option value="KHONGCHOXEMHANG">Không cho xem hàng
                                                                </option>
                                                            </select>
                                                            <div class="text-red-600"
                                                                v-for="error of v$.data_form.required_note.$errors"
                                                                :key="error.$uid">{{ error.$message }}</div>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <label class="text-gray-500" for="">Ghi chú</label><br>
                                                        <textarea v-model="data_form.note"
                                                            class="text-gray-500 border-gray-300" name="" id=""
                                                            cols="40" rows="4"></textarea>
                                                        <div class="text-red-600"
                                                            v-for="error of v$.data_form.note.$errors"
                                                            :key="error.$uid">{{ error.$message }}</div>
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
                                        </div>
                                        <div class="justify-center w-full mx-auto">
                                            <div class="">
                                                <div class="space-x-0 lg:flex lg:space-x-4">
                                                    <div class="w-full lg:w-1/2">
                                                        <label for="firstName"
                                                            class="block mb-3 text-sm font-semibold text-gray-500">Họ
                                                            tên</label>
                                                        <p
                                                            class="text-gray-500 w-full px-4 py-3 text-sm border lg:text-sm">
                                                            {{ this.info_user.name }}
                                                        </p>
                                                    </div>
                                                    <div class="w-full lg:w-1/2 ">
                                                        <label for="firstName"
                                                            class="block mb-3 text-sm font-semibold text-gray-500">Điện
                                                            thoại</label>
                                                        <p
                                                            class="text-gray-500 w-full px-4 py-3 text-sm border  lg:text-sm">
                                                            {{ this.info_user.phone }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="">
                                                    <label class="text-gray-500" for="">Tỉnh thành</label>
                                                    <p
                                                        class="text-gray-500 w-full px-4 py-3 text-sm border  lg:text-sm">
                                                        {{ this.info_user.province }}
                                                    </p>
                                                </div>
                                                <div class="">
                                                    <label class="text-gray-500" for="">Quận / huyện</label>
                                                    <p
                                                        class="text-gray-500 w-full px-4 py-3 text-sm border  lg:text-sm">
                                                        {{ this.info_user.district }}
                                                    </p>
                                                </div>
                                                <div class="">
                                                    <label class="text-gray-500" for="">Xã / phuờng</label>
                                                    <p
                                                        class="text-gray-500 w-full px-4 py-3 text-sm border  lg:text-sm">
                                                        {{ this.info_user.ward }}
                                                    </p>
                                                </div>
                                                <div class="mt-4">
                                                    <div class="w-full">
                                                        <label for="Address"
                                                            class="block mb-3 text-sm font-semibold text-gray-500">Ghi
                                                            chú</label>
                                                        <p
                                                            class="text-gray-500 w-full px-4 py-3 text-sm border  lg:text-sm">
                                                            {{ this.info_user.note }}
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
            </form>
        </div>
    </div>
    <div v-if="this.showModalAction" class="opacity-25 fixed inset-0 z-40 bg-black"></div>
</template>
<script>
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';
import useVuelidate from '@vuelidate/core';
import { helpers, required, numeric, minValue, maxValue } from "@vuelidate/validators";
import { createShipingGhn, createShiping,createLogTracking } from "../../../services/transport/transport.js";
import { getOrder, getInfoUser, getDetailOrderGhn, getDetailOrderServiceGhn, updatePriceOrder } from '../../../services/Bag/bag.js'
export default {
    data() {
        return {
            v$: useVuelidate(),
            showModal: this.showModalAction,
            data_order_transport: [],
            total_cod_amount: 0,
            order: {},
            info_user: [],
            total_cod_amount: 0,
            total_price_order: 0,
            data_form: {
                name_product: null,
                code_order: null,
                weight: null,
                length: null,
                height: null,
                width: null,
                cod_amount: null,
                required_note: null,
                note: null

            },
            data_or: [],
            data_trans: []
        }
    },
    validations() {
        return {
            data_form: {
                name_product: { required: helpers.withMessage('Vui lòng nhập tên sản phẩm', required), $autoDirty: true },
                weight: { numeric: helpers.withMessage('Vui lòng nhập số', numeric), required: helpers.withMessage('Vui lòng nhập trọng lượng', required), $autoDirty: true },
                length: { numeric: helpers.withMessage('Vui lòng nhập số', numeric), required: helpers.withMessage('Vui lòng nhập chiều dài', required), $autoDirty: true },
                height: { numeric: helpers.withMessage('Vui lòng nhập số', numeric), required: helpers.withMessage('Vui lòng nhập chiều cao', required), $autoDirty: true },
                width: { numeric: helpers.withMessage('Vui lòng nhập số', numeric), required: helpers.withMessage('Vui lòng nhập bề rộng', required), $autoDirty: true },
                required_note: { required: helpers.withMessage('Vui lòng chọn lưu ý khi vận chuyển', required), $autoDirty: true },
                note: { required: helpers.withMessage('Bắt buộc nhập', required), $autoDirty: true },

            },
        }
    },
    components: {
        Loading,
    },
    emits: {
        showModal: Boolean,
        isLoadingAll: Boolean,
        item: Number,
    },
    props: {
        showModalAction: Boolean,
        item: Number,
        GetIdOrder: Boolean
    },
    mounted() {
        // Emits on mount
        this.emitInterface();
    },
    created() {
        this.getIdOrder()

    },
    methods: {
        toggleModal: function () {
            this.$emit('showModal', this.showModalAction);
        },
        getIdOrder(item) {
            getOrder(item).then((resp) => {
                this.data_order_transport = resp.data[0]
                this.total_cod_amount = +resp.data[0].purchase_fee + +resp.data[0].inventory_fee + +resp.data[0].total_price + +resp.data[0].global_shipping_fee + +resp.data[0].wood_packing_fee + +resp.data[0].separately_wood_packing_fee + +resp.data[0].high_value_fee + +resp.data[0].auto_shipping_fee + +resp.data[0].saving_shipping_fee + +resp.data[0].express_shipping_fee
                this.total_cod_amount = parseInt(this.total_cod_amount);
                getInfoUser(resp.data[0].address_id).then((res) => {
                    this.info_user = res.data[0]
                })
            })
        },
        emitInterface() {
            this.$emit("interface", {
                getIdOrder: (item) => this.getIdOrder(item)
            });
        },
        createShipingOrder() {
            this.v$.$touch();
            if (!this.v$.$error) {
                this.$swal.fire({
                    title: 'Bạn có chắc muốn tạo đơn vận chuyển không ?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Tạo'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.isLoading = true;
                        this.data_or = {
                            name_product: this.data_form.name_product,
                            code_order: this.data_form.code_order,
                            weight: this.data_form.weight,
                            length: this.data_form.length,
                            height: this.data_form.height,
                            width: this.data_form.width,
                            cod_amount: this.total_cod_amount,
                            required_note: this.data_form.required_note,
                            note: this.data_form.note
                        }
                        console.log(this.data_or)
                        createShipingGhn(
                            {
                                payment_type_id: 2,
                                note: this.data_or.note,
                                required_note: this.data_or.required_note,
                                client_order_code: "",
                                to_name: this.info_user.name,
                                to_phone: this.info_user.phone,
                                to_address: this.info_user.note,
                                to_ward_name: this.info_user.ward,
                                to_district_name: this.info_user.district,
                                to_province_name: this.info_user.province,
                                cod_amount: this.data_or.cod_amount,
                                content: this.data_or.note,
                                weight: this.data_or.weight,
                                length: this.data_or.length,
                                width: this.data_or.weight,
                                height: this.data_or.height,
                                service_id: 0,
                                service_type_id: 2,
                            }
                        ).then((resp) => {
                            let data = JSON.parse(resp.config.data)
                            this.data_trans = {
                                payment_type_id: data.payment_type_id,
                                note: data.note,
                                order_id: this.data_order_transport.id,
                                required_note: data.required_note,
                                client_order_code: data.client_order_code,
                                to_name: data.to_name,
                                to_phone: data.to_phone,
                                to_address: data.to_address,
                                to_ward_name: data.to_ward_name,
                                to_district_name: data.to_district_name,
                                to_province_name: data.to_province_name,
                                cod_amount: data.cod_amount,
                                content: data.content,
                                weight: data.weight,
                                length: data.length,
                                width: data.width,
                                height: data.height,
                                service_id: data.service_id,
                                service_type_id: data.service_type_id,
                                order_code: resp.data.data.order_code,
                                user_id: this.info_user.id,
                                status_name: "Chờ xác nhận"
                            }
                            createShiping(this.data_trans).then((response) => {
                                getDetailOrderGhn(this.data_trans.order_code).then((resp_cod) => {
                                    getDetailOrderServiceGhn(this.data_trans.order_code).then((resp) => {
                                        this.total_price_order = resp.data.data.detail.main_service += resp_cod.data.data.cod_amount
                                        console.log(this.data_trans.order_id)
                                        updatePriceOrder({
                                            id_order: this.data_trans.order_id,
                                            total_price_order: this.total_price_order
                                        }).then((resp) => {
                                            this.data_form = {
                                                name_product: null,
                                                code_order: null,
                                                weight: null,
                                                length: null,
                                                height: null,
                                                width: null,
                                                cod_amount: null,
                                                required_note: null,
                                                note: null
                                            }
                                            
                                            createLogTracking({
                                                order_id: this.data_order_transport.id,
                                                tracking_status_name: "Chờ xác nhận (Vn)"
                                            }).then((resp) =>{

                                            })
                                            this.$swal.fire(
                                                'Thông báo',
                                                'Tạo đơn vận thành công',
                                                'success',
                                                this.toggleModal()
                                            )
                                            
                                        })
                                    })
                                })

                            }).catch((error) => {
                                console.log(error)
                            })
                        }).catch((error) => {
                            console.log(error)
                        })
                    }
                });

            }

        },
        formatPrice(value) {
            return new Intl.NumberFormat("en-US", {
                style: "currency",
                currency: "VND",
            }).format(value);
        },
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