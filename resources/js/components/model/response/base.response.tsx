export default class BaseResponse<T> {
    data:T|null = null;
    status = 200; // set ok as default -.-
    statusText = "OK";
}
