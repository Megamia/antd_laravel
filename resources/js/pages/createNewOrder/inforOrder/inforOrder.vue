<template>
    <div class="mainInforOrder">
        <div class="header">
            <div class="title">
                <span class="inforText"> Sản phẩm </span>
                <span class="showMore"> <AkChevronDownSmall /></span>
            </div>
            <div class="button">
                <a-button class="buttonAdd">
                    <CaAddAlt />Thêm sản phẩm</a-button
                >
                <a-button class="buttonScan"> <BxScan />Quét mã</a-button>
            </div>
        </div>
        <div class="content">
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
                            200.000đ <AnOutlinedEdit
                        /></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="height" />
    </div>
</template>
<script setup>
import { AkChevronDownSmall } from "@kalimahapps/vue-icons";
import { CaAddAlt } from "@kalimahapps/vue-icons";
import { BxScan } from "@kalimahapps/vue-icons";
import { AnOutlinedEdit } from "@kalimahapps/vue-icons";
</script>

<style scoped>
.mainInforOrder {
    display: flex;
    flex-direction: column;
    background-color: white;

    .header {
        border-bottom: 1px solid #f0f0f0;
        padding-bottom: 10px;

        .title {
            display: flex;
            flex: 1;
            padding: 0px 10px 10px;
            padding-block: 10px;

            .inforText {
                font-size: 16px;
                font-weight: 500;
                justify-content: start;
            }

            .showMore {
                display: flex;
                flex: 1;
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
        flex-direction: row;
        .product {
            display: flex;
            flex-direction: row;
            padding: 10px;
            gap: 10px;
            /* .imgDiv {
                display: flex;
                width: 80px;
                height: 80px;
                
            } */
            .detailProduct {
                display: flex;
                flex: 1;
                flex-direction: column;
                .products {
                    display: flex;
                    flex: 1;
                    flex-direction: column;
                    gap:10px;
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
            }
        }
    }

    .height {
        width: 100%;
        height: 1000px;
    }
}
</style>
