<template>
    <transition name="modal">
        <div class="modal-mask">
            <div class="modal-wrapper" @click.self="Cancel">
                <div class="modal-container">
                    <div class="header">
                        <div class="title">
                            <span class="titleText" @click="a"
                                >Chi tiết khách hàng</span
                            >
                        </div>
                        <div class="content">
                            <div class="router">
                                <span
                                    @click="handlePageChange('a')"
                                    :class="{ act: currentPage === 'a' }"
                                >
                                    Thông tin chung
                                </span>
                                <span
                                    @click="handlePageChange('b')"
                                    :class="{ act: currentPage === 'b' }"
                                >
                                    Thông tin boom hàng
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="detailContent">
                        <div class="generalInfor" v-if="currentPage === 'a'">
                            <GeneralInfor />
                        </div>
                        <div class="anotherInfor" v-if="currentPage === 'b'">
                            <BoomInfor />
                        </div>
                    </div>
                    <div class="buttonChange">
                        <button class="buttonCancel" @click="Cancel">
                            Hủy
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>

<script setup>
import { ref, defineEmits } from "vue";
import GeneralInfor from "./GeneralInfor.vue";
import BoomInfor from "./BoomInfor.vue";
const emit = defineEmits(["closeModal"]);

const Cancel = () => {
    localStorage.removeItem("currentPage");
    emit("closeModal");
};

const currentPage = ref(localStorage.getItem("currentPage") || "a");

const handlePageChange = (page) => {
    currentPage.value = page;
    localStorage.setItem("currentPage", page);
};
</script>

<style scoped>
.modal-mask {
    position: fixed;
    z-index: 100;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: table;
    /* overflow-y: none;  */
    transition: opacity 0.3s ease;
}

.modal-wrapper {
    display: table-cell;
    vertical-align: bottom;
}

.modal-container {
    /* height: 70vh; */
    /* position: relative; */
    background-color: #fff;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
    transition: all 0.3s ease;
    font-family: Helvetica, Arial, sans-serif;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
    /* overflow-y: scroll; */
    /* padding-bottom: 70px; */

    .header {
        display: flex;
        flex: 1;
        flex-direction: column;
        height: 100px;
        /* background-color: red; */
        .title {
            display: flex;
            flex: 1;
            padding-block: 20px;

            .titleText {
                display: flex;
                flex: 1;
                justify-content: center;
                font-size: 16px;
                font-weight: 600;
            }
        }

        .content {
            display: flex;
            flex: 1;
            flex-direction: column;
            border-bottom: 1px solid #d9d9d9;

            .router {
                display: flex;
                flex: 1;
                span {
                    display: flex;
                    flex: 1;
                    justify-content: center;
                    font-size: 14px;
                    color: black;
                    font-weight: 500;
                    padding-block: 15px;

                    a-active {
                        color: red;
                    }

                    a-focus {
                        color: red;
                    }
                }
            }
        }
    }

    .detailContent {
        display: flex;
        flex: 1;
        /* height:300px; */
        overflow-y: scroll;

        .generalInfor,
        .anotherInfor {
            height: 450px;
            overflow-y: scroll;
            display: flex;
            flex: 1;
            flex-direction: column;
            padding-block: 20px;
        }

        /* .anotherInfor {
            z-index: 200;
            position: relative;
            transition: all 0.3s ease;
            overflow-y: auto;
        } */
    }

    .buttonChange {
        /* position: fixed; */
        width: 100%;
        display: flex;
        flex: 1;
        bottom: 0;
        z-index: 300;
        padding-inline: 20px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
        padding: 10px;
        border-width: 0;
        background-color: white;

        button {
            background-color: white;
            width: 100%;
            justify-content: center;
            background-color: #1890ff;
            color: white;
            border-width: 0;
            font-size: 16px;
            padding: 15px;
        }
    }
}

.act {
    border-bottom: 3px solid #0d99ff !important;
    fill: #0d99ff !important;
    font-weight: bold !important;
    color: #0d99ff !important;
}

.modal-header h3 {
    margin-top: 0;
    color: #42b983;
}

.modal-enter {
    opacity: 0;
}

.modal-leave-active {
    opacity: 0;
}

.modal-enter .modal-container,
.modal-leave-active .modal-container {
    -webkit-transform: scale(1.1);
    transform: scale(1.1);
}

.active {
    border-color: #1890ff;
    color: #1890ff;
}
</style>
