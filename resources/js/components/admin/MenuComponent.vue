<template>
    <div class=" mt-7  ">
        <nav>
            <ul>

                <li style="background-color:#E93B3B; " class="text-white my-2 py-2 pl-5 rounded-[10px]">
                    <router-link to="/">
                        <font-awesome-icon icon="fa fa-home" />
                        Trang chủ
                    </router-link>
                </li>
                <li class="text-white my-2 py-2 pl-5 rounded-[10px]">
                    <router-link to="/order">
                        <font-awesome-icon icon="fa fa-shopping-cart" />
                        Đơn Hàng
                    </router-link>
                </li>
                <li class="text-white my-2 py-2 pl-5 rounded-[10px]">
                    <router-link to="">
                        <font-awesome-icon icon="fa fa-money-bill" />
                        Tiền Hàng
                    </router-link>
                </li>
                <li class="text-white my-2 py-2 pl-5 rounded-[10px]">
                    <router-link to="">
                        <font-awesome-icon icon="fas fa-users" />
                        Khách Hàng</router-link>
                </li>
                <li class="text-white my-2 py-2 pl-5 rounded-[10px]">
                    <router-link to="">
                        <font-awesome-icon icon="fa fa-money-bill" />    
                    Tiền Trung</router-link>
                </li>
                <li class="text-white my-2 py-2 pl-5 rounded-[10px]">
                    <router-link to="/money-vietnamese">
                        <font-awesome-icon icon="fa fa-money-bill" />
                        Tiền Việt</router-link>
                </li>
                <li class="text-white my-2 py-2 pl-5 rounded-[10px]">
                    <router-link to="/bag">
                        <font-awesome-icon  icon="fa fa-luggage-cart" />
                        Bao Hàng</router-link>
                </li>
                <li class="text-white my-2 py-2 pl-5 rounded-[10px]">
                    <router-link to="">
                        <font-awesome-icon icon="fa fa-handshake-alt" />
                        Đối Tác</router-link>
                </li>

            </ul>
        </nav>
    </div>
</template>


<script>
export default {
    methods: {

    }
};
</script>

<style scoped>

</style>
