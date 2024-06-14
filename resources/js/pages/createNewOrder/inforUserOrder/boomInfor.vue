<template>
    <div class="mainBoomInfor">
        <div class="content">
            <div class="name">
                <span
                    >{{ dataUserOrder.name }} |
                    {{ dataUserOrder.phoneNumber }}</span
                >
            </div>
            <div class="boomRate">
                <span>{{ boomRate }} shop đánh giá boom hàng</span>
            </div>
            <div class="levelWarning">
                <span>Cảnh báo cấp {{ levelWarning }}</span>
            </div>
            <div class="orderRate">
                <div class="border">
                    <span class="nameOrder">Đơn mua</span>
                    <span class="number">{{ ordered }}</span>
                </div>
                <div class="border">
                    <span class="nameOrder">Đơn hủy</span>
                    <span class="number">{{ orderCancelled }}</span>
                </div>
                <div class="border">
                    <span class="nameOrder">Tỷ lệ hủy</span>
                    <span class="number">{{ cancelRate }}%</span>
                </div>
            </div>
            <div class="address">
                <div class="quantityAddress">
                    <span>
                        <AkLocation />
                        {{ quantityAddress }} địa chỉ giao hàng
                    </span>
                </div>
                <div class="address" v-for="data in address" :key="data.id">
                    <span>{{ data.data }}</span>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { AkLocation } from "@kalimahapps/vue-icons";
import { ref, onMounted } from "vue";
import axios from "axios";

const dataUserOrder = ref("");
const boomRate = ref("5");
const levelWarning = ref("3");
const ordered = ref("100");
const orderCancelled = ref("5");
const cancelRate = ref("5");
const quantityAddress = ref("5");

const address = ref([
    { id: 1, data: "Số 94, Đường Cao Lỗ, Phường 4, Quận 8, TP. Hồ Chí Minh" },
    {
        id: 2,
        data: "115 ngõ 120, phố Dương Văn Bé, Vĩnh Tuy, Hai Bà Trưng, HN",
    },
    { id: 3, data: "85 Vũ Trọng Phụng, Phường Thanh Xuân Trung, Hà Nội" },
    { id: 4, data: "askjdbckqwjfbklwqd" },
    { id: 5, data: "klwdqlskab kqd" },
]);
const fetchData = async () => {
    try {
        const response = await axios.get(
            `${import.meta.env.VITE_APP_URL_API}/dataUserOrder`
        );
        if (response.data.status === 1) {
            dataUserOrder.value = response.data.dataUserOrder;
        } else {
            console.log("Faile");
        }
    } catch (e) {
        console.log("Error: ", e);
    }
};
onMounted(() => fetchData());
</script>

<style scoped>
.mainBoomInfor {
    display: flex;
    flex: 1;
    flex-direction: column;
    background-color: white;
    .content {
        display: flex;
        flex: 1;
        flex-direction: column;
    }
}
</style>
