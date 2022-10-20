import config from "../../config/config";
const url = '/vietnamese-transaction';

export const getAll = (params) => {
    return config.get(`${url}`,params);
}
export const get = (id) => {
    return config.get(`${url}/${id}`);
}
export const insert = (data) => {
    return config.post(`${url}/create`, data);

}
export const update = (id, data) => {
    return config.put(`${url}/${id}`, data);

}
export const destroy = (id) => {
    return config.delete(`${url}/${id}`);
}