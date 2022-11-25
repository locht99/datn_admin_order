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
                        Nạp tiền, điều chỉnh
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
                        <form>
                            <div class="grid grid-cols-2 gap-4 mb-4">
                                <div>
                                    <div><label for="">Loại giao dịch</label><select v-model="v$.form.type.$model"
                                            name="admin_transactions[type_id]" id="admin_transactions_type"
                                            class="w-full border-gray-300 rounded my-2 px-2 py-1">
                                            <option value="" selected>
                                                -- Chọn loại giao dịch --
                                            </option>
                                            <option v-for="(item, index) in this.dataTypeChina" :key="index"
                                                :value="item.id">{{item.name}}</option>
                                        </select>
                                        <div class="input-errors" v-for="(error, index) of v$.form.type.$errors"
                                            :key="index">
                                            <div class="error-msg">{{error.$message }}</div>
                                        </div>
                                        <!--v-if-->
                                    </div>
                                    <div class="relative"><label for="">Ngày</label>
                                        <Datepicker v-model="v$.form.date.$model" disabled
                                            class="w-full border-gray-300 rounded my-2 px-2 py-1 bg-gray-100" />
                                        <div class="input-errors" v-for="(error, index) of v$.form.date.$errors"
                                            :key="index">
                                            <div class="error-msg">{{ error.$message }}</div>
                                        </div>

                                    </div>
                                    <div><label for="">Số tiền</label>
                                        <CurrencyInput v-model="v$.form.point_cn.$model" :options="{
                                          currency: 'VND',
                                          currencyDisplay: 'hidden',
                                          hideCurrencySymbolOnFocus: false,
                                          hideGroupingSeparatorOnFocus: false,
                                          hideNegligibleDecimalDigitsOnFocus: false,
                                        }" class="w-full border-gray-300 rounded my-2 px-2 py-1"></CurrencyInput>

                                        <div class="input-errors" v-for="(error, index) of v$.form.point_cn.$errors"
                                            :key="index">
                                            <div class="error-msg">{{ error.$message }}</div>
                                        </div>
                                    </div>
                                    <div>
                                        <label for="">Số dư</label>
                                        <CurrencyInput v-model="v$.form.surplus.$model" :options="{
                                          currency: 'VND',
                                          currencyDisplay: 'hidden',
                                          hideCurrencySymbolOnFocus: true,
                                          hideGroupingSeparatorOnFocus: false,
                                          hideNegligibleDecimalDigitsOnFocus: false,
                                        }" class="w-full border-gray-300 rounded my-2 px-2 py-1"></CurrencyInput>

                                        <div class="input-errors" v-for="(error, index) of v$.form.surplus.$errors"
                                            :key="index">
                                            <div class="error-msg">{{ error.$message }}</div>
                                        </div>
                                    </div>
                                    <!--v-if-->
                                </div>
                                <div>
                                    <div><label for="">Nội dung</label><textarea name="admin_transactions[content]"
                                            v-model="v$.form.content.$model"
                                            class="w-full border-gray-300 rounded my-2 px-2 py-1"></textarea>
                                        <!--v-if-->
                                        <div class="input-errors" v-for="(error, index) of v$.form.content.$errors"
                                            :key="index">
                                            <div class="error-msg">{{ error.$message }}</div>
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
                    <button :disabled="v$.form.$invalid" v-on:click="createTransaction()"
                        class=" bg-transparent border border-solid border-red-500 bg-red-500 text-white active:bg-red-600 font-bold uppercase text-sm px-6 py-3 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">
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
import { insert } from '../../../services/ChinaMoney/ChinaMoney';
import Datepicker from 'vue3-datepicker';
import { required, decimal,maxLength } from '@vuelidate/validators';
import CurrencyInput from '../../format_curency/CurrencyInput.vue';
import useVuelidate from '@vuelidate/core';
import { ref } from 'vue';
export default {
    watch: {
        $route: {
            immediate: true,
            handler(to, from) {
                document.title ='Thêm tiền trung';
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
                type: '',
                date: ref(new Date()),
                point_cn: '',
                content: '',
                surplus: ''
            }
        }
    },
    // setup() {
    //     return { v$: useVuelidate() }

    // },
    validations() {
        return {
            form: {
                type: {
                    required,
                    decimal
                },
                date: { required },
                point_cn: {
                    required, decimal,maxLengthValue:maxLength(10)
                },
                content: {
                    required
                },
                surplus: {
                    required, decimal,maxLengthValue:maxLength(10)
                }
            },
            message: ''
        }
    },
    components: {
        Loading,
        Datepicker,
        CurrencyInput
    },
    emits: {
        showModal: Boolean,
        foobar: Function,
        isLoadingAll:Boolean
    },
    props: {
        showModalAction: Boolean,
        dataTypeChina: Array,
        getData: Function,isLoadingAll:Boolean
    },

    methods: {
        toggleModal: function () {
            this.$emit('showModal', this.showModalAction);
        },
        createTransaction() {
            this.isLoading = true;
            insert(this.form).then((response) => {
                this.$emit('foobar');
                this.$emit('isLoadingAll',false);

                if (response.data.errors) {
                    this.message = response.data.errors;
                    this.$swal(this.message);
                } else {
                    // this.data = ;
                    // this.$swal(response.data.message);
                    this.$emit('showModal', true);
                    this.message = response.data.message;
                    this.$swal(this.message);


                }
                this.form.type = '';
                this.form.point_cn = '';
                this.form.surplus = '';
                this.form.content = '';

            })
                .catch((error) => {
                    this.isLoading = false;
                    this.$swal(error.data.message);
                }).finally(() => {
                    this.isLoading = false;
                })
        },
        formatCurrency(value) {
            let val = (value / 1).toFixed(2).replace('.', ',')
            return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        }
    }
}
</script>