const axios = require('axios');
import jwt_decode from "jwt-decode";
import ApiService from "./ApiService";
import JwtTokenService from "./JwtTokenService";

export default class {

    static GUEST_AXIOS = null;
    static AUTH_AXIOS = null;

    /**
     * Get axios for guest
     * @returns Axio object
     */
    static getGuestAxios() {
        if (this.GUEST_AXIOS != null) return this.GUEST_AXIOS;

        this.GUEST_AXIOS = axios.create();
        // Add a response interceptor
        this.GUEST_AXIOS.interceptors.response.use(function (response) {
            // Any status code that lie within the range of 2xx cause this function to trigger
            // Do something with response data
            return response['data'];
        }, function (error) {
            // Any status codes that falls outside the range of 2xx cause this function to trigger
            // Do something with response error
            return error;
        });

        return this.GUEST_AXIOS;
    }

    /**
     * Get axios for authenticated user.
     * set middle ware to handle token work
     */
    static getAuthAxios() {
        if (this.AUTH_AXIOS != null) return this.AUTH_AXIOS;

        this.AUTH_AXIOS = axios.create();

        const CancelToken = axios.CancelToken;

        this.AUTH_AXIOS.interceptors.request.use(async function (config) {
            // Do something before request is sent

            var token = JwtTokenService.getToken();

            // if token is not exist, go to login form
            if(token == "") {
                console.log("Token is not exist. I go to login form ");

                return {
                    ...config,
                    cancelToken: new CancelToken((cancel) => cancel('Token is not exist'))
                }
            }

            // if token is expired then need to refresh it
            var decodedHeader = jwt_decode(token);
            if(Date.now()/1000 >= decodedHeader['exp']) {
                var response = await ApiService.TOKEN_REFRESH(token);

                if (response['code'] == 200) {

                    console.log('token is refreshed')
                    token = response['data']['access_token'];
                    JwtTokenService.setToken(token);

                } else {
                    console.log("Token is expired, I go to login form. Bye");
                    return {
                        ...config,
                        cancelToken: new CancelToken((cancel) => cancel('Token is not exist'))
                    }
                }
            }

            config.headers.common.Authorization = `Bearer ${token}`;

            return config;
        }, function (error) {
            // Do something with request error
            return Promise.reject(error);
        });

        // Add a response interceptor
        this.AUTH_AXIOS.interceptors.response.use(function (response) {
            // Any status code that lie within the range of 2xx cause this function to trigger
            // Do something with response data
            return response['data'];
        }, function (error) {
            // Any status codes that falls outside the range of 2xx cause this function to trigger
            // Do something with response error
            return error;
        });

        return this.AUTH_AXIOS;
    }
}
