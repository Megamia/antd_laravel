<template>
    <transition name="modal">
        <div class="modal-mask">
            <div class="modal-wrapper" @click.self="Cancel">
                <div class="modal-container">
                    <div class="title">
                        <span> Khuyến mãi </span>
                    </div>
                    <div class="content">
                        <div>
                            <a-button>Default Button</a-button>
                            <a-button>Default Button</a-button>
                        </div>
                        <div>
                            <a-checkbox-group
                                v-model:value="selectedItemList"
                                style="width: 100%"
                            >
                                <div
                                    v-for="listItem in listPromotion"
                                    :key="listItem.id"
                                >
                                    <a-checkbox :value="listItem.id" />
                                    <span>{{ listItem.text }}</span>
                                </div>
                            </a-checkbox-group>
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

const emit = defineEmits(["closeModalPromotion"]);

const selectedItemList = ref("");
const listPromotion = ref([
    {
        id: 1,
        state: null,
        text: "Chiến dịch Trung thu đầy trăng",
    },
    {
        id: 2,
        state: null,
        text: "Sale 11/11 Black Friday",
    },
    {
        id: 3,
        state: null,
        text: "Giảm 40k cho đơn trên 1.000.000đ",
    },
    {
        id: 4,
        state: null,
        text: "Tết sum vầy",
    },
    {
        id: 5,
        state: null,
        text: "Đồng giá combo",
    },
]);
const Cancel = () => {
    emit("closeModalPromotion");
};
const apply = () => {
    console.log("selectedItemList: ", selectedItemList.value);
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
