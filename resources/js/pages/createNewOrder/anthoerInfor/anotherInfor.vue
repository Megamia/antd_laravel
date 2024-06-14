<template>
    <div class="mainAnthoerInfor">
        <div class="title">
            <span>Thông tin khác</span>
        </div>
        <div class="content">
            <div class="tagDiv">
                <span>Tag</span>
                <div class="selectOptions">
                    <a-select
                        class="select"
                        v-model:value="value2"
                        :options="options"
                        mode="multiple"
                        :size="size"
                        placeholder="Please select"
                        style="width: 100%"
                    />
                </div>
            </div>
            <div class="orderLabelDiv">
                <span>Nhãn đơn hàng</span>
                <div class="selectOptions">
                    <a-select
                        class="select"
                        v-model:value="value2"
                        :options="options"
                        mode="multiple"
                        :size="size"
                        placeholder="Please select"
                        style="width: 100%"
                    />
                </div>
            </div>
            <div class="formAnotherInforDiv">
                <a-form
                    :model="formState"
                    name="basic"
                    autocomplete="off"
                    @finish="onFinish"
                    @finishFailed="onFinishFailed"
                >
                    <a-form-item
                        label="Tên trường dạng text"
                        name="Text"
                        class="test"
                        :rules="[
                            {
                                required: true,
                                message: 'Please input type Text!',
                            },
                        ]"
                    >
                        <a-input
                            v-model:value="formState.Text"
                            placeholder="Nội dung placehoder"
                        />
                    </a-form-item>

                    <a-form-item
                        label="Tên trường dạng số"
                        name="Number"
                        :rules="[
                            {
                                required: true,
                                message: 'Please input type Number!',
                            },
                        ]"
                    >
                        <a-input
                            v-model:value="formState.Number"
                            placeholder="Nội dung placehoder"
                            type="number"
                        />
                    </a-form-item>

                    <a-form-item
                        label="Tên trường dạng thời gian"
                        name="DateTime"
                        :rules="[
                            {
                                required: true,
                                message: 'Please input type DateTime!',
                            },
                        ]"
                    >
                        <a-input
                            v-model:value="formState.DateTime"
                            placeholder="Nội dung placehoder"
                            type="date"
                        />
                    </a-form-item>
                    <a-form-item
                        label="Tên trường dạng CheckBox"
                        name="CheckBox"
                        :rules="[
                            {
                                required: true,
                                message: 'Please input type CheckBox!',
                            },
                        ]"
                    >
                        <a-select
                            v-model:value="formState.CheckBox"
                            :options="options"
                            mode="multiple"
                            :size="size"
                            placeholder="Please select"
                            style="width: 100%"
                        />
                    </a-form-item>

                    <a-form-item
                        label="Tên trường dạng Địa chỉ"
                        name="City"
                        :rules="[
                            {
                                required: true,
                                message: 'Please input type City!',
                            },
                        ]"
                    >
                        <a-select
                            v-model:value="formState.City"
                            show-search
                            placeholder="Chọn tỉnh/thành phố"
                            style="width: 100%"
                            :options="options1"
                            :filter-option="filterOption"
                            @change="handleChange"
                        ></a-select>
                    </a-form-item>
                    <a-form-item
                        name="District"
                        :rules="[
                            {
                                required: true,
                                message: 'Please input type District!',
                            },
                        ]"
                    >
                        <a-select
                            v-model:value="formState.District"
                            show-search
                            placeholder="Chọn quận/huyện"
                            style="width: 100%"
                            :options="options1"
                            :filter-option="filterOption"
                            @change="handleChange"
                        ></a-select>
                    </a-form-item>

                    <a-form-item
                        name="Wards"
                        :rules="[
                            {
                                required: true,
                                message: 'Please input type Wards!',
                            },
                        ]"
                    >
                        <a-select
                            v-model:value="formState.Wards"
                            show-search
                            placeholder="Chọn xã/phường"
                            style="width: 100%"
                            :options="options1"
                            :filter-option="filterOption"
                            @change="handleChange"
                        ></a-select>
                    </a-form-item>

                    <a-form-item
                        name="SpecificAddress"
                        :rules="[
                            {
                                required: true,
                                message: 'Please input type SpecificAddress!',
                            },
                        ]"
                    >
                        <a-input
                            v-model:value="formState.SpecificAddress"
                            placeholder="Địa chỉ cụ thể"
                        />
                    </a-form-item>

                    <a-form-item
                        label="Tên trường dạng số điện thoại"
                        name="PhoneNumber"
                        :rules="[
                            {
                                required: true,
                                message: 'Please input type PhoneNumber!',
                            },
                        ]"
                    >
                        <a-input
                            v-model:value="formState.PhoneNumber"
                            type="number"
                        >
                            <template #prefix>
                                <PhoneOutlined class="site-form-item-icon" />
                            </template>
                        </a-input>
                    </a-form-item>

                    <a-form-item
                        label="Tên trường dạng email"
                        name="Email"
                        :rules="[
                            {
                                required: true,
                                message: 'Please input type Email!',
                            },
                        ]"
                    >
                        <a-input v-model:value="formState.Email" type="email">
                            <template #prefix>
                                <MailOutlined class="site-form-item-icon" />
                            </template>
                        </a-input>
                    </a-form-item>

                    <!-- <a-form-item>
                        <a-button type="primary" html-type="submit"
                            >Submit</a-button
                        >
                    </a-form-item> -->
                </a-form>
            </div>
        </div>
    </div>
