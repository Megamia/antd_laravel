<template>
    <div class="mainCreateNewOrderLayout">
        <div class="title">
            <h1>Tạo mới đơn hàng</h1>
        </div>
        <div class="userOrder" v-if="selected">
            <userOrder />
        </div>
        <div class="inforUserOrderDiv" v-else>
            <detailInforUserOrder @fetchData1="fetchData1" />
        </div>
        <div class="productOrderDiv">
            <inforOrder @show="showOrHidden" @showModal="ClickShowModal" />
            <modalCostOrder v-if="showModal" @showModal="ClickShowModal" />
        </div>
        <div class="voucherAndTax">
            <voucherAndTax />
        </div>
        <div class="noteOrder">
            <noteOrder />
        </div>
        <div class="inforPayment">
            <inforPayment />
        </div>
        <div class="shippingMethod">
            <shippingMethod />
        </div>
        <div class="anthoerInfor">
            <anthoerInfor v-if="isOpen" />
        </div>
        <div class="costOrder">
            <costOrder />
            <div style="height: 1000px; width: 100%" />
        </div>
    </div>
</template>

<script setup>
import detailInforUserOrder from "./inforUserOrder/detailInforUserOrder.vue";
import userOrder from "./inforUserOrder/userOrder.vue";
import inforOrder from "./inforOrder/inforOrder.vue";
import voucherAndTax from "./voucher&tax/voucherAndTax.vue";
import noteOrder from "./note/noteOrder.vue";
import inforPayment from "./inforPayment/inforPayment.vue";
import shippingMethod from "./shippingMethod/shippingMethod.vue";
import anthoerInfor from "./anthoerInfor/anotherInfor.vue";
import costOrder from "./costOrder/costOrder.vue";
import modalCostOrder from "./inforOrder/modalCostOrder.vue";

import { ref, onMounted } from "vue";
import axios from "axios";
const isOpen = ref(true);
const showModal = ref(false);
const selected = ref(true);

const showOrHidden = () => {
    isOpen.value = !isOpen.value;
};
const ClickShowModal = () => {
    showModal.value = !showModal.value;
};

const fetchData1 = async () => {
    try {
        const response = await axios.get(
            `${import.meta.env.VITE_APP_URL_APP}/dataUserOrder`
        );
        if (response.data.status === 1) {
            selected.value = false;
        } else {
            alert("Vui lòng chọn lại");
            selected.value = true;
        }
    } catch (e) {
        console.log("Error: ", e);
    }
};
</script>

<style scoped>
.mainCreateNewOrderLayout {
    display: flex;
    flex: 1;
    flex-direction: column;
    background-color: #f0f2f5;
    gap: 20px;

    .title {
        background-color: white;
        box-shadow: rgba(0, 0, 0, 0.35) 0px 0px 8px;
        text-align: center;

        h1 {
            padding-top: 15px;
            font-size: 20px;
            font-weight: bold;
        }
    }
}
</style>
