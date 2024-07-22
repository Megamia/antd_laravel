<template>
    <div class="mainDetailVoucher">
        <div class="title">
            <AnOutlinedArrowLeft @click="back" />
            <span @click="test"> Giảm giá </span>
        </div>
        <div class="content">
            <div class="isLoyaltyDiv">
                <div class="left">
                    <img
                        src="../../../../../../public/img/Screenshot2024-07-15091822.png"
                        class="img"
                    />
                    <span> Ưu đãi phân hạng Loyalty </span>
                </div>
                <div class="right">
                    <a-switch v-model:checked="checked" @change="click" />
                </div>
            </div>
            <div class="inputCode itemContent" @click="showModalCode">
                <div class="left">
                    <img
                        src="../../../../../../public/img/c6d6ecaa5187c8e181b28cfcb4ddbf3b.png"
                        class="img"
                    />
                    <span>Mã ưu đãi/ Coupon</span>
                </div>
                <div class="right">
                    <span :class="{ valueSelected: totalCodeString !== '0' }">
                        {{
                            totalCodeString !== "0" ||
                            total === "no chooseVoucherCode"
                                ? totalCodeString + "đ"
                                : "Nhập mã"
                        }}
                        <AkChevronRightSmall />
                    </span>
                </div>
            </div>
            <modalCode
                v-if="isShowModalCode"
                @close-modal-code="showModalCode"
                @value-in-modal-code="valueInModalCode"
            />
            <div class="inputDiscount itemContent" @click="showModalDiscount">
                <div class="left">
                    <span>Chiết khấu</span>
                </div>
                <div class="right">
                    <span
                        :class="{
                            valueSelected: totalDiscount !== 0,
                        }"
                        >{{
                            totalDiscount !== 0
                                ? valueDiscount + "đ"
                                : "Nhập chiết khấu"
                        }}
                        <AkChevronRightSmall />
                    </span>
                </div>
            </div>
            <modalDiscount
                v-if="isShowModalDiscount"
                @close-modal-discount="showModalDiscount"
                @value-in-modal-discount="valueInModalDiscount"
            />
            <div class="itemContent itemLoyalty" v-if="checked">
                <div class="left">
                    <span>Ưu đãi phân hạng Loyalty</span>
                </div>
                <div class="right rightLoyalty">
                    <span> -30.000đ </span>
                </div>
            </div>
            <div class="inputPromotion itemContent" @click="showModalPromotion">
                <div class="left">
                    <span>Khuyến mãi</span>
                </div>
                <div class="right">
                    <span :class="{ valueSelected: totalProString !== '0' }">
                        {{
                            totalProString !== "0"
                                ? totalProString + "đ"
                                : "Chọn mã"
                        }}
                        <AkChevronRightSmall />
                    </span>
                </div>
            </div>
            <modalPromotion
                v-if="isShowModalPromotion"
                @close-modal-promotion="showModalPromotion"
                @value-in-modal-promotion="valueInModalPromotion"
                :sltedId="selectedInModalPromotion.sltId"
            />
        </div>
        <div class="saveDive">
            <div class="totalDiv">
                <span> Tổng cộng giảm giá</span>
                <span class="totalValue"
                    >{{ total !== 0 ? total + "đ" : "" }}
                </span>
            </div>
            <a-button type="primary" @click="buttonSave">Lưu</a-button>
        </div>
    </div>
</template>
<script setup>
import { useRouter } from "vue-router";
import {
    AnOutlinedArrowLeft,
    AkChevronRightSmall,
} from "@kalimahapps/vue-icons";
import modalCode from "./modalCode.vue";
import modalDiscount from "./modalDiscount.vue";
import modalPromotion from "./modalPromotion.vue";
import { ref, onMounted } from "vue";
import eventBus from "../../../../eventBus";

const router = useRouter();
const checked = ref(null);
const click = () => {
    // console.log(checked.value);

    fetchTotal();
};
const back = () => {
    router.back();
};

const fetchData = () => {
    checked.value = eventBus.voucher.isLoyalty;
    // if (eventBus.voucher.isLoyalty) {
    //     checked.value = eventBus.voucher.isLoyalty;
    // }
    // console.log(eventBus.voucher.isLoyalty);
    if (eventBus.product.priceProduct !== 0) {
        // console.log("evBPrice: " + eventBus.product.priceProduct);
        // console.log("discount: " + totalPrice, typeof totalPrice);
    } else {
        console.log("Chưa chọn sản phẩm nào");
    }
    fetchTotal();
};
onMounted(() => fetchData());

// ModalCode

const test = () => {
    // console.log(checked.value);
};
const isShowModalCode = ref(false);

const showModalCode = () => {
    isShowModalCode.value = !isShowModalCode.value;
};

let totalCode = 0;
const totalCodeString = ref("0");
const valueInModalCode = (dataValueInModalCode) => {
    isShowModalCode.value = !isShowModalCode.value;
    totalCode = dataValueInModalCode;
    totalCodeString.value = dataValueInModalCode;
    totalCode = totalCode.replace(/\./g, "");
    // console.log("Giá được giảm từ modal Code: ", totalCode);
    fetchTotal();
};
// ModalCode

// ModalDiscount

const isShowModalDiscount = ref(false);

const showModalDiscount = () => {
    isShowModalDiscount.value = !isShowModalDiscount.value;
};
const valueDiscount = ref("0");
let totalDiscount = 0;

