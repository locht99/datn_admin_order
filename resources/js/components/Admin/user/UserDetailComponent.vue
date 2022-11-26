<template>
    <div class="detail-user my-4">
        <h5 class="text-xl uppercase my-4">Thông tin tài khoản</h5>
        <div class="grid grid-cols-12 gap-4">
            <div class="col-span-3">
                <div class="bg-white rounded">
                    <div class="bg-red-700 p-2 text-white rounded-t">
                        <span>Thông tin</span>
                    </div>
                    <loading v-model:active="is_loading" :is-full-page="true" />
                    <div class="info-container mx-4">
                        <div class="info">
                            <div class="name my-2">
                                <i class="far fa-user-circle"></i>
                                <span class="ml-2 font-bold text-blue-600">{{
                                        user_info.username
                                }}</span>
                            </div>
                            <div class="mail my-2">
                                <i class="fas fa-envelope"></i>
                                <span class="ml-2">{{ user_info.email }}</span>
                            </div>
                            <div class="phone my-2">
                                <i class="fas fa-phone"></i>
                                <span class="ml-2">{{ user_info.phone }}</span>
                            </div>
                            <div class="point my-2">
                                <i class="fas fa-dollar-sign"></i>
                                <span class="font-weight-bold ml-2 text-green-500">{{ formatPrice(user_info.point)
                                }}</span>
                            </div>
                            <div class="date my-2">
                                <i class="far fa-calendar"></i>
                                <span class="ml-2">
                                    {{ user_info.created_at }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded col-span-4">
                <div class="bg-red-700 p-2 text-white rounded-t">
                    <span>Giao dịch gần đây
                        <a href="" class="underline hover:text-gray-400">Xem tất cả</a></span>
                </div>
                <div class="wrapper-scroll" v-if="recent_transactions_user.length > 0">
                    <table class="w-full text-sm text-left text-black dark:text-gray-400">
                        <tr class="text-white">
                            <th scope="col" class="px-2 py-2 sticky top-0 bg-red-500">
                                Ngày
                            </th>
                            <th scope="col" class="px-2 py-2 sticky top-0 bg-red-500">
                                Loại
                            </th>
                            <th scope="col" class="px-2 py-2 sticky top-0 bg-red-500 text-right">
                                Số tiền
                            </th>
                        </tr>
                        <tbody>
                            <tr class="border-b dark:bg-gray-800 dark:border-gray-700 odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700"
                                v-for="(
                                    item, index
                                ) in recent_transactions_user" :key="index">
                                <td class="px-2 py-2">
                                    {{ item.created_at }}
                                </td>
                                <td class="px-2 py-2">{{ item.type_name }}</td>
                                <td class="px-2 py-2 text-right">
                                    {{ formatPrice(item.point) }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div v-else class="m-2">
                    <i class="text-gray-500">Không có giao dịch gần đây!</i>
                </div>
            </div>
            <div class="bg-white rounded col-span-5">
                <div class="bg-red-700 p-2 text-white rounded-t">
                    <span>Đơn hàng gần đây
                        <a href="" class="underline hover:text-gray-400">Xem tất cả</a></span>
                </div>
                <div class="wrapper-scroll" v-if="recent_orders_user.length > 0">
                    <table class="w-full text-sm text-left dark:text-gray-400">
                        <thead>
                            <tr class="text-white">
                                <th scope="col" class="px-2 py-2 sticky top-0 bg-red-500">
                                    Id
                                </th>
                                <th scope="col" class="px-2 py-2 sticky top-0 bg-red-500">
                                    Tình trạng
                                </th>
                                <th scope="col" class="px-2 py-2 sticky top-0 bg-red-500">
                                    Đã thanh toán
                                </th>
                                <th scope="col" class="px-2 py-2 sticky top-0 bg-red-500">
                                    Tổng tiền
                                </th>
                                <th scope="col" class="px-2 py-2 sticky top-0 bg-red-500">
                                    Còn lại
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b dark:bg-gray-800 dark:border-gray-700 odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700"
                                v-for="(item, index) in recent_orders_user" :key="index">
                                <td class="text-center px-2 py-2">
                                    <a :href="'/orderdetail/' + item.id"
                                        class="text-blue-600 hover:underline font-bold">{{ item.order_code }}</a>
                                </td>
                                <td class="px-2 py-2">
                                    {{ item.status_name }}
                                </td>
                                <td class="px-2 py-2">
                                    {{ formatPrice(item.deposit_amount) }}
                                </td>
                                <td class="px-2 py-2">
                                    {{ formatPrice(item.total_price) }}
                                </td>
                                <td class="px-2 py-2">
                                    {{ formatPrice(item.remain_amount) }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div v-else class="m-2">
                    <i class="text-gray-500">Không có đơn hàng gần đây!</i>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/vue-loading.css";

export default {
    watch: {
        $route: {
            immediate: true,
            handler(to, from) {
                document.title ='Chi tiết tài khoản';
            }
        },
  },
    data() {
        return {
            user_id: null,
            is_loading: false,
            user_info: {},
            recent_transactions_user: {},
            recent_orders_user: {},
        };
    },
    components: {
        loading
    },
    methods: {
        getUserInfo() {
            this.is_loading = true;
            axios
                .get(`/api/get-user-detail/${this.user_id}`)
                .then((res) => {
                    this.user_info = res.data.user_info;
                    this.recent_transactions_user =
                        res.data.recent_transactions;
                    this.recent_orders_user = res.data.recent_orders;
                })
                .catch((error) => console.log(error))
                .finally(() => (this.is_loading = false));
        },
        formatPrice(value) {
            return new Intl.NumberFormat("en-US", {
                style: "currency",
                currency: "VND",
            }).format(value);
        },
    },
    created() {
        const url = location.href;
        const start = url.lastIndexOf("/") + 1;
        this.user_id = url.substring(start);
        if (this.user_id) {
            this.getUserInfo();
        }
    }
};
</script>
