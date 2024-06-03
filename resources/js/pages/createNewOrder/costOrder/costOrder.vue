<template>
    <div class="mainCostOrder">
        <div class="costDiv">
            <div class="title">
                <span class="left">Tổng cộng </span>
                <span class="right">(8 sản phẩm)</span>
            </div>
            <div class="cost">
                <span>3.000.000đ</span>
            </div>
        </div>
        <div class="order">
            <button>Tạo đơn hàng</button>
        </div>
    </div>
</template>
<script setup></script>

<style scoped>
.mainCostOrder {
    display: flex;
    flex: 1;
    background-color: white;
    padding: 12px;
    flex-direction: row;

    .costDiv {
        display: flex;
        flex-direction: column;
        gap: 5px;
        .title {
            display: flex;
            flex-direction: row;
            gap: 5px;
            span {
                font-size: 12px;
                font-weight: 600;
            }

            .right {
                color: #00000073;
            }
        }
        .cost {
            font-size: 16px;
            color: #1890ff;
        }
    }
    .order {
        display: flex;
        flex: 1;
        justify-content: end;
        button {
            background-color: #1890ff;
            color: white;
            border: 0;
            padding:6px 15px 6px 15px;
            font-size: 16px;
        }
    }
}
</style>
