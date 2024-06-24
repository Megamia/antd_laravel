<template>
    <div class="mainAddProduct">
        <div class="title">
            <AnOutlinedArrowLeft @click="back" />
            <span> Thêm sản phẩm </span>
        </div>

        <a-form style="display: flex; flex-direction: column; gap: 30px" layout="inline" :model="formState"
            @finish="handleFinish" @finishFailed="handleFinishFailed">
            <a-form-item>
                <a-input v-model:value="formState.value.name" placeholder="Tên sản phẩm">
                </a-input>
            </a-form-item>
            <a-form-item>
                <a-cascader v-model:value="formState.value.tag" style="width: 100%" multiple max-tag-count="responsive"
                    :options="options" placeholder="Please select"></a-cascader>
            </a-form-item>
            <a-form-item>
                <a-input v-model:value="formState.value.price" placeholder="Giá sản phẩm">
                </a-input>
            </a-form-item>
            <a-form-item>
                <a-input v-model:value="formState.value.quantity" placeholder="Số lượng tồn kho">
                </a-input>
            </a-form-item>
            <a-form-item>

                <a-upload :action="uploadUrl" list-type="picture" class="upload-list-inline" :headers="headers"
                    :beforeUpload="handleUploadChange" @remove="removee">
                    <!-- :data="formState.img" -->
                    <a-button :disabled="!checkImg">
                        <upload-outlined />
                        Upload
                    </a-button>
                </a-upload>
            </a-form-item>

            <a-form-item>
                <a-button type="primary" html-type="submit" :disabled="a">
                    Thêm sản phẩm
                </a-button>
            </a-form-item>
        </a-form>
        <!-- v-model:file-list="fileList1" -->

        <button @click="show">Show</button>
        <div v-if="data">
            <div v-for="(image, index) in data" style="display: inline-block; margin: 10px">
                <a-image :src="image.url" style="width: 200px; height: auto" />
                <p @click="del(image, index)">{{ image.name }}</p>
            </div>
        </div>
        <button @click="showProduct">inforProduct</button>
        <div v-if="inforProduct" style="display: flex; flex-direction: row;">
            <div style="display: flex; flex-direction: column;" v-for="inforProduct in inforProduct"
                :key="inforProduct.id">
                <span>id: {{ inforProduct.id }}</span>
                <span>name: {{ inforProduct.name }}</span>
                <span>tag: {{ inforProduct.tag }}</span>
                <span>quantity: {{ inforProduct.quantity }}</span>
                <span>price: {{ inforProduct.price }}</span>
                <span>img: {{ inforProduct.img }}</span>
            </div>
        </div>
        <button @click="test">test</button>
    </div>
</template>

<script setup>
import { ref, computed, reactive } from "vue";
import { UploadOutlined } from "@ant-design/icons-vue";
import { AnOutlinedArrowLeft } from "@kalimahapps/vue-icons";
import { useRouter } from "vue-router";
import axios from "axios";

const router = useRouter();

const back = () => {
    router.back();
}

const a = computed(() => {
    const { name, quantity, price, img, tag } = formState.value;
    return !(name || quantity || price || img || tag);
});

const checkImg = computed(() => {
    return !formState.value.img;
});
const formState = reactive({
    value: {
        img: "",
        name: "",
        price: "",
        quantity: "",
        tag: "",
    },
});
const removee = () => {
    return (formState.value.img = "");
};
const inforProduct = ref("");
const handleUploadChange = (file) => {
    if (confirm("Chắc chắn tải ảnh lên?")) {
        formState.value.img = file.name;
        return true;
    } else {
        return false;
    }
};

const test = () => {
    console.log("Typeof: ", typeof formState.value.name);
    console.log("Value: ", formState.value.tag);
    console.log("Value String: ", formState.value.tag.toString());
    console.log("FormState.value: ", formState.value);

}

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

const showProduct = async () => {


    try {
        const response = await axios.get(
            `${import.meta.env.VITE_APP_URL_API}/inforProduct`
        );
        if (response.data.status === 1) {
            inforProduct.value = response.data.inforProduct;
            console.log("Data: ", inforProduct.value);
        } else {
            console.log("No data");
        }
    } catch (e) {
        console.log("Error: ", e);
    }
};

const handleFinish = async () => {
    for (let fieldName in formState.value) {
        if (!formState.value[fieldName]) {
            alert("Vui lòng điền đầy đủ thông tin");
            return;
        }
    }
    try {
        formState.value.tag = formState.value.tag.toString();
        const response = await axios.post(
            `${import.meta.env.VITE_APP_URL_API}/addNewProduct`
            ,
            {
                name: formState.value.name,
                tag: formState.value.tag,
                price: formState.value.price,
                quantity: formState.value.quantity,
                img: formState.value.img,
                headers: headers["X-CSRF-TOKEN"]
            }
        );
        if (response.data.status === 1) {
            console.log("Add product success: ", response.data.inforProduct);
        } else {
            console.log("Add product faile: ", response.data.inforProduct);
        }
    } catch (e) {
        console.log("Error: ", e);
    }
    // console.log(formState)
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
.mainAddProduct {
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
}

.upload-list-inline :deep(.ant-upload-list-item) {
    float: left;
    width: 200px;
    margin-right: 8px;
}

.upload-list-inline [class*="-upload-list-rtl"] :deep(.ant-upload-list-item) {
    float: right;
}
</style>
