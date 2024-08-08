<template>
    <div class="mainVoucherAndTax">
        <RouterLink to="/detailVoucher" class="voucher">
            <span class="name">Giảm giá</span>
            <span class="cost">
                {{ valueVoucher ? valueVoucher + "đ" : "0đ" }}
                <AkChevronRight
            /></span>
        </RouterLink>
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
            <span class="name" @click="test">Thuế VAT (10%)</span>
            <span class="cost"> {{ VATvalue }}đ <AkChevronRight /></span>
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
import { ref, defineEmits, onMounted, defineExpose } from "vue";
import eventBus from "../../../eventBus";

const emit = defineEmits(["closeModalShip", "fetchData", "fetchDataVAT"]);

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
    valueShip.value = valueShip.value.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    emit("fetchData");
};
//ModalShip

//ModalVAT
const isModalVAT = ref(false);
const closeModalVAT = () => {
    isModalVAT.value = !isModalVAT.value;
};
const VATvalue = ref("0");
const valueInModalVAT = () => {
    // console.log("eventBus.voucher.valueVAT: ", eventBus.voucher.valueVAT);
    // console.log(
    //     "eventBus.product.priceProduct: ",
    //     eventBus.product.priceProduct
    // );
    VATvalue.value = parseFloat(
        (eventBus.product.priceProduct *
            parseFloat(eventBus.voucher.valueVAT)) /
            100
    );

    VATvalue.value = VATvalue.value.toString();
    VATvalue.value = VATvalue.value.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    // console.log("VATvalue: ", VATvalue.value);
    emit("fetchDataVAT", VATvalue.value);
};

const test = () => {};
//ModalVAT

const fetchDataModal = () => {
    emit("fetchData");
};

const fetchData = async () => {
    if (eventBus.voucher.valueShip) {
        valueShip.value = eventBus.voucher.valueShip;
        valueShip.value = valueShip.value.toString();
        valueShip.value = valueShip.value.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
};
onMounted(() => fetchData());

defineExpose({
    fetchData,
    valueInModalVAT,
});
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
