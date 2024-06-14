<template>
    <div class="mainDetailInforUserOrder" v-if="isUser">
        <div class="detailInforUser">
            <div class="nameUser">
                <span>
                    {{ dataUserOrder.name }} |
                    {{ dataUserOrder.phoneNumber }}</span
                >
            </div>
            <div class="totalInforOrderUser">
                <div class="order ordered">
                    <span class="upText">Đơn mua</span>
                    <span class="downText">100</span>
                </div>
                <div class="order cancelOrder">
                    <span class="upText">Đơn hủy</span>
                    <span class="downText">5</span>
                </div>
                <div class="order">
                    <span class="upText">Tỷ lệ hủy</span>
                    <span class="downText canceledRate">5%</span>
                </div>
            </div>
            <div class="seeMoreDiv">
                <span class="seeMoreText" @click="showModalInforUser">
                    Xem thêm
                </span>
            </div>
            <modalInforUserOrder
                v-if="isShowModalInforUser"
                @closeModal="closeModal"
            />
        </div>
        <div class="addressUserDiv">
            <div class="inforAddress">
                <div class="inforAddressText">
                    <span>Thông tin giao hàng</span>
                </div>
                <div class="swapAddress">
                    <span> Đổi địa chỉ</span>
                </div>
            </div>
            <div class="nameUser">
                <span>
                    {{ dataUserOrder.name }} |
                    {{ dataUserOrder.phoneNumber }}</span
                >
            </div>
            <div class="detailAddress">
                {{ dataUserOrder.address ? "" : "Chưa có thông tin" }}
            </div>
        </div>
    </div>
    <div class="guest" v-if="isGuest">
        <span> Khách lẻ </span>
    </div>
</template>
<script setup>
import { ref, onMounted, defineEmits } from "vue";
import modalInforUserOrder from "./modalInforUserOrder.vue";

const emit = defineEmits(["fetchData1"]);

const dataUserOrder = ref({
    name: "",
    phoneNumber: "",
    email: "",
    text: "",
    number: "",
    date: "",
    dropDown: "",
    checkBox: "",
    address: "",
    email2: "",
});
const isUser = ref(null);
const isGuest = ref(null);
const isShowModalInforUser = ref(false);
const checkShow = ref(false);
const showModalInforUser = () => {
    fetchData();
    if (checkShow.value === true) {
        isShowModalInforUser.value = true;
    } else {
        console.log("Vui lòng chọn lại user");
        emit("fetchData1");
    }
};

const closeModal = () => {
    isShowModalInforUser.value = false;
};

const fetchData = async () => {
    try {
        const response = await axios.get(
            `${import.meta.env.VITE_APP_URL_API}/dataUserOrder`
        );
        if (response.data.status === 1) {
            if (response.data.dataUserOrder != "guest") {
                dataUserOrder.value = response.data.dataUserOrder;
                isGuest.value = false;
                isUser.value = true;
                // console.log(dataUserOrder.value);
            } else {
                dataUserOrder.value = response.data.dataUserOrder;
                isGuest.value = true;
                isUser.value = false;
                // console.log(dataUserOrder.value);
            }
            checkShow.value = true;
        } else {
            checkShow.value = false;
        }
    } catch (e) {
        console.log("Error: ", e);
    }
};

onMounted(() => fetchData());
</script>

<style scoped>
.mainDetailInforUserOrder,
.guest {
    display: flex;
    flex-direction: column;
    flex: 1;
    background-color: white !important;
    padding-block: 10px;
    border-top: 1px solid #d9d9d9;
    .title {
        display: flex;
        flex: 1;
        padding: 0px 10px 10px;
        border-bottom: 2px solid #f0f0f0;
        .inforText {
            font-size: 16px;
            font-weight: bold;
            justify-content: start;
        }
        .uncheckedText {
            display: flex;
            flex: 1;
            justify-content: end;
            font-size: 14px;
            color: red;
        }
    }
    .detailInforUser {
        border-bottom: 2px solid #f0f0f0;
        display: flex;
        flex-direction: column;
        margin-inline: 10px;
        .nameUser {
            padding-block: 10px;
            font-size: 14px;
            font-weight: 600;
        }
        .totalInforOrderUser {
            display: flex;
            flex-direction: row;
            flex: 1;
            justify-content: space-between;
            .order {
                padding-inline: 10px;

                flex: 1;
                gap: 10px;
                display: flex;
                flex-direction: column;

                .upText {
                    color: #8c8c8c;
                }
                .downText {
                    color: black;
                    font-weight: 600;
                }
                .canceledRate {
                    color: red;
                }
            }
            .ordered {
                padding-inline: 0;
            }
            .cancelOrder {
                border-inline: 2px solid #f0f0f0;
            }
        }
        .seeMoreDiv {
            padding-block: 10px;
            .seeMoreText {
                color: #1890ff;
            }
        }
    }
    .addressUserDiv {
        padding-inline: 10px;
        color: #8c8c8c;
        .inforAddress {
            display: flex;
            flex: 1;
            flex-direction: row;
            padding-block: 10px;
            .inforAddressText {
                span {
                    font-size: 12px;
                    font-weight: bold;
                    color: black;
                }
            }
            .swapAddress {
                display: flex;
                flex: 1;
                justify-content: end;
                color: #1890ff;
                font-size: 12px;
            }
        }
        .nameUser {
            padding-block: 10px;
            font-size: 14px;
            font-weight: 400;
            color: black;
        }
    }
}
.guest {
    span {
        padding-inline: 10px;
        font-size: 14px;
        color: #000000d9;
    }
}
</style>
