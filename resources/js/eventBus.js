// eventBus.js
import { reactive } from "vue";

const eventBus = reactive({
    id: null,
    clear() {
        this.id = null;
    },
});

export default eventBus;
