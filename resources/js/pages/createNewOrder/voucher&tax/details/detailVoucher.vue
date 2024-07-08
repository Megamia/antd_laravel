<template>
    <div class="mainDetailVoucher">
        <div class="title">
            <AnOutlinedArrowLeft @click="back" />
            <span> Giảm giá </span>
        </div>
        <div class="content">
            <div class="inputCode itemContent" @click="showModalCode">
                <div class="left">
                    <img
                        src="../../../../../../public/img/c6d6ecaa5187c8e181b28cfcb4ddbf3b.png"
                        class="img"
                    />
                    <span>Mã ưu đãi/ Coupon</span>
                </div>
                <div class="right">
                    <span :class="{ valueSelected: totalCode !== 0 }">
                        {{
                            totalCode !== 0 || total === "no chooseVoucherCode"
                                ? totalCode + "đ"
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
                    <span :class="{ valueSelected: totalDiscount !== 0 }"
                        >{{
                            totalDiscount !== 0
                                ? totalDiscount
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
            <div class="inputPromotion itemContent" @click="showModalPromotion">
                <div class="left">
                    <span>Khuyến mãi</span>
                </div>
                <div class="right">
                    <span :class="{ valueSelected: totalPro !== 0 }">
                        {{ totalPro !== 0 ? totalPro + "đ" : "Chọn mã" }}
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
import { ref } from "vue";

const router = useRouter();
const back = () => {
    router.back();
};

// ModalCode

const isShowModalCode = ref(false);

const showModalCode = () => {
    isShowModalCode.value = !isShowModalCode.value;
};

let totalCode = 0;
const valueInModalCode = (dataValueInModalCode) => {
    isShowModalCode.value = !isShowModalCode.value;
    totalCode = dataValueInModalCode;
    console.log("Giá được giảm từ modal Code: ", totalCode);
    fetchTotal();
};
// ModalCode

// ModalDiscount

const isShowModalDiscount = ref(false);

const showModalDiscount = () => {
    isShowModalDiscount.value = !isShowModalDiscount.value;
};
let totalDiscount = 0;

const valueInModalDiscount = (dataValueInModalDiscount, message) => {
    isShowModalDiscount.value = !isShowModalDiscount.value;
    if (message.message === "percent") {
        totalDiscount = dataValueInModalDiscount + "%";
    } else if (message.message === "money") {
        totalDiscount = dataValueInModalDiscount;
    }
    console.log("Phần trăm được giảm từ modal Discount: ", totalDiscount);
    fetchTotal();
};

// ModalDiscount

//ModalPromotion

const isShowModalPromotion = ref(false);
const showModalPromotion = () => {
    isShowModalPromotion.value = !isShowModalPromotion.value;
};
let totalPro = 0;
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
    console.log(
        "Giá được giảm từ modal Promotion: ",
        totalPro
        // "\n",
        // "id các item đã chọn: ",
        // slt
    );

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
    console.log(
        "Mã ưu đãi: ",
        totalCode ? totalCode : 0,
        "\n",
        "Chiết khấu: ",
        totalDiscount ? totalDiscount : 0,
        // discountValue.value ? discountValue.value : "0",
        "\n",
        "Khuyến mãi: ",
        totalPro ? totalPro : 0,
        "\n",
        "Total: ",
        total.value
    );
    // console.log(typeof totalCode, typeof totalPro);

    return;
};
const fetchTotal = () => {
    // if (totalDiscount.includes("%")) {
    //     let numberTotalDiscount = parseFloat(totalDiscount.replace("%", ""));
    //     total.value = (
    //         parseFloat(totalCode) +
    //         numberTotalDiscount +
    //         parseFloat(totalPro)
    //     ).toFixed(3);
    // } else {
    //     total.value = (
    //         parseFloat(totalCode) +
    //         totalDiscount +
    //         parseFloat(totalPro)
    //     ).toFixed(3);
    // }
    total.value = (parseFloat(totalCode) + parseFloat(totalPro)).toFixed(3);
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
