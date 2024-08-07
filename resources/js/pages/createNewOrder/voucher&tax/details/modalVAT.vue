<template>
    <transition name="modal">
        <div class="modal-mask">
            <div class="modal-wrapper" @click.self="Cancel">
                <div class="modal-container">
                    <div class="title">
                        <span> Thuế VAT </span>
                    </div>
                    <div class="content">
                        <div class="detail">
                            <span>Thuế VAT</span>
                            <a-input
                                suffix="%"
                                v-model:value="valueVAT"
                                type="number"
                                required
                                style="border-radius: 0; padding: 5px"
                            />
                        </div>
                        <div class="detail">
                            <span>Lý do sửa </span>
                            <a-input
                                placeholder="Nhập lý do"
                                v-model:value="valueReason"
                                required
                            />
                        </div>
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

const emit = defineEmits(["closeModalVAT", "valueInModalVAT"]);

const Cancel = () => {
    emit("closeModalVAT");
};

const valueVAT = ref("0");
const valueReason = ref("");
const apply = async () => {
    try {
        // console.log("VAT: ", valueVAT.value);
        eventBus.voucher.valueVAT = valueVAT.value;
        emit("valueInModalVAT");
        emit("closeModalVAT");
    } catch (e) {
        console.log("Error: ", e);
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
        padding: 16px 12px;
        gap: 20px;
        .detail {
            display: flex;
            flex: 1;
            flex-direction: column;
            gap: 10px;
        }
        /* background-color: red; */
        .ant-input {
            padding: 5px;
            border-radius: 0;
            border: 1px solid #d9d9dd;
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
