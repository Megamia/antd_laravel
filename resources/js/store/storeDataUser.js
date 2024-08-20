const storeDataUser = {
    namespaced: true,
    state: {
        dataUser: null,
        userExpiry: null,
    },
    mutations: {
        setDataUser(state, payload) {
            state.dataUser = payload.dataUser;
            state.userExpiry = payload.userExpiry;
        },
        clearDataUser(state) {
            state.dataUser = null;
            state.userExpiry = null;
        },
    },
    actions: {
        updateDataUser({ commit }, data) {
            commit("setDataUser", data);
        },
        clearDataUser({ commit }) {
            commit("clearDataUser");
        },
    },
    getters: {
        getDataUser: (state) => state.dataUser,
        getUserExpiry: (state) => state.userExpiry,
    },
};

export default storeDataUser;
