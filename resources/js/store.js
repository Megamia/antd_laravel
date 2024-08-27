import { createStore } from "vuex";
import storeDataUser from "./store/storeDataUser";
import storeDataAddress from "./store/storeDataAddress";
import storeDataProduct from "./store/storeDataProduct";
import storeDataVoucher from "./store/storeDataVoucher";
import createPersistedState from "vuex-persistedstate";
const store = createStore({
    modules: {
        user: storeDataUser,
        address: storeDataAddress,
        product: storeDataProduct,
        voucher: storeDataVoucher,
    },
    mutations: {
        clearAllData(state) {
            store.commit("user/clearDataUser");
            store.commit("address/clearDataAddress");
            store.commit("product/clearDataProduct");
            store.commit("voucher/code/clearDataVoucherCode");
        },
    },
    plugins: [
        createPersistedState({
            storage: window.sessionStorage,
        }),
    ],
});

export default store;
