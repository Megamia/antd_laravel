// eventBus.js
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
        clearValueVoucher() {
            this.valueVoucher = 0;
        },
        valueShip:0,
        clearValueShip() {
            this.valueShip = 0;
        },
        valueVAT:0,
        clearValueVAT() {
            this.valueVAT = 0;
        },
    },
});

export default eventBus;
