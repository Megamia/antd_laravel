<template>
    <div class="mainAnthoerInfor">
        <div class="title">
            <span>Thông tin khác</span>
        </div>
        <div class="content">
            <div class="tagDiv">
                <span>Tag</span>
                <div class="selectOptions">
                    <a-select class="select" v-model:value="value2" :options="options" mode="multiple" :size="size"
                        placeholder="Please select" style="width: 100%" />
                </div>
            </div>
            <div class="orderLabelDiv">
                <span>Nhãn đơn hàng</span>
                <div class="selectOptions">
                    <a-select class="select" v-model:value="value2" :options="options" mode="multiple" :size="size"
                        placeholder="Please select" style="width: 100%" />
                </div>
            </div>
            <div class="formAnotherInforDiv">
                <a-form :model="formState" name="basic" autocomplete="off" @finish="onFinish"
                    @finishFailed="onFinishFailed">
                    <a-form-item label="Tên trường dạng text" name="Text" class="test"
                        :rules="[{ required: true, message: 'Please input type Text!' }]">
                        <a-input v-model:value="formState.Text" placeholder="Nội dung placehoder" />
                    </a-form-item>

                    <a-form-item label="Tên trường dạng số" name="Number"
                        :rules="[{ required: true, message: 'Please input type Number!' }]">
                        <a-input v-model:value="formState.Number" placeholder="Nội dung placehoder" type="number" />
                    </a-form-item>

                    <a-form-item label="Tên trường dạng thời gian" name="DateTime"
                        :rules="[{ required: true, message: 'Please input type DateTime!' }]">
                        <a-input v-model:value="formState.DateTime" placeholder="Nội dung placehoder" type="date" />
                    </a-form-item>

                    <a-form-item label="Tên trường dạng dropdown list" name="DropDownList"
                        :rules="[{ validator: (rule, value) => value !== undefined && value !== null, message: 'Please input type DropDownList!' }]">
                        <a-select v-model:value="formState.DropDownListItem" :options="options"
                            placeholder="Please select" style="width: 100%" />
                    </a-form-item>

                    <a-form-item label="Tên trường dạng checkbox" name="CheckBox"
                        :rules="[{ required: true, message: 'Please input type CheckBox!' }]">
                        <a-select v-model:value="formState.Checkbox" :options="options" mode="multiple" :size="size"
                            placeholder="Please select" style="width: 100%" />
                    </a-form-item>

                    <a-form-item label="Tên trường dạng địa chỉ" name="Address" class="formAddress"
                        :rules="[{ required: true, validator: value => value !== undefined && value !== null, message: 'Please input type Address!' }]">
                        <div class="formAddressDiv">

                            <a-select v-model="formState.SelectCity" :options="options"
                                placeholder="Chọn tỉnh/thành phố" style="width: 100%" />
                            <a-select v-model="formState.District" :options="options" placeholder="Chọn quận/huyện"
                                style="width: 100%" />
                            <a-select v-model="formState.Wards" :options="options" placeholder="Chọn xã/phường"
                                style="width: 100%" />
                            <input placeholder="Địa chỉ cụ thể" />
                        </div>
                    </a-form-item>

                    <a-form-item>
                        <a-button type="primary" html-type="submit">Submit</a-button>
                    </a-form-item>
                </a-form>

            </div>
        </div>
    </div>
</template>
<script setup>
import { ref } from 'vue';

const Text = ref('');
const Number = ref('');
const DateTime = ref('');
const DropDownListItem = ref('Actions');
const Checkbox = ref(['Tag1', 'Tag2', 'Tag3']);
const SelectCity = ref('');
const District = ref('');
const Wards = ref('');

const formState = ref({
    Text: Text.value,
    Number: Number.value,
    DateTime: DateTime.value,
    DropDownListItem: DropDownListItem.value,
    Checkbox: Checkbox.value,
    SelectCity: SelectCity.value,
    District: District.value,
    Wards: Wards.value,
});

const onFinish = () => {
    console.log('Success:', formState.value);
};

const onFinishFailed = () => {
    console.log('Failed:', formState.value);
};

const size = ref('middle');
const value2 = ref(['Tag1', 'Tag2']);
const options = [...Array(25)].map((_, i) => ({ value: `Tag${i + 1}` }));

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
                    gap: 10px
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

                .formAddress {
                    .formAddressDiv {
                        display: flex;
                        flex: 1;
                        flex-direction: column;
                        gap: 18px;

                        .ant-select {
                            /* background-color: red; */
                            border-radius: 0;
                        }

                        input {
                            border: 1px solid #d9d9d9;
                            padding: 5px 12px 5px 12px;
                            border-radius: 7px;
                        }

                        input:focus {
                            outline: none;
                        }

                        input::placeholder {
                            color: #00000040;
                            font-size: 14px;
                        }
                    }
                }
            }
        }
    }
}
</style>
