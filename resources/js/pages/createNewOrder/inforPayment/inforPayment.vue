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
                <span> Chọn hình thức <AkChevronRight /></span>
            </div>
            <div class="statusPayment">
                <span>Đã thanh toán</span>
                <span><a-switch v-model:checked="checked" /></span>
            </div>
        </div>
    </div>
</template>
<script setup>
import { AkChevronRight } from "@kalimahapps/vue-icons";
import { ref } from "vue";

const checked = ref(false);
</script>

<style scoped>
.mainInforPayment {
    display: flex;
    flex: 1;
    flex-direction: column;
    background-color: white;
    padding: 10px;
    .title {
        display: flex;
        flex-direction: row;
        flex: 1;
        align-items: center;
        text-align: center;
    }
}
</style>
