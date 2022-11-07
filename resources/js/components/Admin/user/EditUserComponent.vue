<template>
    <div>
        <div v-if="this.showModalAction"
            class="overflow-x-hidden  overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center flex	 ease-in-out duration-500">
            <loading v-model:active="isLoading" :color="backGroundcolor" />

            <div class="relative  duration-300 delay-100 ease-in w-auto my-6 mx-auto max-w-6xl">
                <!--content-->
                <div
                    class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
                    <!--header-->
                    <div class="flex items-start justify-between p-5 border-b border-solid border-slate-200 rounded-t">
                        <h3 class="text-3xl font-semibold">
                            Chỉnh sửa thông tin người dùng
                        </h3>
                        <button
                            class="p-1 ml-auto bg-transparent border-0 opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none"
                            v-on:click="toggleModal()">
                            <span
                                class="bg-transparent text-black opacity-5 h-6 w-6 text-2xl block outline-none focus:outline-none">
                                X
                            </span>
                        </button>
                    </div>
                    <!--body-->
                    <div class="relative p-6 flex-auto">
                        <div class="form-point">
                            <form>
                                <div class="flex items-center justify-center w-full">
                                    <div class="w-full">
                                        <div class="flex items-center w-full">
                                            <div class="w-[30%]">
                                                <label for="">Tên đăng nhập</label>
                                            </div>
                                            <div class="w-[70%]">
                                                <input name="admin_transactions_point" type="text"
                                                    class="w-full border-gray-300 rounded my-2 px-2 py-1"
                                                    v-model="v$.form.username">
                                                <div class="input-errors" v-for="(error, index) of v$.form.name.$errors"
                                                    :key="index">
                                                    <div class="error-msg">{{ error.$message }}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex items-center w-full">
                                            <div class="w-[30%]">
                                                <label for="">Số điện thoại</label>
                                            </div>
                                            <div class="w-[70%]">
                                                <input type="text"
                                                    class="w-full border-gray-300 rouned my-2 px-2 py-1 rounded">
                                                 
                                                <div class="input-errors"
                                                    v-for="(error, index) of v$.form.phone.$errors" :key="index">
                                                    <div class="error-msg">{{ error.$message }}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex items-center w-full">
                                            <div class="w-[30%]">
                                                <label for="">Điểm</label>
                                            </div>
                                            <div class="w-[70%]">
                                                <input type="text" v-model="v$.form.point"
                                                    class="w-full border-gray-300 rouned my-2 px-2 py-1 rounded">
                                                <div class="input-errors"
                                                    v-for="(error, index) of v$.form.point.$errors" :key="index">
                                                    <div class="error-msg">{{ error.$message }}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex items-center w-full">
                                            <div class="w-[30%]">
                                                <label for="">Kích hoạt</label>
                                            </div>
                                            <div class="w-[70%]">
                                                <input type="checkbox"  v-model="this.is_running" />
                                            </div>
                                        </div>
                                     
                                    </div>

                                    <!--v-if-->

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
                        <button :disabled="v$.form.$invalid" v-on:click="updatePartner()"
                            class=" bg-transparent border border-solid border-red-500 bg-red-500 text-white active:bg-red-600 font-bold uppercase text-sm px-6 py-3 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                            type="button">
                            Lưu thay đổi
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="this.showModalAction" class="opacity-25 fixed inset-0 z-40 bg-black"></div>
    </div>
</template>
<script>
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';
import Datepicker from 'vue3-datepicker';
import { update, get } from '../../../services/partner/partner.js';
import { required, decimal } from '@vuelidate/validators';
import useVuelidate from '@vuelidate/core';
export default {
    data() {
        return {
            v$: useVuelidate(),
            showModal: this.showModalAction,
            modal: false,
            isLoading: false,
            backGroundcolor: '#E93B3B',
            form: {
                id: '',
                username: '',
                phone: Number,
                point: '',
            },
           


        }
    },
    validations() {
        return {
            form: {
                name: {
                    required
                },
                phone: {
                    required, decimal
                },
                point: {
                    required, decimal
                }
            }
        }
    },
    emits: {
        showModal: Boolean,
        foobar: Function,
        isLoadingEdit: Boolean,
        item: Object, 
    },

    components: {
        Loading,
        Datepicker,
    },
    props: {
        showModalAction: Boolean,
        foobar: Function,
        isLoadingEdit: Boolean,
        item: Object,
      
    },
    mounted() {
        // Emits on mount
        this.emitInterface();
        console.log(this.item)
    },
    methods: {
        toggleModal: function () {
            this.$emit('showModal', this.showModalAction);
        },

        getPartner(item) {
            this.form = {...item}
        },
        updatePartner() {
            const form = {...this.form}
            form.is_running =  this.is_running;
            this.isLoading = true;
            update(this.form.id, form).then((response) => {
                const { error, message } = response.data;
                console.log(message);
                if (error) {
                    this.$swal(message.phone[0]);
                } else {
                    this.$swal('Chỉnh sửa người dùng thành công');
                    this.$emit('showModal', true);
                    this.$emit('foobar');
                    this.form.name = '';
                    this.form.phone = '';

                }
            }).finally(() => {
                this.isLoading = false;
            });
        },
        emitInterface() {
            this.$emit("interface", {
                getPartner: (item) => this.getPartner(item)
            });
        }

    }
}
</script>
<style lang="">
    
</style>