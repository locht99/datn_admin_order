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
                <li v-if="role == 1 || role == 2" class="text-white my-2 py-2 pl-5 rounded-[10px]">
                    <router-link to="/pay-fist" class="text-white">
                        <font-awesome-icon icon="fa fa-money-bill" />
                        Tiền Hàng
                    </router-link>
                </li>
                <li v-if="role == 1" class="text-white my-2 py-2 pl-5 rounded-[10px]">
                    <router-link to="/user" class="text-white">
                        <font-awesome-icon icon="fas fa-users" />
                        Khách Hàng
                    </router-link>
                </li>
                <li v-if="role == 1 || role == 2" class="text-white my-2 py-2 pl-5 rounded-[10px]">
                    <router-link to="chinese-money" class="text-white">
                        <font-awesome-icon icon="fa fa-money-bill" />
                        Giao Dịch Tiền Trung
                    </router-link>
                </li>
                <li v-if="role == 1 || role == 2" class="text-white my-2 py-2 pl-5 rounded-[10px]">
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
                <li v-if="role == 1 || role == 2" class="text-white my-2 py-2 pl-5 rounded-[10px]">
                    <router-link to="/partner" class="text-white">
                        <font-awesome-icon icon="fa fa-handshake-alt" />
                        Đối Tác
                    </router-link>
                </li>

                <li class="text-white my-2 py-2 pl-5 rounded-[10px]">
                    <router-link to="/manager" class="text-white">
                        <font-awesome-icon icon="fa-solid fa-chart-pie" />
                        Quản trị viên
                    </router-link>
                </li>

                <li class="text-white my-2 py-2 pl-5 rounded-[10px]">
                    <router-link to="/report" class="text-white">
                        <font-awesome-icon icon="fa-solid fa-chart-pie" />
                        Báo cáo
                    </router-link>
                </li>


                <!-- <router-link to="/config-payment">
                       
                        Thiết Lập
                    </router-link> -->
                <Dropdown v-if="role == 1 || role == 2" title="Thiết Lập" height="h-24" :fontAwesome="icon_fontAwesome" :icon="icon" class="text-white my-2 py-2 pl-5 rounded-[10px]" >
                    <li class="mb-2" v-if="role == 1">
                       <router-link to="/config-payment">Thông tin thanh toán</router-link>
                    </li>
                    <li class="mb-2">
                        <router-link to="/settings">Thiết lập cửa hàng</router-link>
                    </li>
              
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
import { getUser } from "../../../services/User/user";
export default {
   data(){
        return {
            icon_fontAwesome: 'fas',
            icon: 'fa-cog',
            role: 0
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
        this.checkRole()
    },
    methods: {
        checkRole(){
            let token = localStorage.getItem("auth_token_default") || null;
            if(token){
                getUser().then(res => {
                    this.role = res.data.data.role
                }).catch(err => {
                    
                })
            }else{
                
            }
        }  
    },

};
</script>

<style scoped>

</style>
