import config from "../../config/config";
const url = '/admin-packets';

export const getAll = (params) => {
    return config.get(`packets`,params);
}
export const insert = (data) => {
    return config.post(`${url}`,data);
}
export const show = (id) => {
    return config.get(`${url}/${id}`);
}
export const update = (id,data) => {
    return config.put(`${url}/${id}`,data);
}
export const destroy = (id) => {
    return config.delete(`${url}/${id}`);
}
export const transportStatus = () => {
    return config.get(`transport-status`);
}
export const search = (code) => {
    return config.get(`search-order?code=`+code);
}