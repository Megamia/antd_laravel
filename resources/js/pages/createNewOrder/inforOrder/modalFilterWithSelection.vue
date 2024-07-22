<template>
    <transition name="modal">
        <div class="modal-mask">
            <div class="modal-wrapper" @click.self="Cancel">
                <div class="modal-container">
                    <div class="content">
                        <div class="title">
                            <AnOutlinedArrowLeft
                                v-if="titleId >= 2"
                                @click="back"
                            />
                            <span class="titleText" @click="test">{{
                                titleFilterWithTagValue
                            }}</span>
                        </div>
                        <div class="contentSelection" v-if="titleId === 1">
                            <span @click="showAll">Tất cả sản phẩm</span>
                        </div>
                        <div class="itemDetail">
                            <div
                                v-for="(dataParent, index) in dataParentDefault"
                                :key="index"
                            >
                                <div class="contentSelection">
                                    <span
                                        class="titleText"
                                        @click="
                                            handleCurrentSelectionChange(
                                                dataParent.id_item,
                                                dataParent.parent_id,
                                                dataParent.id
                                            )
                                        "
                                        >{{ dataParent.name }}
                                        <AkChevronRightSmall
                                            v-if="dataParent.itemChil === 1"
                                        />
                                    </span>
                                    <!-- <span v-else @click="show(dataParent.id_item, dataParent.parent_id)">
                                    {{ dataParent.name }}
                                </span> -->
                                </div>

                                <!-- <div class="contentSelection" >
                                <span @click="
                                    handleCurrentSelectionChange(
                                        dataParent.id_item
                                    )
                                    ">{{ dataParent.id_item }}
                                    <AkChevronRightSmall v-if="dataParent.itemChil" />
                                </span>
                            </div> -->
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
import { ref, defineEmits, onMounted } from "vue";
import axios from "axios";
// const show = () => {
//     console.log("flattenedData: ",flattenedData.value);
// };
const router = useRouter();
const emit = defineEmits(["showModal", "tags"]);

const back = () => {
    titleId = titleId - 1;

    fetchData();
    fetchDataTitle();
    return;
};

const test = () => {
    console.log(titleId);
};

const show = (data1, data2) => {
    console.log(data1, data2);
};

let currentItemId = 1;
let iconback = 0;
const itemChoosed = ref("");

const showAll = async () => {
    try {
        const response = await axios.get(
            `${import.meta.env.VITE_APP_URL_API}/itemFilterWithTag`
        );
        if (response.data.status === 1) {
            // console.log("All: ", response.data.inforProduct)
            itemChoosed.value = response.data.itemFilterWithTag;
            let ids = itemChoosed.value.map((item) => item.id).join(",");
            // console.log("IDs: ", ids);
            emit("tags", ids);
        } else if (response.data.status === 0) {
            console.log(response.data.itemFilterWithTag);
        }
    } catch (e) {
        console.log("Error: ", e);
    }
};

const choosed = ref("");
let level = 0;
const handleCurrentSelectionChange = (id_item, parent_id, id) => {
    // console.log(id_item, parent_id, id);
    fetchDataItem(id_item, parent_id);
    choosed.value = dataParentDefault.value.filter((item) => item.id === id);
    for (let i = 0; i < choosed.value.length; i++) {
        level = choosed.value[i].parent_id;
        choosed.value = choosed.value[i].id;
        // console.log("level:", level)
    }
    // console.log("choosed.value: ", choosed.value);
    // console.log("Level: ", level)
    if (level === 3) {
        emit("tags", choosed.value);
    }

    // for(let i=0;i<dataParentDefault.value.length;i++){
    //     itemChoosed.value=dataParentDefault.value[i].find(item=>item.)
    // }
    // console.log('itemChoosed.value: ', itemChoosed.value)
};

const fetchDataItem = async (id_item, parent_id) => {
    parent_id = parent_id + 1;
    try {
        // console.log(parent_id, id_item)
        const response = await axios.post(
            `${import.meta.env.VITE_APP_URL_API}/dataTagItem`,
            {
                parent_id: parent_id,
                id_item: id_item,
            }
        );
        if (response.data.status === 1) {
            // console.log(response.data.dataTagItem)
            dataParentDefault.value = response.data.dataTagItem;
            // console.log(dataParentDefault.value)
        } else if (response.data.status === 0) {
            // console.log(response.data.dataTagItem)
        }
        fetchDataTitle(id_item);
    } catch (e) {
        console.log("Error: ", e);
    }
};

const dataParentDefault = ref("");
const titleFilterWithTagValue = ref("");
let titleId;

const fetchDataTitle = async (id_item) => {
    try {
        if (id_item) {
            titleId = id_item + 1;
        } else {
            titleId = 1;
        }
        const response = await axios.post(
            `${import.meta.env.VITE_APP_URL_API}/titleFilterWithTag`,
            {
                title_id: titleId,
            }
        );
        if (response.data.status === 1) {
            // console.log(response.data.titleFilterWithTag);
            titleFilterWithTagValue.value =
                response.data.titleFilterWithTag.title_name;
        } else if (response.data.status === 0) {
            // console.log(response.data.titleFilterWithTag);
        }
    } catch (e) {
        console.log("Error: ", e);
    }
};

let currentParentId = 1;

const fetchData = async () => {
    try {
        const response = await axios.post(
            `${import.meta.env.VITE_APP_URL_API}/choosedTag`,
            {
                parent_id: currentParentId,
            }
        );
        if (response.data.status === 1) {
            dataParentDefault.value = response.data.choosedTag;
        } else if (response.data.status === 0) {
            // console.log(dataParentDefault.value);
        }
        fetchDataTitle();
    } catch (e) {
        console.log("Error: ", e);
    }
};
onMounted(async () => {
    try {
        await Promise.all([
            fetchData(),
            // , fetchDataTitle()
        ]);
    } catch (error) {
        console.error("Error fetching data:", error);
    }
});
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

        .title {
            display: flex;
            flex: 1;
            justify-content: space-between;
            border-bottom: 1px solid #d9d9d9;
            padding-block: 20px;
            padding-inline: 20px;
            align-items: center;

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
            margin-inline: 20px;

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
        /* .itemDetail {
        } */
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
