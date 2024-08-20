import { createStore } from "vuex";
import storeDataUser from "./store/storeDataUser";
import storeDataAddress from "./store/storeDataAddress";
import storeDataProduct from "./store/storeDataProduct";
import storeDataVoucher from "./store/storeDataVoucher";

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
            // store.commit('user/clearDataUser');
        },
    },
});

export default store;