const valueInModalDiscount = (dataValueInModalDiscount, message) => {
    isShowModalDiscount.value = !isShowModalDiscount.value;
    if (message.message === "percent") {
        totalDiscount =
            (eventBus.product.priceProduct * dataValueInModalDiscount) / 100;
    } else if (message.message === "money") {
        totalDiscount = parseFloat(dataValueInModalDiscount);
    }
    // valueDiscount.value = totalDiscount.toLocaleString("de-DE", {
    //     maximumFractionDigits: 2,
    // });
    valueDiscount.value = totalDiscount.toString();
    valueDiscount.value = valueDiscount.value.replace(
        /\B(?=(\d{3})+(?!\d))/g,
        ","
    );
    // console.log(valueDiscount.value);
    // console.log("Phần trăm được giảm từ modal Discount: ", valueDiscount.value);
    fetchTotal();
};

// ModalDiscount

//ModalPromotion

const isShowModalPromotion = ref(false);
const showModalPromotion = () => {
    isShowModalPromotion.value = !isShowModalPromotion.value;
};
let totalPro = 0;
const totalProString = ref("0");
const selectedInModalPromotion = ref({
    sltId: [],
});
const valueInModalPromotion = (datavalueInModalPromotion, slt) => {
    // const array=[];
    isShowModalPromotion.value = !isShowModalPromotion.value;
    // console.log("data: ", data);
    // for (let i = 0; i < Object.keys(data).length; i++) {
    //     console.log("data: ", data[i]["id"]);
    //     array.push(data[i]["id"]);

    //     totalPro += array[i];
    // }
    totalPro = datavalueInModalPromotion;
    totalProString.value = datavalueInModalPromotion;
    totalPro = totalPro.replace(/\./g, "");
    // console.log("Giá được giảm từ modal Promotion: ", totalPro);

    selectedInModalPromotion.value.sltId = slt;
    fetchTotal();
    // console.log(
    //     "selectedInModalPromotion .value.sltId: ",
    //     selectedIdInModalPromotion.value.sltId
    // );
};

//ModalPromotion

// let total = 0;
const total = ref("0");
const buttonSave = () => {
    if (total.value === "0") {
        eventBus.voucher.clearValueVoucher();
    }
    // console.log(checked.value);
    eventBus.voucher.isLoyalty = checked.value;
    fetchData();
    router.back();
};

const fetchTotal = () => {
    let totalValue = 0;

    totalValue = parseFloat(totalCode) + parseFloat(totalPro) + totalDiscount;
    // console.log(
    //     "parseFloat(totalCode): " + parseFloat(totalCode),
    //     "\n",
    //     "totalDiscount: " + totalDiscount,
    //     "\n",
    //     "parseFloat(totalPro): " + parseFloat(totalPro)
    // );
    if (checked.value === true) {
        totalValue = totalValue + 30000;
    }
    // if(totalValue.toString().length>3)
    // console.log(totalValue.toString().length);
    // totalValue = totalValue.replace(/\./g, "");
    eventBus.voucher.valueVoucher = totalValue;
    totalValue = totalValue.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    // console.log("totalValue: " + totalValue);
    total.value = totalValue;
};
</script>

<style scoped>
.mainDetailVoucher {
    display: flex;
    flex: 1;
    flex-direction: column;
    background-color: #f0f2f5;
    gap: 20px;

    .title {
        background-color: white;
        display: flex;
        padding: 16px 36px 16px 12px;
        align-items: center;

        svg {
            position: relative;
            font-size: 25px;
        }

        span {
            font-size: 20px;
            line-height: 28px;
            font-weight: bold;
            display: flex;
            flex: 1;
            justify-content: center;
        }
    }

    .content {
        display: flex;
        flex-direction: column;
        background-color: white;

        .isLoyaltyDiv {
            display: flex;
            flex: 1;
            background-color: #f0f2f5;
            padding: 0 12px 20px 12px;
            align-items: center;
            justify-content: space-between;
        }
        .itemContent {
            border-bottom: 1px solid #d9d9d9;
            display: flex;
            flex: 1;
            justify-content: space-between;
            align-items: center;
            padding: 12px;
            font-size: 14px;
            line-height: 22px;
        }
        .itemLoyalty {
            span {
                padding-right: 24px;
            }
        }

        .isLoyaltyDiv,
        .inputCode,
        .inputDiscount,
        .inputPromotion {
            .left {
                gap: 10px;
                display: flex;
                align-items: center;

                img {
                    width: 20px;
                    height: 20px;
                }
            }

            .right {
                display: flex;
                align-items: center;
                color: #00000073;
                span {
                    display: flex;
                    align-items: center;
                    gap: 10px;
                }

                .valueSelected {
                    color: #000000d9;
                }
            }
        }
    }

    .saveDive {
        /* position: fixed; */
        background-color: white;
        bottom: 0;
        width: 100%;
        padding: 10px;
        border: 0 0 10px 0;
        border-top: 1px solid rgba(0, 0, 0, 0.15);
        box-shadow: 0 0.15rem 0.15rem rgba(0, 0, 0, 0.15);

        button {
            position: relative;
            width: 100%;
            border-radius: 0;
            margin-top: 10px;
        }

        .totalDiv {
            display: flex;
            flex: 1;
            justify-content: space-between;

            .totalValue {
                font-size: 14px;
                color: #1890ff;
            }
        }
    }
}
</style>
