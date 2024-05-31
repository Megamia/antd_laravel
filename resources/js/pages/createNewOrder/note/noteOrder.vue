<template>
    <div class="mainNoteOrder">
        <span>Ghi chú đơn hàng</span>
        <input placeholder="Nhập nội dung" />
    </div>
</template>
<script setup></script>

<style scoped>
.mainNoteOrder {
    display: flex;
    flex: 1;
    background-color: white;
    flex-direction: column;
    padding: 10px;
    gap: 10px;
    font-size: 14px;
    font-weight: 400;
    input {
        border-width: 0;
        
    }
    input:focus {
        outline: none;
    }
}
</style>
