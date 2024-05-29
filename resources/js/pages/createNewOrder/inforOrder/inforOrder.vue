<template>
    <div class="mainInforOrder">
        <div class="title">
            <span class="inforText"> Sản phẩm </span>
            <span class="showProduct">
                <AkChevronDownSmall />
            </span>
        </div>
    </div>
</template>

<script setup>
import { AkChevronDownSmall } from "@kalimahapps/vue-icons";
</script>
<style scoped>
.mainInforOrder {
    .title {
        display: flex;
        flex-direction: row;
        flex: 1;
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
    .inforOrder {
        display: flex;
        margin-bottom: -10px;
    }
}
</style>
