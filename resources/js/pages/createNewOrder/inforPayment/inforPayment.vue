<template>
    <div class="mainInforPayment">
        <div class="title">
            <a-image
                :width="20"
                :height="20"
                src="https://s3-alpha-sig.figma.com/img/ae60/71b5/d9cf2f0acaf1b3b98a0e1097490e64ef?Expires=1717977600&Key-Pair-Id=APKAQ4GOSFWCVNEHN3O4&Signature=bGOWMCjB61PaZvMUsEicVMqPgJM8pcUVciasFaAEn~VvBlikGVj-UFpdyYskbD6FKFNH~lRntJbJFjgbyYdVZkkrzZ5nwXUJ82zf0Y9nUnejC~wAcyq6YnKtpy-nbiJ5pu4oO46IkXqNU6wjnPCvcbOhr3iH1GET26PQE-4muYRFh6y8dDdYpe5OdKCS1Jq0tCLlwZh0c14MXZjr12qHPgB08zDU4oUItbDZH4-IIxfoGoX0fwrYxgrLAG76mPm430sOWea~V2sqqI4ojPRAZVVDBBDklBeXkkgU6Pc6CZwhgwKXfDT2qJPOnBgpV3qIfexWrJA2Agx7-IyymlLo5Q__"
            />
            <span>Thông tin thanh toán</span>
        </div>
        <div class="typePayment">
            <div class="selectType">
                <span>Hình thức</span>
                <span @click="closeModalPayment" class="choosePaymentMethod">
                    {{ valuePayment ? valuePayment : "Chọn hình thức" }}
                    <AkChevronRight v-if="!valuePayment" />
                </span>
            </div>
            <modalPayment
                v-if="isModalPayment"
                @close-modal-payment="closeModalPayment"
                @value-in-modal-payment="valueInModalPayment"
            />
            <div class="statusPayment selectType">
                <span>Đã thanh toán</span>
                <span class="isPaid"
                    ><a-switch v-model:checked="checked"
                /></span>
            </div>
            <div class="source">
                <span>Nguồn đơn</span>
                <span class="sell">Bán hàng</span>
            </div>
        </div>
    </div>
</template>
<script setup>
import { AkChevronRight } from "@kalimahapps/vue-icons";
import modalPayment from "./detail/modalPayment.vue";
import { ref } from "vue";

const checked = ref(false);

//ModalPayment
const isModalPayment = ref(false);
const valuePayment = ref("");

const closeModalPayment = () => {
    isModalPayment.value = !isModalPayment.value;
};
const valueInModalPayment = (data) => {
    isModalPayment.value = !isModalPayment.value;
    valuePayment.value = data;
};

//ModalPayment

const nothing = () => {
    alert("Chưa xử lý sự kiện này");
};
</script>

<style scoped>
.mainInforPayment {
    display: flex;
    flex: 1;
    flex-direction: column;
    background-color: white;

    .title {
        display: flex;
        flex-direction: row;
        flex: 1;
        align-items: end;
        gap: 5px;
        border-bottom: 1px solid #d9d9d9;
        padding: 10px;

        span {
            font-weight: bold;
            font-size: 16px;
        }
    }

    .typePayment {
        display: flex;
        flex: 1;
        flex-direction: column;
        padding-inline: 10px;

        .selectType,
        .statusPayment,
        .source {
            display: flex;
            flex: 1;
            padding-block: 10px;

            span {
                display: flex;
                align-items: center;
            }

            .choosePaymentMethod,
            .isPaid,
            .sell {
                display: flex;
                flex: 1;
                justify-content: end;
                color: #00000073;
                gap: 5px;
            }
        }

        .selectType {
            border-bottom: 1px solid #d9d9d9;
        }
        .source {
            border: 0;
        }
    }
}
</style>
