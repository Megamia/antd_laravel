<template>
    <div class="main">
        <div class="titlePage">
            <h1>Tạo mới đơn hàng</h1>
        </div>
        <div class="inforUserDiv">
            <div class="title">
                <span class="inforText"> Thông tin khách hàng </span>
                <span class="uncheckedText" @click="uncheckedText">
                    Bỏ chọn</span
                >
            </div>
            <div class="detailInforUser">
                <div class="nameUser">
                    <span> Lan Anh | 0388911165</span>
                </div>
                <div class="totalInforOrderUser">
                    <div class="order ordered">
                        <span class="upText">Đơn mua</span>
                        <span class="downText">100</span>
                    </div>
                    <div class="order cancelOrder">
                        <span class="upText">Đơn hủy</span>
                        <span class="downText">5</span>
                    </div>
                    <div class="order">
                        <span class="upText">Tỷ lệ hủy</span>
                        <span class="downText canceledRate">5%</span>
                    </div>
                </div>
                <div class="seeMoreDiv">
                    <span class="seeMoreText"> Xem thêm </span>
                </div>
            </div>
            <div class="addressUserDiv">
                <div class="nameUser">
                    <span> Lan Anh | 0388911165</span>
                </div>
                <div class="detailAddress">
                    85 vũ Trọng Phụng, phường Thanh Xuân Trung, quận Thanh Xuân,
                    Hà Nội
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
const uncheckedText = () => {
    alert("Ai cho bỏ mà bỏ");
};
</script>

<style scoped>
.main {
    display: flex;
    flex: 1;
    height: 100vh;
    flex-direction: column;
    background-color: #f0f2f5;
    gap: 20px;

    .titlePage {
        background-color: white;
        /* border-bottom: 2px solid #b587f6; */
        box-shadow: rgba(0, 0, 0, 0.35) 0px 0px 8px;
        text-align: center;
        h1 {
            font-size: 20px;
            font-weight: bold;
        }
    }
    .inforUserDiv {
        display: flex;
        flex-direction: column;
        background-color: white;
        padding-block: 20px;

        .title {
            display: flex;
            flex-direction: row;
            flex: 1;
            border-bottom: 1px solid #f0f0f0;
            padding-bottom: 20px;
            padding-inline: 10px;

            span {
                font-size: 16px;
            }
            .inforText {
                font-weight: bold;
                display: flex;
                flex: 1;
            }
            .uncheckedText {
                display: flex;
                justify-content: end;
                color: red;
            }
        }
        .detailInforUser {
            border-bottom: 1px solid #f0f0f0;
            display: flex;
            flex-direction: column;
            margin-inline: 10px;
            .nameUser {
                padding-block: 10px;
                font-size: 14px;
                font-weight: 600;
            }
            .totalInforOrderUser {
                display: flex;
                flex-direction: row;
                flex: 1;
                justify-content: space-between;
                .order {
                    padding-inline: 10px;

                    flex: 1;
                    gap: 10px;
                    display: flex;
                    flex-direction: column;

                    .upText {
                        color: #8c8c8c;
                    }
                    .downText {
                        color: black;
                        font-weight: 600;
                    }
                    .canceledRate {
                        color: red;
                    }
                }
                .ordered {
                    padding-inline: 0;
                }
                .cancelOrder {
                    border-inline: 1px solid gray;
                }
            }
            .seeMoreDiv {
                padding-block: 10px;
                .seeMoreText {
                    color: #1890ff;
                }
            }
        }
        .addressUserDiv {
            .nameUser {
                padding-block: 10px;
                font-size: 14px;
                font-weight: 600;
            }
        }
    }
}
</style>
