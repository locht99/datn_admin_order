import config from "../../config/config";

export const getAllMoney = (params) => {
    return config.get(`get-money`, params);
}