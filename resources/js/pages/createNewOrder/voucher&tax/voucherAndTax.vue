<template>
    <div class="mainVoucherAndTax">
        <!-- <div class="voucher" @click="nothing"> -->
        <RouterLink to="/detailVoucher" class="voucher">
            <span class="name">Giảm giá</span>
            <span class="cost">
                {{ valueVoucher ? valueVoucher + "đ" : "0đ" }}
                <AkChevronRight
            /></span>
        </RouterLink>
        <!-- </div> -->
        <div class="ship" @click="closeModalShip">
            <span class="name">Phí ship</span>
            <span class="cost">
                {{ valueShip ? valueShip : "0" }}đ <AkChevronRight
            /></span>
        </div>
        <ModalShip
            v-if="isModalShip"
            @close-modal-ship="closeModalShip"
            @value-in-modal-ship="valueInModalShip"
            @fetch-data-modal="fetchDataModal"
        />
        <div class="VAT" @click="closeModalVAT">
            <span class="name">Thuế VAT (10%)</span>
            <span class="cost">
                {{ valueVAT ? valueVAT : "0" }}đ <AkChevronRight
            /></span>
        </div>
        <ModalVAT
            v-if="isModalVAT"
            @close-modal-VAT="closeModalVAT"
            @value-in-modal-VAT="valueInModalVAT"
        />
    </div>
</template>
<script setup>
import { AkChevronRight } from "@kalimahapps/vue-icons";
import ModalShip from "./Details/ModalShip.vue";
import ModalVAT from "./Details/ModalVAT.vue";
import { ref, defineEmits, onMounted } from "vue";
import eventBus from "../../../eventBus";

const emit = defineEmits(["closeModalShip", "fetchData"]);

const valueVoucher = ref("0");
valueVoucher.value = eventBus.voucher.valueVoucher.toString();
valueVoucher.value = valueVoucher.value.replace(/\./g, "");
valueVoucher.value = valueVoucher.value.replace(/\B(?=(\d{3})+(?!\d))/g, ",");

//ModalShip
const isModalShip = ref(false);
const valueShip = ref("0");

const closeModalShip = () => {
    isModalShip.value = !isModalShip.value;
};
const valueInModalShip = (data1) => {
    isModalShip.value = !isModalShip.value;
    valueShip.value = data1;
    valueShip.value = valueShip.value.replace(/\./g, "");
    valueShip.value = parseFloat(valueShip.value);
    eventBus.voucher.valueShip = valueShip.value;
    valueShip.value = valueShip.value.toString();
    // console.log(eventBus.voucher.valueShip);
    valueShip.value = valueShip.value.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    // fetchData();
    emit("fetchData");
};
//ModalShip

//ModalVAT
const isModalVAT = ref(false);
const valueVAT = ref("0");
const valueVATFinal = ref("0");
const closeModalVAT = () => {
    isModalVAT.value = !isModalVAT.value;
};
const valueInModalVAT = (data1) => {
    isModalVAT.value = !isModalVAT.value;
    if (!eventBus.voucher.valueVAT) {
        eventBus.voucher.valueVAT = parseFloat(data1);
        // console.log(
        //     "eventBus.voucher.valueVAT: " + eventBus.voucher.valueVAT,
        //     typeof eventBus.voucher.valueVAT
        // );
    }
    valueVAT.value = parseFloat(data1);
    valueVAT.value = valueVAT.value.toString();
    valueVAT.value = valueVAT.value.replace(/\B(?=(\d{3})+(?!\d))/g, ",");

    // if (eventBus.product.priceProduct !== 0) {
    //     valueVAT.value = data1.toString();
    // }
    // valueVATFinal.value = valueVAT.value.replace(/\./g, "");

    // valueVATFinal.value = valueVATFinal.value.replace(
    //     /\B(?=(\d{3})+(?!\d))/g,
    //     "."
    // );
    // eventBus.voucher.valueVAT =
    //     (eventBus.product.priceProduct * data1.value) / 100;
    // fetchData();
    emit("fetchData");
};
//ModalVAT

const fetchDataModal = () => {
    emit("fetchData");
};

const fetchData = () => {
    if (eventBus.voucher.valueShip) {
        valueShip.value = eventBus.voucher.valueShip;
        valueShip.value = valueShip.value.toString();
        valueShip.value = valueShip.value.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
    if (eventBus.voucher.valueVAT) {
        // console.log("eventBus.voucher.valueVAT: " + eventBus.voucher.valueVAT);
        valueVAT.value = eventBus.voucher.valueVAT.toString();
        valueVAT.value = valueVAT.value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        // console.log(valueVAT.value);
    }
};
onMounted(() => fetchData());
const nothing = () => {
    alert("Chưa xử lý sự kiện này");
};
</script>

<style scoped>
.mainVoucherAndTax {
    background-color: white;
    display: flex;
    flex: 1;
    flex-direction: column;

    .voucher,
    .ship,
    .VAT {
        padding: 10px;
        display: flex;
        flex: 1;
        flex-direction: row;
        text-align: center;
        border-bottom: 1px solid #0000000f;
        color: black;
        text-decoration: none;
        span {
            display: flex;
            align-items: center;
            svg {
                align-items: center;
            }
        }
        .name {
            display: flex;
            font-size: 14px;
        }
        .cost {
            display: flex;
            flex: 1;
            justify-content: end;
            gap: 8px;
            font-size: 14px;
        }
    }
}
</style>