</template>
<script setup>
import { reactive, ref } from "vue";
import { PhoneOutlined, MailOutlined } from "@ant-design/icons-vue";
const Text = ref("");
const Number = ref("");
const DateTime = ref("");
const CheckBox = ref(["Tag1", "Tag2"]);
const City = ref(null);
const District = ref(null);
const Wards = ref(null);
const SpecificAddress = ref(null);
const PhoneNumber = ref("");
const Email = ref("");

const formState = reactive({
    Text: Text.value,
    Number: Number.value,
    DateTime: DateTime.value,
    CheckBox: CheckBox.value,
    City: City.value,
    District: District.value,
    Wards: Wards.value,
    SpecificAddress: SpecificAddress.value,
    PhoneNumber: PhoneNumber.value,
    Email: Email.value,
});

const handleChange = (value) => {
    console.log(`selected ${value}`);
};

const filterOption = (input, option) => {
    return option.value.toLowerCase().indexOf(input.toLowerCase()) >= 0;
};

const onFinish = (values) => {
    console.log("Success:", values);
};

const onFinishFailed = (errorInfo) => {
    console.log("Failed:", errorInfo);
};

const size = ref("middle");
const value2 = ref(["Tag1", "Tag2"]);
const options = [...Array(25)].map((_, i) => ({ value: `Tag${i + 1}` }));
const options1 = [
    { label: "Lucy1", value: "Lucy1" },
    { label: "Lucy2", value: "Lucy2" },
    { label: "Lucy3", value: "Lucy3" },
];
</script>

<style scoped>
.mainAnthoerInfor {
    display: flex;
    flex: 1;
    flex-direction: column;
    background-color: white;

    .title {
        display: flex;
        flex: 1;
        font-size: 16px;
        font-weight: 600;
        padding: 10px;
        border-bottom: 1px solid #d9d9d9;
    }

    .content {
        display: flex;
        flex: 1;
        flex-direction: column;

        .tagDiv,
        .orderLabelDiv {
            display: flex;
            flex: 1;
            flex-direction: column;
            padding-inline: 10px;
            padding-top: 20px;
            gap: 10px;
            font-size: 14px;
            font-weight: 400;

            .selectOptions {
                .select {
                    gap: 10px;
                }
            }
        }

        .formAnotherInforDiv {
            display: flex;
            flex: 1;
            margin-top: 44px;
            padding-inline: 10px;

            .ant-form {
                display: flex;
                flex: 1;
                flex-direction: column;
                gap: 20px;

                .ant-form-item {
                    margin-top: -24px;
                }
            }
        }
    }
}
</style>
