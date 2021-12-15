import Vue from 'vue';
import Vuex from 'vuex'
import app_store from './module/app.store';
import invoice_store from './module/invoice.store';

Vue.use(Vuex);

const store = new Vuex.Store({
    modules: {
        "app_store": app_store,
        "invoice_store": invoice_store
    }
});

export default store;
