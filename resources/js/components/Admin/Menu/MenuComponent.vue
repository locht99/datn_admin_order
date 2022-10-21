<template>
    <div class=" mt-7  ">
        <nav>
            <ul>

                <li style="background-color:#E93B3B; " class="text-white my-2 py-2 pl-5 rounded-[10px]">
                    <router-link to="/">
                        <font-awesome-icon icon="fa fa-home"  />
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
                    <router-link to="/pay-fist">
                        <font-awesome-icon icon="fa fa-money-bill" />
                        Tiền Hàng
                    </router-link>
                </li>
                <li class="text-white my-2 py-2 pl-5 rounded-[10px]">
                    <router-link to="/user">
                        <font-awesome-icon icon="fas fa-users" />
                        Khách Hàng</router-link>
                </li>
                <li class="text-white my-2 py-2 pl-5 rounded-[10px]">
                    <router-link to="chinese-money">
                        <font-awesome-icon icon="fa fa-money-bill" />    
                   Giao Dịch Tiền Trung</router-link>
                </li>
                <li class="text-white my-2 py-2 pl-5 rounded-[10px]">
                    <router-link to="/money-vietnamese">
                        <font-awesome-icon icon="fa fa-money-bill" />
                        Giao Dịch Tiền Việt </router-link>
                </li>
                <li class="text-white my-2 py-2 pl-5 rounded-[10px]">
                    <router-link to="/bag">
                        <font-awesome-icon  icon="fa fa-luggage-cart" />
                        Bao Hàng</router-link>
                </li>
                <li class="text-white my-2 py-2 pl-5 rounded-[10px]">
                    <router-link to="/partner">
                        <font-awesome-icon icon="fa fa-handshake-alt" />
                        Đối Tác</router-link>
                </li>
            </ul>
        </nav>
    </div>
</template>
<style scoped>
a{
    padding: 5px 50px 5px 5px;
}
</style>

<script>
export default {
 methods:{
    
 },
 mounted(){
    var li =  document.querySelectorAll('li');

   li.forEach(el => {
        el.addEventListener('click',function(){
            li.forEach(el=>{
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
