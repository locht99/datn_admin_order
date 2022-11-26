require("./bootstrap");
require("flowbite");
import { createApp } from "vue";
import { createRouter, createWebHistory } from "vue-router";
import { library } from "@fortawesome/fontawesome-svg-core";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { fas } from "@fortawesome/free-solid-svg-icons";
import { fab } from "@fortawesome/free-brands-svg-icons";
import { far } from "@fortawesome/free-regular-svg-icons";
import VueSweetalert2 from "vue-sweetalert2";
import "sweetalert2/dist/sweetalert2.min.css";
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";
import App from "./App.vue";
import routes from "./routes";
import { getUser } from "./services/User/user";
import VueAxios from "vue-axios";
import axios from "axios";
import { createAuth } from "@websanova/vue-auth";
import driverAuthBearer from "@websanova/vue-auth/dist/drivers/auth/bearer.esm.js";
import driverHttpAxios from "@websanova/vue-auth/dist/drivers/http/axios.1.x.esm.js";
import driverRouterVueRouter from "@websanova/vue-auth/dist/drivers/router/vue-router.2.x.esm.js";
import Antd from "ant-design-vue";
import "ant-design-vue/dist/antd.css";
const router = createRouter({
    history: createWebHistory(),
    routes,
});

library.add(fas, fab, far);
// window.Vue = Vue
const baseURL = '/api/';

const app = createApp(App);
app.component("font-awesome-icon", FontAwesomeIcon);
app.use(VueAxios, axios);
app.axios.defaults.baseURL = process.env.API_URL;
app.axios.defaults.headers.common["Accept"] = "application/json";
app.axios.defaults.headers.common["Content-Type"] =
    "application/json;charset=UTF-8";
app.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
app.use(router);
app.use(VueSweetalert2);
app.use(Toast)
var auth = createAuth({
    plugins: {
        http: axios,
        router: router,
    },
    drivers: {
        http: driverHttpAxios,
        auth: driverAuthBearer,
        router: driverRouterVueRouter,
        tokenDefaultName: "access_token",
        tokenStore: ["localStorage"],

        rememberkey: "auth_remember",
        tokenDefaultKey: "auth_token_default",
        tokenImpersonateKey: "auth_token_impersonate",
        notFoundRedirect: {
            path: "/home",
        },
    },
    options: {
        rolesKey: "type",
        notFoundRedirect: { name: "/" },
        loginData: {
            url: baseURL + "login",
            method: "POST",
            redirect: "/",
            authType: "bearer",
            rememberMe: true,
            fetchUser: true,
            makeRequest: true,
        },
        logoutData: {
            url: baseURL + "logout",
            method: "POST",
            redirect: "/login",
            makeRequest: true,
        },
        fetchData: {
            url: baseURL + "users",
            method: "GET",
            enabled: true,
        },
        refreshData: {
            url: baseURL + "refresh",
            method: "GET",
            enabled: true,
            interval: 30,
        },
        parseUserData(data) {
            return data || {};
        },
    },
});
router.beforeEach((to, from, next) => {
    let token = localStorage.getItem("auth_token_default") || null;
    if (token) {
        getUser()
            .then((res) => {
                // Check page
                if (to.matched.some((record) => record.meta.notLogin)) {
                    router.replace("/");
                    next();
                } else if (to.matched.some((record) => record.meta.auth)) {
                    next();
                } else {
                    // Check permission
                    let role = res.data.data.role;
                    if (role == 1) {
                        next();
                    } else if (role == 2) {
                        if (
                            to.matched.some(
                                (record) => record.meta.just_superadmin
                            )
                        ) {
                            alert(
                                "Bạn không có quyền truy cập vào đường dẫn này"
                            );
                            router.replace("/");
                            next();
                        } else {
                            next();
                        }
                    } else if (role == 3) {
                        if (to.matched.some((record) => record.meta.employee)) {
                            next();
                        } else {
                            alert(
                                "Bạn không có quyền truy cập vào đường dẫn này"
                            );
                            router.replace("/");
                            next();
                        }
                    } else {
                        if (localStorage.getItem("auth_token_default")) {
                            localStorage.removeItem("auth_token_default");
                        }
                        router.replace("/login");
                    }
                }
            })
            .catch((err) => {
                if (localStorage.getItem("auth_token_default")) {
                    localStorage.removeItem("auth_token_default");
                }
                router.replace("/login");
                next();
            });
    } else {
        if (to.matched.some((record) => record.meta.auth)) {
            router.replace("/login");
        } else if (to.matched.some((record) => record.meta.notLogin)) {
            next();
        }
    }
});
app.use(router);
app.use(auth);
app.use(Antd);

app.mount("#app");
