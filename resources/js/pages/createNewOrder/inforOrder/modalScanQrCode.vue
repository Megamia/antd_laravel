<template>
    <transition name="modal">
        <div class="modal-mask">
            <div class="modal-wrapper" @click.self="Cancel">
                <div class="modal-container">
                    <div class="title">
                        <span class="titleText">Chọn loại mã</span>
                    </div>
                    <div class="content">
                        <div class="barCode" @click="showScan">
                            <span class="name">Mã vạch</span>
                            <StreamBarcodeReader v-if="open" />
                        </div>
                        <div class="physicalCode" @click="showScan">
                            <span class="name">Mã vật lý</span>
                            <!-- <StreamBarcodeReader v-if="open" /> -->
                        </div>
                        <div class="IMEICode" @click="showScan">
                            <span class="name">Mã định danh imei/serial</span>
                            <!-- <StreamBarcodeReader v-if="open" /> -->
                        </div>
                    </div>
                    <div class="buttonChange">
                        <button class="buttonCancel" @click="Cancel">
                            Hủy
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>

<script setup>
// import { QrcodeStream, QrcodeDropZone, QrcodeCapture } from "vue-qrcode-reader";
import { StreamBarcodeReader } from "vue-barcode-reader";
import { ref, defineEmits } from "vue";

const emit = defineEmits([ "closeModalScanQrCode"]);
const open = ref(false);

const showScan = () => {
    open.value = true;
};
const Cancel = () => {
    // open.value = false;
    emit("closeModalScanQrCode");
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
        padding-block: 20px;
        .titleText {
            display: flex;
            flex: 1;
            justify-content: center;
            font-size: 16px;
            font-weight: 600;
        }
    }
    .content {
        display: flex;
        flex: 1;
        flex-direction: column;
        .barCode,
        .physicalCode,
        .IMEICode {
            border-top: 1px solid #d9d9d9;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            .name {
                color: #1890ff;
                font-size: 14px;
            }
        }
    }
    .buttonChange {
        display: flex;
        flex: 1;

        button {
            border-bottom-right-radius: 5px;
            border-bottom-left-radius: 5px;
            background-color: white;
            display: flex;
            flex: 1;
            justify-content: center;
            border: 1px solid #d9d9d9;
            color: black;
            font-size: 16px;
            padding: 15px;
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
