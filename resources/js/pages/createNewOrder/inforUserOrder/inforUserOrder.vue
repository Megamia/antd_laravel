<template>
    <div class="mainInforUserOrder">
        <div class="title">
            <span class="inforText"> Thông tin khách hàng </span>
            <span class="uncheckedText"> Bỏ chọn</span>
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
            <div class="inforAddress">
                <div class="inforAddressText">
                    <span>Thông tin giao hàng</span>
                </div>
                <div class="swapAddress">
                    <span> Đổi địa chỉ</span>
                </div>
            </div>
            <div class="nameUser">
                <span> Lan Anh | 0388911165</span>
            </div>
            <div class="detailAddress">
                85 vũ Trọng Phụng, phường Thanh Xuân Trung, quận Thanh Xuân, Hà
                Nội
            </div>
        </div>
    </div>
</template>
<style scoped>
.mainInforUserOrder {
    display: flex;
    flex-direction: column;
    flex: 1;
    background-color: white !important;
    padding-block: 10px;
    .title {
        display: flex;
        flex: 1;
        padding: 0px 10px 10px;
        border-bottom: 2px solid #f0f0f0;
        .inforText {
            font-size: 16px;
            font-weight: bold;
            justify-content: start;
        }
        .uncheckedText {
            display: flex;
            flex: 1;
            justify-content: end;
            font-size: 14px;
            color: red;
        }
    }
    .detailInforUser {
        border-bottom: 2px solid #f0f0f0;
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
                border-inline: 2px solid #f0f0f0;
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
        padding-inline: 10px;
        color: #8c8c8c;
        .inforAddress {
            display: flex;
            flex: 1;
            flex-direction: row;
            padding-block: 10px;
            .inforAddressText {
                span {
                    font-size: 12px;
                    font-weight: bold;
                    color: black;
                }
            }
            .swapAddress {
                display: flex;
                flex: 1;
                justify-content: end;
                color: #1890ff;
                font-size: 12px;
            }
        }
        .nameUser {
            padding-block: 10px;
            font-size: 14px;
            font-weight: 400;
            color: black;
        }
    }
}
</style>
