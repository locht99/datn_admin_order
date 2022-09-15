<template>
    <div class=" mt-7">
        <nav>
            <ul>
                <li style="background-color: #E93B3B;" class="text-white my-2 py-2 pl-5 rounded-[10px]"><router-link to="/">Trang chủ</router-link></li>
                <li class="text-white my-2 py-2 pl-5 rounded-[10px]"><router-link to="/order">Đơn Hàng</router-link></li>
                <li class="text-white my-2 py-2 pl-5 rounded-[10px]"><router-link to="/tien-hang">Tiền Hàng</router-link></li>
                <li class="text-white my-2 py-2 pl-5 rounded-[10px]"><router-link to="/khach-hang">Khách Hàng</router-link></li>
                <li class="text-white my-2 py-2 pl-5 rounded-[10px]"><router-link to="">Tiền Trung</router-link></li>
                <li class="text-white my-2 py-2 pl-5 rounded-[10px]"><router-link to="">Tiền Việt</router-link></li>
                <li class="text-white my-2 py-2 pl-5 rounded-[10px]"><router-link to="">Bao Hàng</router-link></li>
                <li class="text-white my-2 py-2 pl-5 rounded-[10px]"><router-link to="">Đối Tác</router-link></li>
            </ul>
        </nav>
    </div>
</template>
<style scoped>
a{
    padding: 5px 70px 5px 5px;
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
