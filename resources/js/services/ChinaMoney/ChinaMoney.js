import config from "../../config/config";
const url = 'china-transaction';
export const getAll = () => {
    return config.get(url);
}
export const get = (id) => {
    return config.get(`${url}/${id}`);
}
export const insert = (data) => {
    return config.post(`${url}/create`,data);
}
export const update = (id, data) => {
   return config.put(`${url}/${id}`,data);
}
export const destroy = (id) => {
  return config.delete(`${url}/${id}`);
}
export const getTypeMoneyChina = () =>{
 return config.get('china-type-transaction');
}