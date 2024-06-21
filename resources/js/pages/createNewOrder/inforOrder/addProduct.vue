<template>
    <div style="display: flex; flex-direction: column">
        <h1 style="justify-content: center; display: flex; margin-top: 50px">
            Thêm sản phẩm
        </h1>

        <a-form
            style="display: flex; flex-direction: column; gap: 30px"
            layout="inline"
            :model="formState"
            @finish="handleFinish"
            @finishFailed="handleFinishFailed"
        >
            <a-form-item>
                <a-input
                    v-model:value="formState.name"
                    placeholder="Tên sản phẩm"
                >
                </a-input>
            </a-form-item>
            <a-form-item>
                <a-input
                    v-model:value="formState.tag"
                    placeholder="Phân loại sản phẩm"
                >
                </a-input>
            </a-form-item>
            <a-form-item>
                <a-input
                    v-model:value="formState.price"
                    placeholder="Giá sản phẩm"
                >
                </a-input>
            </a-form-item>
            <a-form-item>
                <a-input
                    v-model:value="formState.quantity"
                    placeholder="Số lượng tồn kho"
                >
                </a-input>
            </a-form-item>

            <a-form-item>
                <a-button
                    type="primary"
                    html-type="submit"
                    :disabled="
                        formState.user === '' || formState.password === ''
                    "
                >
                    Log in
                </a-button>
            </a-form-item>
            <!-- :action="" -->
            <a-upload
                list-type="picture"
                class="upload-list-inline"
                :headers="headers"
                :data="uploadData"
            >
                <a-button>
                    <upload-outlined />
                    Upload
                </a-button>
            </a-upload>
        </a-form>
        <!-- v-model:file-list="fileList1" -->

        <button @click="show">Show</button>
        <div v-if="data">
            <div
                v-for="(image, index) in data"
                style="display: inline-block; margin: 10px"
            >
                <a-image :src="image.url" style="width: 200px; height: auto" />
                <p @click="del(image,index)">{{ image.name }}</p>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";
import { UploadOutlined } from "@ant-design/icons-vue";

const formState = ref({
    name: "",
    tag: "",
    quantity: "",
    price: "",
    img: "",
});
const handleFinish = () => {
    console.log(formState.value);
};
const handleFinishFailed = (errors) => {
    console.log(errors);
};

const uploadUrl = "http://127.0.0.1:8000/api/uploads";
const headers = {
    "X-CSRF-TOKEN": document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),
};
const uploadData = {
    name: "file",
};
const del = (image,index) => {
    if (confirm("Chắc chắn muốn xóa?")) {
        data.value.splice(index, 1);
    } else {
        console.log(index + 1);
        formState.value.img = image.name;
        console.log("FormState.img: ", formState.value.img);
    }
};
// const url = ref({});
const data = ref([]);
const imgUrl = ref([]);
const show = async () => {
    const response = await axios.get(
        `${import.meta.env.VITE_APP_URL_API}/showImg`
    );
    if (response.data.status === 1) {
        data.value = response.data.images;
        imgUrl.value = data.value.map((image) => image.url);
        console.log("Data: ", data.value);
        console.log("Url: ", imgUrl);
    } else {
        console.log(response.data.images);
    }
};
const remove = () => {
    console.log("del");
};
</script>

<style scoped>
.upload-list-inline :deep(.ant-upload-list-item) {
    float: left;
    width: 200px;
    margin-right: 8px;
}
.upload-list-inline [class*="-upload-list-rtl"] :deep(.ant-upload-list-item) {
    float: right;
}
</style>
