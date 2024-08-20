const storeDataProduct = {
    namespaced: true,
    state: {
        price: null,
        idDetailProduct: null,
    },
    mutations: {
        setDataProduct(state, payload) {
            state.price = payload.price;
            state.idDetailProduct = payload.idDetailProduct;
        },
        clearDataProduct(state) {
            state.price = null;
            state.idDetailProduct = null;
        },
    },
    actions: {
        updateDataProduct({ commit }, data) {
            commit("setDataProduct", data);
        },
        clearDataProduct({ commit }) {
            commit("clearDataProduct");
        },
    },
    getters: {
        getPrice: (state) => state.price,
        getIdDetailProduct: (state) => state.idDetailProduct,
    },
};

export default storeDataProduct;
