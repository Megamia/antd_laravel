<template>
    <div class="main">
        <div class="titlePage">
            <h1>Tạo mới đơn hàng</h1>
        </div>
        <div class="inforUserDiv">
            <div class="title">
                <span class="inforText"> Thông tin khách hàng </span>
                <span class="uncheckedText" @click="uncheckedText">
                    Bỏ chọn</span
                >
            </div>
            <div class="inforUserOrder">
                <inforUserOrder />
            </div>
        </div>
        <div class="productOrderDiv">
            <inforOrder />
        </div>
    </div>
</template>

<script setup>
import inforUserOrder from "./inforUserOrder/inforUserOrder.vue";
import inforOrder from "./inforOrder/inforOrder.vue";
import { AkChevronDownSmall } from "@kalimahapps/vue-icons";

const uncheckedText = () => {
    alert("Ai cho bỏ mà bỏ");
};
</script>

<style scoped>
.main {
    display: flex;
    flex: 1;
    flex-direction: column;
    background-color: #f0f2f5;
    gap: 20px;
    .titlePage {
        background-color: white;
        box-shadow: rgba(0, 0, 0, 0.35) 0px 0px 8px;
        text-align: center;
        h1 {
            padding-top: 15px;
            font-size: 20px;
            font-weight: bold;
        }
    }
    .inforUserDiv {
        display: flex;
        flex-direction: column;
        background-color: white;
        padding-block: 20px;

        .title {
            display: flex;
            flex-direction: row;
            flex: 1;
            border-bottom: 1px solid #f0f0f0;
            padding-bottom: 20px;
            padding-inline: 10px;

            span {
                font-size: 16px;
            }
            .inforText {
                font-weight: bold;
                display: flex;
                flex: 1;
            }
            .uncheckedText {
                display: flex;
                justify-content: end;
                color: red;
            }
            .showProduct {
                padding-inline-end: 10px;
            }
        }
        .inforUserOrder {
            display: flex;
        }
    }
    .productOrderDiv {
        display: flex;
        flex-direction: column;
        background-color: white;
        padding-block: 20px;
        border-bottom: 1px solid #8c8c8c;
    }
}
</style>
