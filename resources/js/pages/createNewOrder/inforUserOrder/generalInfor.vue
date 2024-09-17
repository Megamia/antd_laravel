<template>
  <div class="mainGeneralInfor">
    <div class="content">
      <div class="name">
        <span class="nameData">Họ và tên</span>
        <span class="data">{{ dataUserOrder.name }}</span>
      </div>
      <div class="phoneNumber">
        <span class="nameData">Số điện thoại</span>
        <span class="data">{{ dataUserOrder.phoneNumber }}</span>
      </div>
      <div class="email">
        <span class="nameData">Email</span>
        <span class="data">{{ dataUserOrder.email }}</span>
      </div>
      <div class="text">
        <span class="nameData">Tên trường text</span>
        <span class="data">{{
          dataUserOrder.text ? dataUserOrder.text : "Chưa có dữ liệu"
        }}</span>
      </div>
      <div class="number">
        <span class="nameData">Tên trường số</span>
        <span class="data">{{
          dataUserOrder.text ? dataUserOrder.phoneNumber : "Chưa có dữ liệu"
        }}</span>
      </div>
      <div class="time">
        <span class="nameData">Tên trường thời gian</span>
        <span class="data">{{
          dataUserOrder.text ? dataUserOrder.date : "Chưa có dữ liệu"
        }}</span>
      </div>
      <div class="dropList">
        <span class="nameData">Tên trường dropdown list</span>
        <span class="data">{{
          dataUserOrder.text ? dataUserOrder.dropDown : "Chưa có dữ liệu"
        }}</span>
      </div>
      <div class="checkBox">
        <span class="nameData">Tên trường checkbox</span>
        <span class="data">{{
          dataUserOrder.text ? dataUserOrder.checkBox : "Chưa có dữ liệu"
        }}</span>
      </div>
      <div class="address">
        <span class="nameData">Tên trường địa chỉ</span>
        <span class="data">{{
          dataUserOrder.text ? dataUserOrder.address : "Chưa có dữ liệu"
        }}</span>
      </div>
      <div class="phone">
        <span class="nameData">Tên trường số điện thoại</span>
        <span class="data">{{
          dataUserOrder.text ? dataUserOrder.number : "Chưa có dữ liệu"
        }}</span>
      </div>
      <div class="mail">
        <span class="nameData">Trường email</span>
        <span class="data">{{
          dataUserOrder.text ? dataUserOrder.email2 : "Chưa có dữ liệu"
        }}</span>
      </div>
    </div>
  </div>
</template>
<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import store from "../../../store";

const dataUserOrder = ref("");
const dataAddress = ref("");
const fetchData = async () => {
  if (store.state.address.dataAddress && store.state.address.dataAddress != null) {
    try {
      const response = await axios.post(
        `${import.meta.env.VITE_APP_URL_API}/getDataUser`,
        {
          idAddress: store.state.address.dataAddress.id,
        }
      );
      if (response.data.status === 1) {
        dataUserOrder.value = response.data.getDataUser;
        dataAddress.value = response.data.getDataAddress;
      } else {
        console.log("Lỗi khi lấy thông tin của user");
      }
    } catch (e) {
      console.log("Error: ", e);
    }
  } else {
    alert("Chưa chọn địa chỉ");
    return;
  }
};
onMounted(() => fetchData());
</script>

<style scoped>
.mainGeneralInfor {
  display: flex;
  flex: 1;
  flex-direction: column;
  background-color: white;

  .content {
    display: flex;
    flex: 1;
    flex-direction: column;

    .name,
    .phoneNumber,
    .email,
    .text,
    .number,
    .time,
    .dropList,
    .checkBox,
    .address,
    .phone,
    .mail {
      display: flex;
      flex: 1;

      span {
        font-size: 14px;
        padding-inline: 10px;
        padding-block: 12px;
      }

      .nameData {
        display: flex;
        flex: 2;
        color: #00000073;
      }

      .data {
        display: flex;
        flex: 3;
        font-weight: bold;
      }
    }

    .number,
    .dropList,
    .address {
      background-color: #fafafa;
    }
  }
}
</style>
