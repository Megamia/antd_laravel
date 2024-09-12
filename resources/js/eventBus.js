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
        
        idProductTemporary: null,
        priceProduct: 0,
        numberSelected: 0,
        priceAfterSale: 0,
    },
    voucher: {
        idVoucherCode: null,
        idVoucherPromotion: null,
        clearIdVoucher() {
            this.idVoucherCode = null;
            this.idVoucherPromotion = null;
        },

        valueVoucher: 0,
        isLoyalty: false,
        clearValueVoucher() {
            this.valueVoucher = 0;
        },

        valueShip: 0,
        clearValueShip() {
            this.valueShip = 0;
        },

        valuePercentVAT: 0,
        clearValueVAT() {
            this.valuePercentVAT = 0;
        },

        clearAllVoucher() {
            this.clearValueVoucher();
            this.clearValueShip();
            this.clearValueVAT();
            this.clearIdVoucher();
        },
    },
    // newOrder() {
    //     this.clear();
    //     this.product.clearProduct();
    //     this.voucher.clearAllVoucher();
    // },
});

export default eventBus;
