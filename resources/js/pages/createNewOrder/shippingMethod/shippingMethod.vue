<template>
    <div class="mainShippingMethod" @click="closeModalShipping">
        <div class="title">
            <span class="titleTextUp">Phương thức vận chuyển</span>
            <span class="titleTextDown">Nhận hàng trực tiếp</span>
        </div>
        <div class="icon">
            <span>
                <AkChevronRight />
            </span>
        </div>
    </div>
    <modalShippingMethod
        v-if="isModalShipping"
        @close-modal-shipping="closeModalShipping"
        @value-in-modal-shipping="valueInModalShipping"
    />
</template>

<script setup>
import { AkChevronRight } from "@kalimahapps/vue-icons";
import modalShippingMethod from "./detail/modalShippingMethod.vue";
import { ref } from "vue";

//ModalShipping
const isModalShipping = ref(false);
const valueShipping = ref("0");

const closeModalShipping = () => {
    isModalShipping.value = !isModalShipping.value;
};
const valueInModalShipping = (data1) => {
    isModalShipping.value = !isModalShipping.value;
    valueShipping.value = data1.toLocaleString("de-DE", {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2,
    });
    valueShipping.value = valueShipping.value.replace(
        /\B(?=(\d{3})+(?!\d))/g,
        "."
    );
    console.log(valueShipping.value);
};
//ModalShipping

const nothing = () => {
    alert("Chưa xử lý sự kiện này");
};
</script>

<style scoped>
.mainShippingMethod {
    background-color: white;
    display: flex;
    flex: 1;
    flex-direction: row;
    padding: 10px;

    .title {
        display: flex;
        flex: 1;
        flex-direction: column;
        gap: 10px;

        .titleTextUp {
            font-size: 16px;
            font-weight: 500;
        }

        .titleTextDown {
            font-size: 14px;
            color: #00000073;
            font-weight: 400;
        }
    }

    .icon {
        display: flex;
        flex: 1;
        justify-content: end;
        align-items: center;
        color: #878a99;
    }
}
</style>
