import config from '../../config/config.js';

export const get = () => {
    return config.get("/get-noti");
}
export const edit = (data) => {
    return config.post('edit-noti', data);
}