// import { createAuth } from '@websanova/vue-auth';
// import driverAuthBearer from '@websanova/vue-auth/dist/drivers/auth/bearer.esm.js';
// import driverHttpAxios from '@websanova/vue-auth/dist/drivers/http/axios.1.x.esm.js';
// import driverRouterVueRouter from '@websanova/vue-auth/dist/drivers/router/vue-router.2.x.esm.js';
// const baseURL = "http://localhost:8000"
// const auth = createAuth({
//     auth: driverAuthBearer,
//     http: driverHttpAxios,
//     router: driverRouterVueRouter,
    // tokenDefaultName: 'auth-token',
    // tokenStore: ['localStorage'],
//     notFoundRedirect: {
//         path: '/home'
//     },
//     registerData: {
        // url: baseURL + '/api/auth/register',
        // method: 'POST',
        // redirect: null,
//     },
    // loginData: {
    //     url: baseURL + '/api/auth/login',
    //     method: 'POST',
    //     redirect: '/home',
    //     fetchUser: true,
    // },
    // logoutData: {
    //     url: baseURL + '/api/auth/logout',
    //     method: 'POST',
    //     redirect: '/login',
    //     makeRequest: true
    // },
    // fetchData: {
    //     url: baseURL + '/api/auth/user',
    //     method: 'GET',
    //     enabled: true
    // },
    // parseUserData(data) {
    //     return data || {}
    // },

// });

// export default auth;