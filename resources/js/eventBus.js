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
});

export default eventBus;
