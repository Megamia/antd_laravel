<template>
    <div class="mainUserOrder">
        <div class="title">
            <span> Thông tin khách hàng</span>
        </div>
        <div class="function">
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
    </div>
</template>
<script setup>
import {
    BxTimer,
    AnOutlinedUserAdd,
    PhMagnifyingGlass,
} from "@kalimahapps/vue-icons";
import { useRouter } from "vue-router";

const router = useRouter();
const nothing = () => {
    alert("Chưa xử lý sự kiện này");
};

const addNewUser = () => {
    router.push("/addNewUser");
};
</script>

<style scoped>
.mainUserOrder {
    display: flex;
    flex: 1;
    flex-direction: column;
    background-color: white;
    padding: 12px;
    gap: 8px;
    .title {
        font-weight: bold;
    }
    .function {
        display: flex;
        flex-direction: row;
        padding-inline: 10px;

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
