<template>
    <div class="flex justify-between items-center">
        <div class="code-order flex items-center">
            <div class="p-2">
                <span class="bg-red-600 p-1 rounded text-white">Mã #{{ orderId }}</span>
            </div>
            <div>
                <div class="date">
                   
                    <p>Tạo ngày: {{ date }}</p>
                </div>
            </div>

        </div>
        <div class="flex items-center">
            <div class="flex items-center justify-around m-3">
                <div class="mx-1">
                    <router-link to="/orderdetail/"
                        class="bg-red-600 rounded p-1 text-white focus:outline-none focus:ring focus:ring-red-400 duration-100">
                        Đơn hàng</router-link>
                </div>
                <div class="mx-1">
                    <router-link to="/orderdetail/package"
                        class="bg-red-600 rounded p-1 text-white focus:outline-none focus:ring focus:ring-red-400 duration-100">
                        Gói hàng</router-link>
                </div>
                <div class="mx-1">
                    <router-link to="/orderdetail/fee"
                        class="bg-red-600 rounded p-1 text-white focus:outline-none focus:ring focus:ring-red-400 duration-100">
                        Tiền phí</router-link>
                </div>
                <div class="mx-1">
                    <router-link to="/orderdetail/status"
                        class="bg-red-600 rounded p-1 text-white focus:outline-none focus:ring focus:ring-red-400 duration-100">
                        Tình trạng</router-link>
                </div>
            </div>
        </div>
    </div>
</template>
<script>

export default {
    props: ["orderId", "date"],
    mounted(){
        console.log(this.orderId, this.date)
    }
    // setup() {
    //     const currentRoute = computed(() => {
    //         return useRouter().currentRoute.value.name;
    //     })
    //     return { currentRoute }
    // }
}
</script>
<style>

</style>