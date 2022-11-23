import config_ghn from '../../config/config_ghn.js';
import config from '../../config/config.js';
export const createShipingGhn = (params) => {
    return config_ghn.post(`create`, params)
}

export const createShiping = (params) => {
    return config.post(`/create-order-ghn`, params)
}
export const createLogTracking = (params) => {
    return config.post(`/create-log-tracking-vn`, params)
}