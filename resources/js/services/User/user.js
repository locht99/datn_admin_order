import config from '../../config/config.js';
const url = 'get-users';
const update_url = 'update-user'
export const getAll = (params) => {
    return config.get(url,{params});
}
export const get = (params) => {
    return config.get(update_url, {params});
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