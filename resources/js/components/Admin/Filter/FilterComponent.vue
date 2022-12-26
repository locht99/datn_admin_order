<template>
    <div id="filter"
        class="absolute flex right-[-380px]  z-10  top-[-90px] overflow-hidden filterProduct dark:bg-gray-700 shadow"
        v-bind:class="[styleFilter, filterTranform]">
        <div class="bg-white max-w-[350px] h-screen drop-shadow-md border">
            <div class="fillter">
                <div class="filter-header bg-gray-100 p-4">
                    <div class="filter-title flex items-center justify-between">
                        <p class="text-black text-[20px] font-medium">Bộ lọc tìm kiếm</p>
                        <div class="text-[25px] cursor-pointer hover:bg-white px-3 py-1 duration-300  rounded-full"
                            @click="filters_action()">
                            <font-awesome-icon icon="fa fa-times-square" />
                        </div>
                    </div>
                </div>
                <div class="filter-main">
                    <div class="filter-children">
                        <div class="label py-4">
                            <label for="" class="w-full ml-2">Theo Ngày</label>
                            <div class="flex w-[90%]  mx-auto pb-3 mt-3 border-b ">
                                <div class="h-10">
                                    <input v-model="from" type="date" class="w-[100%] py-2 ">
                                </div>
                                <div class="border-r-2"></div>
                                <div class="w-[70%]">
                                    <input v-model="to" type="date" class="w-[80%] py-2 ">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="filter-children">
                        <div class="label py-4">
                            <label for="" class="w-full ml-2">Theo tài khoản</label>
                            <div class="flex w-[90%] mx-auto pb-3 mt-3 border-b ">
                                <input v-model="username"
                                    class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none font-medium"
                                    type="text" placeholder="Tài khoản" aria-label="Full name">

                            </div>
                        </div>
                    </div>
                    <div class="filter-children" v-if="listOrder">
                        <div class="label py-4">
                            <label for="" class="w-full ml-2">Theo mã đơn hàng</label>
                            <div class="flex mx-auto w-[90%] pb-3 mt-3 border-b ">
                                <input v-model="order_code"
                                    class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none font-medium"
                                    type="text" placeholder="Mã đơn" aria-label="Full name">
                            </div>
                        </div>
                    </div>
                    <div class="filter-children" v-if="orderModule">
                        <div class="label py-4">
                            <label for="" class="w-full ml-2">Theo loại</label>
                            <div class="flex mx-auto w-[90%] pb-3 mt-3 border-b ">
                                <select class="w-full" v-model="status">
                                    <option selected disabled>Select Option</option>
                                    <option v-for="(item, index) in this.data_status" :key="index" :value="item.id">{{
                                            item.type_name
                                    }}
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="filter-children" v-if="userModule">
                        <div class="label py-4">
                            <label for="" class="w-full ml-2">Theo số điện thoại</label>
                            <div class="flex w-[90%] mx-auto pb-3 mt-3 border-b ">
                                <input v-model="phone"
                                    class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none font-medium"
                                    type="text" placeholder="Số điện thoại" aria-label="Phone">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="filter-footer relative flex justify-center">
                    <div class="fixed bottom-0  ">
                        <div class="flex justify-around m-2">
                            <div class="button mr-3">
                                <button
                                    class="border-2 border-rose-600 px-3 py-2 text-rose-600 font-medium hover:bg-rose-600 hover:text-white duration-300">THIẾT
                                    LẬP LẠI</button>
                            </div>
                            <div class="button mr-3">
                                <button @click="getAllValueFilter()"
                                    class="bg-rose-600 px-5 py-[10px] text-white font-medium hover:bg-rose-800 duration-300">ÁP
                                    DỤNG</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { getAll } from '../../../services/Filter/filter.js';
export default {

    data() {
        return {
            filterAction: true,
            filterTranform: this.styleFilter,
            data_status: [],
            from: null,
            to: null,
            username: null,
            phone: null,
            status: null,
            data: [],
            order_code: null
        }
    },
    components: {
    },
    props: {
        filter: Boolean,
        styleFilter: String,
        userModule: false,
        orderModule: false,
        listOrder: false
    },
    created() {
        this.getAllTypeTransactions()
    },

    methods: {
        getAllValueFilter() {
            this.data = {
                from: this.from,
                to: this.to,
                username: this.username,
                status: this.status,
                phone: this.phone,
                order_code: this.order_code
            }
            this.$emit('values_filter', this.data)
            this.$emit('action_search')
        },
        filters_action() {
            this.$emit('filter_action', 'duration-300')
        },
        getAllTypeTransactions() {
            getAll().then((resp) => {
                this.data_status = resp.data
            })
        }
    }
}
</script>
