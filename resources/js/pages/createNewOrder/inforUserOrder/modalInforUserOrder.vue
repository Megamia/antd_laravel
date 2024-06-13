<template>
    <transition name="modal">
        <div class="modal-mask">
            <div class="modal-wrapper">
                <div :class="container" >
                    <div class="title">
                        <span class="titleText" @click="a">Chi tiết khách hàng</span>
                    </div>
                    <div class="content">
                        <div class="router">
                            <span @click="handlePageChange('a')"
                            :class="{ act: currentPage === 'a' }">
                                    
                                    Thông tin chung
                            </span>
                            <span @click="handlePageChange('b')"
                            :class="{ act: currentPage === 'b' }">
                                    
                                    Thông tin boom hàng
                            </span>
                        </div>
                    </div>
                    <anotherInfor v-if="currentPage==='b'"/>
                    <div v-if="currentPage==='a'">abc</div>
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
import anotherInfor from "../anthoerInfor/anotherInfor.vue";
const emit = defineEmits(["closeModal"]);

const Cancel = () => {
    emit("closeModal");
};

const container = ref('modal-container')

function a() {
  container.value = container.value === 'modal-container' ? 'modal2' : 'modal-container'
}
const currentPage = ref(localStorage.getItem("currentPage") || "a");

const handlePageChange = (page) => {
    currentPage.value = page;
    localStorage.setItem("currentPage", page);
};
</script>
<style scoped>
.modal-mask {
    position: fixed;
    z-index: 9998;
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

.modal2 {
    height: 500px;
    position: relative;
    background-color: #fff;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
    transition: all 0.3s ease;
    font-family: Helvetica, Arial, sans-serif;
    border-radius: 10px;
    overflow-y: auto; 
    min-height: 100vh;
    
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
                a-active {
                    color: red;
                }
                a-focus {
                    color: red;
                }
            }
        }
    }
    .buttonChange {
        display: flex;
        flex: 1;

        button {
            border-bottom-right-radius: 5px;
            border-bottom-left-radius: 5px;
            background-color: white;
            display: flex;
            flex: 1;
            justify-content: center;
            border: 1px solid #d9d9d9;
            color: black;
            font-size: 16px;
            padding: 15px;
        }
    }
}
.modal-container {
    height: 500px;
    position: relative;
    background-color: #fff;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
    transition: all 0.3s ease;
    font-family: Helvetica, Arial, sans-serif;
    border-radius: 10px;
    overflow-y: auto; 
    max-height: 90vh;
    
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
                a-active {
                    color: red;
                }
                a-focus {
                    color: red;
                }
            }
        }
    }
    .buttonChange {
        display: flex;
        flex: 1;

        button {
            border-bottom-right-radius: 5px;
            border-bottom-left-radius: 5px;
            background-color: white;
            display: flex;
            flex: 1;
            justify-content: center;
            border: 1px solid #d9d9d9;
            color: black;
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
