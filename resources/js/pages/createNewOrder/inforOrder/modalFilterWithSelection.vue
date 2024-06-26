<template>
    <transition name="modal">
        <div class="modal-mask">
            <div class="modal-wrapper" @click.self="Cancel">
                <div class="modal-container">
                    <div class="content">
                        <div v-if="currentSelection === 'Parent'">
                            <div class="title">
                                <span class="titleText">Lọc sản phẩm</span>
                            </div>
                            <div class="contentSelection">
                                <span>Tất cả sản phẩm</span>
                            </div>
                            <div class="contentSelection">
                                <span
                                    @click="
                                        handleCurrentSelectionChange('Child')
                                    "
                                    >Thương hiệu <AkChevronRightSmall
                                /></span>
                            </div>
                            <div class="contentSelection">
                                <span
                                    @click="
                                        handleCurrentSelectionChange('Child')
                                    "
                                    >Danh mục <AkChevronRightSmall
                                /></span>
                            </div>
                            <div class="contentSelection contentSelectionLast">
                                <span
                                    @click="
                                        handleCurrentSelectionChange('Child')
                                    "
                                    >Tags <AkChevronRightSmall
                                /></span>
                            </div>
                        </div>
                        <!-- <div
                            v-if="currentSelection === 'a'"
                            class="testSelection"
                        >
                            <div class="title">
                                <span class="icon">
                                    <AnOutlinedArrowLeft @click="back" />
                                </span>
                                <span class="titleText"> Thương hiệu</span>
                            </div>
                            <div class="contentSelection">
                                <span @click="handleCurrentSelectionChange('a')"
                                    >Danh mục cấp 2 <AkChevronRightSmall
                                /></span>
                            </div>
                        </div>
                        <div
                            v-if="currentSelection === 'b'"
                            class="testSelection"
                        >
                            <div class="title">
                                <span class="titleText">Danh mục</span>
                            </div>
                            <div class="contentSelection">
                                <span> b</span>
                            </div>
                        </div> -->
                        <div v-else>
                            <div class="title">
                                <AnOutlinedArrowLeft @click="back" />
                                <span class="titleText">Thương hiệu</span>
                            </div>
                            <div class="contentSelection">
                                <span>Danh mục cấp 2</span>
                            </div>
                            <div class="contentSelection">
                                <span @click="handleCurrentSelectionChange('a')"
                                    >Danh mục cấp 2 <AkChevronRightSmall
                                /></span>
                            </div>
                            <div class="contentSelection">
                                <span @click="handleCurrentSelectionChange('b')"
                                    >Danh mục <AkChevronRightSmall
                                /></span>
                            </div>
                            <div class="contentSelection contentSelectionLast">
                                <span @click="handleCurrentSelectionChange('c')"
                                    >Tags <AkChevronRightSmall
                                /></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>

<script setup>
import {
    AkChevronRightSmall,
    AnOutlinedArrowLeft,
} from "@kalimahapps/vue-icons";
import { useRouter } from "vue-router";
import { ref, defineEmits } from "vue";

const router = useRouter();

const currentSelection = ref("Parent");

const back = () => {
    currentSelection.value = "Parent";
};
const handleCurrentSelectionChange = (item) => {
    currentSelection.value = item;
};

const emit = defineEmits(["showModal"]);

const Cancel = () => {
    emit("showModal");
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
    transition: opacity 0.3s ease;
}

.modal-wrapper {
    display: table-cell;
    vertical-align: middle;
}

.modal-container {
    margin: 0px 30px;
    background-color: #fff;
    border-radius: 2px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
    transition: all 0.3s ease;
    font-family: Helvetica, Arial, sans-serif;
    border-radius: 10px;

    .content {
        display: flex;
        flex: 1;
        flex-direction: column;
        padding-inline: 20px;
        .title {
            display: flex;
            flex: 1;
            justify-content: space-between;
            border-bottom: 1px solid #d9d9d9;
            padding-block: 20px;

            .titleText {
                display: flex;
                flex: 1;
                justify-content: center;
                font-size: 16px;
                font-weight: 600;
            }
            .icon {
                position: absolute;
            }
        }
        .contentSelection {
            border-bottom: 1px solid #d9d9d9;
            padding-block: 12px;
            font-size: 14px;
            line-height: 22px;
            color: black;

            span {
                display: flex;
                flex: 1;
                justify-content: space-between;
                align-items: center;
                text-decoration: none;
                color: black;
            }
        }
        .contentSelectionLast {
            border: 0;
        }
        .testSelection {
            display: flex;
            flex: 1;
            flex-direction: column;

            .contentSelection {
                display: flex;
                flex: 1;
                justify-content: space-between;
                align-items: center;
            }
        }
    }
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
