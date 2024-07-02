<template>
    <div class="mainDetailVoucher">
        <div class="title">
            <AnOutlinedArrowLeft @click="back" />
            <span> Giảm giá </span>
        </div>
        <div class="content">
            <div class="inputCode itemContent" @click="showModalCode">
                <div class="left">
                    <img
                        src="../../../../../../public/img/c6d6ecaa5187c8e181b28cfcb4ddbf3b.png"
                        class="img"
                    />
                    <span>Mã ưu đãi/ Coupon</span>
                </div>
                <div class="right">
                    <span>Nhập mã <AkChevronRightSmall /></span>
                </div>
            </div>
            <modalCode
                v-if="isShowModalCode"
                @close-modal-code="showModalCode"
            />
            <div class="inputDiscount itemContent" @click="showModalDiscount">
                <div class="left">
                    <span>Chiết khấu</span>
                </div>
                <div class="right">
                    <span>Nhập chiết khấu <AkChevronRightSmall /></span>
                </div>
            </div>
            <modalDiscount
                v-if="isShowModalDiscount"
                @close-modal-discount="showModalDiscount"
            />
            <div class="inputPromotion itemContent" @click="showModalPromotion">
                <div class="left">
                    <span>Khuyến mãi</span>
                </div>
                <div class="right">
                    <span>Chọn mã <AkChevronRightSmall /></span>
                </div>
            </div>
            <modalPromotion
                v-if="isShowModalPromotion"
                @close-modal-promotion="showModalPromotion"
            />
        </div>
    </div>
</template>
<script setup>
import { useRouter } from "vue-router";
import {
    AnOutlinedArrowLeft,
    AkChevronRightSmall,
} from "@kalimahapps/vue-icons";
import modalCode from "./modalCode.vue";
import modalDiscount from "./modalDiscount.vue";
import modalPromotion from "./modalPromotion.vue";
import { ref } from "vue";

const router = useRouter();

const back = () => {
    router.back();
};

const isShowModalCode = ref(false);

const showModalCode = () => {
    isShowModalCode.value = !isShowModalCode.value;
};

const isShowModalDiscount = ref(false);

const showModalDiscount = () => {
    isShowModalDiscount.value = !isShowModalDiscount.value;
};

const isShowModalPromotion = ref(false);

const showModalPromotion = () => {
    isShowModalPromotion.value = !isShowModalPromotion.value;
};
</script>

<style scoped>
.mainDetailVoucher {
    display: flex;
    flex: 1;
    flex-direction: column;
    background-color: #f0f2f5;
    gap: 20px;

    .title {
        background-color: white;
        display: flex;
        padding: 16px 36px 16px 12px;
        align-items: center;

        svg {
            position: relative;
            font-size: 25px;
        }

        span {
            font-size: 20px;
            line-height: 28px;
            font-weight: bold;
            display: flex;
            flex: 1;
            justify-content: center;
        }
    }
    .content {
        display: flex;
        flex-direction: column;
        background-color: white;
        .itemContent {
            border-bottom: 1px solid #d9d9d9;
            display: flex;
            flex: 1;
            justify-content: space-between;
            align-items: center;
            padding: 12px;
            font-size: 14px;
            line-height: 22px;
        }
        .inputCode,
        .inputDiscount,
        .inputPromotion {
            .left {
                gap: 10px;
                display: flex;
                align-items: center;
                img {
                    width: 20px;
                    height: 20px;
                }
            }
            .right {
                display: flex;
                align-items: center;
                color: #00000073;
                span {
                    display: flex;
                    align-items: center;
                }
            }
        }
    }
}
</style>
