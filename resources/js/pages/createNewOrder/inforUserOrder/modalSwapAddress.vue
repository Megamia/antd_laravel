<template>
    <transition name="modal">
        <div class="modal-mask">
            <div class="modal-wrapper" @click.self="Cancel">
                <div class="modal-container">
                    <div class="title">
                        <span class="titleText">Bạn muốn xóa địa chỉ này?</span>
                    </div>
                    <div class="content">
                        <span>
                            Sau khi xóa địa chỉ này, bạn sẽ không tìm thấy trong
                            danh sách địa chỉ ship hàng nữa.
                        </span>
                    </div>
                    <div class="buttonChange">
                        <button class="buttonCancel" @click="Cancel">
                            Hủy
                        </button>
                        <button class="buttonApply" @click="Apply">
                            <span> Xóa địa chỉ </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>

<script setup>
// import { QrcodeStream, QrcodeDropZone, QrcodeCapture } from "vue-qrcode-reader";
import { ref, defineEmits, defineProps } from "vue";

const open = ref(false);
const emit = defineEmits(["cancel", "apply"]);
const props = defineProps({
    idUser: Number,
});
const Cancel = () => {
    // open.value = false;
    emit("cancel");
};

const Apply = () => {
    emit("apply", props.idUser);
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
        padding-block: 15px;
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
        padding-inline: 15px;
        span {
            display: flex;
            flex: 1;
            text-align: center;
            /* justify-content: center; */
            align-items: center;
            color: #00000073;
            font-size: 14px;
            padding-bottom: 20px;
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
            padding: 10px;
        }
        .buttonCancel {
        }
        .buttonApply {
            span {
                font-weight: bold;
                color: #ff4d4f;
            }
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
