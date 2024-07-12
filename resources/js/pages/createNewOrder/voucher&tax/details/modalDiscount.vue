<template>
    <transition name="modal">
        <div class="modal-mask">
            <div class="modal-wrapper" @click.self="Cancel">
                <div class="modal-container">
                    <div class="title">
                        <span> Chiết khấu </span>
                    </div>
                    <div class="content">
                        <a-radio-group v-model:value="option">
                            <a-radio :value="1" class="text radio"
                                >Giảm giá theo phần trăm (%)</a-radio
                            >
                            <div v-if="option === 1" class="inputDiv">
                                <a-input
                                    placeholder="Nhập số"
                                    v-model:value="percentValue.percentText"
                                    suffix="%"
                                    required
                                    type="number"
                                    @change="percentValueNumberInput"
                                />
                                <span class="reasonText text">Lý do sửa</span>
                                <a-input
                                    placeholder="Nhập lý do"
                                    v-model:value="percentValue.reasonText"
                                />
                            </div>
                            <a-radio
                                :value="2"
                                class="text radio"
                                :class="{ radioDown: option === 2 }"
                                >Giảm giá theo số tiền</a-radio
                            >
                            <div v-if="option === 2" class="inputDiv">
                                <a-input
                                    placeholder="Nhập số"
                                    v-model:value="moneyValue.moneyText"
                                    suffix="₫"
                                    required
                                    type="number"
                                    @change="moneyValueNumberInput"
                                />
                                <span class="reasonText text">Lý do sửa</span>
                                <a-input
                                    placeholder="Nhập lý do"
                                    v-model:value="moneyValue.reasonText"
                                />
                            </div>
                        </a-radio-group>
                    </div>
                    <div class="buttonDiv">
                        <button class="button buttonCancel" @click="Cancel">
                            Hủy
                        </button>
                        <button class="button buttonApply" @click="apply">
                            Áp dụng
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>

<script setup>
import { ref, defineEmits } from "vue";
import eventBus from "../../../../eventBus";

const emit = defineEmits(["closeModalDiscount", "valueInModalDiscount"]);

const option = ref(1);
const Cancel = () => {
    emit("closeModalDiscount");
};

const percentValue = ref({
    percentText: "0",
    reasonText: "",
});
const moneyValue = ref({
    moneyText: "0",
    reasonText: "",
});

// Chưa hoàn thiện

const percentValueNumberInput = () => {
    let inputPercentValue = Number(percentValue.value.percentText);
    if (percentValue.value.percentText !== "0") {
        if (inputPercentValue < 0 || inputPercentValue > 100) {
            alert("Yêu cầu nhập số % hợp lệ trong khoảng 0 đến 100%");
            percentValue.value.percentText = "0";
        } else {
            percentValue.value.percentText = inputPercentValue;
            // console.log(inputPercentValue);
        }
    }
};

// Chưa hoàn thiện

const moneyValueNumberInput = () => {
    if (moneyValue.value.moneyText !== "0") {
        let inputMoneyValue = Number(moneyValue.value.moneyText);
        if (inputMoneyValue === 0) {
            moneyValue.value.moneyText = "0";
        } else {
            moneyValue.value.moneyText = inputMoneyValue;
        }
    }
};

const checkEmpty = () => {
    return (
        (percentValue.value.percentText && percentValue.value.reasonText) ||
        (moneyValue.value.moneyText && moneyValue.value.reasonText)
    );
};

const apply = () => {
    if (!checkEmpty()) {
        alert("Chưa nhập đủ");
    } else {
        if (option.value === 1) {
            // console.log("percentValue: ", percentValue.value);
            emit("valueInModalDiscount", percentValue.value.percentText, {
                message: "percent",
            });
        } else if (option.value === 2) {
            // console.log("moneyValue: ", moneyValue.value);
            if (
                moneyValue.value.moneyText > eventBus.product.priceProduct &&
                eventBus.product.priceProduct
            ) {
                alert("Không thể giảm giá cao hơn giá sản phẩm");
                return;
            } else {
                emit("valueInModalDiscount", moneyValue.value.moneyText, {
                    message: "money",
                });
            }
        }
    }
};
</script>
<style scoped>
.modal-mask {
    position: fixed;
    z-index: 100;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: table;
    /* overflow-y: none;  */
    transition: opacity 0.3s ease;
}

.modal-wrapper {
    display: table-cell;
    vertical-align: middle;
    padding-inline: 50px;
}

.modal-container {
    border-radius: 8px;
    position: relative;
    background-color: #fff;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
    transition: all 0.3s ease;
    font-family: Helvetica, Arial, sans-serif;
    overflow-y: auto;

    .title {
        display: flex;
        flex: 1;
        justify-content: center;
        align-items: center;
        border-bottom: 1px solid #d9d9dd;
        padding: 10px 12px 10px 12px;
        gap: 10px;

        span {
            font-size: 16px;
            font-weight: bold;
            line-height: 24px;
        }
    }

    .content {
        display: flex;
        flex: 1;
        flex-direction: column;
        gap: 10px;

        .ant-radio-group {
            display: flex;
            flex: 1;
            flex-direction: column;
            padding-block: 10px;

            .inputDiv {
                display: flex;
                flex: 1;
                flex-direction: column;
                padding: 10px 20px 20px 0;
                margin: 0 0 10px 35px;
                gap: 10px;
                border-bottom: 1px solid #d9d9dd;

                span {
                    border-radius: 0;
                }

                .reasonText {
                    font-size: 14px;
                }
            }

            .text {
                font-weight: bold;
            }

            .radio {
                display: flex;
                flex: 1;
                padding: 0 0 0 10px;
            }

            .radioDown {
                display: flex;
                flex: 1;
                border-top: 1px solid #d9d9dd;
                margin: 10px 0 0 10px;
                padding: 10px 0 0 0;
            }
        }
    }

    .buttonDiv {
        display: flex;
        flex: 1;

        button {
            display: flex;
            flex: 1;
            align-items: center;
            justify-content: center;
            padding: 10px;
            border-radius: 0;
            border: 1px solid #d9d9dd;
            background-color: white;
            font-weight: bold;
        }

        .buttonCancel {
            color: black;
        }

        .buttonApply {
            color: #1890ff;
        }
    }
}

.modal-header h3 {
    margin-top: 0;
    color: #42b983;
}

.modal-enter {
    opacity: 0;
}

.modal-leave-active {
    opacity: 0;
}

.modal-enter .modal-container,
.modal-leave-active .modal-container {
    -webkit-transform: scale(1.1);
    transform: scale(1.1);
}
</style>
