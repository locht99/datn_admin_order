<template>
    <div>
        <div class="order-detail">
            <div class="head-detail">
                <div class="title-order-detail">
                    <p class="text-gray-800 font-medium py-3">Chi tiết đơn hàng ##00123</p>
                </div>
            </div>
            <div class="main-order-detail">
                <div class="info-order-detail bg-white rounded">
                    <HeadDonHang />
                    <div class="border-b w-[95%] mx-auto"></div>
                    <div class="md:flex">
                        <div class="border-r md:w-[60%]">
                            <div class="p-4 ">
                                <div class="flex items-center mb-3">
                                    <p class="font-medium text-gray-800 text-[25px]">Chi tiết gói hàng:</p>
                                </div>
                                <div class="mb-3 bg-gray-200 p-3">
                                    <p>Số lượng khách đặt mua: 0123456789</p>
                                </div>
                                <div class="mb-3 p-3">
                                    Mã vận đơn: 123
                                </div>
                                <div class="mb-3 bg-gray-200 p-3">
                                    Tỷ giá (NDT/VNĐ): 3,400
                                </div>
                                <div class="mb-3 p-3">
                                    Khối lượng: 10kg
                                </div>
                                <div class="mb-3 bg-gray-200 p-3">
                                    Thể tích: 10kg
                                </div>
                                <div class="mb-3  p-3">
                                    Khối lượng quy đổi: 0kg
                                </div>
                            </div>

                        </div>
                        <div class="md:w-[40%] p-3">
                            <div class="note-titl font-medium text-gray-800 text-[25px] p-[6px]">Tùy chọn gói hàng: </div>
                                <div class="mb-3 bg-gray-200 p-3">
                                    <p>Kiểm hàng: 0123456789</p>
                                </div>
                                <div class="mb-3 p-3">
                                    Đóng gỗ: 123
                                </div>
                                <div class="mb-3 bg-gray-200 p-3">
                                    Đóng gỗ riêng: 3,400
                                </div>
                                <div class="mb-3 p-3">
                                   Ký gửi: 10kg
                                </div>
                                <div class="mb-3 bg-gray-200 p-3">
                                    Tự động giao hàng: 10kg
                                </div>
                                <div class="mb-3  p-3">
                                   Giao hàng tiết kiệm: 0kg
                                </div>
                                <div class="mb-3 bg-gray-200 p-3">
                                   Giao hàng nhanh: 10kg
                                </div>
                        </div>
                    </div>
                    <div class="border-b mx-auto w-[95%]"></div>

                </div>

            </div>
        </div>
    </div>
</template>
<style>

</style>
<script>
import HeadDonHang from './HeadDonHangComponent.vue';

export default {

    data() {
        return {
            data: [1, 2, 3, 4, 5, 6]
        }
    },

    components: {
        HeadDonHang
    }
}
</script>