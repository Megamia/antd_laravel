<template>
    <div class="mainBoomInfor">
        <div class="content">
            <div class="name">
                <span>{{ dataUserOrder.name }} |
                    {{ dataUserOrder.phoneNumber }}</span>
            </div>
            <div class="boomRate">
                <div class="boomRateDiv">
                    <span class="boomRateSpan">{{ boomRate }} shop đánh giá boom hàng</span>
                </div>
                <div class="levelWaringDiv">
                    <span class="levelWaringSpan">Cảnh báo cấp {{ levelWarning }}</span>
                </div>
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
                    <span class="number cancelRateSpan">{{ cancelRate }}%</span>
                </div>
            </div>
            <div class="address">
                <div class="quantityAddress">
                    <span>
                        <AkLocation />
                        {{ quantityAddress }} địa chỉ giao hàng
                    </span>
                </div>
                <div class="detailAddress" >
                    <span v-for="data in address" :key="data.id"> {{ data.data }}</span>
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
    { id: 6, data: "wdsqwqww kqd" },
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
        flex-direction: column;
        padding: 20px;
        gap: 20px;

        .name {
            color: black;
            font-weight: bold;
            font-size: 14px;
        }

        .boomRate {
            display: flex;
            flex-direction: column;
            gap: 10px;

            .boomRateDiv,
            .levelWaringDiv {
                display: flex;
                font-size: 12px;
            }

            .boomRateSpan {
                padding: 8px;
                background-color: #FFCCC7;
                border-radius: 4px;
            }

            .levelWaringSpan {
                padding: 8px;
                background-color: #FFF1B8;
                border-radius: 4px;
            }
        }

        .orderRate {
            display: flex;
            flex: 1;
            flex-direction: row;
            gap: 15px;

            .border {
                display: flex;
                flex: 1;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                gap: 10px;
                border: 1px solid #d9d9d9;
                border-radius: 4px;
                padding: 8px;

                .nameOrder {
                    font-size: 12px;
                }

                .number {
                    font-size: 14px;
                    font-weight: bold;
                }

                .cancelRateSpan {
                    color: #FF4D4F;
                }
            }
        }
        .address{
            display: flex;
            flex:1;
            flex-direction: column;
            gap:20px;
            .quantityAddress{
                display: flex;
                flex:1;
                flex-direction: row;
                align-items:center ;
                span{
                    display: flex;
                    flex:1;
                    flex-direction: row;
                    gap:10px;
                    svg{
                        display: flex;
                        color:#1890FF;
                    }
                }
            }
            .detailAddress{
                display: flex;
                flex:1;
                flex-direction: column;
                padding-inline: 25px;
                gap:20px;
                font-size: 14px;
                color: #00000073;
            }
        }
    }
}
</style>
