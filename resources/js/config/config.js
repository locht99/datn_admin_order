import axios from "axios";

const URL = '/api/';
const config = axios.create({
    baseURL: URL,
    headers: {
        'Content-Type': 'application/json',
        Authorization: `Bearer ${window.localStorage.getItem('auth_token_default')}`
    }
})


export default config;