<template>
    <div class="mainUserOrder">
        <div class="title">
            <span> Thông tin khách hàng</span>
        </div>
        <div class="function">
            <a-button class="button buttonAdd" @click="nothing">
                <BxTimer />Khách lẻ</a-button
            >
            <a-button class="button buttonScan" @click="nothing">
                <AnOutlinedUserAdd />Thêm mới</a-button
            >
            <a-button class="button buttonScan" @click="nothing">
                <PhMagnifyingGlass />Tìm kiếm</a-button
            >
        </div>
    </div>
</template>
<script setup>
import {
    BxTimer,
    AnOutlinedUserAdd,
    PhMagnifyingGlass,
} from "@kalimahapps/vue-icons";
const nothing = () => {
    alert("Chưa xử lý sự kiện này");
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
    }
    .function {
        display: flex;
        flex-direction: row;
        padding-inline: 10px;
        
        button {
            display: flex;
            flex: 1;
            flex-direction: row;
            align-items: center;
            background-color: #f5f5f5;
            gap: 5px;
            font-size: 14px;
            font-weight: 400;
            border-width: 0;
            justify-content: center;
            svg {
                color: #f26722;
            }
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
