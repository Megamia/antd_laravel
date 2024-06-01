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
            <div>
                <a-form :model="formState" name="basic" :label-col="{ span: 8 }" :wrapper-col="{ span: 16 }"
                    autocomplete="off" @finish="onFinish" @finishFailed="onFinishFailed">
                    <a-form-item label="Tên trường dạng text" name="Text"
                        :rules="[{ required: true, message: 'Please input your school name type Text!' }]">
                        <a-input v-model:value="formState.Text" placeholder="Nội dung placehoder" />
                    </a-form-item>

                    <a-form-item label="Tên trường dạng số" name="Number"
                        :rules="[{ required: true, message: 'Please input your scholl name type Number!' }]">
                        <a-input v-model:value="formState.Number" placeholder="Nội dung placehoder" type="number" />
                    </a-form-item>

                    <a-form-item label="Tên trường dạng thời gian" name="DateTime"
                        :rules="[{ required: true, message: 'Please input your scholl name type DateTime!' }]">
                        <a-input v-model:value="formState.DateTime" placeholder="Nội dung placehoder" type="date" />
                    </a-form-item>

                    <a-form-item :wrapper-col="{ offset: 8, span: 16 }">
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

const formState = ref({
    Text: Text.value,
    Number: Number.value,
    DateTime: DateTime.value,
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
        font-weight: 500;
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
    }
}
</style>
