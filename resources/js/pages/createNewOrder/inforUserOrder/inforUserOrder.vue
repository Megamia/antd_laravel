<template>
    <div class="main">
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
                85 vũ Trọng Phụng, phường Thanh Xuân Trung, quận Thanh Xuân, Hà
                Nội
            </div>
        </div>
    </div>
</template>
<style scoped>
.main {
    display: flex;
    flex: 1;
    background-color: white !important;

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
        padding-inline: 10px;
        color: #8c8c8c;
        .nameUser {
            padding-block: 10px;
            font-size: 14px;
            font-weight: 600;
            color: black;
        }
    }
}
</style>
