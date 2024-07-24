<template>
    <div class="mainAddNewAddress">
        <div class="title">
            <AnOutlinedArrowLeft @click="back" />
            <span> Thêm địa chỉ mới </span>
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
                    label="Người nhận"
                    name="username"
                    :rules="[
                        {
                            required: false,
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
                    label="Tỉnh/ Thành phố"
                    name="city"
                    :rules="[
                        {
                            required: true,
                            message: 'Nhập email',
                        },
                    ]"
                >
                    <a-select
                        v-model:value="formState.city"
                        show-search
                        placeholder="Chọn Tỉnh/ Thành phố"
                        style="width: 100%"
                        :options="options1"
                        :filter-option="filterOption"
                        @change="handleChange"
                    ></a-select>
                </a-form-item>

                <a-form-item
                    label="Quận/ Huyện"
                    name="district"
                    :rules="[
                        {
                            required: true,
                            message: 'Nhập email',
                        },
                    ]"
                >
                    <a-select
                        v-model:value="formState.district"
                        show-search
                        placeholder="Chọn Quận/ Huyện"
                        style="width: 100%"
                        :options="options1"
                        :filter-option="filterOption"
                        @change="handleChange"
                    ></a-select>
                </a-form-item>

                <a-form-item
                    label="Phường/ Xã"
                    name="ward"
                    :rules="[
                        {
                            required: true,
                            message: 'Chọn Phường/ Xã',
                        },
                    ]"
                >
                    <a-select
                        v-model:value="formState.ward"
                        show-search
                        placeholder="Chọn Phường/ Xã"
                        style="width: 100%"
                        :options="options1"
                        :filter-option="filterOption"
                        @change="handleChange"
                    ></a-select>
                </a-form-item>

                <a-form-item
                    label="Địa chỉ"
                    name="address"
                    :rules="[
                        {
                            required: true,
                            message: 'Nhập tên đường, số nhà, tòa nhà',
                        },
                    ]"
                >
                    <a-input
                        v-model:value="formState.address"
                        type="text"
                        placeholder="Nhập tên đường, số nhà, tòa nhà"
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

const options1 = [
    { label: "Lucy1", value: "Lucy1" },
    { label: "Lucy2", value: "Lucy2" },
    { label: "Lucy3", value: "Lucy3" },
];
const formState = ref({
    username: "",
    phoneNumber: "",
    city: null,
    district: null,
    ward: null,
    address: "",
});

const handleChange = (value) => {
    // console.log(`selected ${value}`);
};

const filterOption = (input, option) => {
    return option.value.toLowerCase().indexOf(input.toLowerCase()) >= 0;
};

const onFinish = async () => {
    try {
        const payload = {
            username: formState.value.username,
            phoneNumber: formState.value.phoneNumber,
            city: formState.value.city,
            district: formState.value.district,
            ward: formState.value.ward,
            address: formState.value.address,
        };
        const response = await axios.post(
            `${import.meta.env.VITE_APP_URL_API}/addNewAddress`,
            payload
        );
        if (response.data.status === 1) {
            alert("Thêm địa chỉ mới thành công");
            router.back();
        } else {
            alert("Thêm địa chỉ mới thất bại");
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
.mainAddNewAddress {
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
        padding-top: 10px;

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
