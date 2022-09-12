<template>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <div class="bg-[#f9f9f9] mx-auto overflow-hidden relative">
        <div class="container h-screen  overflow-x-hidden mx-auto grid grid-cols-[230px,_1fr] bg-[#f9f9f9]" id="main">
            <aside class="duration-300  w-[230px] bg-gradient-to-br from-[#e93c3b] to-[#f26435] h-full p-5 relative ">
                <div class="img mt-2 mb-4">
                    <img class="w-20 m-auto rounded-full" src="/images/logo.png" alt="" />
                </div>
                <hr />
                <menu-component-vue />
                <div id="icon"
                    class="duration-300 transition ease-in-out delay-50 text-center w-10 h-10 absolute top-10 right-[-20px] text-white bg-gradient-to-br from-[#e93c3b] to-[#f26435] text-2xl border-solid border-[4px] border-white rounded-full cursor-pointer"
                    @click="aside_action">
                    <i class="fa-solid fa-angle-left mt-1"></i>
                </div>
            </aside>
            <section class="m-6  ">
                <header>
                    <div 
                        class="top flex justify-between border-solid border-[1px] duration-300 border-[#ededed] bg-white shadow-[0px_4px_4px_rgba(0, 0, 0, 0.25)] rounded-[10px] h-[60px]">
                        <div class="black_client">
                            <i class="fa-regular fa-moon text-4xl ml-6"></i>
                        </div>
                        <div class="user">
                            <img class="w-[50px] h-[50px] rounded-full mr-[25px] mt-[5px]" src="/images/avt.jpg"
                                alt="" />
                        </div>
                    </div>
                </header>
                <main>
                    <router-view></router-view>
                </main>
                <footer>
                    <span class="text-[16px] absolute bottom-0 text-[#7e7373]">© 2022 , hệ thống được thiết kế và vận
                        hành bởi Order Việt
                        Trung</span>
                </footer>
            </section>
        </div>
    </div>
</template>

<style lang="css" scoped>
header .top .black_client i {
    line-height: 60px;
    cursor: pointer;
}
</style>

<script>
import MenuComponentVue from "../components/admin/MenuComponent.vue";
export default {
    setup() { },
    components: {
        MenuComponentVue,
    },
    methods: {
        aside_action() {
            let aside = document.getElementsByTagName("aside")[0];
            let container = document.getElementsByClassName('container')[0]
            let icon = document.getElementById('icon')
            if (aside.style.transform === "translateX(-230px)") {
                aside.style.transform = "translateX(0px)";
                icon.style.transform = "rotate(0deg)"
                container.style.gridTemplateColumns = '230px 1fr'
            } else {
                aside.style.transform = "translateX(-230px)";
                icon.style.transform = "rotate(180deg)"
                container.style.gridTemplateColumns = '30px 1fr'
            }
        },
    },
};
</script>
