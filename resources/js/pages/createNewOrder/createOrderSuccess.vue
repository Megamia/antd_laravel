<template>
    <div class="mainCreateOrderSuccess">
        <div class="content">
            <div class="detail">
                <GlStatusSuccess />

                <span class="titleText"> Tạo đơn hàng thành công </span>
                <span class="message"
                    >Vui lòng truy cập trên website để xem chi tiết đơn
                    hàng</span
                >
            </div>
            <div class="button" @click="createNewOrder">
                <a-button type="primary">
                    <CaAddAlt />Tạo đơn hàng mới</a-button
                >
            </div>
        </div>
    </div>
</template>
<script setup>
import { GlStatusSuccess, CaAddAlt } from "@kalimahapps/vue-icons";
import { useRouter } from "vue-router";
// import eventBus from "../../eventBus";
const router = useRouter();

const createNewOrder = () => {
    router.push("/");
};
</script>

<style scoped>
.mainCreateOrderSuccess {
    display: flex;
    flex: 1;
    height: 100vh;
    flex-direction: column;
    background-color: white;
    justify-content: center;
    align-items: center;
    .content {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 20px;
        .detail {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
            svg {
                font-size: 52px;
                color: #52c41a;
            }
            .titleText {
                font-size: 20px;
                line-height: 28px;
                font-weight: bold;
            }
            .message {
                font-size: 13px;
                color: #999999;
            }
        }
        .button {
            display: flex;
            flex: 1;
            button {
                display: flex;
                flex: 1;
                align-items: center;
                gap: 8px;
                border-radius: 2px;
                padding: 4px 15px 4px 15px;
            }
        }
    }
}
</style>
