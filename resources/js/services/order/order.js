import config from '../../config/config.js';
const url = 'orders';
export const getAll = (params) => {
    return config.get(url+'?page='+params.page, params);
}
export const get = (params) => {
    return config.get("detail-order?id="+params.id);
}
export const insert = (data) => {
    return config.post(url, data);
}
export const update = (id, data) => {
    return config.put(`${url}/${id}`, data);
}
export const destroy = (id) => {
    return config.delete(`${url}/${id}`);
}