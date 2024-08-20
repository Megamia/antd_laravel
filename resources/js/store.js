import { createStore } from "vuex";

const storeDataUser = createStore({
    state: {
        dataUserOrder: null,
        userExpiry: null,
        dataAddress: null,
    },
    mutations: {
        //DataUser
        setDataUserOrder(state, payload) {
            state.dataUserOrder = payload.dataUserOrder;
            state.userExpiry = payload.userExpiry;
        },
        clearDataUserOrder(state) {
            state.dataUserOrder = null;
            state.userExpiry = null;
        },
        //DataUser

        //DataAddress
        setDataAddress(state, payload) {
            state.dataAddress = payload.dataAddress;
        },
        clearDataAddress(state) {
            state.dataAddress = null;
        },
        //DataAddress
    },
    actions: {
        updateDataUserOrder({ commit }, data) {
            commit("setDataUserOrder", data);
        },
        clearDataUserOrder({ commit }) {
            commit("clearDataUserOrder");
        },
    },
    getters: {
        getDataUserOrder: (state) => state.dataUserOrder,
        getUserExpiry: (state) => state.userExpiry,
        getDataAddress: (state) => state.dataAddress,
    },
});

export default storeDataUser;
