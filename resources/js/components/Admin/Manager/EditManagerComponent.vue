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
                            Chỉnh sửa thông tin quản trị viên
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
                                                    v-model="v$.form.username.$model">
                                                <div class="input-errors" v-for="(error, index) of v$.form.username.$errors"
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
                                                    v-model="v$.form.phone.$model"
                                                    class="w-full border-gray-300 rouned my-2 px-2 py-1 rounded">
                                                 
                                                <div class="input-errors"
                                                    v-for="(error, index) of v$.form.phone.$errors" :key="index">
                                                    <div class="error-msg">{{ error.$message }}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex items-center w-full">
                                            <div class="w-[30%]">
                                                <label for="">Vai trò</label>
                                            </div>
                                            <div class="w-[70%]">
                                                <select name="" v-model="v$.form.role.$model" id="" class="w-full border-gray-300 rouned my-2 px-2 py-1 rounded">
                                                    <option value="1">Admin tổng</option>
                                                    <option value="2">Admin</option>
                                                    <option value="3">Nhân viên</option>
                                                </select>
                                                <div class="input-errors"
                                                    v-for="(error, index) of v$.form.role.$errors" :key="index">
                                                    <div class="error-msg">{{ error.$message }}</div>
                                                </div>
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
                        <button :disabled="v$.form.$invalid" v-on:click="updateManager()"
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
import { update, get } from '../../../services/Manager/manager.js';
import { required, decimal } from '@vuelidate/validators';
import useVuelidate from '@vuelidate/core';
export default {
    watch: {
        $route: {
            immediate: true,
            handler(to, from) {
                document.title ='Cập nhật tài khoản';
            }
        },
  },
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
                role: "",
            },
            params: {}

        }
    },
    validations() {
        return {
            form: {
                username: {
                    required
                },
                phone: {
                    required, decimal
                },
                role: {
                    required
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
        this.getManager(this.item)
    },
    methods: {
        toggleModal: function () {
            this.$emit('showModal', this.showModalAction);
        },

        getManager(item) {
            this.form = {...item}
        },
        updateManager() {
            this.isLoading = true;
            this.params = {...this.form}
            update(this.params).then((response) => {
                const { error, message } = response.data;
                if (error) {
                    this.$swal(message.phone[0]);
                } else {
                    this.$swal('Cập nhật thông tin thành công');
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
                getPartner: (item) => this.getManager(item)
            });
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
<style lang="">
    
</style>