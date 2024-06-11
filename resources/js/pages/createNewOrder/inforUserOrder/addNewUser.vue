<template>
    <div class="mainAddNewUser">
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
                    <a-input
                        v-model:value="formState.username"
                        placeholder="Nhập họ và tên"
                    />
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
                        placeholder="Nhập số điện thoại"
                    />
                </a-form-item>
                <a-form-item
                    label="Email"
                    name="email"
                    :rules="[
                        {
                            required: false,
                            message: 'Nhập email',
                        },
                    ]"
                >
                    <a-input
                        v-model:value="formState.email"
                        type="email"
                        placeholder="Nhập email"
                    />
                </a-form-item>

                <a-form-item class="buttonSubmit">
                    <a-button
                        type="primary"
                        html-type="submit"
                        class="buttonSave"
                        >Thêm mới</a-button
                    >
                </a-form-item>
            </div>
        </a-form>
    </div>
</template>
<script setup>
import { AnOutlinedArrowLeft } from "@kalimahapps/vue-icons";
import { useRouter } from "vue-router";
import { ref } from "vue";
import axios from "axios";
const formState = ref({
    username: "",
    phoneNumber: "",
    email: "",
});
const onFinish = async () => {
    try {
        const response = await axios.post(
            `${import.meta.env.VITE_APP_URL_API}/addUserOrder`,
            {
                username: formState.value.username,
                phoneNumber: formState.value.phoneNumber,
                email: formState.value.email,
            }
        );
        if (response.data.status === 1) {
            console.log("Success: ", formState.value);
        } else {
            console.log("Faile");
        }
    } catch (e) {
        console.log("Error: ", e);
    }
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
.mainAddNewUser {
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

        .ant-form-item {
            padding-inline: 10px;
        }

        .buttonSubmit {
            position: absolute;
            background-color: white;
            bottom: 0;
            width: 100%;
            padding: 12px;
            margin: 0;

            button {
                position: relative;
                border-radius: 0;
            }

            .buttonSave {
                width: 100%;
            }
        }
    }
}
</style>
