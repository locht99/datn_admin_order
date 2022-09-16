import axios from "axios";
const URL ='';
const config = axios.create({
    baseURL: URL,
    headers: {
        Authorization: 'Bearer {token}'
    }
})
export default config;