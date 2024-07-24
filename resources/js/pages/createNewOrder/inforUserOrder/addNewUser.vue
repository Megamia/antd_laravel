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
                <div
                    v-if="filter.length > 0 && formState.phoneNumber && show"
                    class="inforUser"
                >
                    <div class="titleInforUser">
                        <span>Gợi ý khách hàng từ Bizfly CRM</span>
                    </div>
                    <div
                        v-for="data in filter"
                        :key="data.id"
                        class="detailInforUserDiv"
                    >
                        <div class="detailInforUser">
                            <span class="name">
                                {{ data.name }}
                            </span>
                            <span class="phoneNumber">
                                {{ data.phoneNumber }}
                            </span>
                        </div>
                        <div class="buttonChoose">
                            <a-button
                                type="primary"
                                @click="inforUserSelected(data.id)"
                                >Chọn</a-button
                            >
                        </div>
                    </div>
                </div>
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
            <div style="height: 1000px" />
        </a-form>
    </div>
</template>
<script setup>
import { AnOutlinedArrowLeft } from "@kalimahapps/vue-icons";
import { useRouter } from "vue-router";
import { ref, onMounted, computed } from "vue";
import axios from "axios";

const router = useRouter();
const dataUser = ref("");
const show = ref(true);
const formState = ref({
    username: "",
    phoneNumber: "",
    email: null,
});

const fetchData = async () => {
    try {
        const response = await axios.get(
            `${import.meta.env.VITE_APP_URL_API}/inforUserCRM`
        );
        if (response.data.status === 1) {
            // console.log(response.data.inforUserCRM);
            dataUser.value = response.data.inforUserCRM;
        } else if (response.data.status === 0) {
            console.log(response.data.inforUserCRM);
        }
    } catch (e) {
        console.log("Error: ", e);
    }
};

onMounted(() => fetchData());

const filter = computed(() => {
    if (formState.value.phoneNumber) {
        return dataUser.value.filter((data) => {
            return formState.value.phoneNumber
                .toLowerCase()
                .split(" ")
                .every((v) => data.phoneNumber.toLowerCase().includes(v));
        });
    } else {
        return dataUser.value;
    }
});

const b = ref([]);
const inforUserSelected = (a) => {
    // console.log(a);
    show.value = !show.value;
    b.value = dataUser.value.filter((item) => item.id === a);
    formState.value.username = b.value[0].name;
    formState.value.phoneNumber = b.value[0].phoneNumber;
};

const onFinish = async () => {
    try {
        const payload = {
            username: formState.value.username,
            phoneNumber: formState.value.phoneNumber,
            email: formState.value.email,
        };
        const response = await axios.post(
            `${import.meta.env.VITE_APP_URL_API}/addUserOrder`,
            payload
        );
        if (response.data.status === 1) {
            // console.log("Success: ", formState.value);
            alert(`Thêm mới người dùng ${formState.value.username} thành công`);
            router.back();
        } else {
            alert(
                `Đã tồn tại người dùng với số điện thoại ${formState.value.phoneNumber}`
            );
        }
    } catch (e) {
        console.log("Error: ", e);
    }
};

const onFinishFailed = (errorInfo) => {
    console.log("Failed:", errorInfo);
};

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

        .inforUser {
            display: flex;
            flex: 1;
            flex-direction: column;
            background-color: #e6f7ff80;
            margin-inline: 10px;
            padding-inline: 12px;

            .titleInforUser {
                display: flex;
                flex: 1;
                padding-block: 12px;
                span {
                    font-size: 14px;
                    font-weight: bold;
                }
            }
            .detailInforUserDiv {
                display: flex;
                flex: 1;
                flex-direction: row;
                .detailInforUser {
                    display: flex;
                    flex-direction: column;
                    font-size: 14px;
                    padding-block: 12px;
                    justify-content: center;
                    .name {
                        font-weight: 500;
                    }
                    .phoneNumber {
                        color: #00000073;
                    }
                }
                .buttonChoose {
                    display: flex;
                    flex: 1;
                    justify-content: end;
                    align-items: center;
                }
            }
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
