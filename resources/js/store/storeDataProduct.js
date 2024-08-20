const storeDataUser = {
    namespaced: true,
    state: {
        dataUserOrder: null,
        userExpiry: null,
    },
    mutations: {
        setDataUserOrder(state, payload) {
            state.dataUserOrder = payload.dataUserOrder;
            state.userExpiry = payload.userExpiry;
        },
        clearDataUserOrder(state) {
            state.dataUserOrder = null;
            state.userExpiry = null;
        },
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
    },
};

export default storeDataUser;
