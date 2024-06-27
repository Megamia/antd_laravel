<template>
    <transition name="modal">
        <div class="modal-mask">
            <div class="modal-wrapper" @click.self="Cancel">
                <div class="modal-container">
                    <div class="content">
                        <div
                            v-if="currentSelection === 'Parent'"
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
                        <div>
                            <div v-for="item in flattenedData" :key="item.id">
                                <div v-if="currentSelection === item.id">
                                    <div class="title">
                                        <AnOutlinedArrowLeft @click="back" />
                                        <span class="titleText">{{
                                            item.title
                                        }}</span>
                                    </div>

                                    <div
                                        class="contentSelection"
                                        v-for="childItem in item.itemsChil"
                                        :key="childItem.id"
                                    >
                                        <span
                                            @click="
                                                handleCurrentSelectionChange(
                                                    childItem.id
                                                )
                                            "
                                        >
                                            {{ childItem.name }}
                                            <AkChevronRightSmall
                                                v-if="childItem.iconNext"
                                            />
                                        </span>
                                    </div>
                                </div>
                            </div>
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
import { ref, defineEmits, computed } from "vue";

// const show = () => {
//     console.log("flattenedData: ",flattenedData.value);
// };
const router = useRouter();

const currentSelection = ref("Parent");

const back = () => {
    currentSelection.value = "Parent";
};
const handleCurrentSelectionChange = (item) => {
    if (item === 0) {
        return;
    } else {
        currentSelection.value = item;
        console.log(currentSelection.value);
    }
};
const flattenedData = computed(() => {
    const flatten = (dataChildDefault) => {
        return dataChildDefault.reduce((acc, item) => {
            acc.push(item);
            if (item.itemsChil) {
                acc = acc.concat(flatten(item.itemsChil));
            }
            return acc;
        }, []);
    };
    return (
        console.log(flatten(dataChildDefault.value)[0].items),
        flatten(dataChildDefault.value)[0].items
    );
});
const dataParentDefault = ref([
    {
        title: "Lọc sản phẩm",
        iconBack: false,
        items: [
            { id: 0, title: "Tất cả sản phẩm", iconNext: false },
            { id: 1, title: "Thương hiệu", iconNext: true },
            { id: 2, title: "Danh mục", iconNext: true },
            { id: 3, title: "Tags", iconNext: true },
        ],
    },
]);
const dataChildDefault = ref([
  {
    items: [
      {
        id: 1,
        title: "Thương hiệu",
        iconBack: true,
        iconNext: false,
        itemsChil: [
          { id: 1, name: "Danh mục cấp 2", iconNext: false },
          {
            id: 2,
            name: "Danh mục cấp 2",
            iconNext: true,
            title: "Thương hiệu",
            itemsChil: [
              { id: 1, name: "Danh mục cấp 3", iconNext: false },
              { id: 2, name: "Danh mục cấp 3", iconNext: true },
              { id: 3, name: "Danh mục cấp 3", iconNext: true },
            ],
          },
          { id: 3, name: "Danh mục cấp 2", iconNext: true },
          { id: 4, name: "Danh mục cấp 2", iconNext: true },
        ],
      },
      {
        id: 2,
        title: "Danh mục",
        iconBack: true,
        iconNext: false,
        itemsChil: [
          { id: 1, name: "Danh mục cấp 2", iconNext: false },
          { id: 2, name: "Danh mục cấp 2", iconNext: true },
          { id: 3, name: "Danh mục cấp 2", iconNext: true },
          { id: 4, name: "Danh mục cấp 2", iconNext: true },
        ],
      },
      {
        id: 3,
        title: "Tags",
        iconBack: true,
        iconNext: false,
        itemsChil: [
          { id: 1, name: "Danh mục cấp 2", iconNext: false },
          { id: 2, name: "Danh mục cấp 2", iconNext: true },
          { id: 3, name: "Danh mục cấp 2", iconNext: true },
          { id: 4, name: "Danh mục cấp 2", iconNext: true },
        ],
      },
    ],
  },
]);

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
