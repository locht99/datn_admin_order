<template>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <div class="   h-screen bg-gradient-to-br from-[#e93c3b] to-[#f26435] ">
        <div class="container mx-auto">
            <form
                class=" absolute top-[50%] left-[50%]  bg-white w-[1100px] h-[600px] mt-[-300px] ml-[-550px]  rounded-[10px] grid grid-cols-[1fr,_1fr]">
                <div class="aside m-auto">
                    <div class="img mb-4">
                        <router-link to="/">
                            <img class="w-[340px] h-[340px]" src="/images/logo.png" alt="" />
                        </router-link>
                    </div>
                    <span class="text-lg font-bold">Website đặt hàng trung gian Việt Trung</span>
                    <br />
                    <span class="text-lg font-bold">Gọi hỗ trợ: 0123456789</span>
                    <br />
                    <span class="text-lg font-bold">Facebook: OrderViettrung</span>
                    <br />
                </div>
                <div class="main m-auto text-center h-[490px]">
                    <div class="title mt-14 mb-5">
                        <h2 class="text-2xl font-bold">THÔNG TIN ĐĂNG NHẬP</h2>
                    </div>
                    <div class="input relative">
                        <i
                            class="fa-solid fa-user absolute text-[22px] text-[#6b6b6b] translate-x-[15px] translate-y-[33px]"></i>
                        <input class="w-[315px] h-[50px] rounded-[5px] my-5 font-bold font-[19px] pl-[50px]" type="text"
                            placeholder="Tên đăng nhập..." v-model="auth.username" /> <br />

                        <i
                            class="fa-solid fa-lock absolute text-[22px] text-[#6b6b6b] translate-x-[15px] translate-y-[33px]"></i>
                        <input class="w-[315px] h-[50px] rounded-[5px] my-5 font-bold font-[19px] pl-[50px]"
                            type="password" placeholder="Mật khẩu..." v-model="auth.password" />
                    </div>
                    <div class="capcha">
                        <vue-recaptcha ref="recaptcha" :sitekey="this.sitekey" :load-recaptcha-script="true">

                        </vue-recaptcha>
                    </div>
                    <button @click="handleSubmit" class="mt-4 w-[315px] h-[45px]  bg-gradient-to-br	from-[#e93c3b] to-[#f26435]
                 rounded-[8px] font-bold font-[18px] text-white
                ">Đăng Nhập</button>
                </div>
            </form>
        </div>
    </div>
</template>

<style scoped>

</style>
<script>
import { VueRecaptcha } from 'vue-recaptcha';
import { login } from '../../services/Auth/auth.js';
import Auth from '../../config/auth.js';
// import Validation from '@/services/recaptchaValidate'

export default {
    data() {
        return {
            auth: {
                username: '',
                password: '',
                access_token: ''
            },
            sitekey: '6LdupAQiAAAAAOl8y9dp3a1uCJbWa9BgT1ACJR1y'
        }
    },
    components: {
        VueRecaptcha
    },

    methods: {
        onEvent() {

            // when you need a reCAPTCHA challenge
            this.$refs.recaptcha.execute();
        },
        handleSubmit(e) {
            e.preventDefault();
            if (this.auth.password.length > 0) {
                const dataAuth = { username: this.auth.username, password: this.auth.password };
                login(dataAuth).then(response => {
                    const { data } = response;
                    const { access_token, expires_at, token_type } = data;
                    this.auth.access_token = access_token;
                    Auth.login(access_token, expires_at);
                    if (this.auth.access_token) {
                       this.$router.push('/');
                    }
                }).catch(function (error) {
                    console.log(error);
                });
            }
        },


    },
    created() {
        if (Auth.check()) {
            this.$router.push('/');
        }
    }
}
</script>
