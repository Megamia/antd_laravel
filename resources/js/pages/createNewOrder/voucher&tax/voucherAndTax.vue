<template>
    <div class="mainVoucherAndTax">
        <!-- <div class="voucher" @click="nothing"> -->
        <RouterLink to="/detailVoucher" class="voucher">
            <span class="name">Giảm giá</span>
            <span class="cost">
                {{
                    eventBus.voucher.valueVoucher
                        ? eventBus.voucher.valueVoucher + "đ"
                        : "0đ"
                }}
                <AkChevronRight
            /></span>
        </RouterLink>
        <!-- </div> -->
        <div class="ship" @click="closeModalShip">
            <span class="name">Phí ship</span>
            <span class="cost"> {{ valueShip }}đ <AkChevronRight /></span>
        </div>
        <modalShip
            v-if="isModalShip"
            @close-modal-ship="closeModalShip"
            @value-in-modal-ship="valueInModalShip"
        />
        <div class="VAT" @click="closeModalVAT">
            <span class="name">Thuế VAT (10%)</span>
            <span class="cost"> {{ valueVATFinal }}đ <AkChevronRight /></span>
        </div>
        <modalVAT
            v-if="isModalVAT"
            @close-modal-VAT="closeModalVAT"
            @value-in-modal-VAT="valueInModalVAT"
        />
    </div>
</template>
<script setup>
import { AkChevronRight } from "@kalimahapps/vue-icons";
import modalShip from "./details/modalShip.vue";
import modalVAT from "./details/modalVAT.vue";
import { ref, defineEmits, onMounted } from "vue";
import eventBus from "../../../eventBus";

const emit = defineEmits(["closeModalShip"]);
onMounted(() => {
    console.log(eventBus.voucher.valueVoucher);
});
//ModalShip
const isModalShip = ref(false);
const valueShip = ref("0");

const closeModalShip = () => {
    isModalShip.value = !isModalShip.value;
};
const valueInModalShip = (data1) => {
    isModalShip.value = !isModalShip.value;
    valueShip.value = data1.toLocaleString("de-DE", {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2,
    });
    valueShip.value = valueShip.value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    console.log(valueShip.value);
};
//ModalShip

//ModalVAT
const isModalVAT = ref(false);
let valueVAT = 0;
const valueVATFinal = ref("0");
const closeModalVAT = () => {
    isModalVAT.value = !isModalVAT.value;
};
const valueInModalVAT = (data1) => {
    isModalVAT.value = !isModalVAT.value;
    // console.log(
    //     eventBus.product.priceProduct,
    //     typeof eventBus.product.priceProduct,
    //     data1,
    //     typeof data1
    // );
    valueVAT = (eventBus.product.priceProduct * data1) / 100;

    valueVATFinal.value = valueVAT.toLocaleString("de-DE", {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2,
    });
    valueVATFinal.value = valueVATFinal.value.replace(
        /\B(?=(\d{3})+(?!\d))/g,
        "."
    );
    // console.log(valueVATFinal.value);
};
//ModalVAT

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
