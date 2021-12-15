import JwtTokenService from "./JwtTokenService";
import jwt_decode from "jwt-decode";

export default class AuthService {
    static IS_LOGGED_IN() {
        var token = JwtTokenService.getToken();

        if(token == "") return false;

        return true;
    }
}
