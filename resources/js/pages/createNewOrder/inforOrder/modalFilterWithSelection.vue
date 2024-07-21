<template>
    <transition name="modal">
        <div class="modal-mask">
            <div class="modal-wrapper" @click.self="Cancel">
                <div class="modal-container">
                    <div class="content">
                        <div
                            v-for="(dataParent, index) in dataParentDefault"
                            :key="index"
                        >
                            <div class="title">
                                <AnOutlinedArrowLeft
                                    v-if="dataParent.iconBack"
                                />
                                <span class="titleText">{{
                                    dataParent.title
                                }}</span>
                            </div>

                            <div
                                class="contentSelection"
                                v-for="(dataChil, index) in dataParent.items"
                                :key="index"
                            >
                                <span
                                    @click="
                                        handleCurrentSelectionChange(
                                            dataChil.id
                                        )
                                    "
                                    >{{ dataChil.title }}
                                    <AkChevronRightSmall
                                        v-if="dataChil.iconNext"
                                    />
                                </span>
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

// const show = () => {
//     console.log("flattenedData: ",flattenedData.value);
// };
const router = useRouter();
const emit = defineEmits(["showModal", "tags"]);

const back = () => {
    currentSelection.value = "Parent";
};
const handleCurrentSelectionChange = (item) => {
    if (item === 0) {
        return;
    } else {
        console.log(item);
        emit("tags", item);
    }
};

const dataParentDefault = ref([
    {
        title: "Lọc sản phẩm",
        iconBack: false,
        items: [
            { id: 0, title: "Tất cả sản phẩm", iconNext: false },
            { id: 1, title: "Tag1", iconNext: true },
            { id: 2, title: "Tag2", iconNext: true },
            { id: 3, title: "Tag3", iconNext: true },
        ],
    },
]);

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
