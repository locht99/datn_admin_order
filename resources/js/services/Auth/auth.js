import config from '../../config/config.js';
const url = '/login';

export const login = (data) => {
    return config.post(`${url}`,data);
}
