<template>
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
                        Tạo mới đối tác
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
                    <div class="form-point my-4 mx-4">
                        <form  >
                            <div class="grid grid-cols-2 gap-4 mb-4">
                                <div>


                                    <div><label for="">Tên</label><input name="admin_transactions_point" type="text"
                                            class="w-full border-gray-300 rounded my-2 px-2 py-1" 
                                            v-model="v$.form.name.$model">
                                            <div class="input-errors" v-for="(error, index) of v$.form.name.$errors"
                                            :key="index">
                                            <div class="error-msg">{{ error.$message }}</div>
                                        </div>
                                    </div>
                                    <div>
                                        <label for="">Điện thoại</label>
                                        <input type="text" class="w-full border-gray-300 rouned my-2 px-2 py-1 rounded"
                                        v-model="v$.form.phone.$model">
                                            <div class="input-errors" v-for="(error, index) of v$.form.phone.$errors"
                                            :key="index">
                                            <div class="error-msg">{{ error.$message }}</div>
                                        </div>
                                    </div>
                                    <!--v-if-->
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
                    <button style="background:red" :disabled="v$.form.$invalid" v-on:click="createPartner()"
                    class=" bg-transparent border border-solid border-red-500 bg-red-500 text-white active:bg-red-600 font-bold uppercase text-sm px-6 py-3 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                        type="button">
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
import Datepicker from 'vue3-datepicker';
import { insert } from '../../../services/partner/partner.js';
import { required,decimal } from '@vuelidate/validators';
import useVuelidate from '@vuelidate/core';
import { reactive, computed } from 'vue';


export default {
    watch: {
        $route: {
            immediate: true,
            handler(to, from) {
                document.title ='Thêm đối tác';
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
                name: '',
                phone: ''
            }


        }
    },
    validations() {
        return {
            form: {
                name: {
                    required
                },
                phone: {
                    required,decimal
                }
            }
        }
    },
    emits: {
        showModal: Boolean,
        foobar: Function
    },
   
    components: {
        Loading,
        Datepicker,
    },
    props: {
        showModalAction: Boolean,
        foobar: Function
    },

    methods: {
        toggleModal: function () {
            this.$emit('showModal', this.showModalAction);
        },
        createPartner: function () {
            this.isLoading = true;
            insert(this.form).then((response)=>{
                const {error,message} = response.data;
                if(error){
                    this.form.phone = '';
                    this.$swal(message.phone[0]);
                }else{
                    this.$swal('Thêm đối tác thành công');
                    this.$emit('showModal', true);
                    this.$emit('foobar');
                    this.form.name = '';
                    this.form.phone = '';

                }
            }).finally(()=>{
                this.isLoading = false;
            });
        }

    }
}
</script>