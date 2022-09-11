<template>
    <div>
        <div>
            <div class="order">
                <div class="head-order flex justify-between items-center ">
                    <div class="title-order">
                        <p class="text-medium text-gray-800 text-[20px] p-3">Đơn hàng</p>
                    </div>
                    <div class="filter-order">
                        <span class="text-[23px] cursor-pointer hover:bg-white px-4  rounded-full"
                            @click="open_filter()">
                            <button>
                                <font-awesome-icon icon="fas fa-sliders-h" />
                            </button>
                        </span>
                    </div>
                </div>
                <div class="main-order">
                    <div class="status-table flex  items-center bg-red-600 rounded-t-[10px]">
                        <div v-for="data in status"
                            class="w-full flex items-center hover:underline text-white hover:text-white py-1 px-[26px] text-[13px] cursor-pointer">
                            <button>
                                {{data.name}}
                            </button>
                            <div class="bg-white text-black rounded">100</div>
                        </div>
                    </div>
                    <table class="table-auto w-full border text-center bg-white">
                        <thead>
                            <tr>
                                <th v-for="data in nameTable" class="border-b bg-gray-200 text-[15px]">
                                    {{data.name}}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="hover:bg-gray-100 border-b">
                                <td>1</td>
                                <td>1</td>
                                <td>1</td>
                                <td>1</td>
                                <td>1</td>
                                <td>1</td>
                                <td>1</td>
                                <td>1</td>
                                <td>1</td>
                            </tr>
                            <tr class="hover:bg-gray-100 border-b">
                                <td>1</td>
                                <td>1</td>
                                <td>1</td>
                                <td>1</td>
                                <td>1</td>
                                <td>1</td>
                                <td>1</td>
                                <td>1</td>
                                <td>1</td>
                            </tr>
                            <tr class="hover:bg-gray-100">
                                <td>1</td>
                                <td>1</td>
                                <td>1</td>
                                <td>1</td>
                                <td>1</td>
                                <td>1</td>
                                <td>1</td>
                                <td>1</td>
                                <td>1</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <Filter v-on:filter_action="updateOpenFilter($event)" :filter="this.openFilter" :styleFilter="this.styleFilter" />

    </div>
</template>
<script>
import Filter from '../Filter/FilterComponent.vue';

export default {
    data() {
        return {
            openFilter: true,
            styleFilter: '',
            status: [
                {
                    name: "Đã đặt cọc"
                },
                {
                    name: "Đã mua hàng"
                },
                {
                    name: "Shop giao hàng"
                },
                {
                    name: "Kho nhận hàng"
                },
                {
                    name: "Vận chuyển"
                },
                {
                    name: "Chờ giao"
                },
                {
                    name: "Chờ giao yêu cầu"
                },
                {
                    name: "Đang yêu cầu"
                }
            ],
            nameTable: [
                {
                    name: 'STT'
                },
                {
                    name: 'ĐƠN HÀNG'
                },
                {
                    name: 'NGÀY'
                },
                {
                    name: 'TÀI KHOẢN'
                }, {
                    name: 'WEBSITE'
                },
                {
                    name: 'MÃ VẬN ĐƠN'
                },
                {
                    name: 'GIÁ VỐN'
                },
                {
                    name: 'TỔNG'
                },
                {
                    name: 'TÌNH TRẠNG'
                }
            ]
        }
    },
    components: {
        Filter
    },

    methods: {
        open_filter() {
            this.openFilter = !this.openFilter;
            this.styleFilter = 'translate-x-[-360px] duration-300 ';
        },
        updateOpenFilter(newVal) {
            this.styleFilter = newVal;
        }
    }
}
</script>
<style>

</style> 