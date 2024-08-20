const storeDataVoucher = {
    namespaced: true,
    state: {
        dataVoucher: null,
    },
    mutations: {
        setDataVoucher(state, payload) {
            state.dataVoucher = payload.dataVoucher;
        },
        clearDataVoucher(state) {
            state.dataVoucher = null;
        },
    },
    actions: {
        updateDataVoucher({ commit }, data) {
            commit("setDataVoucher", data);
        },
        clearDataVoucher({ commit }) {
            commit("clearDataVoucher");
        },
    },
    getters: {
        getDataVoucher: (state) => state.dataVoucher,
    },
};

export default storeDataVoucher;
