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
                <UserOrder @data-infor-user="dataInforUser" />
            </div>

            <div class="productOrderDiv">
                <InforOrder
                    @show="showOrHidden"
                    @showModal="ClickShowModal"
                    @infor-product="inforProduct"
                    @fetch-data="click"
                    @product-selected="productSelected"
                />
                <ModalCostOrder v-if="showModal" @showModal="ClickShowModal" />
            </div>
            <div class="voucherAndTax">
                <VoucherAndTax @fetch-data="click" />
            </div>
            <div class="noteOrder">
                <NoteOrder />
            </div>
            <div class="inforPayment">
                <InforPayment />
            </div>
            <div class="shippingMethod">
                <ShippingMethod />
            </div>
            <div class="anthoerInfor">
                <AnotherInfor v-if="isOpen" />
            </div>
        </div>
        <div class="footer">
            <!-- <div class="costOrder">
                <CostOrder
                    :quantityProduct="quantityProduct"
                    :priceProductValue="priceProductValue"
                    @console="Console"
                />
            </div> -->
            <div class="mainCostOrder">
                <div class="costDiv">
                    <div class="titleCostOrder">
                        <span class="left">Tổng cộng </span>
                        <span class="right"
                            >({{ quantityProduct }} sản phẩm)</span
                        >
                    </div>
                    <div class="cost">
                        <span
                            >{{
                                priceProductValue ? priceProductValue : "0"
                            }}đ</span
                        >
                    </div>
                </div>
                <div class="order">
                    <button @click="createOrder">Tạo đơn hàng</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import UserOrder from "./InforUserOrder/UserOrder.vue";
import InforOrder from "./InforOrder/InforOrder.vue";
import VoucherAndTax from "./Voucher&tax/VoucherAndTax.vue";
import NoteOrder from "./Note/NoteOrder.vue";
import InforPayment from "./InforPayment/InforPayment.vue";
import ShippingMethod from "./ShippingMethod/ShippingMethod.vue";
import AnotherInfor from "./AnotherInfor/AnotherInfor.vue";
import ModalCostOrder from "./InforOrder/ModalCostOrder.vue";
import { AkCircleCheckFill } from "@kalimahapps/vue-icons";

import { ref, onMounted } from "vue";
import axios from "axios";
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

//UserOrder
const dataUser = ref("");
const dataInforUser = (data) => {
    dataUser.value = data;
    // console.log("DataUser: ", data);
};
//UserOrder

//InforOrder
let quantityProduct = 0;
const priceProduct = ref("0");
const dataProduct = ref("");
const inforProduct = (data1, data2, data3) => {
    // console.log(data3);
    dataProduct.value = data3;
    quantityProduct = data1;
    if (data2) {
        priceProduct.value = data2;
    }
};

const dataOrder = ref("");
const productSelected = (data) => {
    dataOrder.value = data;
    // idProductSelected.value = id;
    // numberProductSelected.value = numberSelected;
    // console.log("dataProduct: ", dataOrder.value);
    // console.log("dataOrder.value: ", dataOrder.value);
};
const product = ref("");
const fetchDataOrder = async () => {
    // console.log("dataOrder.valuee: ", dataOrder.value);
    // console.log("plainData: ", plainData);

    // const plainData = JSON.parse(JSON.stringify(dataOrder.value));
    try {
        if (dataOrder.value !== "No choosedProduct" && dataOrder.value) {
            const response = await axios.post(
                `${import.meta.env.VITE_APP_URL_API}/productSelected`,
                {
                    data: dataOrder.value,
                }
            );
            // console.log("data: ", data);
            if (response.data.status === 1) {
                product.value = response.data.productSelected;
            } else {
                console.log("No productSelected");
            }
        }
    } catch (e) {
        console.log("Error: ", e);
    }
};
onMounted(() => fetchDataOrder());
//InforOrder

//CostOrder
const createOrder = async () => {
    await fetchDataOrder();
    // const Product = JSON.parse(JSON.stringify(product.value));
    console.log("Order: ", dataUser.value, "\n", product.value);
};
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
        overflow-y: auto;
    }
    .footer {
        display: flex;
        flex: 1;
        .mainCostOrder {
            display: flex;
            flex: 1;
            background-color: white;
            padding: 12px;
            flex-direction: row;

            .costDiv {
                display: flex;
                flex-direction: column;
                gap: 5px;
                .titleCostOrder {
                    display: flex;
                    flex-direction: row;
                    gap: 5px;
                    span {
                        font-size: 12px;
                        font-weight: 600;
                    }

                    .right {
                        color: #00000073;
                    }
                }
                .cost {
                    font-size: 16px;
                    color: #1890ff;
                }
            }
            .order {
                display: flex;
                flex: 1;
                justify-content: end;
                button {
                    background-color: #1890ff;
                    color: white;
                    border: 0;
                    padding: 6px 15px 6px 15px;
                    font-size: 16px;
                }
            }
        }
    }
}
</style>
