<template>
    <div v-if="this.showModalAction"
        class="overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center flex	 ease-in-out duration-500">
        <loading v-model:active="isLoading" :color="backGroundcolor" />

        <div class="relative w-auto my-6 mx-auto max-w-6xl">
            <!--content-->
            <div
                class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
                <!--header-->
                <div class="flex items-start justify-between p-5 border-b border-solid border-slate-200 rounded-t">
                    <h3 class="text-3xl font-semibold">
                        Nạp tiền, điều chỉnh
                    </h3>
                    <button
                        class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none"
                        v-on:click="toggleModal()">
                        <span
                            class="bg-transparent text-black opacity-5 h-6 w-6 text-2xl block outline-none focus:outline-none">
                            ×
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
                                            v-model="data.type" id="admin_transactions_type"
                                            class="w-full border-gray-300 rounded my-2 px-2 py-1">
                                            <option value="0"> -- Chọn loại giao dịch -- </option>
                                            <option value="2">Thanh toán</option>
                                            <option value="3">Phí kho</option>
                                            <option value="4">Phí vận chuyển</option>
                                            <option value="5">Chi phí nhân viên</option>
                                            <option value="6">Khác</option>
                                        </select>
                                        <!--v-if-->
                                    </div>
                                    <div class="relative"><label for="">Ngày</label>
                                        <Datepicker name="admin_transactions[date]" type="text" v-model="data.date"
                                            class="w-full border-gray-300 rounded my-2 px-2 py-1 bg-gray-100" />
                                    </div>
                                    <div><label for="">Số tiền</label><input name="admin_transactions_point"
                                            v-model="data.point_vn" type="text"
                                            class="w-full border-gray-300 rounded my-2 px-2 py-1"></div>
                                    <!--v-if-->
                                </div>
                                <div>
                                    <div><label for="">Nội dung</label><textarea name="admin_transactions[content]"
                                            v-model="data.content"
                                            class="w-full border-gray-300 rounded my-2 px-2 py-1"></textarea>
                                        <!--v-if-->
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
                    <button
                        class="text-red-500 background-transparent font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                        type="button" @click="createTransaction()">
                        Lưu thay đổi
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
import { insert } from '../../../services/VietNamese';
import Datepicker from 'vue3-datepicker'
export default {
    data() {
        return {
            showModal: this.showModalAction,
            modal: false,
            isLoading: false,
            backGroundcolor: '#E93B3B',
            data: {
                type: 0,
                date: new Date(),
                point_vn: 0,
                content: ''
            },
        }
    },
    emits: {
        showModal:Boolean
    },
    components: {
        Loading,
        Datepicker
    },
    props: {
        showModalAction: Boolean,
    },
    methods: {
        toggleModal: function () {
            this.$emit('showModal', this.showModalAction)
        },
        createTransaction() {
            this.isLoading = true;
            insert(this.data).then((response) => {
                if (response.data.errors) {
                    this.$swal(response.data.errors);

                } else {
                    this.data = response.data.data;
                    // console.log(response.data)
                    this.$swal(response.data.message);
                    this.$router.push('/money-vietnamese');

                }
                this.data.type = 0;
                this.data.point_vn = 0;
                this.data.content = '';

            }).catch(error => {
                this.$swal(error.data.message);
                console.log(error);
            }).finally(() => {
                this.isLoading = false
            })
        }
    }
}
</script>