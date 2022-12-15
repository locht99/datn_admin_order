<template>
    <div class="bg-[#f9f9f9] mx-auto overflow-hidden relative">
        <div
            class="layout h-screen grid grid-cols-[230px,_1fr] bg-[#f9f9f9] w-full duration-500"
        >
            <aside
                class="fixed w-[230px] bg-gradient-to-br from-[#e93c3b] to-[#f26435] h-full p-5 relative duration-500"
            >
                <div class="img">
                    <img
                        class="w-12 m-auto rounded-full"
                        src="data:image/png;base64,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"
                        alt=""
                    />
                </div>
                <hr />
                <menu-component-vue />
                <div
                    id="icon"
                    class="transition ease-in-out delay-50 text-center w-10 h-10 absolute top-10 right-[-20px] text-white bg-gradient-to-br from-[#e93c3b] to-[#f26435] text-2xl border-solid border-[4px] border-white rounded-full cursor-pointer"
                    @click="aside_action"
                >
                    <font-awesome-icon icon="fa-solid fa-angle-left" class="mt-1" />
                </div>
            </aside>
            <section class="m-6 relative">
                <header>
                    <div
                        class="top flex justify-between border-solid border-[1px] border-[#ededed] shadow-[0px_4px_4px_rgba(0, 0, 0, 0.25)] rounded-[10px] h-[60px]"
                    >
                        <div class="black_client">
                            <font-awesome-icon icon="fa-regular fa-moon" class="text-4xl ml-6 mt-3" />
                        </div>
                        <div class="user">
                            <img
                                class="w-[50px] h-[50px] rounded-full mr-[25px] mt-[5px]"
                                src="/images/avt.jpg"
                                alt=""
                            />
                            <Transition name="slide-fade">
                                <div v-if="boxUserInfo"
                                  class="absolute top-14 right-0 w-60 rounded-lg shadow-md shadow-gray-400 bg-[#ff3f3a] text-white px-5 z-50">
                                  <ul>
                                    <li class="py-3">
                                      <router-link to="" @click="logout()" class="text-base font-semibold text-white text-decoration-none">Đăng xuất</router-link>
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
                    <span class="text-[16px] absolute bottom-0 text-[#7e7373]"
                        >© 2022 , hệ thống được thiết kế và vận hành bởi Order
                        Việt Trung</span
                    >
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
    setup() {},
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
        }
    },
};
</script>
