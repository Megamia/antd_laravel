<template>
    <div class="mainAddNewProduct">
        <div class="title">
            <AnOutlinedArrowLeft @click="back" />
            <span> Thêm sản phẩm </span>
        </div>
        <div class="content">
            <div class="details">
                <div class="search">
                    <a-input-search
                        v-model:value="nameOrPhoneNumber"
                        placeholder="Nhập tên sản phẩm/combo"
                    />
                </div>
                <div class="filterWithSelection">
                    <span
                        class="filterSpan"
                        @click="showModalFilterWithSelection"
                        >Tất cả sản phẩm
                        <AkChevronDownSmall />
                    </span>
                </div>
                <modalFilterWithSelection
                    v-if="isShowModalFilterWithSelection"
                    @showModal="showModalFilterWithSelection"
                    @tags="filterWithTag"
                />
                <div class="productInfor">
                    <a-checkbox-group v-model:value="a" style="width: 100%">
                        <div
                            class="productItems"
                            v-for="product in filter"
                            :key="product.id"
                        >
                            <a-checkbox
                                :value="product.id"
                                style="margin-left: 12px; margin-top: 12px"
                                :disabled="product.quantity <= 0"
                            />
                            <div class="productInforRadio">
                                <img
                                    style="
                                        width: 60px;
                                        height: 60px;
                                        margin-block: 10px;
                                    "
                                    :src="product.img"
                                />
                                <div class="detailsProduct">
                                    <div class="nameAndTagProduct">
                                        <span class="nameProduct">{{
                                            product.name
                                        }}</span>
                                        <span class="tagProduct">{{
                                            product.tag
                                        }}</span>
                                    </div>
                                    <div class="priceAndQuantityProduct">
                                        <span class="priceProduct">
                                            {{ product.price }}đ
                                        </span>
                                        <span class="quantityProduct">
                                            <span class="labelQuantity"
                                                >Tồn kho:
                                            </span>
                                            <span class="textQuantity">
                                                {{ product.quantity }}
                                            </span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="height: 1000px; width: 100%" />
                    </a-checkbox-group>
                    <!-- <a-radio-group v-model:value="a">
                    <a-button type="text" @click="addNewUser">
                        <CaAddAlt />Thêm mới sản phẩm
                    </a-button>

                </a-radio-group> -->
                </div>
            </div>
        </div>

        <div class="footer">
            <div class="saveDive">
                <span> Đã chọn ({{ a.length }}) sản phẩm</span>
                <a-button type="primary" @click="buttonSave">Lưu</a-button>
            </div>
        </div>
    </div>
</template>

<script setup>
import {
    AnOutlinedArrowLeft,
    CaAddAlt,
    AkChevronDownSmall,
} from "@kalimahapps/vue-icons";
import ModalFilterWithSelection from "./ModalFilterWithSelection.vue";
import { useRouter } from "vue-router";
import { ref, computed, onMounted, defineEmits } from "vue";
import axios from "axios";
import eventBus from "../../../eventBus";
const emit = defineEmits(["choosedProduct", "fetchData"]);

const tag = ref("");
const a = ref([1]);
// if (eventBus.product.idProduct) {
//     for (let i = 0; i < eventBus.product.idProduct.length; i++) {
//         console.log(eventBus.product.idProduct[i].value);
//     }
// }
// a.value = eventBus.product.idProduct.split(",").map((item) => item.trim());
// const selectedUser = ref("");
const nameOrPhoneNumber = ref("");
const router = useRouter();

const isShowModalFilterWithSelection = ref(false);
const showModalFilterWithSelection = () => {
    isShowModalFilterWithSelection.value =
        !isShowModalFilterWithSelection.value;
};
const filterWithTag = (data) => {
    isShowModalFilterWithSelection.value =
        !isShowModalFilterWithSelection.value;
    // console.log("filterWithTag:", data);
    tag.value = data;
    // console.log("tag.value:", tag.value);
    fetchData();
};
// const click = () => {
//     if (a.value === "guest") {
//         console.log("Đã chọn khách lẻ");
//     } else {
//         selectedUser.value = data.value.find((user) => user.id === a.value);
//         if (selectedUser.value) {
//             console.log("Đã chọn user: ", selectedUser.value.name);
//         } else {
//             console.log(a.value);
//         }
//     }
// };

const data = ref({});

const fetchData = async () => {
    if (eventBus.product.idProduct) {
        let values = Object.values(eventBus.product.idProduct);
        eventBus.product.idProduct = values.join(",").split(",").map(Number);
        a.value = eventBus.product.idProduct.filter((item) => item !== 0);
    }

    try {
        if (tag.value) {
            // console.log(tag.value);
            const response = await axios.post(
                `${import.meta.env.VITE_APP_URL_API}/inforProductWithTag`,
                {
                    tag: tag.value,
                }
            );
            if (response.data.status === 1) {
                data.value = response.data.inforProductWithTag;
                // console.log(data.value);
                return data.value;
            } else {
                console.log("Faile");
            }
        } else {
            const response = await axios.get(
                `${import.meta.env.VITE_APP_URL_API}/inforProduct`
            );
            if (response.data.status === 1) {
                data.value = response.data.inforProduct;
                return data.value;
            } else {
                console.log("Faile");
            }
        }
    } catch (e) {
        console.log("Error: ", e);
    }
};

