<template>

    <div class="bg-[#f9f9f9] mx-auto overflow-hidden relative" v-if="$auth.check()">

        <div class="layout h-screen grid grid-cols-[230px,_1fr] bg-[#f9f9f9] w-full overflow-x-hidden">
            <aside class=" w-[230px] bg-gradient-to-br from-[#e93c3b] to-[#f26435] h-full p-5 relative">
                <div class="img mt-2 mb-4">
                    <img class="w-20 m-auto cursor-pointer" src="/images/order.png" alt="" />
                </div>
                <hr />
                <menu-component-vue />
                <div id="icon"
                    class="transition ease-in-out delay-50 text-center w-10 h-10 absolute top-10 right-[-20px] text-white bg-gradient-to-br from-[#e93c3b] to-[#f26435] text-2xl border-solid border-[4px] border-white rounded-full cursor-pointer"
                    @click="aside_action">
                    <font-awesome-icon icon="fa-solid fa-angle-left" class="mt-1" />
                </div>
            </aside>
            <section class="m-6 relative">
                <header>
                    <div
                        class="top flex justify-between border-solid border-[1px] border-[#ededed] shadow-[0px_4px_4px_rgba(0, 0, 0, 0.25)] rounded-[10px] h-[60px]">
                        <div class="black_client">
                            <font-awesome-icon icon="fa-regular fa-moon" class="text-4xl ml-6 mt-3" />
                        </div>
                        <div class="user">
                            <img @click="isClickDisplayMenu"
                                class="w-[50px] h-[50px] rounded-full mr-[25px] mt-[5px]  cursor-pointer"
                                src="/images/avt.jpg" />
                                <div
                                class=" bg-white absolute text-base z-[999] float-left py-2 list-none text-left rounded shadow-lg min-w-48  right-0 top-[75px]">
                            <Transition name="slide-fade">
                                <div  v-if="isDisplayProfile">
                                    <a
                                    class="hover:bg-gray-400 text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700">
                                    Thông tin </a>
                                <a href="javascript:void(0);"
                                    class="hover:bg-gray-400 text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700">
                                    Đổi mật khẩu </a>
                                <a href="javascript:void(0);"
                                    class="hover:bg-gray-400 text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700">
                                    Something else here </a>
                                <div class=" h-0 my-2 border border-solid border-blueGray-100"></div><a
                                    href="javascript:void(0);" @click="logout"
class="hover:bg-gray-400 text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700">
                                    Đăng xuất </a>
                                </div>
                            </Transition>

                            </div>

                        </div>
                    </div>
                </header>
                <main class="w-full">
                    <router-view></router-view>
                </main>
                <footer class="pt-8">
                    <span class="text-[16px] absolute bottom-0 text-[#7e7373]">© 2022 , hệ thống được thiết kế và vận
                        hành bởi Order
                        Việt Trung</span>
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

.slide-fade-enter-active {
    transition: all 0.3s ease-out;
}

.slide-fade-leave-active {
    transition: all 0.8s cubic-bezier(1, 0.5, 0.8, 1);
}

.slide-fade-enter-from,
.slide-fade-leave-to {
    transform: translateX(20px);
    opacity: 0;
}
</style>

<script>
import MenuComponentVue from "../components/Admin/Menu/MenuComponent.vue";
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';
export default {
    setup() { },
    components: {
        MenuComponentVue,
        Loading
    },
    data() {
        return {
            isDisplayProfile: false,
            isLoading: true,
            backGroundcolor: '#E93B3B',
        }
    },
    methods: {
        aside_action() {
            let aside = document.getElementsByTagName("aside")[0];
            let container = document.getElementsByClassName("layout")[0];
            let icon = document.getElementById("icon");
            if (aside.style.transform === "translateX(-230px)") {
                aside.style.transform = "translateX(0px)";
                icon.style.transform = "rotate(0deg)";
                container.style.gridTemplateColumns = "230px 1fr";
            } else {
                aside.style.transform = "translateX(-230px)";
                icon.style.transform = "rotate(180deg)";
                container.style.gridTemplateColumns = "30px 1fr";
            }
        },
        isClickDisplayMenu() {
            console.log(this.isDisplayProfile);
            this.isDisplayProfile = !this.isDisplayProfile;
        },
        logout() {
            //    Auth.logout();
            this.$auth.logout();
            this.$router.push('/login');
        }
    },

};
</script>