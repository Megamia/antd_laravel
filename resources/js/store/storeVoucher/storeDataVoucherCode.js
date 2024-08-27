const storeDataVoucherCode = {
    namespaced: true,
    state: {
        dataVoucherCode: null,
    },
    mutations: {
        setDataVoucherCode(state, payload) {
            state.dataVoucherCode = payload.dataVoucherCode;
        },
        clearDataVoucherCode(state) {
            state.dataVoucherCode = null;
        },
    },
    actions: {
        updateDataVoucherCode({ commit }, data) {
            commit("setDataVoucherCode", data);
        },
        clearDataVoucherCode({ commit }) {
            commit("clearDataVoucherCode");
        },
    },
    getters: {
        getDataVoucherCode: (state) => state.dataVoucherCode,
    },
};

export default storeDataVoucherCode;
