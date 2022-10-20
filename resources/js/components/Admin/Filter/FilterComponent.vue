<template>
    <div id="filter"
        class="absolute flex right-[-380px]  z-10  top-[-90px] overflow-hidden filterProduct dark:bg-gray-700 shadow"
        v-bind:class="[styleFilter,filterTranform]">
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
                                    <input type="date" v-model="this.form.from" class="w-[100%] py-2 ">
                                </div>
                                <div class="border-r-2"></div>
                                <div class="w-[70%]">
                                    <input type="date" v-model="this.form.to" class="w-[80%] py-2 ">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="filter-children">
                        <div class="label py-4">
                            <label for="" class="w-full ml-2">Theo tài khoản</label>
                            <div class="flex w-[90%] mx-auto pb-3 mt-3 border-b ">
                                <input v-model="this.form.name"
                                    class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none font-medium"
                                    type="text" placeholder="Tài khoản" aria-label="Full name">

                            </div>
                        </div>
                    </div>
                    <div class="filter-children" v-if="this.dataType">
                        <div class="label py-4">
                            <label for="" class="w-full ml-2">Theo loại</label>
                            <div class="flex mx-auto w-[90%] pb-3 mt-3 border-b ">
                                <select class="w-full" v-model="this.form.type">

                                    <option :value="item.id" v-for="item in this.dataType ">{{item.name}}</option>
                                </select>
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
                                <button @click="searchData"
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
export default {

    data() {
        return {
            filterAction: true,
            filterTranform: this.styleFilter,
            form: {
                from: '',
                to: '',
                name: '',
                type: ''
            }
        }
    },
    components: {
    },

    props: {
        filter: Boolean,
        styleFilter: String,
        dataType: [],
        function: Function
    },
    methods: {
        filters_action() {
            this.$emit('filter_action', 'duration-300')
        },
        searchData() {
            this.$emit('filter_action', 'duration-300');
            this.$emit('function', 1, this.form);
        }
    }
}
</script>
