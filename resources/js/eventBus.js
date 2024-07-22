import { reactive } from "vue";

const eventBus = reactive({
    id: null,
    clear() {
        this.id = null;
    },
    product: {
        idProduct: null,
        clearProduct() {
            this.idProduct = null;
        },
        priceProduct: 0,
    },
    voucher: {
        valueVoucher: 0,
        isLoyalty: false,
        clearValueVoucher() {
            this.valueVoucher = 0;
        },
        valueShip: 0,
        clearValueShip() {
            this.valueShip = 0;
        },
        valueVAT: 0,
        clearValueVAT() {
            this.valueVAT = 0;
        },
        clearAllVoucher() {
            this.clearValueVoucher();
            this.clearValueShip();
            this.clearValueVAT();
        },
    },
    // newOrder() {
    //     this.clear();
    //     this.product.clearProduct();
    //     this.voucher.clearAllVoucher();
    // },
});

export default eventBus;
