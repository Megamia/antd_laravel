<template>
    <div class="mainUserOrder">
        <div class="title">
            <span> Thông tin khách hàng</span>
            <span class="refuse" @click="Esc" v-if="!showChoose"> Bỏ chọn</span>
        </div>
        <div class="function" v-if="showChoose">
            <div class="button">
                <a-button class="buttonChild buttonAdd" @click="nothing">
                    <BxTimer />
                    <span>Khách lẻ</span>
                </a-button>
            </div>

            <div class="button">
                <a-button class="buttonChild buttonScan" @click="addNewUser">
                    <AnOutlinedUserAdd />
                    <span>Thêm mới</span>
                </a-button>
            </div>

            <div class="button">
                <a-button class="buttonChild buttonScan" @click="nothing">
                    <PhMagnifyingGlass />
                    <span>Tìm kiếm </span>
                </a-button>
            </div>
        </div>
        <div v-else>
            <DetailInforUserOrder @fet="fet" />
        </div>
    </div>
</template>
<script setup>
import {
    BxTimer,
    AnOutlinedUserAdd,
    PhMagnifyingGlass,
} from "@kalimahapps/vue-icons";
import DetailInforUserOrder from "./DetailInforUserOrder.vue";
import { ref, onMounted, defineEmits } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";
import eventBus from "../../../eventBus";

const emit = defineEmits("fet");

const showChoose = ref(true);
const dataUserOrder = ref("");

const Esc = async () => {
    try {
        const response = await axios.get(
            `${import.meta.env.VITE_APP_URL_API}/deleteSession`
        );
        if (response.data.status === 1) {
            eventBus.clear();
        } else {
        }
    } catch (e) {
        console.log("Error: ", e);
    }
    fetchData();
};

const fetchData = async () => {
    try {
        const response = await axios.get(
            `${import.meta.env.VITE_APP_URL_API}/dataUserOrder`
        );
        if (response.data.status === 1) {
            if (response.data.dataUserOrder != "guest") {
                dataUserOrder.value = response.data.dataUserOrder.name;
                // console.log(dataUserOrder.value);
            } else {
                dataUserOrder.value = response.data.dataUserOrder;

                // console.log(dataUserOrder.value);
            }
            showChoose.value = false;
        } else {
            showChoose.value = true;
        }
        return;
    } catch (e) {
        console.log("Error: ", e);
    }
};
const fet = async () => {
    fetchData();
};

onMounted(() => fetchData());

const router = useRouter();
const nothing = () => {
    alert("Chưa xử lý sự kiện này");
};

const addNewUser = () => {
    router.push("/chooseUser");
};
</script>

<style scoped>
.mainUserOrder {
    display: flex;
    flex: 1;
    flex-direction: column;
    background-color: white;

    .title {
        padding: 12px;

        display: flex;
        flex: 1;
        justify-content: space-between;
        font-weight: bold;

        .refuse {
            color: #ff4d4f;
            font-size: 14px;
        }
    }

    .function {
        display: flex;
        flex-direction: row;
        padding: 0 10px 10px 10px;

        .button {
            display: flex;
            flex: 1;
            flex-direction: column;
        }

        button {
            display: flex;
            flex: 1;
            flex-direction: row;
            align-items: center;
            background-color: #f5f5f5;
            font-size: 14px;
            font-weight: 400;
            border-width: 0;
            justify-content: center;

            svg {
                color: #f26722;
                font-size: 20px;
            }
        }

        .buttonChild {
            display: flex;
            flex-direction: column;
        }

        .buttonAdd {
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }

        .buttonScan {
            border-left: 1px solid #d9d9d9;
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }
    }
}
</style>
