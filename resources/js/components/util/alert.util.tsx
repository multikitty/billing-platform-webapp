import store from '../store/index'

export default class AlertUtil {

    static SHOW_SUCCESS_ALERT(msg) {
        store.commit('showSnackbar', msg)
    }

    static SHOW_ERROR_ALERT(msg) {
        store.commit('showSnackbar', msg)
    }
}
