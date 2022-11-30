<template>
    <div class="relative duration-300">
        <loading v-model:active="is_loading" :color="backGroundcolor" />
        <div class="my-2">
        <h5>
            <span class="uppercase text-xl">Thiết lập phí dịch vụ</span>
            <a href="/settings/edit" class="bg-teal-500 text-white p-1.5 rounded m-4">
                <font-awesome-icon icon="fa-solid fa-pen-to-square" /> Sửa
            </a>
        </h5>
        <div class="grid grid-cols-2 my-4 text-gray-700">
            <table>
                <tbody>
                        <tr class="even:bg-gray-100 odd:bg-gray-300" v-for="(item, index) in data_fee">
                            <td scope="row" class="p-4 w-3/4">
                                {{  item.name }}
                            </td>
                            <td class="p-4">
                                {{  formatPrice(item.value) }}
                            </td>
                        </tr>
                </tbody>
            </table>
        </div>
    </div>
    </div>
</template>

<script>
import Loading from 'vue-loading-overlay';
export default {
    data() {
        return {
            backGroundcolor: '#E93B3B',
            data_fee: null,
            is_loading: false
        }
    },
    components: {
        Loading
    },

    methods: {
        formatPrice(value) {
            return new Intl.NumberFormat("en-US", {
                style: "currency",
                currency: "VND",
            }).format(value);
        },
        getFreeConfig(page = 1) {
            this.is_loading = true;
            axios.get("api/settings")
                .then((res) => {
                    this.data_fee = res.data.data_settings;
                })
                .catch((error) => console.log(error))
                .finally(() => (this.is_loading = false));
        },
    },
    created() {
        this.getFreeConfig();
    },
}

</script>

