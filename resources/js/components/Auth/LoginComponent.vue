<template>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <div class="layout h-screen bg-gradient-to-br from-[#e93c3b] to-[#f26435] w-full">
        <form action="" autocomplete="off" method="post" @submit.prevent="submitLogin" class="bg-white
        w-3/4 h-[593px] m-auto translate-y-[70px]
        rounded-[10px] grid grid-cols-[1fr,_1fr]
        
        ">
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
                        placeholder="Tên đăng nhập..." v-model="form.username" /> <br />
                    <i
                        class="fa-solid fa-lock absolute text-[22px] text-[#6b6b6b] translate-x-[15px] translate-y-[33px]"></i>
                    <input class="w-[315px] h-[50px] rounded-[5px] my-5 font-bold font-[19px] pl-[50px]" type="password"
                        placeholder="Mật khẩu..." v-model="form.password" />
                </div>
                <div class="capcha">
                    <vue-recaptcha ref="recaptcha" sitekey="6Ld9imgiAAAAAAiy8XdLMU_jXq9ftpi9s8pgWxeg"
                        @expired="onCaptchaExpired" @verify="onCaptchaVerify">
                    </vue-recaptcha>
                </div>
                <div class="mt-3">
                    <VueLoadingButton aria-label="Post message" class="mt-7  w-[315px] h-[45px]  bg-gradient-to-br	from-[#e93c3b] to-[#f26435]
                 rounded-[8px] font-bold font-[18px] text-white
                " @click.native="submitLogin" :loading="isLoading" :styled="isStyled">Đăng nhập</VueLoadingButton>
                </div>


            </div>
        </form>
    </div>
</template>
<script>
import { VueRecaptcha } from 'vue-recaptcha';
// import { login } from '../../services/Auth/auth.js';
// import Auth from '../../config/auth.js';
import { useToast } from "vue-toastification";
import VueLoadingButton from '../loading-button/vue-loading-button.vue'
export default {
    data() {
        return {
            form: {
                username: '',
                password: '',
                access_token: '',
                'g-recaptcha-response': ''
            },
            isLoading: false,
            isStyled: false,
            error: false,
            errors: {},
            success: false
        }
    },
    components: {
        VueRecaptcha,
        VueLoadingButton
    },
    setup() {
        const toast = useToast();

        return {
            toast
        };
    },
    created() {
    },
    methods: {
        onEvent() {
            // when you need a reCAPTCHA challenge

            this.$refs.recaptcha.execute();
        },

        onCaptchaVerify(token) {
            console.log(this.form)

            const self = this;
            self.status = "Submitting";
            // Provide the token response to the form object.
            this.form['g-recaptcha-response'] = token;
        },
        onCaptchaExpired() {
            this.$refs.recaptcha.reset();
        },
        submitLogin() {
            this.isLoading = true;
            // var redirect = this.$auth.redirect();
            console.log(this.form);
            var app = this;
            this.$auth.login({
                data: this.form,
                authType: "bearer",
                rememberMe: true,
                fetchUser: true,

            }).then((response) => {
                this.isLoading = false
                const { data } = response;
                this.form.access_token = data.access_token
                if (this.form.access_token) {
                    this.$auth.token("bearer " + this.form.access_token);
                    window.localStorage.setItem("token", this.form.access_token);
                    axios.defaults.headers.common["Authorization"] = "Bearer " + this.form.access_token;
                    this.toast.success("Đăng nhập thành công, chuyển hướng sau 3s", { timeout: 3000 })
                    setTimeout(() => {
                        this.$router.push('/');
                    }, 3000)
                }
            }).catch(error => {
                this.isLoading = false;
                const { response } = error;
                const { data } = response;
                const { message } = data;
                this.$swal(message);
                this.$refs.recaptcha.reset();
            });
        }
    }
}
</script>
<style scoped>

</style>
