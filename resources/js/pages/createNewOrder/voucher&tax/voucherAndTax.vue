<template>
    <div class="mainVoucherAndTax">
        <!-- <div class="voucher" @click="nothing"> -->
            <RouterLink to="/detailVoucher" class="voucher">
                <span class="name">Giảm giá</span>
                <span class="cost"> -30.000đ <AkChevronRight /></span>
            </RouterLink>
        <!-- </div> -->
        <div class="ship" @click="nothing">
            <span class="name">Phí ship</span>
            <span class="cost"> 20.000đ <AkChevronRight /></span>
        </div>
        <div class="VAT" @click="nothing">
            <span class="name">Thuế VAT (10%)</span>
            <span class="cost"> 2.000đ <AkChevronRight /></span>
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
.mainVoucherAndTax {
    background-color: white;
    display: flex;
    flex: 1;
    flex-direction: column;

    .voucher,
    .ship,
    .VAT {
        padding: 10px;
        display: flex;
        flex: 1;
        flex-direction: row;
        text-align: center;
        border-bottom: 1px solid #0000000f;
        color:black;
        text-decoration: none;
        span {
            display: flex;
            align-items: center;
            svg {
                align-items: center;
            }
        }
        .name {
            display: flex;
            font-size: 14px;
        }
        .cost {
            display: flex;
            flex: 1;
            justify-content: end;
            gap: 8px;
            font-size: 14px;
        }
    }
}
</style>
