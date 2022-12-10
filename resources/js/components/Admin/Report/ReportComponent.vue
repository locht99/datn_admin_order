<template>
    <div class="pt-6">
        <loading v-model:active="is_loading" :color="backGroundcolor" />
        <div class="title grid grid-cols-2">
            <h1 class="text-[#566a7f] text-[28px] font-[700]">Báo cáo</h1>
            <div class="col-sm-6">
                <div date-rangepicker class="flex items-center float-right">
                    <div class="relative">
                        <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <input name="start" type="date" v-model="from"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Select date start">
                    </div>
                    <span class="mx-4 text-gray-500">to</span>
                    <div class="relative">
                        <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <input name="end" type="date" v-model="to"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Select date end">
                    </div>
                    <button @click="getReport"
                        class="bg-[#E93B3B] hover:bg-orange-800 duration-300 text-white p-2.5 mx-4 rounded-lg">Save</button>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-12 mb-12 mx-auto">
            <div>
                <Bar :chart-options="chartOptions" :chart-data="chartData" :chart-id="chartId"
                    :dataset-id-key="datasetIdKey" :plugins="plugins" :css-classes="cssClasses" :styles="styles"
                    :width="width" :height="height" />
            </div>
            <div class="grid  grid-cols-2 place-items-center mx-auto gap-12">
                <div class="text-center">
                    <div><font-awesome-icon icon="fa-solid fa-cart-shopping" class="text-6xl text-yellow-300" /></div>
                    <p class="text-blue-600 pt-4 text-xl">{{ total_order }}</p>
                </div>
                <div class="text-center">
                    <div><font-awesome-icon icon="fa-solid fa-money-bill-trend-up" class="text-6xl text-green-500" /></div>
                    <p class="text-blue-600 pt-4 text-xl">{{ formatPrice(total_deposite) }}</p>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-3 gap-12 mb-12 mx-auto">
            <div class="col-span-2">
                <Bar :chart-data="chartDataTrans" :plugins="plugins" :css-classes="cssClasses" :styles="styles"
                    :width="width" :height="height" />
            </div>
        </div>
    </div>
</template>

<script>
import Loading from 'vue-loading-overlay';
import { Bar } from 'vue-chartjs'
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js';

ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale)

export default {
    components: { Bar, Loading },
    props: {
        chartId: {
            type: String,
            default: 'bar-chart'
        },
        datasetIdKey: {
            type: String,
            default: 'label'
        },
        width: {
            type: Number,
            default: 400
        },
        height: {
            type: Number,
            default: 200
        },
        cssClasses: {
            default: '',
            type: String
        },
        styles: {
            type: Object,
            default: () => {

            }
        },
        plugins: {
            type: Object,
            default: () => { }
        }
    },
    data: () => ({
        is_loading: false,
        chartData: {},
        chartDataTrans: {},
        chartOptions: {
            responsive: true
        },
        from: null,
        to: null,
        total_order: null,
        total_deposite: null
    }),
    methods: {
        getReport() {
            this.is_loading = true;
            axios
                .get('/api/report', {
                    params: {
                        from: this.from,
                        to: this.to
                    },
                })
                .then((res) => {
                    if (res.status == 200) {
                        this.chartData = {
                            labels: res.data.labels,
                            datasets: [{
                                label: 'User created',
                                data: res.data.data,
                                backgroundColor: "#EC3434",
                            }],
                        }
                        this.chartDataTrans = {
                            labels: res.data.labelsTrans,
                            datasets: [{
                                label: 'Giao dịch nạp tiền',
                                data: res.data.dataTrans,
                                backgroundColor: "#0B2EDC",
                            }],
                        }
                        this.total_order = res.data.dataOrder.total
                        this.total_deposite = res.data.dataOrder.total_deposite
                        this.is_loading = true
                    }
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
        this.getReport()
    }
}
</script>