onMounted(() => fetchData());

const back = () => {
    buttonSave();
};

const addNewUser = () => {
    router.push("/addProduct");
};

const buttonSave = async () => {
    if (!a.value || a.value.length <= 0) {
        alert("Hãy chọn ít nhất 1 sản phẩm");
        a.value = [1];
    } else {
        // console.log(a.value.sort().toString());
        // console.log(a.value);
        try {
            const response = await axios.post(
                `${import.meta.env.VITE_APP_URL_API}/choosedProduct`,
                {
                    id: a.value.sort().toString(),
                }
            );
            if (response.data.status === 1) {
                // console.log(response.data.choosedProduct);
                eventBus.product.idProduct = a.value.sort().toString();
                // console.log("evB: ", eventBus.product.idProduct);
                router.back();
                // emit("choosedProduct", response.data.choosedProduct);
            } else {
                console.log("No choosedProduct");
            }
        } catch (e) {
            console.log("Error: ", e);
        }
    }
};
const filter = computed(() => {
    if (nameOrPhoneNumber.value) {
        return data.value.filter((product) => {
            return nameOrPhoneNumber.value
                .toLowerCase()
                .split(" ")
                .every(
                    (v) =>
                        product.name.toLowerCase().includes(v) ||
                        product.price.toLowerCase().includes(v)
                );
        });
    } else {
        return data.value;
    }
});
</script>

<style scoped>
.mainAddNewProduct {
    display: flex;
    flex: 1;
    flex-direction: column;
    background-color: #f0f2f5;

    .title {
        background-color: white;
        display: flex;
        max-height: 100px;
        padding: 16px 36px 16px 12px;
        align-items: center;
        background-color: white;
        box-shadow: rgba(0, 0, 0, 0.35) 0px 0px 8px;
        text-align: center;

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
        flex: 1;
        overflow-y: scroll;
        padding-top: 20px;
        .details {
            display: flex;
            flex: 1;
            flex-direction: column;
            background-color: white;

            .search {
                padding: 10px 12px 10px 12px;
                border-bottom: 1px solid #d9d9dd;
            }

            .filterWithSelection {
                background-color: #f0f2f5;
                padding: 12px;
                gap: 8px;

                .filterSpan {
                    font-size: 14px;
                    color: #000000d9;
                    font-weight: 400;
                }
            }

            .productInfor {
                display: flex;
                flex: 1;
                flex-direction: column;
                margin-bottom: 70px;
                height: 400px;
                overflow-y: scroll;
                button {
                    display: flex;
                    flex: 1;
                    align-items: center;
                    padding: 10px;
                    border-radius: 0;
                    color: #1890ff;
                    gap: 10px;
                }

                .productItems {
                    display: flex;
                    flex: 1;
                    flex-direction: row;
                    align-items: start;
                    border-top: 1px solid #d9d9dd;
                    gap: 10px;

                    .productInforRadio {
                        display: flex;
                        flex: 1;
                        flex-direction: row;

                        .detailsProduct {
                            display: flex;
                            flex: 1;
                            flex-direction: column;
                            padding: 12px;
                            gap: 10px;

                            .nameAndTagProduct {
                                display: flex;
                                flex: 1;
                                flex-direction: column;
                                .nameProduct {
                                    font-size: 14px;
                                    white-space: nowrap;
                                    text-overflow: ellipsis;
                                    overflow: hidden;
                                    max-width: 250px;
                                    /* background-color: red; */
                                }
                                .nameProduct:hover {
                                    overflow: visible;
                                }

                                .tagProduct {
                                    font-size: 12px;
                                    color: #00000073;
                                }
                            }

                            .priceAndQuantityProduct {
                                display: flex;
                                flex: 1;
                                flex-direction: row;
                                justify-content: space-between;

                                .priceProduct {
                                    font-size: 14px;
                                    color: #f26722;
                                    white-space: nowrap;
                                    text-overflow: ellipsis;
                                    overflow: hidden;
                                    max-width: 150px;
                                }
                                .priceProduct:hover {
                                    overflow: visible;
                                }

                                .quantityProduct {
                                    font-size: 14px;
                                    font-weight: 600;

                                    .labelQuantity {
                                        font-size: 12px;
                                        font-weight: 500;
                                        color: #00000073;
                                    }
                                    .textQuantity {
                                        white-space: nowrap;
                                        text-overflow: ellipsis;
                                        overflow: hidden;
                                        max-width: 10px;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    .footer {
        display: flex;
        .saveDive {
            /* position: absolute; */
            /* fixed*/
            display: flex;
            flex-direction: column;
            background-color: white;
            bottom: 0;
            width: 100%;
            padding: 10px;
            border: 0 0 10px 0;
            border-top: 1px solid rgba(0, 0, 0, 0.15);
            box-shadow: 0 0.15rem 0.15rem rgba(0, 0, 0, 0.15);

            button {
                position: relative;
                width: 100%;
                border-radius: 0;
                margin-top: 10px;
            }
        }
    }
}
</style>
