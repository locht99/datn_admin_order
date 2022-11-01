import config from '../../config/config.js';
const url = '/type-transactions';

export const getAll = () => {
    return config.get(`${url}`);
}