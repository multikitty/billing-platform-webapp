import AxiosInstance from "./AxiosInstance";
import JwtTokenService from "./JwtTokenService";
import BaseRequest from "../model/request/base.request";

export const BASE_ROUTE = '/api'

export const routes = {

};

export default class ApiService {

    static LOGIN = (request) => {
        return AxiosInstance.getGuestAxios().post(BASE_ROUTE + "/auth/login", request);
    }

    static TOKEN_REFRESH = (token) => {
        return AxiosInstance.getGuestAxios().post(BASE_ROUTE + "/auth/refresh", {}, {headers:{Authorization:`Bearer ${token}`}});
    }

    static SETTING_GET_INDEX = () => {
        return AxiosInstance.getAuthAxios().get(BASE_ROUTE + "/setting");
    }

    static SETTING_SAVE = (request) => {
        return AxiosInstance.getAuthAxios().post(BASE_ROUTE + "/setting", request);
    }

    static SETTING_UPDATE_LOGO = (request) => {
        return AxiosInstance.getAuthAxios().post(BASE_ROUTE + "/setting/logo/update", request);
    }

    static SETTING_CREATE_ADDTIONAL = (request) => {
        return AxiosInstance.getAuthAxios().post(BASE_ROUTE + "/setting/create/additional_setting", request);
    }

    static SETTING_DELETE_ADDITIONAL = (id) => {
        return AxiosInstance.getAuthAxios().delete(BASE_ROUTE + "/setting/delete/additional_setting/" + id)
    }

    static MEMBER_GET_INDEX = () => {
        return AxiosInstance.getAuthAxios().get(BASE_ROUTE + "/member");
    }

    static MEMBER_ADD = (request) => {
        return AxiosInstance.getAuthAxios().post(BASE_ROUTE + "/member", request);
    }

    static MEMBER_UPDATE = (id, request) => {
        return AxiosInstance.getAuthAxios().post(BASE_ROUTE + "/member/" + id, request);
    }
}
