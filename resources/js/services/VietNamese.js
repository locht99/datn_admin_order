import config from '../config/config.js';
const url = '/tienviet';

export const getAll = () => {
    return config.get(`${url}`);
}
export const get = (id) => {
    return config.get(`${url}/${id}`);
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