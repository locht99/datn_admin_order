<template>
    <loading v-model:active="is_loading" :is-full-page="true" />

    <div class="packet-add my-4 grid grid-cols-6 gap-4">
        <div class="col-span-2 text-gray-600">
            <h5 class="uppercase text-xl">Thêm mới bao hàng</h5>
            <form @submit="formSubmit($event)">
                <div class="bg-white rounded-md mt-4 p-4" style="min-height: 500px">
                    <div class="grid grid-cols-12 mb-4">
                        <div class="col-span-5 flex items-center">
                            <label for="">Kho hàng
                                <span class="text-red-600">*</span></label>
                        </div>
                        <div class="col-span-7">
                            <select name="admin_packet[ware_house]" id="admin_packet_ware_house"
                                class="w-full border-gray-300 rounded my-2 px-2 py-0.5" v-model="data.warehouse_id"
                                @change="inputSearch($event)">
                                <option value="">Vui lòng chọn kho hàng</option>
                                <option value="1">Hà Nội</option>
                                <option value="2">Sài Gòn</option>
                            </select>
                        </div>
                        <p v-if="errors.warehouse_id" class="text-red-600 col-span-12 text-right">
                            {{ errors.warehouse_id[0] }}
                        </p>
                    </div>
                    <hr />
                    <div class="grid grid-cols-12 mb-4">
                        <div class="col-span-5 flex items-center">
                            <label for="">Trọng lượng
                                <span class="text-red-600">*</span></label>
                        </div>
                        <div class="flex col-span-7">
                            <input type="text" id="website-admin"
                                class="rounded-l w-full text-sm border-gray-300 my-2 px-2 py-1 text-right"
                                v-model="data.weight" />
                            <span
                                class="inline-flex w-14 items-center text-sm text-gray-900 bg-gray-200 my-2 px-2 py-0.5 rounded-r border border-r-0 border-gray-300 dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                kg
                            </span>
                        </div>
                        <p v-if="errors.weight" class="text-red-600 col-span-12 text-right">
                            {{ errors.weight[0] }}
                        </p>
                        <div class="col-span-5 flex items-center">
                            <label for="">Thể tích
                                <span class="text-red-600">*</span></label>
                        </div>
                        <div class="flex col-span-7">
                            <input type="text" id="website-admin"
                                class="rounded-l w-full text-sm border-gray-300 my-2 px-2 py-1 text-right"
                                v-model="data.volume" />
                            <span
                                class="inline-flex w-14 items-center text-sm text-gray-900 bg-gray-200 my-2 px-2 py-0.5 rounded-r border border-r-0 border-gray-300 dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                cm<sup>3</sup>
                            </span>
                        </div>
                        <p v-if="errors.volume" class="text-red-600 col-span-12 text-right">
                            {{ errors.volume[0] }}
                        </p>
                        <div class="col-span-5 flex items-center">
                            <label for="">Khối lượng quy đổi
                                <span class="text-red-600">*</span></label>
                        </div>
                        <div class="flex col-span-7">
                            <input type="text" id="website-admin"
                                class="rounded-l w-full text-sm border-gray-300 my-2 px-2 py-1 text-right"
                                v-model="data.weight_from_volume" />
                            <span
                                class="inline-flex w-14 items-center text-sm text-gray-900 bg-gray-200 my-2 px-2 py-0.5 rounded-r border border-r-0 border-gray-300 dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                kg
                            </span>
                        </div>
                        <p v-if="errors.weight_from_volume" class="text-red-600 col-span-12 text-right">
                            {{ errors.weight_from_volume[0] }}
                        </p>
                    </div>
                    <hr />
                    <div class="grid grid-cols-12 mb-4">
                        <div class="col-span-5 flex items-center">
                            <label for="">Đơn giá
                                <span class="text-red-600">*</span></label>
                        </div>
                        <div class="flex col-span-7">
                            <input type="text" id="website-admin"
                                class="rounded-l w-full text-sm border-gray-300 my-2 px-2 py-1 text-right"
                                v-model="data.unit_price" />
                            <span
                                class="inline-flex w-14 items-center text-sm text-gray-900 bg-gray-200 my-2 px-2 py-0.5 rounded-r border border-r-0 border-gray-300 dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                VNĐ
                            </span>
                        </div>
                        <p v-if="errors.unit_price" class="text-red-600 col-span-12 text-right">
                            {{ errors.unit_price[0] }}
                        </p>
                        <div class="col-span-5 flex items-center">
                            <label for="">Phí đóng gỗ</label>
                        </div>
                        <div class="flex col-span-7">
                            <input type="text" id="website-admin"
                                class="rounded-l w-full text-sm border-gray-300 my-2 px-2 py-1 text-right"
                                v-model="data.wood_packing_price" />
                            <span
                                class="inline-flex w-14 items-center text-sm text-gray-900 bg-gray-200 my-2 px-2 py-0.5 rounded-r border border-r-0 border-gray-300 dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                VNĐ
                            </span>
                        </div>
                        <p v-if="errors.wood_packing_price" class="text-red-600 col-span-12 text-right">
                            {{ errors.wood_packing_price[0] }}
                        </p>
                        <div class="col-span-5 flex items-center">
                            <label for="">Phí khác</label>
                        </div>
                        <div class="flex col-span-7">
                            <input type="text" id="website-admin"
                                class="rounded-l w-full text-sm border-gray-300 my-2 px-2 py-1 text-right"
                                v-model="data.other_price" />
                            <span
                                class="inline-flex w-14 items-center text-sm text-gray-900 bg-gray-200 my-2 px-2 py-0.5 rounded-r border border-r-0 border-gray-300 dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                VNĐ
                            </span>
                        </div>
                        <p v-if="errors.other_price" class="text-red-600 col-span-12 text-right">
                            {{ errors.other_price[0] }}
                        </p>
                    </div>
                    <hr />
                    <div class="grid grid-cols-12 mb-4">
                        <div class="col-span-5 flex items-center">Đóng gỗ</div>
                        <div class="flex col-span-7">
                            <input type="checkbox" v-model="data.wood_packing"
                                class="border-gray-300 rounded my-2 px-2 bg-red-600" />
                        </div>
                        <div class="col-span-5 flex items-center">
                            <label for="">Thanh toán</label>
                        </div>
                        <div class="flex col-span-7">
                            <input type="checkbox" v-model="data.paid"
                                class="border-gray-300 rounded my-2 px-2 bg-red-600" />
                        </div>
                        <div class="col-span-5 flex items-center">
                            <label for="">Tình trạng</label>
                        </div>
                        <div class="flex col-span-7">
                            <select name="admin_packet[ware_house]"
                                class="w-full border-gray-300 rounded my-2 px-2 py-0.5" v-model="data.status_id">
                                <option value="6">Kho nhận hàng</option>
                                <!-- <option value="7">Vận chuyển</option>
                                <option value="8">Chờ giao</option>
                                <option value="9">Chờ yêu cầu giao</option> -->
                            </select>
                        </div>
                    </div>
                    <div class="grid grid-cols-12 mb-4">
                        <div class="col-span-5 flex items-center">
                            <label for="">Ghi chú</label>
                        </div>
                        <div class="flex col-span-7">
                            <textarea class="w-full border-gray-300 rounded my-2 px-2 py-0.5"
                                v-model="data.note"></textarea>
                        </div>
                    </div>
                    <div>
                        <button type="submit"
                            class="w-full border-red-600 bg-red-600 text-white hover:bg-red-500 rounded px-2 py-1">
                            Tạo mới
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-span-4">
            <i class="block pb-1 text-red-600 warning" id="warning">Chọn kho trước khi thêm đơn hàng...</i>
            <form @submit="formSearch($event)" class="form-search-code hidden" id="form-search-code">
                <div class="grid grid-cols-3 gap-x-4">
                    <div class="col-span-2">
                        <input type="text" placeholder="Nhập mã vận đơn" name="code" v-model="code"
                            class="w-full border-gray-300 rounded px-2 py-0.5" />
                    </div>
                    <div>
                        <button type="submit"
                            class="w-full border-red-600 bg-red-600 text-white hover:bg-red-500 rounded px-2 py-0.5">
                            Tra cứu
                        </button>
                    </div>
                </div>
            </form>
            <div class="bg-white rounded-md mt-4" style="min-height: 500px">
                <div class="wrapper-scroll rounded-md">
                    <table class="w-full text-sm text-left dark:text-gray-400">
                        <thead class="text-sm text-white">
                            <tr>
                                <th scope="col" class="sticky top-0 bg-red-500 px-2 py-2">
                                    #
                                </th>
                                <th scope="col" class="sticky top-0 bg-red-500 px-2 py-2">
                                    Đơn hàng
                                </th>
                                <th scope="col" class="sticky top-0 bg-red-500 px-2 py-2">
                                    Mã vận đơn
                                </th>
                                <th scope="col" class="sticky top-0 bg-red-500 px-2 py-2 w-10">
                                    &nbsp;
                                </th>
                                <th scope="col" class="sticky top-0 bg-red-500 px-2 py-2 w-10">
                                    &nbsp;
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                                v-for="(item, index) in data.orders" :key="index" :class="[
                                    item.order_id
                                        ? 'text-green-400'
                                        : 'text-red-600',
                                ]">
                                <td class="px-2 py-2">{{ index + 1 }}</td>
                                <td class="px-2 py-2">
                                    {{
                                            item.order_id
                                                ? item.order_code
                                                : "không tìm thấy"
                                    }}
                                </td>
                                <td class="px-2 py-2">{{ item.code }}</td>
                                <td class="px-2 py-2 text-center hover:text-red-800 cursor-pointer" :class="[
                                    item.order_id
                                        ? 'text-gray-600'
                                        : 'text-red-600',
                                ]" @click="removeOrder(item)">
                                    <font-awesome-icon icon="fa-solid fa-trash" />
                                </td>
                                <td class="text-center text-red-600 hover:text-red-700 cursor-pointer">
                                    <i v-if="!item.order_id" @click="searchOrderAgain(item)">
                                        <font-awesome-icon icon="fa-solid fa-reply" />
                                    </i>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Loading from 'vue-loading-overlay';

