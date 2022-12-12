import config from '../../config/config.js';

const url = 'get-manager';
const update_url = 'update-manager'
const add_url = 'add-manager'

export const getAll = (params) => {
    return config.get(url,{params});
}
export const get = (params) => {
    return config.get(update_url, {params});
}
export const update = (params) => {
    return config.post(update_url, params);
}
export const insert = (data) => {
    return config.post(add_url, data);
}
export const destroy = (id) => {
    return config.delete(`${url}/${id}`);
}