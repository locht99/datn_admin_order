import axios from "axios";
const URL = 'http://localhost:8000/api/';
const token = window.localStorage.getItem('token') || null;
const config = axios.create({
    baseURL: URL,
    headers: {
        'Content-Type': 'application/json',
        Authorization: `Bearer ${token}`
    }
})
export default config;