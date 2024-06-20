<template>
    <a-form
        :model="formState"
        name="validate_other"
        v-bind="formItemLayout"
        @finishFailed="onFinishFailed"
        @finish="onFinish"
    >
        <a-form-item
            name="upload"
            label="Upload"
            extra="longgggggggggggggggggggggggggggggggggg"
        >
            <a-upload
                v-model:fileList="formState.upload"
                name="logo"
                list-type="picture"
                :action="uploadUrl"
                :headers="headers"
                :beforeUpload="beforeUpload"
                multiple
            >
                <a-button>
                    <template #icon><UploadOutlined /></template>
                    Click to upload
                </a-button>
            </a-upload>
        </a-form-item>

        <a-form-item label="Dragger">
            <a-form-item name="dragger" no-style>
                <a-upload-dragger
                    v-model:fileList="formState.dragger"
                    name="files"
                    :action="uploadUrl"
                    :headers="headers"
                    :beforeUpload="beforeUpload"
                    multiple
                >
                    <p class="ant-upload-drag-icon">
                        <InboxOutlined />
                    </p>
                    <p class="ant-upload-text">
                        Click or drag file to this area to upload
                    </p>
                    <p class="ant-upload-hint">
                        Support for a single or bulk upload.
                    </p>
                </a-upload-dragger>
            </a-form-item>
        </a-form-item>

        <a-form-item :wrapper-col="{ span: 12, offset: 6 }">
            <a-button type="primary" html-type="submit">Submit</a-button>
        </a-form-item>
        <button @click="back">Back</button>

        <div v-if="uploadedImageUrls.length">
            <h3>Uploaded Images:</h3>
            <div v-for="(url, index) in uploadedImageUrls" :key="index">
                <a-image
                    :src="url"
                    alt="Uploaded Image"
                    style="max-width: 200px; margin: 10px"
                />
            </div>
        </div>
    </a-form>
</template>

<script setup>
import { reactive, ref, computed } from "vue";
import { UploadOutlined, InboxOutlined } from "@ant-design/icons-vue";
import axios from "axios";
import { useRouter } from "vue-router";

const router = useRouter();
const back = () => {
    router.push("/");
};

const formItemLayout = {
    labelCol: { span: 6 },
    wrapperCol: { span: 14 },
};

const formState = reactive({
    upload: [],
    dragger: [],
});

const uploadUrl = `${import.meta.env.VITE_APP_URL_API}/uploads`;

const uploadedImageUrls = ref([]);

function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(";").shift();
    return null;
}

function getCsrfToken() {
    let csrfToken = getCookie("csrf_token");
    if (!csrfToken) {
        const metaTag = document.querySelector('meta[name="csrf-token"]');
        if (metaTag) {
            csrfToken = metaTag.getAttribute("content");
        }
    }
    console.log(`CSRF token retrieved: ${csrfToken}`);
    return csrfToken;
}

const headers = computed(() => {
    return {
        "X-CSRF-TOKEN": getCsrfToken(),
        "Content-Type": "multipart/form-data",
    };
});

const beforeUpload = (file) => {
    return true; 
};

const onFinish = async () => {
    const formData = new FormData();
    formState.upload.forEach((file) => {
        formData.append("files[]", file.originFileObj);
    });
    formState.dragger.forEach((file) => {
        formData.append("files[]", file.originFileObj);
    });

    try {
        const response = await axios.post(uploadUrl, formData, {
            headers: headers.value,
        });
        if (response.data.status === 1) {
            console.log("Success:", response.data);
            uploadedImageUrls.value = response.data.filePaths.map(
                (path) => `${import.meta.env.VITE_APP_URL_API}/storage/${path}`
            );
        } else {
            console.log("Failed:");
        }
    } catch (error) {
        if (error.response && error.response.status === 422) {
            console.log("Validation Error:", error.response.data.errors);
        } else {
            console.log("Error:", error);
        }
    }
};

const onFinishFailed = (errorInfo) => {
    console.log("Failed:", errorInfo);
};
</script>

<style scoped>
.mainAddProduct {
    display: flex;
    flex: 1;
    flex-direction: column;
    background-color: white;
}
</style>
