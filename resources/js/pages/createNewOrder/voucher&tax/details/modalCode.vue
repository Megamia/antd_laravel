<template>
    <transition name="modal">
        <div class="modal-mask">
            <div class="modal-wrapper" @click.self="Cancel">
                <div class="modal-container">
                    <div class="title">
                        <span>Mã ưu đãi/ Coupon </span>
                    </div>
                    <div class="content">
                        <span>Nhập mã</span>
                        <input type="text" placeholder="Nhập lý do" v-model="inputCodeText" />
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
import axios from "axios";

const emit = defineEmits(["closeModalCode","valueInModalCode"]);

const inputCodeText = ref("");

// const fetchData = async () => {
//     const response = await axios.get(`${import.meta.env.VITE_APP_URL_API}/dataValueVoucherCode`)
//     console.log(response.data.dataValueVoucherCode);
    // console.log(response.data.dataValueVoucherCode.find(a => a.code === 'NHAPBUADI'));
// }
// onMounted(() => fetchData());

const Cancel = () => {
    emit("closeModalCode");
};
const dataVoucherCode = ref("");
const apply = async () => {
    try {
        const response = await axios.post(`${import.meta.env.VITE_APP_URL_API}/chooseVoucherCode`, {
            code: inputCodeText.value
        })
        if (response.data.status === 1) {
            dataVoucherCode.value = response.data.chooseVoucherCode[0].value;
            // console.log(dataVoucherCode.value);
        } else if (response.data.status == 0) {
            dataVoucherCode.value = response.data.chooseVoucherCode;
            // console.log(dataVoucherCode.value);
        }
        emit("valueInModalCode",dataVoucherCode.value.toString());
    } catch (e) {
        console.log("Error: ", e);
    }
}
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
        gap: 10px;

        input {
            padding: 10px;
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
