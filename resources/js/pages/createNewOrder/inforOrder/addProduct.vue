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
                <a-cascader
                    v-model:value="formState.tag"
                    style="width: 100%"
                    multiple
                    max-tag-count="responsive"
                    :options="options"
                    placeholder="Please select"
                ></a-cascader>
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
                    :disabled="!formState"
                >
                    Log in
                </a-button>
            </a-form-item>
            <a-upload
                :action="uploadUrl"
                list-type="picture"
                class="upload-list-inline"
                :headers="headers"
                :data="formState.img"
                :beforeUpload="handleUploadChange"
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
                <p @click="del(image, index)">{{ image.name }}</p>
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
    img: {},
});

const handleUploadChange = (file) => {
    formState.value.img = file.name;
    console.log(file.name);
};

const options = ref([
    {
        label: "Light",
        value: "light",
        children: new Array(20)
            .fill(null)
            .map((_, index) => ({ label: `Number ${index}`, value: index })),
    },
    {
        label: "Bamboo",
        value: "bamboo",
        children: [
            {
                label: "Little",
                value: "little",
                children: [
                    {
                        label: "Toy Fish",
                        value: "fish",
                    },
                    {
                        label: "Toy Cards",
                        value: "cards",
                    },
                    {
                        label: "Toy Bird",
                        value: "bird",
                    },
                ],
            },
        ],
    },
]);

const handleFinish = () => {
    // const stringTag = formState.value.tag.toString();
    // const stringImg = formState.value.img.toString();
    // if (
    //     formState.value.name ||
    //     formState.value.quantity ||
    //     formState.value.price ||
    //     stringImg ||
    //     stringTag
    // ) {
    //     console.log(formState.value);
    // } else {
    //     console.log("No data");
    // }
    // console.log("formState.value.tag:", formState.value.tag);
    // console.log("stringTag: ", stringTag);
    // console.log(formState.value);
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
// const uploadData = {
//     name: "file",
// };

const del = (image, index) => {
    if (confirm("Chắc chắn muốn xóa?")) {
        data.value.splice(index, 1);
    } else {
        console.log(index + 1);
        formState.value.img.path = image.url;
        console.log("FormState.img: ", formState.value.img.path);
    }
};
const url = ref({});
const data = ref([]);
const imgUrl = ref([]);
const show = async () => {
    const response = await axios.get(
        `${import.meta.env.VITE_APP_URL_API}/showImg`
    );
    if (response.data.status === 1) {
        data.value = response.data.images;
        // imgUrl.value = data.value.map((image) => image.url);
        // console.log("Data: ", data.value);
        // console.log("Url: ", imgUrl);
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
