<template>
    <div class="mainInforNewUser">
        <div class="title">
            <AnOutlinedArrowLeft @click="back" />
            <span> Thêm mới khách hàng </span>
        </div>
        <a-form
            :model="formState"
            name="basic"
            autocomplete="off"
            @finish="onFinish"
            @finishFailed="onFinishFailed"
        >
            <div class="content">
                <a-form-item
                    label="Họ và tên"
                    name="username"
                    :rules="[
                        {
                            required: true,
                            message: 'Nhập họ và tên',
                        },
                    ]"
                >
                    <a-input v-model:value="formState.username" />
                </a-form-item>

                <a-form-item
                    label="Số điện thoại"
                    name="phoneNumber"
                    :rules="[
                        {
                            required: true,
                            message: 'Nhập số điện thoại',
                        },
                    ]"
                >
                    <a-input
                        v-model:value="formState.phoneNumber"
                        type="number"
                    />
                </a-form-item>
                <a-form-item
                    label="Email"
                    name="email"
                    :rules="[
                        {
                            message: 'Nhập email',
                        },
                    ]"
                >
                    <a-input v-model:value="formState.email" type="email" />
                </a-form-item>

                <a-form-item class="buttonSubmit">
                    <a-button type="primary" html-type="submit" class="buttonSave"
                        >Submit</a-button
                    >
                </a-form-item>
            </div>
        </a-form>
    </div>
</template>
<script setup>
import { AnOutlinedArrowLeft, CaAddAlt } from "@kalimahapps/vue-icons";
import { useRouter } from "vue-router";
import { reactive } from "vue";

const formState = reactive({
    username: "",
    phoneNumber: "",
    email: "",
});
const onFinish = (values) => {
    console.log("Success:", values);
};

const onFinishFailed = (errorInfo) => {
    console.log("Failed:", errorInfo);
};
const router = useRouter();

const back = () => {
    router.back();
};
</script>

<style scoped>
.mainInforNewUser {
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
        flex: 1;
        flex-direction: column;
        background-color: white;

        .buttonSubmit {
            position: absolute;
            display: flex;
            background-color: white;
            bottom: 0;
            width: 100%;
            padding: 12px;
            button {
                position: relative;
                border-radius: 0;
            }
            .buttonSave{
                width: 100%;

            }
        }
    }
}
</style>
