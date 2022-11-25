<template>
    <div>
        <div class="pt-8 bg-white mt-8">
            <div class="title">
                <h1 class="text-[20px] ml-4">Chỉnh sửa đơn hàng {{ order_code }}</h1>
            </div>
            <a-row class="justify-between">
                <a-col :span="8">
                    <div style="background: #ffff; padding: 20px">
                        <a-card title="Thông tin chung" class="w-full">
                            <div class="w-full mb-3">
                                <label for="">Mã đặt hàng(taobao,1688)</label>
                                <a-input :disabled="disabled" v-model:value="this.order_code" class="w-full" placeholder="Mã đặt hàng" />
                            </div>
                            <div class="w-full mb-3">
                                <label for="">Mã vận đơn</label>
                                <a-input v-model:value="this.shippingcode" class="w-full" placeholder="Mã vận đơn" />
                            </div>
                            <!-- <div class="w-full mb-3">
                                <label for="">Link lấy mã vận đơn</label>
                                <a-input v-model:value="value" class="w-full" placeholder="Link lấy mã vận đơn" />
                            </div> -->
                        </a-card>
                    </div>
                </a-col>
                <a-col :span="8">
                    <div style="background: #ffff; padding: 20px">
                        <a-card title="Thông tin khác" class="w-[100%]">
                            <div class="w-[100%]">
                                <div class="mb-5">
                                    <label for="">Khối lượng</label>
                                    <a-input addon-after="Kg" v-model:value="kg" />
                                </div>
                                <div class="mb-5">
                                    <label for="">Khối lượng</label>
                                    <a-input addon-after="Cm3" v-model:value="cm3" />
                                </div>
                                <div class="mb-5">
                                    <label for="">Số lượng khách muốn đặt hàng</label>
                                    <a-input v-model:value="quantityPurchasedCustomer" />
                                </div>
                                <div class="mb-5">
                                    <label for="">Số lượng mua được</label>
                                    <a-input v-model:value="quantityPurchased" />
                                </div>
                                <div class="mb-5">
                                    <label for="">Phí giao hàng trong TQ</label>
                                    <a-input addon-after="Y" v-model:value="feeShippingChina" />
                                </div>
                                <!-- <div class="mb-5">
                                    <label for="">Phí bảo hiểm hàng giá trị cao</label>
                                    <a-input addon-after="VNĐ" v-model:value="feeOrderInsurance" />
                                </div> -->

                            </div>
                        </a-card>
                    </div>
                </a-col>
                <a-col :span="7">
                    <div style="background: #ffff; padding: 20px">
                        <a-card title="Dịch vụ" class="w-full">
                            <div class="mb-3">
                                <a-checkbox v-model:checked="option.order_checking">Đã kiểm hàng</a-checkbox>
                            </div>
                            <div class="mb-3">
                                <a-checkbox v-model:checked="option.inventory">Phí kiểm hàng</a-checkbox>
                            </div>
                            <div class="mb-3">
                                <a-checkbox v-model:checked="option.autoshipping">Tự động giao hàng</a-checkbox>
                            </div>
                            <div class="mb-3">
                                <a-radio-group v-model:value="woodpacking">
                                    <a-radio :style="radioStyle" :value="1">Phí đóng gỗ</a-radio>
                                    <a-radio :style="radioStyle" :value="0">Phí đóng gỗ riêng</a-radio>
                                </a-radio-group>
                            </div>

                            <div class="mb-3">
                                <a-radio-group v-model:value="shipping">
                                    <a-radio :style="radioStyle" :value="0">Giao hàng tiết kiệm</a-radio>
                                    <a-radio :style="radioStyle" :value="1">Giao hàng nhanh</a-radio>
                                </a-radio-group>
                            </div>


                        </a-card>
                    </div>
                </a-col>
            </a-row>
            <div class="flex justify-end mr-4 pb-3">

                <a-button @click="updateOrderPacket()" type="primary">Lưu thay đổi</a-button>
            </div>
        </div>
    </div>
</template>
<script>
import { defineComponent, reactive, ref } from 'vue';
import { getOrderUpdate, updateOrderPacket } from "../../../services/order/order.js";
import { message } from 'ant-design-vue';

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
            order_id: 0,
            data: [],
            order_code: 0,
            disabled: true,
            option: {
                order_checking: null,
                autoshipping: null,
                savingshipping: null,
                inventory: null,
                wood_packing: null,
                seperatewoodpacking: null,
                autoshipping: null,
                express_shipping: null
            },
            shipping: null,
            woodpacking: null,
            shippingcode: null,
            kg: null,
            cm3: null,
            quantityPurchased: null,
            quantityPurchasedCustomer: null,
            feeShippingChina: null,
            feeOrderInsurance: null,
        }
    },
    created() {
        this.order_id = this.$route.params.id;
        this.getDetailCart();
    },
    methods: {
        getDetailCart() {
            // key:''

            getOrderUpdate({ id: this.order_id }).then((response) => {
                this.data = response.data;
                this.data.map((res) => {
                    console.log(res);
                    this.order_code = res.order_code;
                    this.shippingcode = res.shippingcode;
                    this.option.order_checking = res.opt_order_checking == 1 ? true : false;
                    this.option.inventory = res.opt_inventory == 1 ? true : false;
                    this.option.autoshipping = res.opt_auto_shipping == 1 ? true : false;
                    this.option.wood_packing = res.opt_wood_packing;
                    this.option.seperatewoodpacking = res.opt_separete_wood_packing;
                    this.option.express_shipping = res.opt_express_shipping;
                    this.option.savingshipping = res.opt_saving_shipping;
                    this.shipping = this.option.express_shipping == 1 ? this.option.express_shipping : this.option.savingshipping;
                    this.woodpacking = this.option.wood_packing == 1 ? this.option.wood_packing : this.option.seperatewoodpacking;
                    this.kg = res.weight;
                    this.cm3 = res.volume;
                    this.quantityPurchased = res.quantitybuy;
                    this.quantityPurchasedCustomer = res.quantityreceive;

                })
            }).finally(() => {

            })
        },
        updateOrderPacket() {
            const key = 'updatable';
            message.loading({ content: 'Đang tải...', key });
            const params = {
                order_id: this.order_id,
                weight: this.kg,
                volume: this.cm3,
                quantity_buy: this.quantityPurchasedCustomer,
                quantity_receive: this.quantityPurchased,
                opt_order_checking: this.option.order_checking,
                opt_order_checking: this.option.order_checking,
                opt_auto_shipping: this.option.autoshipping,
                opt_saving_shipping: this.shipping == 0 ? 1 : 0,
                opt_express_shipping: this.shipping == 1 ? 1 : 0,
                opt_inventory: this.option.inventory,
                opt_wood_packing: this.woodpacking == 1 ? 1 : 0,
                opt_separate_wood_packing: this.woodpacking == 0 ? 1 : 0,
                code: this.shippingcode
            }
            updateOrderPacket(params).then((response) => {
                console.log(response);
                message.success({ content: 'Cập nhật đơn hàng thành công!', key, duration: 2 });

            }).finally(() => {

            });
        },
    }
}
</script>
<style>

</style>