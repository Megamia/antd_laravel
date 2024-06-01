<template>
    <div class="mainShippingMethod" @click="nothing">
        <div class="title">
            <span class="titleTextUp">Phương thức vận chuyển</span>
            <span class="titleTextDown">Nhận hàng trực tiếp</span>
        </div>
        <div class="icon">
            <span>
                <AkChevronRight />
            </span>
        </div>
    </div>
</template>
<script setup>
import { AkChevronRight } from "@kalimahapps/vue-icons";

const nothing = () => {
    alert("Chưa xử lý sự kiện này");
};
</script>

<style scoped>
.mainShippingMethod {
    background-color: white;
    display: flex;
    flex: 1;
    flex-direction: row;
    padding: 10px;

    .title {
        display: flex;
        flex: 1;
        flex-direction: column;
        gap: 10px;

        .titleTextUp {
            font-size: 16px;
            font-weight: 500;
        }

        .titleTextDown {
            font-size: 14px;
            color: #00000073;
            font-weight: 400;
        }
    }

    .icon {
        display: flex;
        flex: 1;
        justify-content: end;
        align-items: center;
        color: #00000073
    }
}
</style>
