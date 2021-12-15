const app_store = {
    state:() => ({
        busy: false,
        snackbar: {
            show: false,
            msg: ""
        }
    }),
    mutations: {
        set_busy (state, payload) {
            state.busy = payload.data;
        },
        showSnackbar(state, msg) {
            state.snackbar = {
                show:true,
                msg: msg
            }
        },
        hideSnackbar(state) {
            state.snackbar = {
                show: false,
                msg: ""
            }
        }
    },
    getters: {
        is_busy(state) {
            return state.busy;
        },
        snackbar(state) {
            return state.snackbar
        }
    }
}

export default app_store;
