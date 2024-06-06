<template>
    <div class="mainAddNewUser">
        <div class="title">
            <AnOutlinedArrowLeft @click="back" />
            <span> Tìm kiếm khách hàng </span>
        </div>
        <div class="content">
            <div class="search">
                <a-input-search
                    v-model:value="value"
                    placeholder="Nhập tên và số điện thoại"
                    search
                />
            </div>
            <div class="userInfor">
                <a-button type="text">
                    <CaAddAlt />Thêm mới khách hàng
                </a-button>
                <div class="userItems">
                    <a-radio v-model:checked="checked">
                        <div class="userInforRadio">
                            <span class="nameUser">Khách lẻ</span>
                        </div>
                    </a-radio>
                </div>
                <div class="userItems">
                    <a-radio v-model:checked="checked" />
                    <div class="userInforRadio">
                        <span class="nameUser">Đỗ Phúc Lộc</span>
                        <span class="phoneNumberUser">0388911562</span>
                    </div>
                </div>
                <div class="userItems">
                    <a-radio v-model:checked="checked" />
                    <div class="userInforRadio">
                        <span class="nameUser">Đỗ Phúc Lộc</span>
                        <span class="phoneNumberUser">0388911562</span>
                    </div>
                </div>
                <div class="userItems">
                    <a-radio v-model:checked="checked" />
                    <div class="userInforRadio">
                        <span class="nameUser">Đỗ Phúc Lộc</span>
                        <span class="phoneNumberUser">0388911562</span>
                    </div>
                </div>
                <div class="userItems">
                    <a-radio v-model:checked="checked" />
                    <div class="userInforRadio">
                        <span class="nameUser">Đỗ Phúc Lộc</span>
                        <span class="phoneNumberUser">0388911562</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="saveDive">
            <a-button type="primary">Lưu</a-button>
        </div>
    </div>
</template>

<script setup>
import { AnOutlinedArrowLeft, CaAddAlt } from "@kalimahapps/vue-icons";
import { useRouter } from "vue-router";
import { ref } from "vue";

const checked = ref();
const value = ref("");
const router = useRouter();

const back = () => {
    router.back();
};
</script>

<style scoped>
.mainAddNewUser {
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
    .content {
        display: flex;
        flex-direction: column;
        background-color: white;
        .search {
            padding: 10px 12px 10px 12px;
            border-bottom: 1px solid #d9d9dd;
        }
        .userInfor {
            display: flex;
            flex-direction: column;
            button {
                display: flex;
                flex: 1;
                align-items: center;
                padding: 10px;
                border-radius: 0;
                color: #1890ff;
                gap: 10px;
            }
            .userItems {
                display: flex;
                flex-direction: row;
                align-items: start;
                border-top: 1px solid #d9d9dd;
                margin-inline: 10px;
                padding-block: 10px;
                .userInforRadio {
                    display: flex;
                    flex-direction: column;
                }
                .nameUser {
                    font-size: 14px;
                }
                .phoneNumberUser {
                    font-size: 14px;
                    color: #00000073;
                }
            }
        }
    }
    .saveDive {
        position: absolute;
        display: flex;
        background-color: white;
        bottom: 0;
        width: 100%;
        padding: 10px;

        button {
            position: relative;
            width: 100%;
            border-radius: 0;
        }
    }
}
</style>
