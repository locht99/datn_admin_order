<template>

    <div class="relative duration-300   ">
        <div class="">
            <div class="flex justify-between items-center ">
                <div class="title mx-5">
                    <p class="text-[#5c646b] text-[23px] font-medium">Tiền Việt</p>
                </div>
                <div>
                    <div class="flex justify-between items-center mx-5">
                        <div class="p-3">
                            <button data-modal-toggle="large-modal"
                                class="bg-[#E93B3B] hover:bg-orange-800 duration-300 text-white py-1 px-8 rounded ">+
                                Giao dịch mới</button>

                        </div>
                        <div>
                            <span class="text-[23px] cursor-pointer hover:bg-white px-4  rounded-full" @click="open_filter()">
                                <button >
                                    <font-awesome-icon icon="fas fa-sliders-h" />
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="py-2  ">
                <div class="overflow-hidden rounded-t-[13px] bg-white">
                    <table class="w-[100%] table-auto  border text-center">
                        <thead class="">
                            <tr class="bg-[#FF3F3A]    uppercase leading-normal ">
                                <th class="text-[14px] font-bold text-white  py-2 ">
                                    STT
                                </th>
                                <th class="text-[14px] font-bold text-white  py-2 ">
                                    NGÀY
                                </th>
                                <th class="text-[14px] font-bold text-white  py-2 ">
                                    LOẠI
                                </th>
                                <th class="text-[14px] font-bold text-white  py-2">
                                    TÀI KHOẢN
                                </th>
                                <th class="text-[14px] font-bold text-white  py-2">
                                    ĐƠN HÀNG
                                </th>
                                <th class="text-[14px] font-bold text-white  py-2">
                                    GÓI HÀNG
                                </th>
                                <th class="text-[14px] font-bold text-white  py-2">
                                    SỐ TIỀN
                                </th>
                                <th class="text-[14px] font-bold text-white  py-2">
                                    SỐ DƯ
                                </th>
                                <th class="text-[14px] font-bold text-white  py-2">
                                    NỘI DUNG
                                </th>
                                <th class="text-[14px] font-bold text-white  py-2">
                                    NGÀY TẠO
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="px-6 py-2 whitespace-nowrap text-sm font-bold text-gray-900 ">1
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap ">
                                    25-05-20 03:48
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap ">
                                    Phí kiện hàng
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap">
                                    Demo1
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap">
                                    <a href="" class="hover:text-blue-900">demo1</a>

                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap">
                                    0
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap">
                                    1,446,700
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap">
                                    0
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap">
                                    HÀ NỘI
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap">
                                    08-07-22 09:14
                                </td>

                            </tr>
                            <tr class="border-b hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="px-6 py-2 whitespace-nowrap text-sm font-bold text-gray-900 ">1
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap ">
                                    25-05-20 03:48
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap ">
                                    Phí kiện hàng
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap">
                                    Demo1
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap">
                                    <a href="">demo1</a>

                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap">
                                    0
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap">
                                    1,446,700
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap">
                                    0
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap">
                                    HÀ NỘI
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap">
                                    08-07-22 09:14
                                </td>

                            </tr>
                            <tr class="border-b hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="px-6 py-2 whitespace-nowrap text-sm font-bold text-gray-900 ">1
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap ">
                                    25-05-20 03:48
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap ">
                                    Phí kiện hàng
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap">
                                    Demo1
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap">
                                    <a href="">demo1</a>

                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap">
                                    0
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap">
                                    1,446,700
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap">
                                    0
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap">
                                    HÀ NỘI
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap">
                                    08-07-22 09:14
                                </td>

                            </tr>
                            <tr class="border-b hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="px-6 py-2 whitespace-nowrap text-sm font-bold text-gray-900 ">1
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap ">
                                    25-05-20 03:48
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap ">
                                    Phí kiện hàng
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap">
                                    Demo1
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap">
                                    <a href="">demo1</a>
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap">
                                    0
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap">
                                    1,446,700
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap">
                                    0
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap">
                                    HÀ NỘI
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap">
                                    08-07-22 09:14
                                </td>

                            </tr>

                        </tbody>
                    </table>
                    <div class="p-10">
                         
                    </div>
                </div>
            </div>
        </div>
        <Filter v-on:filter_action="updateOpenFilter($event)" :filter="this.openFilter" :styleFilter="this.styleFilter" />

    </div>

    <AddMoneyVietNam />
</template>
<script>
import AddMoneyVietNam from './AddMoneyVietNamComponent.vue';
import Filter from '../Filter/FilterComponent.vue';
export default {
    data() {
        return {
            openFilter: true,
            styleFilter: ''
        }
    },
    
    components: {
        AddMoneyVietNam,
        Filter
    },
  
    methods:{
        open_filter(){
            this.openFilter =! this.openFilter;
            this.styleFilter ='translate-x-[-360px] duration-300 ';
        },
        updateOpenFilter(newVal){
            this.styleFilter = newVal;
        }
    }
}
</script>
<style  scoped>

</style>