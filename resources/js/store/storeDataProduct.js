const storeDataProduct = {
    namespaced: true,
    state: {
        totalPrice: null,
        idDetailProduct: [],
        dataProduct: null,
        numberSelected: [],
    },
    mutations: {
        setDataProduct(state, payload) {
            state.totalPrice = payload.totalPrice;
            state.idDetailProduct = payload.idDetailProduct;
            state.dataProduct = payload.dataProduct;
            state.numberSelected = payload.numberSelected;
        },
        clearDataProduct(state) {
            state.totalPrice = null;
            state.idDetailProduct = null;
            state.dataProduct = null;
            state.numberSelected = null;
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
        getTotalPrice: (state) => state.totalPrice,
        getIdDetailProduct: (state) => state.idDetailProduct,
        getDataProduct: (state) => state.dataProduct,
        getDataNumberSelected: (state) => state.numberSelected,
    },
};

export default storeDataProduct;
