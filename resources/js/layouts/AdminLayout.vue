<template>
    <div class="bg-[#f9f9f9] mx-auto overflow-hidden relative">
        <div class="layout h-screen grid grid-cols-[230px,_1fr] bg-[#f9f9f9] w-full duration-500">
            <aside
                class="fixed w-[230px] bg-gradient-to-br from-[#e93c3b] to-[#f26435] h-full p-5 relative duration-500">
                <div class="img mt-2 mb-4">
                    <img class="w-[80%] m-auto" src="/images/order.png" alt="" />
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
                        <div class="user" @click="modelLogout()">
                            <img class="w-[50px] h-[50px] rounded-full mr-[25px] mt-[5px]" src="/images/avt.jpg"
                                alt="" />
                            <Transition name="slide-fade">
                                <div v-if="this.boxUserInfo == true"
                                    class="absolute top-14 right-0 w-60 rounded-lg shadow-md shadow-gray-400 bg-[#ff3f3a] text-white px-5 z-50">
                                    <ul>
                                        <li class="py-3">
                                            <router-link to="" @click="logout()"
                                                class="text-base font-semibold text-white text-decoration-none">Đăng
                                                xuất</router-link>
                                        </li>
                                    </ul>
                                </div>
                            </Transition>
                        </div>
                    </div>
                </header>
                <main class="w-full">
                    <router-view></router-view>
                </main>
                <footer>
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
</style>

<script>
import MenuComponentVue from "../components/Admin/Menu/MenuComponent.vue";
export default {
    setup() { },
    data() {
        return {
            boxUserInfo: false,
        }
    },
    components: {
        MenuComponentVue,
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
        logout() {
            let auth_token_default = localStorage.getItem('auth_token_default')
            if (auth_token_default) {
                localStorage.removeItem('auth_token_default')
                localStorage.removeItem('_grecaptcha')
                localStorage.removeItem('auth_stay_signed_in')
                localStorage.removeItem('token')
                this.$router.replace("/login")
            }
        },
        modelLogout() {
            if (this.boxUserInfo == false) {
                this.boxUserInfo = true
            } else {
                this.boxUserInfo = false
            }

        }
    },
};
</script>
