<template>
    <div class="mainCreateNewOrderLayout">
        <div class="title">
            <div class="h1">
                <h1 @click="test">Tạo mới đơn hàng</h1>
            </div>
            <div class="loyalty" v-if="isLoyalty">
                <span
                    ><AkCircleCheckFill />Đã áp dụng ưu đãi phân hạng
                    Loyalty</span
                >
            </div>
        </div>
        <div class="content">
            <div class="userOrder">
                <userOrder />
            </div>

            <div class="productOrderDiv">
                <inforOrder
                    @show="showOrHidden"
                    @showModal="ClickShowModal"
                    @infor-product="inforProduct"
                    @fetch-data="click"
                />
                <modalCostOrder v-if="showModal" @showModal="ClickShowModal" />
            </div>
            <div class="voucherAndTax">
                <voucherAndTax @fetch-data="click" />
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
        </div>
        <div class="footer">
            <div class="costOrder">
                <costOrder
                    :quantityProduct="quantityProduct"
                    :priceProductValue="priceProductValue"
                />
            </div>
        </div>
    </div>
</template>

<script setup>
import userOrder from "./inforUserOrder/userOrder.vue";
import inforOrder from "./inforOrder/inforOrder.vue";
import voucherAndTax from "./voucher&tax/voucherAndTax.vue";
import noteOrder from "./note/noteOrder.vue";
import inforPayment from "./inforPayment/inforPayment.vue";
import shippingMethod from "./shippingMethod/shippingMethod.vue";
import anthoerInfor from "./anthoerInfor/anotherInfor.vue";
import costOrder from "./costOrder/costOrder.vue";
import modalCostOrder from "./inforOrder/modalCostOrder.vue";
import { AkCircleCheckFill } from "@kalimahapps/vue-icons";

import { ref, onMounted } from "vue";
import eventBus from "../../eventBus";
// import axios from "axios";
const isLoyalty = ref(false);
const isOpen = ref(true);
const showModal = ref(false);
const showOrHidden = () => {
    isOpen.value = !isOpen.value;
};
const ClickShowModal = () => {
    showModal.value = !showModal.value;
};
const test = () => {
    console.log(eventBus.voucher.isLoyalty);
};

const click = () => {
    // console.log("priceProduc: " + eventBus.product.priceProduct);
    // console.log("Voucher: " + eventBus.voucher.valueVoucher);
    // console.log("Ship: " + eventBus.voucher.valueShip);
    // console.log("VAT: " + eventBus.voucher.valueVAT);
    let giamgia = 0;
    giamgia =
        parseFloat(eventBus.voucher.valueVoucher) +
        parseFloat(eventBus.voucher.valueShip) +
        parseFloat(eventBus.voucher.valueVAT);
    // console.log("Tổng giảm: " + giamgia);
    priceProductValue.value = eventBus.product.priceProduct - giamgia;
    priceProductValue.value = priceProductValue.value.toString();
    priceProductValue.value = priceProductValue.value.replace(
        /\B(?=(\d{3})+(?!\d))/g,
        ","
    );
    // inforProduct();
    // console.log(priceProductValue.value);
    // priceProduct.value = priceProductValue.toString();
};
onMounted(() => click());
// if (priceProduct.value !== 0) {
//     priceProduct.value = priceProduct.value.replace(
//         /\B(?=(\d{3})+(?!\d))/g,
//         "."
//     );
// }
const fetchData = () => {
    isLoyalty.value = eventBus.voucher.isLoyalty;
};
onMounted(() => fetchData());
const priceProductValue = ref("0");

//InforOrder
let quantityProduct = 0;
const priceProduct = ref("0");
const inforProduct = (data1, data2) => {
    // console.log(data1, data2);
    quantityProduct = data1;
    if (data2) {
        priceProduct.value = data2;
    }
};
//InforOrder

//CostOrder

//CostOrder
</script>

<style scoped>
.mainCreateNewOrderLayout {
    display: flex;
    height: 100vh;
    flex-direction: column;
    background-color: #f0f2f5;
    /* gap: 20px; */
    .title {
        display: flex;
        max-height: 100px;
        flex-direction: column;
        background-color: #f0f2f5;
        box-shadow: rgba(0, 0, 0, 0.35) 0px 0px 8px;
        text-align: center;
        gap: 5px;
        .h1 {
            background-color: white;
            h1 {
                padding-top: 15px;
                font-size: 20px;
                font-weight: bold;
            }
        }
        .loyalty {
            display: flex;
            background-color: #f6ffed;
            flex: 1;
            padding: 9px 16px 9px 16px;

            span {
                display: flex;
                flex: 1;
                align-items: center;

                gap: 10px;
                svg {
                    color: #52c41a;
                }
            }
        }
    }
    .content {
        padding-block: 20px;
        display: flex;
        flex-direction: column;
        background-color: #f0f2f5;
        gap: 20px;
        overflow-y: scroll;
    }
    .footer {
        display: flex;
        widows: 100%;
        .costOrder{
            display: flex;
            flex:1;
        }
    }
}
</style>
