<template>
    <div>
        <div class="pt-8 bg-white mt-8">
            <div class="title">
                <h1 class="text-[20px] ml-4">Chỉnh sửa đơn hàng</h1>
            </div>
            <a-row class="justify-between">
                <a-col :span="8">
                    <div style="background: #ffff; padding: 20px">
                        <a-card title="Thông tin chung" class="w-full">
                            <div class="w-full mb-3">
                                <label for="">Mã đặt hàng(taobao,1688)</label>
                                <a-input v-model:value="value" class="w-full" placeholder="Mã đặt hàng" />
                            </div>
                            <div class="w-full mb-3">
                                <label for="">Mã vận đơn</label>
                                <a-input v-model:value="value" class="w-full" placeholder="Mã vận đơn" />
                            </div>
                            <div class="w-full mb-3">
                                <label for="">Link lấy mã vận đơn</label>
                                <a-input v-model:value="value" class="w-full" placeholder="Link lấy mã vận đơn" />
                            </div>
                        </a-card>
                    </div>
                </a-col>
                <a-col :span="8">
                    <div style="background: #ffff; padding: 20px">
                        <a-card title="Thông tin khác" class="w-[100%]">
                            <div class="w-[100%]">
                                <div class="mb-5">
                                    <a-input v-model:value="value" addon-before="Khối lượng" addon-after="Kg" />
                                </div>
                                <div class="mb-5">
                                    <a-input v-model:value="value" addon-before="Khối lượng" addon-after="Cm3" />
                                </div>
                                <div class="mb-5">
                                    <a-input v-model:value="value" addon-before="Số lượng khách muốn đặt hàng" />
                                </div>
                                <div class="mb-5">
                                    <a-input v-model:value="value" addon-before="Số lượng mua được" addon-after="" />
                                </div>
                                <div>

                                </div>
                            </div>
                        </a-card>
                    </div>
                </a-col>
                <a-col :span="7">
                    <div style="background: #ffff; padding: 20px">
                        <a-card title="Dịch vụ" class="w-full">
                            <div class="mb-3">
                                <a-checkbox v-model:checked="checked">Đã kiểm hàng</a-checkbox>
                            </div>
                            <div class="mb-3">
                                <a-checkbox v-model:checked="checked">Phí kiểm hàng</a-checkbox>
                            </div>
                            <div class="mb-3">
                                <a-checkbox v-model:checked="checked">Phí ký gửi</a-checkbox>
                            </div>

                            <div class="mb-3">
                                <a-checkbox v-model:checked="checked">Tự động giao hàng</a-checkbox>
                            </div>
                            <div class="mb-3">
                                <a-radio-group v-model:value="value">
                                    <a-radio :style="radioStyle" :value="1">Phí đóng gỗ</a-radio>
                                    <a-radio :style="radioStyle" :value="1">Phí đóng gỗ riêng</a-radio>
                                </a-radio-group>
                            </div>

                            <div class="mb-3">
                                <a-radio-group v-model:value="value">
                                    <a-radio :style="radioStyle" :value="1">Giao hàng tiết kiệm</a-radio>
                                    <a-radio :style="radioStyle" :value="1">Giao hàng nhanh</a-radio>
                                </a-radio-group>
                            </div>


                        </a-card>
                    </div>
                </a-col>
            </a-row>
            <div class="flex justify-end mr-4 pb-3">
                <a-button type="primary">Lưu thay đổi</a-button>
            </div>
        </div>
    </div>
</template>
<script>
import { defineComponent, reactive, ref } from 'vue';

export default {
    setup() {
        const value = ref(1);

        const radioStyle = reactive({
            display: 'flex',
            height: '30px',
            lineHeight: '30px',
        });
        return {
            radioStyle,
            value
        }

    },
    data() {
        return {
          
        }
    }
}
</script>
<style>

</style>