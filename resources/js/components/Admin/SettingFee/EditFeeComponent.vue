<template>
    <div class="partner-main my-2 mx-16">
        <Loading v-model:active="is_loading" :color="backGroundcolor" />
        <h5 class="">
            <span class="uppercase text-xl">Thiết lập phí dịch vụ</span>
        </h5>
        <form @submit="formSubmit($event)">
            <div class="w-1/2">
                <div
                    class="grid grid-cols-2"
                    v-for="(item, index) in data"
                    :key="index"
                >
                    <div class="flex items-center">
                        <label for=""
                            >{{ item.name }}
                            <span class="text-red-600">*</span></label
                        >
                    </div>
                    <div>
                        <input
                            type="text"
                            :value="data[index].value_format"
                            @input="
                                data[index].value_format = formatCurrency2(
                                    $event.target.value
                                )
                            "
                            class="w-full border-gray-300 rounded my-2 px-2 py-0.5 text-right"
                        />
                        <span
                            v-if="errors[index + '.value']"
                            class="text-red-600 float-right"
                            >{{ errors[index + ".value"][0] }}</span
                        >
                    </div>
                </div>
                <div class="text-right my-2">
                    <button
                        type="submit"
                        class="bg-cyan-600 text-white hover:bg-cyan-700 py-1.5 px-8 rounded mr-8"
                    >
                        Cập nhật
                    </button>
                    <a
                        href="/settings"
                        class="bg-gray-50 text-gray-900 hover:bg-gray-400 hover:text-white py-2 px-8 rounded"
                    >
                        Hủy
                    </a>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import Loading from "vue-loading-overlay";

export default {
    data() {
        return {
            is_loading: false,
            data: [],
            errors: {},
            backGroundcolor: '#E93B3B',
        };
    },
    components: {
        Loading,
    },
    methods: {
        formSubmit(e) {
            e.preventDefault();
            this.data.forEach((ele) => {
                ele.value = this.formatCurencyToNumber(ele.value_format);
            });
            this.updateConfig();
        },

        updateConfig() {
            this.is_loading = true;
            axios
                .post("/api/update-config", this.data)
                .then((res) => {
                    if (res.data.errors) {
                        this.errors = res.data.errors;
                    } else {
                        this.errors = {};
                        this.$swal
                            .fire("Phí dịch vụ đã được cập nhật", "", "success")
                            .then((res) => {
                                window.location.assign("/settings");
                            });
                    }
                })
                .catch((error) => console.log(error))
                .finally(() => (this.is_loading = false));
        },
        getDataConfig() {
            this.is_loading = true;
            axios
                .get("/api/get-data-config")
                .then((res) => {
                    this.data = res.data.data_settings;
                    this.data.forEach((e, i) => {
                        this.data[i].value_format = this.formatPrice(
                            e.value
                        );
                    });
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
        formatCurencyToNumber(val) {
            if (!val) {
                return null;
            }
            return parseFloat(val.replace(/[^.\d]/g, ""));
        },
        formatCurrency2(val) {
            return val
                .replace(/[^.\d]/g, "")
                .toString()
                .replace(/\B(?<!\.\d+)(?=(\d{3})+(?!\d))/g, ",");
        },
    },
    created() {
        this.getDataConfig();
    },
};
</script>
