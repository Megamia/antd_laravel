<template>
    <div class="mainInforOrder">
        <div class="header">
            <div class="title">
                <span class="inforText"> Sản phẩm </span>
                <span class="showMore" @click="show" v-if="showOrder">
                    <AkChevronDownSmall />
                </span>
                <span class="showMore" @click="show" v-else>
                    <AkChevronUpSmall />
                </span>
            </div>
            <div class="button" v-if="showOrder">
                <a-button class="buttonAdd" @click="addNewProduct">
                    <CaAddAlt />Thêm sản phẩm</a-button
                >
                <a-button class="buttonScan" @click="openModalScanQRCode">
                    <BxScan />Quét mã</a-button
                >
                <modalScanQRCode
                    v-if="isModalScanQRCode"
                    @closeModalScanQrCode="closeModalScanQrCode"
                />
            </div>
        </div>
        <div class="content" v-if="showOrder">
            <div class="totalProduct">
                <div class="product">
                    <div class="imgDiv">
                        <a-image
                            :width="80"
                            :height="80"
                            src="https://s3-alpha-sig.figma.com/img/27b2/3acc/b01a8548b32136d8258ebb5131b4b5b4?Expires=1717977600&Key-Pair-Id=APKAQ4GOSFWCVNEHN3O4&Signature=ki-IpgNmUleGIka9Y2E6aih9HChCU90LUwrolhQyV2wTr~scB1GDPUIlkFAnATLM-4ooNUMCZtxvuS7a4ev~qkEX3TWeDmLStLTsNhYun6V~Pqd31vVyQ0aT~5lxaubUkgHOsblQaM6hOs3a72AUO-XS-0IvMb0y4ak2EfYOQz6ieqON4rnXmE48ggUitCy4Sk4MYeMsA95Xju0LavyvaTPmMreGLi8o6f28AVfpDaA74l2cKn3~-YWOWc2O07gnOEDX1s2HIDA1eV9nni28DLyjboOTd8D2HES26RgHze~0vZUplJJM7T7mqb0xIj48fl9ck1AB~2VbWp0EuZ8WyA__"
                        />
                    </div>
                    <div class="detailProduct">
                        <div class="products">
                            <span class="nameProduct">
                                Tên sản phẩm có phân loại</span
                            >
                            <span class="typeProduct"> Phân loại sản phẩm</span>
                            <span class="costProduct">
                                200.000đ
                                <AnOutlinedEdit @click="clickShowModal"
                            /></span>
                        </div>
                        <div class="changeQuantityOrder">
                            <div class="buttonChangeQuantityOrder">
                                <button
                                    class="buttonAddOrder"
                                    @click="buttonAddOrder"
                                >
                                    +
                                </button>
                                <input
                                    class="inputQuantityOrder"
                                    v-model="value1"
                                    type="number"
                                    required
                                />
                                <button
                                    class="buttonDelOrder"
                                    @click="buttonDelOrder"
                                >
                                    -
                                </button>
                            </div>
                            <div class="delOrderDiv">
                                <span @click="nothing">Xóa</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product">
                    <div class="imgDiv">
                        <a-image
                            :width="80"
                            :height="80"
                            src="https://s3-alpha-sig.figma.com/img/437a/b313/0b936eb81d043d5545d8b6c5a271f7d6?Expires=1717977600&Key-Pair-Id=APKAQ4GOSFWCVNEHN3O4&Signature=GM7YL~rr8mSP0q~KN6FYKrGncZF-eJVa3P7qJcBYK8VD-XLPiarXKMzweJBEMRvarqAgT-JKGhxjYuKSEbLmkJ1Wnu-v7S2JDjuveRwulvjIoRhldmahtFPshtE63ZWDKwUCt2uIFNGRWZASP2RDeQ~wulDPQZOggp4ouI5DqOCGeEbZ2QQ46cjYFf68EE3MlhS38gEQyZDI4EoKHKVBKpxoBy8Hn3fLRoVcaPw2L1Ue5Cw8jO0FeFMF66fRI2d7-wBv583YBKMIF8asbJnTDUZnglm5wgvFMHZiSOhj1dCtEl75JIIbLcJziYIQG3e17QolIyIwMwxBYJi13Ez-Ow__"
                        />
                    </div>
                    <div class="detailProduct">
                        <div class="products">
                            <span class="nameProduct">
                                Tên sản phẩm không có phân loại</span
                            >
                            <span class="typeProduct"> Phân loại sản phẩm</span>
                            <span class="costProduct">
                                1.900.000đ
                                <AnOutlinedEdit @click="clickShowModal"
                            /></span>
                        </div>
                        <div class="changeQuantityOrder">
                            <div class="buttonChangeQuantityOrder">
                                <button
                                    class="buttonAddOrder"
                                    @click="buttonAddOrder"
                                >
                                    +
                                </button>
                                <input
                                    class="inputQuantityOrder"
                                    v-model="value1"
                                    type="number"
                                    required
                                />
                                <button
                                    class="buttonDelOrder"
                                    @click="buttonDelOrder"
                                >
                                    -
                                </button>
                            </div>
                            <div class="delOrderDiv">
                                <span @click="nothing">Xóa</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="totalCostOrder">
            <span class="countOrder">Tạm tính (8 sản phẩm)</span>
            <span class="costOrder"> 2.900.000đ</span>
        </div>
    </div>
