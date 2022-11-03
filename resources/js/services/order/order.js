import config from '../../config/config.js';
const url = 'orders';
const  detail_order_url = 'detail-order'
export const getAll = (params) => {
    return config.get(url,{params});
}
export const get = (params) => {
    return config.get(detail_order_url, {params});
}
export const insert = (data) => {
    return config.post(url, data);
}
export const update = (id, data) => {
    return config.put('edit-status-order?id='+id+'&status_id='+data);
}
export const destroy = (id) => {
    return config.delete(`${url}/${id}`);
}