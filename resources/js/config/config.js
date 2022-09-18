import axios from "axios";
const URL ='';
const config = axios.create({
    baseURL: URL,
    headers: {
        'Content-Type': 'application/json',
        Authorization: 'Bearer {token}'
    }
})
export default config;