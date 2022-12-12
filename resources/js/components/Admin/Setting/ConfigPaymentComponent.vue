<template>
    <div>
        <div class="pt-6 relative">
            <div class="title"><h1 class="text-[#566a7f] text-[28px] font-[700]"> Thông tin thanh toán</h1></div>

            <table class="w-full rounded-t-md overflow-hidden bg-white">
                <thead class="bg-[#FF3F3A] text-white h-[40px] font-bold text-[16px]">
                    <tr class="px-2 text-left">
                        <th class="text-center">STT</th>
                        <th class="pl-5">Serec key(Mã bảo mật)</th>
                        <th>Assecc Key(Mã truy cập)</th>
                        <th>Api End Point(Đường dẫn môi trường)</th>
                        <th>Suppliter(Nhà cung cấp)</th>
                        <th>Partner Code(Mã đối tác)</th>
                        <th class="w-1/10"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="item border-solid border-b-[1px] border-[#E2E2E2] h-[52px] font-[16px]">
                        <td class="font-bold text-center">1</td>
                        <td class="pl-5"> {{'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa'.slice(0,20)}}...</td>
                        <td>klm05TvNBzhg7h7j</td>
                        <td>https://test-payment.momo.vn</td>
                        <td>Momo</td>
                        <td>MOMOBKUN20180529</td>
                        <td class="">
                                <button @click="isOpen = true">
                                <font-awesome-icon icon="fa-regular fa-pen-to-square "
                                    class="mt-1 text-[#FF3F3A] text-[20px] cursor-pointer" />
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <EditConfigPaymentComponentVue :open="isOpen" @close = "isOpen = !isOpen"></EditConfigPaymentComponentVue>
    </div>
</template>
<script>
import EditConfigPaymentComponentVue from './EditConfigPaymentComponent.vue';
export default {
    data(){
        return {
            isOpen: false
        }
    },
    components:{
     EditConfigPaymentComponentVue
    },
    method:{
        Actionchild($event){
        // this.showModalAction = !$event
       }
    },
    
}
</script>
<style lang="">
    
</style>