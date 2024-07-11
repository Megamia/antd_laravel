<template>
    <transition name="modal">
        <div class="modal-mask">
            <div class="modal-wrapper" @click.self="Cancel">
                <div class="modal-container">
                    <div class="title">
                        <span> Phương thức vận chuyển </span>
                    </div>
                    <div class="content">
                        <a-radio-group v-model:value="selection" class="radio">
                            <a-radio :value="1">Nhận hàng trực tiếp</a-radio>
                            <a-radio :value="2">Tự giao hàng</a-radio>
                            <a-radio :value="3">Đối tác vận chuyển</a-radio>
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
// import axios from "axios";

const emit = defineEmits(["closeModalShipping", "valueInModalShipping"]);
const selection = ref(1);
const selectionText = ref("");
const Cancel = () => {
    emit("closeModalShipping");
};

const apply = async () => {
    try {
        if (selection.value === 1) {
            selectionText.value = "Nhận hàng trực tiếp";
        } else if (selection.value === 2) {
            selectionText.value = "Tự giao hàng";
        } else if (selection.value === 3) {
            selectionText.value = "Đối tác vận chuyển";
        }
        // const respone = await axios.post(
        //     `${import.meta.env.VITE_APP_URL_API}/chooseVoucherCode`,
        //     {
        //         code: inputCodeText.value,
        //     }
        // );
        // if (respone.data.status === 1) {
        //     valueCode.value = respone.data.chooseVoucherCode;
        // } else if (respone.data.status === 0) {
        //     valueCode.value = respone.data.chooseVoucherCode;
        // }
        // respone.data.chooseVoucherCode.forEach((data) => {
        //     // console.log("Input: ", data.value);
        emit("valueInModalShipping", selectionText.value);
        // });
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
        .radio {
            display: flex;
            flex-direction: column;
            gap: 5px;
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
