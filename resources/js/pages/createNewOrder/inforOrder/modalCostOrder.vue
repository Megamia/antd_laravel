<template>
    <transition name="modal">
        <div class="modal-mask">
            <div class="modal-wrapper">
                <div class="modal-container">
                    <div class="title">
                        <span class="titleText">Điều chỉnh giá bán</span>
                        <span class="refreshText" @click="refresh"
                            >Đặt lại
                        </span>
                    </div>
                    <div class="content">
                        <div class="typeChange">
                            <a-button
                                :class="{ active: currentChange === 'direct' }"
                                @click="currentChange = 'direct'"
                                >Trực tiếp</a-button
                            >
                            <a-button
                                :class="{ active: currentChange === 'percent' }"
                                @click="currentChange = 'percent'"
                                >Theo %</a-button
                            >
                        </div>
                        <div class="cost" v-if="currentChange === 'direct'">
                            <span>Giá bán </span>
                            <a-input v-model:value="cost" type="number" />
                        </div>
                        <div class="percent" v-else>
                            <a-radio-group v-model:value="selectOptions">
                                <div class="changPercent">
                                    <a-radio :value="1">Tăng</a-radio>
                                    <div class="inputChangePercent">
                                        <a-input
                                            type="number"
                                            v-model:value="upNumberPercent"
                                            :disabled="selectOptions === 2"
                                            placeholder="Nhập số"
                                        >
                                            <template #prefix>
                                                <AkPercentage
                                                    class="site-form-item-icon"
                                                />
                                            </template>
                                        </a-input>
                                    </div>
                                </div>
                                <div class="changPercent">
                                    <a-radio :value="2">Giảm</a-radio>
                                    <div
                                        class="inputChangePercent inputUpChangePercent"
                                    >
                                        <a-input
                                            type="number"
                                            v-model:value="downNumberPercent"
                                            :disabled="selectOptions === 1"
                                            placeholder="Nhập số"
                                        >
                                            <template #prefix>
                                                <AkPercentage
                                                    class="site-form-item-icon"
                                                />
                                            </template>
                                        </a-input>
                                    </div>
                                </div>
                            </a-radio-group>
                        </div>
                    </div>
                    <div class="buttonChange">
                        <button class="buttonCancel" @click="Cancel">
                            Hủy
                        </button>
                        <button class="buttonApply" @click="Apply">
                            Áp dụng
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>

<script setup>
import { AkPercentage } from "@kalimahapps/vue-icons";
import { ref, defineEmits } from "vue";

const upNumberPercent = ref("");
const downNumberPercent = ref("");
const selectOptions = ref(1);

const cost = ref("249.000");
const newCost = ref("");
const currentChange = ref("direct");

const refresh = () => {};
const emit = defineEmits(["showModal"]);

const Cancel = () => {
    console.log("close modal");
    emit("showModal");
};
const Apply = () => {
    if (selectOptions.value === 1 && upNumberPercent.value) {
        newCost.value =
            parseFloat(cost.value) *
            (1 + parseFloat(upNumberPercent.value) / 100);
        alert(
            `Tăng lên ${upNumberPercent.value}% thành ${parseFloat(
                newCost.value
            ).toFixed(4)} thành công`
        );
        upNumberPercent.value = null;
    } else if (selectOptions.value === 2 && downNumberPercent.value) {
        newCost.value =
            parseFloat(cost.value) *
            (1 - parseFloat(downNumberPercent.value) / 100);
        alert(
            `Giảm xuống ${downNumberPercent.value}% thành ${parseFloat(
                newCost.value
            ).toFixed(4)} thành công`
        );
        downNumberPercent.value = null;
    }
    currentChange.value = "direct";
    cost.value = parseFloat(newCost.value).toFixed(4);
    console.log("Cost: " + cost.value + "\n Type: " + typeof cost.value);
    if (parseFloat(cost.value) === 0) {
        cost.value = parseFloat(cost.value).toFixed(2);
        console.log(cost.value);
    }
};
</script>
<style scoped>
.modal-mask {
    position: fixed;
    z-index: 9998;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: table;
    transition: opacity 0.3s ease;
}

.modal-wrapper {
    display: table-cell;
    vertical-align: middle;
}

.modal-container {
    margin: 0px 30px;
    background-color: #fff;
    border-radius: 2px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
    transition: all 0.3s ease;
    font-family: Helvetica, Arial, sans-serif;
    border-radius: 10px;
    .title {
        display: flex;
        flex: 1;
        border-bottom: 1px solid #d9d9d9;
        padding-block: 20px;
        .titleText {
            display: flex;
            flex: 1;
            justify-content: center;
            font-size: 16px;
            font-weight: 600;
        }
        .refreshText {
            position: absolute;
            right: 60px;
            color: #1890ff;
            font-size: 14px;
        }
    }
    .content {
        display: flex;
        flex: 1;
        flex-direction: column;
        padding: 20px;
        gap: 20px;
        .typeChange {
            display: flex;
            flex: 1;
            gap: 20px;

            button {
                display: flex;
                flex: 1;
                justify-content: center;
            }
        }
        .cost {
            display: flex;
            flex: 1;
            flex-direction: column;
            gap: 20px;
        }
        .percent {
            display: flex;
            flex: 1;
            flex-direction: column;
            span {
                display: flex;
                flex-direction: row-reverse;
            }
            .changPercent {
                display: flex;
                flex: 1;
                flex-direction: column;
                gap: 10px;
                .inputChangePercent {
                    margin-left: 30px;
                    padding-bottom: 15px;
                    border-bottom: 1px solid #d9d9d9;
                }
                .inputUpChangePercent {
                    border: 0;
                }
            }
            .ant-radio-group {
                display: flex;
                flex-direction: column;
                gap: 20px;
            }
        }
    }
    .buttonChange {
        display: flex;
        flex: 1;
        button {
            display: flex;
            flex: 1;
            justify-content: center;
            border-radius: 0;
            border: 1px solid #d9d9d9;
            color: black;
            font-size: 16px;
            padding: 10px;
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
.active {
    border-color: #1890ff;
    color: #1890ff;
}
</style>
