import storeDataVoucherCode from "./storeVoucher/storeDataVoucherCode";

const storeDataVoucher = {
    namespaced: true,
    modules: {
        code: storeDataVoucherCode,
    },
};

export default storeDataVoucher;
