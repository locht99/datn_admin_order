import config from '../../config/config.js';
import config_ghn from '../../config/config_ghn.js'
export const getOrder = (id) => {
    return config.get(`get-order?id=` + id);
}
export const updatePriceOrder = (params) => {
    return config.post(`update-price-order`,params);
}
export const getInfoUser = (id) => {
    return config.get(`get-info?address_id=` + id);
}
export const getDetailBag = (id) => {
    return config.get(`detail-bag?packets_id=` + id);
}
export const getDetailOrderGhn = (id) => {
    return config_ghn.get(`detail?order_code=` + id);
}
export const getDetailOrderServiceGhn = (id) => {
    return config_ghn.get(`soc?order_code=` + id);
}
export const checkStatusTrackingBag = (id) => {
    return config.get(`status-bag?bag_id=` + id);
}
