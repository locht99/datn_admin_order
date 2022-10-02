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
                                    <div><label for="">Loại giao dịch</label><select name="admin_transactions[type_id]"
                                            v-model="state.data.type" id="admin_transactions_type"
                                            class="w-full border-gray-300 rounded my-2 px-2 py-1">
                                            <option value="">
                                                -- Chọn loại giao dịch --
                                            </option>
                                            <option v-for="(item, index) in this.dataTypeChina" :key="index"
                                                :value="item.id">{{item.name}}</option>

                                        </select>
                                        <span v-if="v$.data.type.$error">
                                            {{v$.data.type.$errors[0].$messgae}}
                                        </span>
                                        <!--v-if-->
                                    </div>
                                    <div class="relative"><label for="">Ngày</label>
                                        <Datepicker name="admin_transactions[date]" type="text"
                                            v-model="state.data.date"
                                            class="w-full border-gray-300 rounded my-2 px-2 py-1 bg-gray-100" />
                                        <span v-if="v$.data.date.$error">
                                            {{v$.data.date.$errors[0].$messgae}}
                                        </span>
                                    </div>
                                    <div><label for="">Số tiền</label><input name="admin_transactions_point"
                                            v-model="state.data.point_cn" type="text"
                                            class="w-full border-gray-300 rounded my-2 px-2 py-1">
                                        <span v-if="v$.data.point_cn.$error">
                                            {{v$.data.point_cn.$errors[0].$messgae}}
                                        </span>
                                    </div>
                                    <div>
                                        <label for="">Số dư</label>
                                        <input type="text" v-model="state.data.surplus"
                                            class="w-full border-gray-300 rouned my-2 px-2 py-1 rounded">
                                        <span v-if="v$.data.surplus.$error">
                                            {{v$.data.surplus.$errors[0].$messgae}}
                                        </span>
                                    </div>
                                    <!--v-if-->
                                </div>
                                <div>
                                    <div><label for="">Nội dung</label><textarea name="admin_transactions[content]"
                                            v-model="state.data.content"
                                            class="w-full border-gray-300 rounded my-2 px-2 py-1"></textarea>
                                        <!--v-if-->
                                        <span v-if="v$.data.content.$error">
                                            {{v$.data.content.$errors[0].$messgae}}
                                        </span>
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
import { insert } from '../../../services/ChinaMoney/ChinaMoney';
import Datepicker from 'vue3-datepicker';
import { required } from '@vuelidate/validators';
import { useVuelidate } from '@vuelidate/core';
import { reactive, computed } from 'vue';
export default {
    data() {
        return {
            showModal: this.showModalAction,
            modal: false,
            isLoading: false,
            backGroundcolor: '#E93B3B',
        }
    },
    setup() {
        const state = reactive({
            data: {
                type: 0,
                date: new Date(),
                point_cn: 0,
                content: '',
                surplus: 0
            },
        });
        const rules = computed(() => {
            return {
                data: {
                    type: { required },
                    date: { required },
                    point_cn: { required },
                    content: { required },
                    surplus: { required }
                }
            }
        });
        const v$ = useVuelidate(rules, state);
        return {
            state,
            v$
        }
    },
    components: {
        Loading,
        Datepicker
    },

    props: {
        showModalAction: Boolean,
        dataTypeChina: Array,
        getData: Function,
    },
    validations() {
        return {

        }
    },
    methods: {
        toggleModal: function () {
            this.$emit('showModal', this.showModalAction);
        },
        createTransaction() {
            this.isLoading = true;
            insert(this.state.data).then((response) => {
                this.isLoading = false
                if (response.data.errors) {
                    this.$swal(response.data.errors);
                } else {
                    // this.data = ;
                    console.log(response.data.data);
                    this.$swal(response.data.message);
                    this.$emit('showModal', true);
                    this.$emit('foobar');

                }
                this.data.type = 0;
                this.data.point_cn = 0;
                this.data.surplus = 0;
                this.data.content = '';

            }).catch((error) => {
                this.$swal(error.data.message);
            }).finally(() => {
                this.isLoading = false
            })
        }
    }
}
</script>