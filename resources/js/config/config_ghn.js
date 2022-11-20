import axios from "axios";

const config_ghn = axios.create({
    baseURL: "https://dev-online-gateway.ghn.vn/shiip/public-api/v2/shipping-order/",
    headers: {
        'Content-Type': 'application/json',
        'ShopId': 120427,
        token: `989b92f1-59ed-11ed-9ad7-269dd9db11fd`
    }
})

export default config_ghn;