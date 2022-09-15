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
                                    <p class="font-medium text-gray-800 text-[25px]">Chi tiết phí dịch vụ:</p>
                                </div>
                                <div class="mb-3 bg-gray-200 p-3">
                                    <p>Phí giao hàng TQ-VN: 0đ</p>
                                </div>
                                <div class="mb-3 p-3">
                                    Phí giao hàng trong TQ: 10 Y
                                </div>
                                <div class="mb-3 bg-gray-200 p-3">
                                    Phí mua hàng: 3,400
                                </div>
                                <div class="mb-3 p-3">
                                    Phí kiểm hàng: 10kg
                                </div>
                                <div class="mb-3 bg-gray-200 p-3">
                                    Phí kí gửi: 10kg
                                </div>
                                <div class="mb-3  p-3">
                                    Phí đóng gỗ: 0kg
                                </div>
                                <div class="mb-3  p-3">
                                    Phí đóng gỗ riêng: 0kg
                                </div>
                            </div>

                        </div>
                        <div class="md:w-[40%] py-3 relative overflow-hidden">
                            <div class="p-3">
                                <div class="note-titl font-medium text-gray-800 text-[25px] p-[6px] ">Tùy chọn gói hàng:
                                </div>
                                <div class="mb-3 bg-gray-200 p-3">
                                    <p>Bảo hiểm hàng giá trị cao: 0123456789</p>
                                </div>
                                <div class="mb-3 p-3">
                                    Tự động giao hàng: 0đ
                                </div>
                                <div class="mb-3 bg-gray-200 p-3">
                                    Giao hàng tiết kiệm: 0đ
                                </div>
                                <div class="mb-3 p-3">
                                    Giao hàng nhanh: 0đ
                                </div>
                            </div>

                            <div class=" bg-red-600 absolute bottom-0 w-full py-3 px-3 text-white">
                                Tổng:
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