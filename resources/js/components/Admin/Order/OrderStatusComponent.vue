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
                    <HeadOrder />
                    <div class="border-b  mx-auto"></div>
                    <div class="">
                        <div class="">
                            <div class="p-4 w-full">
                                <div class="  mb-3">
                                    <p class="font-medium text-gray-800 text-[25px]">Tình trạng đơn hàng:</p>
                                </div>
                                <div class="mb-3 w-full bg-gray-200 p-3">
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
                      
                    </div>

                </div>

            </div>
        </div>
    </div>
</template>
<style>

</style>
<script>
    import HeadOrder from './HeadOrderComponent.vue';
    
    export default {
    
        data() {
            return {
                data: [1, 2, 3, 4, 5, 6]
            }
        },
    
        components: {
            HeadOrder
        }
    }
    </script>