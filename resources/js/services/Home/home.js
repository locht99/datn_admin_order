import config from '../../config/config.js';

export const getAllTransactions = (params) => {
    return config.get(`transactions`, params);
}
export const getAllOrders = (params) => {
    return config.get(`total-orders`, params);
}