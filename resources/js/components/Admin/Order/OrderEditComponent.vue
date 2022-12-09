<template>
    <div>
        <div class="pt-2">
            <router-link to="/order">Back</router-link>

        </div>
        <div class="pt-8 bg-white mt-8">

            <div class="title flex justify-between items-center">
                <h1 class="text-[20px] ml-4">Chỉnh sửa đơn hàng {{ order_code }}</h1>
            </div>
            <a-row class="justify-between">
                <a-col :span="8">
                    <div style="background: #ffff; padding: 20px">
                        <a-card title="Thông tin chung" class="w-full">
                            <div class="w-full mb-3">
                                <label for="">Mã đặt hàng(taobao,1688)</label>
                                <a-input :disabled="disabled" v-model:value="order_code" class="w-full"
                                    placeholder="Mã đặt hàng" />
                            </div>
                            <div class="w-full mb-3">
                                <label for="">Mã vận đơn</label>
                                <a-input v-model:value="shippingcode" class="w-full" placeholder="Mã vận đơn" />
                            </div>
                            <div class="mb-5">
                                <label for="">Khối lượng</label>
                                <br>
                                <a-input-number addon-after="Kg" min="0.1" @blur="insertFeeShipGlobal(kg)"
                                    v-model:value="kg" addon-before="+"></a-input-number>
                            </div>
                            <div class="mb-5">
                                <label for="">Thành tiền
                                    <a-popover>
                                        <template #content>
                                            <p>Nếu cân nặng của đơn hàng nhỏ hơn hoặc bằng 0.1 kg sẽ mặc định là
                                                5000 VNĐ</p>
                                        </template>
                                        <font-awesome-icon icon="fas fa-info-circle" />
                                    </a-popover>
                                </label>
                                <a-input-number addon-after="VNĐ" :disabled="true" class="w-full font-semibold"
                                    v-model:value="totalGlobalShipping"
                                    :formatter="value => `${value}`.replace(/\B(?=(\d{3})+(?!\d))/g, ',')"
                                    :parser="value => value.replace(/\$\s?|(,*)/g, '')" />
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
                                <a-checkbox v-model:checked="option.wood_packing">Phí đóng gỗ</a-checkbox>
                            </div>
                            <div class="mb-3">
                                <a-checkbox v-model:checked="option.seperatewoodpacking">Phí đóng gỗ riêng</a-checkbox>
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
                <a-col :span="8">
                    <div style="background: #ffff; padding: 20px">
                        <a-card title="Thành tiền đơn hàng" class="w-[100%]">
                            <div class="w-[100%]">

                            </div>
                        </a-card>
                    </div>
                </a-col>
            </a-row>
            <div class="title ml-4">
                <h1 class="text-[20px]">Phí dịch vụ</h1>
            </div>
            <a-row>
                <a-col :span="8" v-for="(item, index) in dataShop" :key="index">
                    <div style="background:#ffff;padding:20px">
                        <a-card :title="item.shop_name ? item.shop_name : item.shop_id" class="w-[100%]">
                            <div class="mb-3">
                                <label for="">Phí ship</label>
                                <CurrencyInput v-model="feeShipChina[index]" :options="{
                                    currency: 'VND',
                                    currencyDisplay: 'hidden',
                                    hideCurrencySymbolOnFocus: true,
                                    hideGroupingSeparatorOnFocus: false,
                                    hideNegligibleDecimalDigitsOnFocus: false,
                                }" class="w-full border-gray-300 rounded my-2 px-2 py-1"></CurrencyInput>
                            </div>
                            <div>
                                <label for="" class="font-semibold">Sản phẩm</label>
                                <div v-for="(it) in this.data">
                                    <div class="w-full" v-if="(it.ShopIdProduct == item.shop_id)">
                                        <p>{{ it.ProductName }}</p>
                                        <div class="mb-3 w-full">
                                            <label for="" class="w-full">Số lượng khách muốn đặt</label>
                                            <input v-model="it.quantity_bought" disabled
                                                class="w-full border-gray-300 rounded my-2 px-2 py-1 border" />
                                            <label for="" class="w-full">Số lượng mua được</label>
                                            <input v-model="it.quantity_received"
                                                class="w-full border border-gray-300 rounded my-2 px-2 py-1" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a-card>
                    </div>
                </a-col>

            </a-row>

            <div class="flex justify-end mr-4 pb-3" v-if="(responseError != 400)">

                <a-button @click="updateOrderPacket()" type="danger">Lưu thay đổi</a-button>
            </div>
        </div>
    </div>
