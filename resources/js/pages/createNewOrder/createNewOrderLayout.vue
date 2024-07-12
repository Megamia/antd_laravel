<template>
  <div class="mainCreateNewOrderLayout">
    <div class="title">
      <h1>Tạo mới đơn hàng</h1>
    </div>
    <div class="userOrder">
      <userOrder />
    </div>

    <div class="productOrderDiv">
      <inforOrder @show="showOrHidden" @showModal="ClickShowModal" />
      <modalCostOrder v-if="showModal" @showModal="ClickShowModal" />
    </div>
    <div class="voucherAndTax">
      <voucherAndTax />
    </div>
    <div class="noteOrder">
      <noteOrder />
    </div>
    <div class="inforPayment">
      <inforPayment />
    </div>
    <div class="shippingMethod">
      <shippingMethod />
    </div>
    <div class="anthoerInfor">
      <anthoerInfor v-if="isOpen" />
    </div>
    <div class="costOrder">
      <costOrder />
      <div style="height: 1000px; width: 100%" />
    </div>
  </div>
</template>

<script setup>
import userOrder from "./inforUserOrder/userOrder.vue";
import inforOrder from "./inforOrder/inforOrder.vue";
import voucherAndTax from "./voucher&tax/voucherAndTax.vue";
import noteOrder from "./note/noteOrder.vue";
import inforPayment from "./inforPayment/inforPayment.vue";
import shippingMethod from "./shippingMethod/shippingMethod.vue";
import anthoerInfor from "./anthoerInfor/anotherInfor.vue";
import costOrder from "./costOrder/costOrder.vue";
import modalCostOrder from "./inforOrder/modalCostOrder.vue";

import { ref } from "vue";
// import axios from "axios";
const isOpen = ref(true);
const showModal = ref(false);
const showOrHidden = () => {
  isOpen.value = !isOpen.value;
};
const ClickShowModal = () => {
  showModal.value = !showModal.value;
};

// const fetchData = async () => {
//   try {
//     const response = await axios.get(`${import.meta.env.VITE_APP_URL_API}/dataUserOrder`);
//     console.log(response.data);
//     if (response.data.status === 1) {
//       //   isChoose.value = false;
//       console.log("Tiếp tục");
//     } else {
//       // alert("Vui lòng chọn lại");
//       //   isChoose.value = true;
//       console.log("Dừng");
//     }
//   } catch (e) {
//     console.log("Error: ", e);
//   }
// };
// onMounted(() => fetchData());
</script>

<style scoped>
.mainCreateNewOrderLayout {
  display: flex;
  flex: 1;
  height: 100%;
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
}
</style>
