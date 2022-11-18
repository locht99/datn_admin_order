<template>
    <div class=" mt-7 ">
        <nav class="h-[100vh]">
            <ul>
                <li style="background-color:#E93B3B; " class="text-white my-2 py-2 pl-5 rounded-[10px]">
                    <router-link to="/" class="text-white">
                        <font-awesome-icon icon="fa fa-home" />
                        Trang chủ
                    </router-link>
                </li>
                <li class="text-white my-2 py-2 pl-5 rounded-[10px]">
                    <router-link to="/order" class="text-white">
                        <font-awesome-icon icon="fa fa-shopping-cart" />
                        Đơn Hàng
                    </router-link>
                </li>
                <li class="text-white my-2 py-2 pl-5 rounded-[10px]">
                    <router-link to="/pay-fist" class="text-white">
                        <font-awesome-icon icon="fa fa-money-bill" />
                        Tiền Hàng
                    </router-link>
                </li>
                <li class="text-white my-2 py-2 pl-5 rounded-[10px]">
                    <router-link to="/user" class="text-white">
                        <font-awesome-icon icon="fas fa-users" />
                        Khách Hàng
                    </router-link>
                </li>
                <li class="text-white my-2 py-2 pl-5 rounded-[10px]">
                    <router-link to="chinese-money" class="text-white">
                        <font-awesome-icon icon="fa fa-money-bill" />
                        Giao Dịch Tiền Trung
                    </router-link>
                </li>
                <li class="text-white my-2 py-2 pl-5 rounded-[10px]">
                    <router-link to="/money-vietnamese" class="text-white">
                        <font-awesome-icon icon="fa fa-money-bill" />
                        Giao Dịch Tiền Việt
                    </router-link>
                </li>
                <li class="text-white my-2 py-2 pl-5 rounded-[10px]">
                    <router-link to="/bag" class="text-white">
                        <font-awesome-icon icon="fa fa-luggage-cart" />
                        Bao Hàng
                    </router-link>
                </li>
                <li class="text-white my-2 py-2 pl-5 rounded-[10px]">
                    <router-link to="/partner" class="text-white">
                        <font-awesome-icon icon="fa fa-handshake-alt" />
                        Đối Tác
                    </router-link>
                </li>


                <!-- <router-link to="/config-payment">
                       
                        Thiết Lập
                    </router-link> -->
                <Dropdown title="Thiết Lập" height="h-24" :fontAwesome="icon_fontAwesome" :icon="icon" class="text-white my-2 py-2 pl-5 rounded-[10px]" >
                    <li class="mb-2">
                       <router-link to="/config-payment">Thông tin thanh toán</router-link>
                    </li>
                    <li class="mb-2">Thiết lập cửa hàng</li>
              
                </Dropdown>

            </ul>
        </nav>
    </div>
</template>
<style scoped>
a {
    padding: 5px 50px 5px 5px;
}
</style>

<script>
import Dropdown from '../dropdown/Dropdown.vue'
export default {
   data(){
        return {
            icon_fontAwesome: 'fas',
            icon: 'fa-cog'

        }
   },
    components: {
        Dropdown
    },
    mounted() {
        var li = document.querySelectorAll('li');

        li.forEach(el => {
            el.addEventListener('click', function () {
                li.forEach(el => {
                    el.style.backgroundColor = 'transparent'
                })
                el.style.backgroundColor = '#E93B3B'
            })
        });

    }

};
</script>

<style scoped>

</style>
