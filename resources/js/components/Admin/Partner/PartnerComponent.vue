<template>
    <div class=" pt-6 relative duration-300">
        <div class="flex justify-between">
            <div class="title">
                <h1 class="text-[#566a7f] text-[28px] font-[700]">
                    Đối Tác
                </h1>
            </div>
            <div class="flex justify-between items-center mx-5">
                <div class="p-3">
                    <button @click="open_modal()" data-modal-toggle="large-modal"
                        class="bg-[#E93B3B] hover:bg-orange-800 duration-300 text-white py-1 px-8 rounded">
                        + Tạo đối tác mới
                    </button>
                </div>
                <div>
                    <span class="text-[23px] cursor-pointer hover:bg-white px-4 rounded-full" @click="open_filter()">
                        <button>
                            <font-awesome-icon icon="fas fa-sliders-h" />
                        </button>
                    </span>
                </div>
            </div>
        </div>
        <div class="main mt-6">
            <table class="w-full rounded-t-md overflow-hidden bg-white">
                <thead class="bg-[#FF3F3A] text-white h-[40px] font-bold text-[16px]">
                    <tr class="px-2 text-left">
                        <th class="text-center">STT</th>
                        <th class="pl-5">TÊN</th>
                        <th>ĐIỆN THOẠI</th>
                        <th>ĐIỂM</th>
                        <th>ĐÃ KÍCH HOẠT</th>
                        <th>KHÓA</th>
                        <th>NGÀY TẠO</th>
                        <th class="w-1/10"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="item border-solid border-b-[1px] border-[#E2E2E2] h-[52px] font-[16px]">
                        <td class="font-bold text-center">1</td>
                        <td class="pl-5">PX20220731_0001</td>
                        <td>Có</td>
                        <td>Không</td>
                        <td>1,446,700</td>
                        <td>0</td>
                        <td>Chưa thanh toán</td>
                        <td class="">
                            <font-awesome-icon icon="fa-regular fa-pen-to-square "
                                class="mt-1 text-[#FF3F3A] text-[20px] cursor-pointer" />
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <Filter v-on:filter_action="updateOpenFilter($event)" :filter="this.openFilter"
            :styleFilter="this.styleFilter" />

    </div>
    <AddPartnerComponent v-on:showModal="updateOpenModal($event)" :showModalAction="this.showModals">
    </AddPartnerComponent>
</template>
<script>
import Filter from '../Filter/FilterComponent';
import AddPartnerComponent from './AddPartnerComponent.vue';
import { getAll } from '../../../services/partner/partner.js';

export default {
    data() {
        return {
            openFilter: true,
            styleFilter: '',
            showModals: false,
        }
    },

    components: {
        Filter,
        AddPartnerComponent,
    },

    methods: {
        open_filter() {
            this.openFilter = !this.openFilter;
            this.styleFilter = 'translate-x-[-360px] duration-300 ';
        },
        updateOpenFilter(newVal) {
            this.styleFilter = newVal;
        },
        open_modal() {
            this.showModals = !this.showModals;
        },
        updateOpenModal(event) {
            this.showModals = !event;
        }
    }
};
</script>