export default {
    data() {
        return {
            is_loading: false,
            data: {
                warehouse_id: "",
                weight: "",
                volume: "",
                weight_from_volume: "",
                unit_price: "",
                wood_packing_price: "",
                other_price: "",
                wood_packing: false,
                paid: false,
                status_id: 6,
                note: "",
                orders: [],
                order_valid: [],
            },
            errors: {},
            code: "",
        };
    },
    components: {
        Loading,
    },
    methods: {
        formSubmit(e) {
            e.preventDefault();
            this.createPacket();
        },
        formSearch(e) {
            e.preventDefault();
            var isset_data = this.data.orders.find((e) => e.code === this.code);
            if (!isset_data) {
                this.searchOrder();
            }
            this.code = "";
        },
        createPacket() {
            this.is_loading = true;
            axios
                .post("/api/admin-packets", this.data)
                .then((res) => {
                    if (res.data.errors) {
                        this.errors = res.data.errors;
                    }
                    if (res.data.order_null) {
                        this.$swal.fire({
                            icon: "error",
                            title: res.data.order_null,
                            toast: true,
                            position: "top-end",
                            showConfirmButton: false,
                            showCloseButton: true,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener(
                                    "mouseenter",
                                    this.$swal.stopTimer
                                );
                                toast.addEventListener(
                                    "mouseleave",
                                    this.$swal.resumeTimer
                                );
                            },
                        });
                    }
                    if (res.data.success) {
                        this.$swal
                            .fire({
                                title: res.data.success,
                                showClass: {
                                    popup: "animate__animated animate__fadeInDown",
                                },
                                hideClass: {
                                    popup: "animate__animated animate__fadeOutUp",
                                },
                            })
                            .finally(() => {
                                window.location.assign("/bag");
                            });
                    }
                })
                .catch((error) => console.log(error))
                .finally(() => (this.is_loading = false));
        },
        searchOrder() {
            this.is_loading = true;
            axios
                .get("/api/search-order", {
                    params: {
                        code: this.code,
                    },
                })
                .then((res) => {
                    this.data.orders.push(res.data.order);
                    this.data.order_valid = this.data.orders.filter(
                        (item) => item.order_id != ""
                    );
                })
                .catch((error) => console.log(error))
                .finally(() => {
                    this.is_loading = false;
                });
        },
        removeOrder(e) {
            this.$swal.fire({
                title: 'Bạn có chắc muốn tạo đơn vận chuyển không ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Tạo'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.data.orders = this.data.orders.filter(
                        (item) => item.code != e.code
                    );
                    this.data.order_valid = this.data.orders.filter(
                        (item) => item.order_id != ""
                    );
                    this.$swal.fire(
                        'Thông báo',
                        'Tạo thành công',
                        'success',
                        this.toggleModal()
                    )
                }
            });
        },
        searchOrderAgain(e) {
            this.data.orders = this.data.orders.filter(
                (item) => item.code != e.code
            );
            this.code = e.code;
        },
        inputSearch(e) {
            if (e.target.value != 0) {
                document.getElementById("warning").classList.add("hidden");
                document.getElementById("form-search-code").classList.remove("hidden");
            }
            else {
                document.getElementById("warning").classList.remove("hidden");
                document.getElementById("form-search-code").classList.add("hidden");
            }
        }
    }
};
</script>