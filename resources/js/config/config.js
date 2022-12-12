import axios from "axios";
<<<<<<< HEAD
const URL = 'http://datn_admin_order.vn/api/';
const token = window.localStorage.getItem('auth_token_default') || null;
=======
const URL = '/api/';
>>>>>>> main
const config = axios.create({
    baseURL: URL,
    headers: {
        'Content-Type': 'application/json',
        Authorization: `Bearer ${window.localStorage.getItem('auth_token_default')}`
    }
})


export default config;