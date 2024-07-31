<template>
    <div class="mainDetailInforUserOrder" v-if="isUser">
        <div class="detailInforUser">
            <div class="nameUser">
                <span>
                    {{
                        dataUserOrder.name
                            ? dataUserOrder.name
                            : dataUserOrder.data.name
                    }}
                    |
                    {{
                        dataUserOrder.phoneNumber
                            ? dataUserOrder.phoneNumber
                            : dataUserOrder.data.phoneNumber
                    }}</span
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
            <ModalInforUserOrder
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
                    <span @click="swapAddress"> Đổi địa chỉ</span>
                </div>
            </div>
            <div class="nameUser">
                <span>
                    {{ displayData.name }} | {{ displayData.phoneNumber }}
                </span>
            </div>
            <div class="detailAddress">
                {{
                    displayData.address
                        ? `${displayData.address}, ${
                              displayData.ward || "Ward"
                          }, ${displayData.district || "District"}, ${
                              displayData.city || "City"
                          }`
                        : "Chưa có thông tin"
                }}
            </div>
        </div>
    </div>
    <div class="guest" v-if="isGuest">
        <span> Khách lẻ </span>
    </div>
</template>
<script setup>
import { ref, onMounted, defineEmits, computed } from "vue";
import ModalInforUserOrder from "./ModalInforUserOrder.vue";
import { useRouter } from "vue-router";
import eventBus from "../../../eventBus";

const emit = defineEmits(["fet"]);

const dataUserOrder = ref("");
const isUser = ref(null);
const isGuest = ref(null);
const isShowModalInforUser = ref(false);
const checkShow = ref(false);
const router = useRouter();

const displayData = computed(() => {
    return eventBus.id ? dataUserOrder.value.address : dataUserOrder.value;
});
const swapAddress = () => {
    router.push({
        name: "SwapAddress",
        params: { id: dataUserOrder.value.id },
    });
};

const showModalInforUser = async () => {
    await fetchData();
    if (checkShow.value) {
        isShowModalInforUser.value = true;
    } else {
        isShowModalInforUser.value = false;
        alert("Vui lòng chọn lại user");
        emit("fet");
    }
    return;
};

const closeModal = () => {
    isShowModalInforUser.value = false;
};

const fetchData = async () => {
    try {
        if (eventBus.id) {
            const response = await axios.post(
                `${import.meta.env.VITE_APP_URL_API}/newDataUserOrderAfterSwap`,
                {
                    id: eventBus.id,
                }
            );
            if (response.data.status === 1) {
                if (response.data.dataUserOrder != "guest") {
                    dataUserOrder.value = response.data.dataUserOrder;
                    isGuest.value = false;
                    isUser.value = true;
                } else {
                    dataUserOrder.value = response.data.dataUserOrder;
                    isGuest.value = true;
                    isUser.value = false;
                }
                checkShow.value = true;
                // console.log(response.data.dataUserOrder);
            } else if (response.data.status === 0) {
                checkShow.value = false;
            }
        } else {
            const response = await axios.get(
                `${import.meta.env.VITE_APP_URL_API}/dataUserOrder`
            );
            // console.log("Data: ", response.data);
            if (response.data.status === 1) {
                if (response.data.dataUserOrder != "guest") {
                    dataUserOrder.value = response.data.dataUserOrder;
                    isGuest.value = false;
                    isUser.value = true;
                } else {
                    dataUserOrder.value = response.data.dataUserOrder;
                    isGuest.value = true;
                    isUser.value = false;
                }
                checkShow.value = true;
            } else if (response.data.status === 0) {
                checkShow.value = false;
            }
            return;
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
