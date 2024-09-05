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
                <UserOrder />
            </div>

            <div class="productOrderDiv">
                <InforOrder @fet="fetchDataInforOrder" />
                <!-- @show="showOrHidden"
                    @showModal="ClickShowModal"
                    @infor-product="inforProduct"
                    @fetch-data="click"
                    @product-selected="productSelected"
                    @fet="fet" -->
                <ModalCostOrder v-if="showModal" @showModal="ClickShowModal" />
            </div>
            <div class="voucherAndTax">
                <VoucherAndTax
                    ref="updateVAT"
                    @fetch-data-voucher="fetchDataVoucher"
                />
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
                            >({{
                                numberProductSelected
                                    ? numberProductSelected
                                    : 0
                            }}
                            sản phẩm)</span
                        >
                    </div>
                    <div class="cost">
                        <span
                            >{{
                                priceProductValueText
                                    ? priceProductValueText
                                    : "0"
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
import { useRouter } from "vue-router";
import { ref, onMounted, reactive, onBeforeUnmount } from "vue";
import axios from "axios";
import eventBus from "../../eventBus";
import store from "../../store";
// import axios from "axios";

const clearEventBus = () => {
    eventBus.voucher.clearAllVoucher();
};

onMounted(() => {
    window.addEventListener("beforeunload", clearEventBus);
});

onBeforeUnmount(() => {
    window.removeEventListener("beforeunload", clearEventBus);
});

const router = useRouter();

const isLoyalty = ref(false);
const isOpen = ref(true);
const showModal = ref(false);
const showOrHidden = () => {
    isOpen.value = !isOpen.value;
};
const ClickShowModal = () => {
    showModal.value = !showModal.value;
};

let giamgia = 0;
const voucher = ref("");
let VATvalue = 0;
const updateVoucher = ref(null);
const updateVAT = ref(null);
const priceProductValueText = ref("0");
let numberProductSelected = 0;
// const click = () => {
//     if (updateVoucher.value) {
//         updateVoucher.value.fetchData();
//     }
//     if (updateVAT.value) {
//         updateVAT.value.valueInModalVAT();
//     }
//     giamgia =
//         eventBus.voucher.valueVoucher + eventBus.voucher.valueShip + VATvalue;
//     voucher.value = giamgia.toString();
//     voucher.value = voucher.value.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
//     priceProductValue = eventBus.product.priceProduct - giamgia;
//     priceProductValueText.value = priceProductValue;
//     // priceProductValueText.value = priceProductValueText.value.toString();
//     // priceProductValueText.value = priceProductValueText.value.replace(
//     //     /\B(?=(\d{3})+(?!\d))/g,
//     //     ","
//     // );
// };

const fetchData = () => {
    fetchDataInforOrder();

    // if (updateVoucher.value) {
    //     updateVoucher.value.fetchData();
    // }
    isLoyalty.value = eventBus.voucher.isLoyalty;
};
onMounted(() => fetchData());
let priceProductValue = 0;

//UserOrder

const dataUser = reactive({
    value: {
        inforUser: "",
        inforAddress: "",
    },
});

//UserOrder

//InforOrder
const priceProduct = ref("0");
const dataProduct = ref("");
const inforProduct = (data1, data2, data3) => {
    dataProduct.value = data3;
    if (data2) {
        priceProduct.value = data2;
    }
};

// const productSelected = (data) => {
//     try {
//         click();
//         if (updateVAT.value) {
//             updateVAT.value.valueInModalVAT();
//         }
//         dataOrder.value = data;
//         fetchDataVoucher();
//     } catch (e) {
//         console.log("Error: ", e);
//     }
// };

let valueVAT = 0;

const fetchDataVoucher = (data) => {
    // console.log(eventBus.product.priceAfterSale);
    valueVAT = data;
    mathCost();
};

const fetchDataInforOrder = () => {
    mathCost();
    if (updateVAT.value) {
        updateVAT.value.valueInModalVAT();
    }
};
// onMounted(() => fetchDataInforOrder());
//Cost
const mathCost = () => {
    if (eventBus.product.idProduct && eventBus.product.idProduct.length > 0) {
        numberProductSelected = eventBus.product.idProduct.length;
    } else {
        numberProductSelected = 0;
    }

    giamgia =
        eventBus.voucher.valueVoucher +
        eventBus.voucher.valueShip +
        parseFloat(valueVAT);
    eventBus.product.priceAfterSale = eventBus.product.priceProduct - giamgia;
    priceProductValueText.value = eventBus.product.priceProduct - giamgia;
    priceProductValueText.value = priceProductValueText.value.toString();
    priceProductValueText.value = priceProductValueText.value.replace(
        /\B(?=(\d{3})+(?!\d))/g,
        ","
    );

    voucher.value = giamgia.toString();
    voucher.value = voucher.value.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
};
//Cost

const product = ref("");
const idProduct = ref("");
const idDetailProduct = ref("");
const fetchDataOrder = async () => {
    try {
        if (dataOrder.value !== "No choosedProduct" && dataOrder.value) {
            const response = await axios.post(
                `${import.meta.env.VITE_APP_URL_API}/productSelected`,
                {
                    data: dataOrder.value,
                }
            );
            if (response.data.status === 1) {
                product.value = response.data.productSelected;
                idProduct.value = product.value.map((item) => item.id);
                idDetailProduct.value = product.value.map(
                    (item) => item.idDetailProduct
                );
            } else {
                console.log("No productSelected");
            }
        }
        fetchDataInforOrder();
        inforProduct();
    } catch (e) {
        console.log("Error: ", e);
    }
};
onMounted(() => fetchDataOrder());
//InforOrder

//CostOrder
//cần update
const dataOrder = ref("");
const test = () => {
    console.log("Address: ", store.state.address);
    console.log("DetailOrder: ", idDetailOrder.value);
    console.log("idVoucherCode: ", eventBus.voucher.idVoucherCode);
    if (store.state.address.length > 0 && idDetailOrder.value.length > 0) {
        console.log("Address: ", store.state.address);
        console.log("DetailOrder: ", idDetailOrder.value);
        console.log("idVoucherCode: ", eventBus.voucher.idVoucherCode);
    } else {
        console.log("Chưa đủ thông tin");
    }
};
const idDataOrderWithoutValue = ref("");
const createOrderWithoutValue = async () => {
    try {
        const response = await axios.post(
            `${import.meta.env.VITE_APP_URL_API}/createOrderWithoutValue`,
            {
                idAddress: store.state.address.dataAddress.id,
                idVoucherCode: eventBus.voucher.idVoucherCode,
            }
        );
        if (response.data.status === 1) {
            console.log("Tạo order không có value thành công");
            idDataOrderWithoutValue.value =
                response.data.createOrderWithoutValue.map((item) => item.id);
        } else {
            console.log("Tạo order không có value thất bại");
            return;
        }
    } catch (e) {
        console.log("Error: ", e);
    }
};

const createOrderWithValue = async () => {
    console.log(idDataOrderWithoutValue.value);
    console.log(eventBus.voucher.idVoucherPromotion);
    try {
        const response = await axios.post(
            `${import.meta.env.VITE_APP_URL_API}/createOrderWithValue`,
            {
                idOrder: idDataOrderWithoutValue.value,
                idVoucherCode: eventBus.voucher.idVoucherCode,
            }
        );
        if (response.data.status === 1) {
            console.log("Tạo order có value thành công");
            console.log(response.data);
        } else {
            console.log("Tạo order có value thất bại", response.data.message);
            return;
        }
    } catch (e) {
        console.log("Error: ", e);
    }
};

const createOrder = async () => {
    // await createProduct();
    // if (!checkValidInputCreateOrder()) {
    //     return;
    // }
    // await createOrderWithoutValue();
    // await createOrderWithValue();
    // await createDetailOrder();
    await createOrderWithoutValue();
    await createVoucher();
    await createOrderWithValue();
    await createDetailOrderWithouPrice();
    await createProduct();
    await createDetailOrderWithPrice();
};
const checkValidInputCreateOrder = () => {
    if (store.state.address.dataAddress && idDetailOrder.value.length > 0) {
        console.log("Checked");
        return true;
    } else {
        alert("Chưa điền đủ thông tin");
        return false;
    }
};
//cần update
//CostOrder
const idProductCreated = ref("");
const createProduct = async () => {
    try {
        if (
            eventBus.product.idProduct != null &&
            Array.isArray(eventBus.product.idProduct) &&
            eventBus.product.idProduct.length > 0
        ) {
            const response = await axios.post(
                `${import.meta.env.VITE_APP_URL_API}/createProduct`,
                {
                    idDetailOrder: idDetailOrder.value,
                    idDetailProduct: eventBus.product.idProduct,
                }
            );

            if (response.data && response.data.status === 1) {
                // idProductSelected.value = response.data.createProduct.map(
                //     (item) => item.id
                // );
                console.log("createProduct thành công");
                idProductCreated.value = response.data.createProduct.map(
                    (item) => item.id
                );
            } else {
                console.log("createProduct thất bại");
                return;
            }
        } else {
            alert("Chưa chọn sản phẩm nào");
        }
    } catch (e) {
        console.log("Error: ", e);
        alert(
            "Đã xảy ra lỗi khi gửi yêu cầu đến server. Vui lòng thử lại sau."
        );
    }
};

const idDetailOrder = ref([]);
const createDetailOrderWithouPrice = async () => {
    try {
        const response = await axios.post(
            `${import.meta.env.VITE_APP_URL_API}/createDetailOrderWithouPrice`,
            {
                idOrder: idDataOrderWithoutValue.value,
            }
        );
        if (response.data.status === 1) {
            console.log("createDetailOrderWithouPrice thành công");
            console.log(response.data.createDetailOrderWithouPrice.id);
            idDetailOrder.value = response.data.createDetailOrderWithouPrice.id;
        } else {
            console.log("createDetailOrderWithouPrice thất bại");
            return;
        }
    } catch (e) {
        console.log("Error: ", e);
    }
};

const createDetailOrderWithPrice = async () => {
    try {
        const response = await axios.post(
            `${import.meta.env.VITE_APP_URL_API}/createDetailOrderWithPrice`,
            {
                idProduct: idProductCreated.value,
            }
        );
        if (response.data.status === 1) {
            console.log("createDetailOrderWithPrice thành công");
        } else {
            console.log("createDetailOrderWithPrice thất bại");
            return;
        }
    } catch (e) {
        console.log("Error:  ", e);
    }
};
const productId = ref([]);
const detailOrderProduct = ref("");
// const fetchDataIdAndPriceProduct = async () => {
//     await fetchDataOrder();
//     productId.value = Array.isArray(idProduct.value)
//         ? Array.from(idProduct.value)
//         : [];
//     if (productId.value.length > 0 && product.value.length > 0) {
//         try {
//             const response = await axios.post(
//                 `${import.meta.env.VITE_APP_URL_API}/addDetailOrder`,
//                 {
//                     idProducts: productId.value,
//                 }
//             );
//             if (response.data.status === 1) {
//                 detailOrderProduct.value = response.data.addDetailOrders;
//                 const idDetailOrder = detailOrderProduct.value.map((b) => b.id);
//                 await createVoucher(idDetailOrder);
//             } else {
//                 alert("Có lỗi khi khởi tạo đơn hàng");
//                 return;
//             }
//         } catch (e) {
//             console.log("Error: ", e);
//         }
//     } else {
//         return;
//     }
// };

const data = ref([]);
const idVoucher = ref([]);
const createVoucher = async (dataOrder) => {
    try {
        const response = await axios.post(
            `${import.meta.env.VITE_APP_URL_API}/createVoucher`,
            {
                idOrder: idDataOrderWithoutValue.value,
                idVoucherPromotion: eventBus.voucher.idVoucherPromotion,
            }
        );
        if (response.data.status === 1) {
            console.log("createVoucher thành công");

            // if (response.data.message !== "Voucher(s) already exists") {
            //     data.value = response.data.createVoucher;
            // } else {
            //     data.value = response.data.existingVouchers;
            // }
            // console.log(data.value);
        } else {
            console.log("createVoucher thất bại");
            return;
        }
    } catch (e) {
        console.log("Error: ", e);
    }
};

// const fetchDataInforUser = async (idDetailOrder, idVoucher) => {
//     try {
//         const response = await axios.post(
//             `${import.meta.env.VITE_APP_URL_API}/InforUser`,
//             {
//                 idUser: dataUser.value.inforUser.id,
//                 idAddress: dataUser.value.inforAddress.id,
//             }
//         );
//         if (response.data.status === 1) {
//             const idInforUser = response.data.InforUser.id;
//             await completeCreateOrder(idDetailOrder, idInforUser, idVoucher);
//         } else {
//             console.log("Faile");
//         }
//     } catch (e) {
//         console.log("Error: ", e);
//     }
// };

// const completeCreateOrder = async (idDetailOrder, idInforUser, idVoucher) => {
//     try {
//         const response = await axios.post(
//             `${import.meta.env.VITE_APP_URL_API}/createOrder`,
//             {
//                 idDetailOrder: idDetailOrder,
//                 idInforUser: idInforUser,
//                 idVoucher: idVoucher,
//             }
//         );
//         if (response.data.status === 1) {
//             router.push("/CreateOrderSuccess");
//         } else {
//             alert("Tạo mới đơn hàng thất bại");
//         }
//     } catch (e) {
//         console.log("Error: ", e);
//     }
// };
</script>

<style scoped>
.mainCreateNewOrderLayout {
    display: flex;
    height: 100vh;
    flex-direction: column;
    background-color: #f0f2f5;
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
