<template>
    <div class="mainAddNewProduct">
        <div class="title">
            <AnOutlinedArrowLeft @click="back" />
            <span> Thêm sản phẩm </span>
        </div>
        <div class="content">
            <div class="search">
                <a-input-search
                    v-model:value="nameOrPhoneNumber"
                    placeholder="Nhập tên sản phẩm/combo"
                />
            </div>
            <div class="filterWithSelection">
                <span class="filterSpan" @click="showModalFilterWithSelection"
                    >Tất cả sản phẩm <AkChevronDownSmall
                /></span>
            </div>
            <modalFilterWithSelection
                v-if="isShowModalFilterWithSelection"
                @showModal="showModalFilterWithSelection"
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
                                        {{ product.quantity }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a-checkbox-group>
                <!-- <a-radio-group v-model:value="a">
                    <a-button type="text" @click="addNewUser">
                        <CaAddAlt />Thêm mới sản phẩm
                    </a-button>

                </a-radio-group> -->
            </div>
            <!-- <div style="height: 1000px" /> -->
        </div>
        <div class="saveDive">
            <span> Đã chọn ({{ a.length }}) sản phẩm</span>
            <a-button type="primary" @click="buttonSave">Lưu</a-button>
        </div>
    </div>
</template>

<script setup>
import {
    AnOutlinedArrowLeft,
    CaAddAlt,
    AkChevronDownSmall,
} from "@kalimahapps/vue-icons";
import modalFilterWithSelection from "./modalFilterWithSelection.vue";
import { useRouter } from "vue-router";
import { ref, computed, onMounted } from "vue";
import axios from "axios";

const a = ref([]);
// const selectedUser = ref("");
const nameOrPhoneNumber = ref("");
const router = useRouter();

const isShowModalFilterWithSelection = ref(false);
const showModalFilterWithSelection = () => {
    isShowModalFilterWithSelection.value =
        !isShowModalFilterWithSelection.value;
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
    try {
        const response = await axios.get(
            `${import.meta.env.VITE_APP_URL_API}/inforProduct`
        );
        if (response.data.status === 1) {
            data.value = response.data.inforProduct;
        } else {
            console.log("Faile");
        }
    } catch (e) {
        console.log("Error: ", e);
    }
};
onMounted(() => fetchData());

const back = () => {
    router.back();
};

const addNewUser = () => {
    router.push("/addProduct");
};

// const buttonSave = async () => {
//     try {
//         // if (a.value === "guest") {
//         //     console.log("Đã chọn khách lẻ");
//         // } else if (a.value && a.value != "guest") {
//         //     selectedUser.value = data.value.find((user) => user.id === a.value);
//         //     console.log("Đã chọn user: ", selectedUser.value);
//         // }

//         // router.back();

//         const response = await axios.post(
//             `${import.meta.env.VITE_APP_URL_API}/chooseUserOrder`,
//             {
//                 id: a.value,
//             }
//         );
//         if (response.data.status === 1) {
//             // if (a.value === "guest") {
//             //     console.log("Đã chọn: ", response.data.dataUserOrder);
//             // } else {
//             //     console.log("Đã chọn: ", response.data.dataUserOrder.name);
//             // }
//             router.back();
//         } else {
//             // console.log("Faile");
//         }
//     } catch (e) {
//         console.log("Lỗi: " + e);
//     }
// };
const buttonSave = () => {
    // alert("Chưa xử lý");
    console.log(a.value.sort().toString());
};
// const test = (user) => {
//     const index = a.value.indexOf(user);
//     if (index > -1) {
//         a.value.splice(index, 1);
//     } else {
//         a.value.push(user);
//     }
// };
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
    gap: 20px;

    .title {
        background-color: white;
        display: flex;
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
            flex-direction: column;
            margin-bottom: 70px;
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
                            }

                            .quantityProduct {
                                font-size: 14px;
                                font-weight: 600;
                                .labelQuantity {
                                    font-size: 12px;
                                    font-weight: 500;
                                    color: #00000073;
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    .saveDive {
        position: fixed;
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
        }
    }
}
</style>
