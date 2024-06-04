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
                            <a-button>Trực tiếp</a-button>
                            <a-button>Theo %</a-button>
                        </div>
                        <div class="cost">
                            <span>Giá bán </span>
                            <a-input v-model:value="cost" />
                        </div>
                    </div>
                    <div class="buttonChange">
                        <button class="buttonCancel" @click="Cancel">
                            Hủy
                        </button>
                        <button class="buttonApply" @click="Cancel">
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
const cost = ref("249.0000");

const refresh = () => {
};
const emit = defineEmits(["showModal"]);

const Cancel = () => {
    console.log("close modal");
    emit("showModal");
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
</style>
