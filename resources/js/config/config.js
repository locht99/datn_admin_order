import axios from "axios";

const URL = 'http://localhost:8000/api/';
const config = axios.create({
    baseURL: URL,
    headers: {
        'Content-Type': 'application/json',
        Authorization: `Bearer ${window.localStorage.getItem('auth_token_default')}`
    }
})


export default config;