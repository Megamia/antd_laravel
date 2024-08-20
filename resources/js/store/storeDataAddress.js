const storeDataAddress = {
    namespaced: true,
    state: {
        dataAddress: null,
    },
    mutations: {
        setDataAddress(state, payload) {
            state.dataAddress = payload.dataAddress;
        },
        clearDataAddress(state) {
            state.dataAddress = null;
        },
    },
    actions: {
        updateDataAddress({ commit }, data) {
            commit("setDataAddress", data);
        },
        clearDataAddress({ commit }) {
            commit("clearDataAddress");
        },
    },
    getters: {
        getDataAddress: (state) => state.dataAddress,
    },
};

export default storeDataAddress;