</template>
<script setup>
import modalScanQRCode from "./modalScanQrCode.vue";
import {
    AkChevronDownSmall,
    AkChevronUpSmall,
    CaAddAlt,
    BxScan,
    AnOutlinedEdit,
} from "@kalimahapps/vue-icons";
import { useRouter } from "vue-router";
import { ref, defineEmits } from "vue";

const router = useRouter();
const showOrder = ref(true);

const isModalScanQRCode = ref(false);

const addNewProduct = () => {
    router.push("/addNewProduct");
};

const openModalScanQRCode = () => {
    isModalScanQRCode.value = true;
};

const closeModalScanQrCode = () => {
    isModalScanQRCode.value = false;
};

const clickShowModal = () => {
    emit("showModal");
};
const emit = defineEmits(["show", "showModal"]);

const value1 = ref(1);
const show = () => {
    showOrder.value = !showOrder.value;
    emit("show");
};
const buttonAddOrder = () => {
    value1.value++;
};
const buttonDelOrder = () => {
    if (value1.value <= 0) {
        return (value1.value = 0);
    } else {
        value1.value--;
    }
};

const nothing = () => {
    alert("Chưa xử lý sự kiện này");
};
</script>

<style scoped>
.mainInforOrder {
    display: flex;
    flex-direction: column;
    background-color: white;

    .header {
        padding-bottom: 10px;
        .title {
            display: flex;
            flex: 1;
            padding: 0px 10px 10px;
            padding-block: 10px;

            .inforText {
                display: flex;
                flex: 1;
                font-size: 16px;
                font-weight: bold;
                justify-content: start;
            }

            .showMore {
                justify-content: end;
                font-size: 14px;
                color: black;
                padding-right: 10px;
            }
        }

        .button {
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
    .content {
        display: flex;
        flex: 1;
        flex-direction: column;
        .totalProduct {
            border-top: 1px solid #d9d9d9;
            display: flex;
            flex: 1;
            flex-direction: column;
            .product {
                display: flex;
                flex-direction: row;
                padding: 10px;
                gap: 10px;
                flex: 1;

                /* .imgDiv {
                    display: flex;
                    width: 80px;
                    height: 80px;
                    
                } */
                .detailProduct {
                    display: flex;
                    flex: 1;
                    flex-direction: column;
                    border-bottom: 1px solid #d9d9d9;
                    padding-bottom: 12px;
                    .products {
                        display: flex;
                        flex: 1;
                        flex-direction: column;
                        gap: 10px;
                        .nameProduct {
                            font-size: 14px;
                            font-weight: 400;
                        }
                        .typeProduct {
                            font-size: 12px;
                            font-weight: 400;
                            color: #8c8c8c;
                        }
                        .costProduct {
                            display: flex;
                            font-size: 14px;
                            font-weight: 400;
                            color: #f26722;
                            align-items: center;
                            gap: 5px;
                            svg {
                                color: #1890ff;
                            }
                        }
                    }
                    .changeQuantityOrder {
                        display: flex;
                        flex: 1;
                        flex-direction: row;
                        align-items: center;
                        margin-top: 10px;
                        .buttonChangeQuantityOrder {
                            button {
                                border: 1px solid #d9d9d9;
                            }
                            input {
                                border-block: 1px solid #d9d9d9;
                                border-inline: 0;
                                padding: 4px 12px 4px 12px;
                                border-radius: 0;
                            }
                            input:focus {
                                outline: none;
                            }

                            .buttonAddOrder {
                                border-radius: 2px 0px 0px 2px;
                                padding: 0px 8px 0px 8px;
                            }
                            .buttonDelOrder {
                                border-radius: 0px 2px 2px 0px;
                                padding: 0px 8px 0px 8px;
                            }
                            font-size: 14px;
                            display: flex;
                            flex-direction: row;
                            input {
                                width: 60px;
                                text-align: center;
                            }
                        }
                        .delOrderDiv {
                            display: flex;
                            flex: 1;
                            justify-content: end;
                            font-size: 12px;
                            color: #1890ff;
                        }
                    }
                }
            }
        }
    }
    .totalCostOrder {
        border-top: 1px solid #d9d9d9;
        display: flex;
        flex: 1;
        flex-direction: row;
        padding: 10px;
        align-items: center;
        .countOrder {
            font-size: 14px;
            font-weight: 400;
        }
        .costOrder {
            display: flex;
            flex: 1;
            justify-content: end;
            font-size: 16px;
            font-weight: 400;
            color: #1890ff;
        }
    }
}
</style>
