export default class {
    /**
     * Save token to local storage
     * @param token
     */
    static setToken(token) {
        window.localStorage.setItem('token', token);
    }

    static getToken() {
        return window.localStorage.getItem('token') || "";
    }

}