</template>
<script>
import { defineComponent, reactive, ref } from 'vue';
import { getOrderUpdate, updateOrderPacket } from "../../../services/order/order.js";
import { message } from 'ant-design-vue';
import CurrencyInput from '../../format_curency/CurrencyInput.vue';
import axios from 'axios';

export default {
    watch: {
        $route: {
            immediate: true,
            handler(to, from) {
                document.title = 'Chỉnh sửa đơn hàng';
            }
        },
    },
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
    components: {
        CurrencyInput
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
            totalGlobalShipping: null,
            quantityPurchased: null,
            quantityPurchasedCustomer: null,
            feeShippingChina: null,
            feeOrderInsurance: null,
            dataShop: [],
            quantityReviced: [],
            globalFee: 0,
            responseError: null,
            feeShipChina: [],
            warehouse: null
        }
    },
    created() {
        this.order_id = this.$route.params.id;
        this.getDetailCart();
    },
    methods: {
        formatPrice(value) {
            return new Intl.NumberFormat("en-US", {
                style: "currency",
                currency: "VND",
            }).format(value);
        },
        insertFeeShipGlobal(kg) {
            axios.post('/api/get-kgOrder', { kg: this.kg, warehouse_id: this.warehouse }).then((res) => {
                const { data } = res.data;
                if (kg <= 0.1) {
                    this.totalGlobalShipping = 5000;
                } else {
                    this.totalGlobalShipping = kg * +data[0];
                }
            }).catch((error) => {

            }).finally(() => {

            })

        },
        getDetailCart() {
            // key:''

            getOrderUpdate({ id: this.order_id }).then((response) => {
                this.data = response.data[0];
                console.log(this.data);
                this.dataShop = response.data[1];
                this.globalFee = response.data[2].value;
                // console.log(this.dataShop);
                this.dataShop.map((item, index) => {
                    this.feeShipChina[index] = item.fee_ship;
                });

                this.data.map((res) => {
                    this.order_code = res.order_code;
                    this.shippingcode = res.code;
                    this.option.order_checking = res.opt_order_checking == 1 ? true : false;
                    this.option.inventory = res.opt_inventory == 1 ? true : false;
                    this.option.autoshipping = res.opt_auto_shipping == 1 ? true : false;
                    this.option.wood_packing = res.opt_wood_packing;
                    this.option.seperatewoodpacking = res.opt_separate_wood_packing;
                    this.option.express_shipping = res.opt_express_shipping;
                    this.option.savingshipping = res.opt_saving_shipping;
                    this.shipping = this.option.express_shipping == 1 ? this.option.express_shipping : this.option.savingshipping;
                    this.kg = res.weight;
                    this.cm3 = res.volume;
                    this.quantityPurchased = res.quantitybuy;
                    this.quantityPurchasedCustomer = res.quantityreceive;
                    this.totalGlobalShipping = res.global_shipping_fee;
                    this.warehouse = res.id_warehouse;
                })
                // console.log("Đóng gỗ", this.option.wood_packing, "Đóng gỗ riêng", this.option.seperatewoodpacking);
            }).catch((error) => {
                if (error.response.status == 400) {
                    this.responseError = 400;
                    this.$swal.fire(error.response.data.message).then((res) => {
                        // console.log(res);
                        if (res.isConfirmed || res.isDismissed) {
                            this.$router.replace("/order")
                        }
                    });
                }
            }).finally(() => {

            })
        },
        updateOrderPacket() {

            const key = 'updatable';
            message.loading({ content: 'Đang tải...', key });
            console.log(this.option);
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
                opt_wood_packing: this.option.wood_packing,
                opt_separate_wood_packing: this.option.seperatewoodpacking,
                code: this.shippingcode,
                fee_ship: this.feeShipChina,
                global_shipping_fee: this.totalGlobalShipping,
                products: this.data
            }
            console.log(params);
            updateOrderPacket(params).then((response) => {
                message.success({ content: 'Cập nhật đơn hàng thành công!', key, duration: 2 });
            }).catch((error) => {
                this.shippingcode = '';
                message.error({ content: error.response.data.failed, key, duration: 2 })
            }).finally(() => {

            });
        },
        getCaculationOrder() {

        }
    }
}
</script>
<style>

</style>