<template>
    <div class="mainCreateNewOrderLayout">
        <div class="title">
            <h1>Tạo mới đơn hàng</h1>
        </div>
        <div class="inforUserOrderDiv">
            <inforUserOrder />
        </div>
        <div class="productOrderDiv">
            <inforOrder />
        </div>
    </div>
</template>

<script setup>
import inforUserOrder from "./inforUserOrder/inforUserOrder.vue";
import inforOrder from "./inforOrder/inforOrder.vue";
</script>

<style scoped>
.mainCreateNewOrderLayout {
    display: flex;
    flex: 1;
    flex-direction: column;
    background-color: #f0f2f5;
    gap: 20px;

    .title {
        background-color: white;
        box-shadow: rgba(0, 0, 0, 0.35) 0px 0px 8px;
        text-align: center;
        h1 {
            padding-top: 15px;
            font-size: 20px;
            font-weight: bold;
        }
    }
    .inforUserOrderDiv {
    }
    .productOrderDiv {
    }
}
</style>
