<template>
    <transition name="modal">
        <div class="modal-mask">
            <div class="modal-wrapper" @click.self="Cancel">
                <div class="modal-container">
                    <div class="title">
                        <span> Khuyến mãi </span>
                    </div>
                    <div class="content">
                        <div class="buttonSelection">
                            <a-button
                                @click="handleButtonChange('order')"
                                :class="{ act: currentSelection === 'order' }"
                                >Theo đơn hàng</a-button
                            >
                            <a-button
                                @click="handleButtonChange('product')"
                                :class="{ act: currentSelection === 'product' }"
                                >Theo sản phẩm</a-button
                            >
                        </div>

                        <div
                            class="itemOrder"
                            v-if="currentSelection === 'order'"
                        >
                            <a-checkbox-group
                                v-model:value="slt"
                                style="
                                    width: 100%;
                                    display: flex;
                                    flex-direction: column;
                                    gap: 10px;
                                "
                            >
                                <span class="titleItem">
                                    Danh sách khuyến mãi</span
                                >

                                <div
                                    class="detailItem"
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
import { ref, defineEmits, onMounted, defineProps } from "vue";
import axios from "axios";

const emit = defineEmits(["closeModalPromotion", "valueInModalPromotion"]);
const currentSelection = ref("order");

const props = defineProps({
    sltedId: Object,
});
const fetchData = async () => {
    try {
        const response = await axios.get(
            `${import.meta.env.VITE_APP_URL_API}/dataValueVoucherPromotion`
        );
        listPromotion.value = response.data.dataValueVoucherPromotion;
        if (props.sltedId && Object.keys(props.sltedId).length > 0) {
            slt.value = props.sltedId;
            // console.log("slt.value: ", slt.value);
            // console.log("props.sltedId: ", props.sltedId);
        } else {
            // console.log("no props");
        }
        // console.log(Object.keys(props.sltedId).length);
        // const a = ref([]);
        // for (
        //     let i = 0;
        //     i < Object.keys(response.data.dataValueVoucherPromotion).length;
        //     i++
        // ) {
        //     a.value.push(response.data.dataValueVoucherPromotion[i].id);
        //     console.log("listPromotion:", response.data.dataValueVoucherPromotion[i].id);
        // }
        // console.log("a: ", a.value.toString());
        // slt.value = a.value;

        if (response.data.status === 1) {
            // console.log("listPromotion: ", listPromotion.value);
        } else if (response.data.status === 0) {
            // console.log("listPromotion: ", listPromotion.value);
        }
    } catch (e) {
        console.log("Error: ", e);
    }
};

onMounted(() => fetchData());

const aVl = ref([]);
const handleButtonChange = (value) => {
    currentSelection.value = value;
};
const slt = ref([1]);
const listPromotion = ref([]);
const Cancel = () => {
    emit("closeModalPromotion");
};
const apply = async () => {
    try {
        const response = await axios.post(
            `${import.meta.env.VITE_APP_URL_API}/chooseVoucherPromotion`,
            {
                id: slt.value,
            }
        );

        if (response.data.status === 1) {
            // console.log("dataVouchersPromotion: ", response.data.dataVouchersPromotion);
        } else {
            // console.log("dataVouchersPromotion: ", response.data.dataVouchersPromotion);
        }
        let total = 0;
        for (let i = 0; i < response.data.chooseVoucherPromotion.length; i++) {
            total += parseFloat(response.data.chooseVoucherPromotion[i].value);
        }
        // console.log(
        //     "total: " + total,
        //     "\n",
        //     "id các item đã chọn: ",
        //     slt.value
        // );

        emit("valueInModalPromotion", total.toFixed(3), slt.value);
        // console.log(response.data.dataVouchersPromotion);
        // emit("closeModalPromotion");
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
        input {
            padding: 10px;
            border: 1px solid #d9d9dd;
        }
        .buttonSelection {
            display: flex;
            flex: 1;
            gap: 10px;
            button {
                display: flex;
                flex: 1;
                align-items: center;
                justify-content: center;
                border-radius: 1px;
                padding: 4px 15px;
            }

            .act {
                color: #4096ff;
                border-color: #4096ff;
            }
        }
        .itemOrder {
            display: flex;
            flex: 1;
            flex-direction: column;
            padding-top: 10px;
            .titleItem {
                font-size: 14px;
                font-weight: bold;
            }
            .detailItem {
                display: flex;
                gap: 10px;
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
