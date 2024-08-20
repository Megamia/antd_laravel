<template>
    <div class="mainChooseUser">
        <div class="title">
            <AnOutlinedArrowLeft @click="back" />
            <span> Tìm kiếm khách hàng </span>
        </div>
        <div class="content">
            <div class="search">
                <a-input-search
                    v-model:value="nameOrPhoneNumber"
                    placeholder="Nhập tên và số điện thoại"
                />
            </div>
            <div class="userInfor">
                <a-radio-group v-model:value="a">
                    <div style="display: flex; flex: 1" @click="addNewUser">
                        <a-button type="text">
                            <CaAddAlt />Thêm mới khách hàng
                        </a-button>
                    </div>
                    <div class="userItems" v-if="!isFiltering">
                        <a-radio value="guest">
                            <div class="userInforRadio">
                                <span class="nameUser">Khách lẻ</span>
                            </div>
                        </a-radio>
                    </div>
                    <div
                        class="userItems"
                        v-for="user in filter"
                        :key="user.id"
                    >
                        <a-radio :value="user.id">
                            <div class="userInforRadio">
                                <span class="nameUser">{{ user.name }}</span>
                                <span class="phoneNumberUser">{{
                                    user.phoneNumber
                                }}</span>
                            </div>
                        </a-radio>
                    </div>
                </a-radio-group>
                <div style="height: 1000px" />
            </div>
        </div>
        <div class="saveDive">
            <a-button type="primary" @click="buttonSave">Lưu</a-button>
        </div>
    </div>
</template>

<script setup>
import { AnOutlinedArrowLeft, CaAddAlt } from "@kalimahapps/vue-icons";
import { useRouter } from "vue-router";
import { ref, computed, onMounted } from "vue";
import store from "../../../store";
import axios from "axios";

const a = ref(null);
const nameOrPhoneNumber = ref("");
const router = useRouter();

const data = ref({});

const fetchData = async () => {
    try {
        const response = await axios.get(
            `${import.meta.env.VITE_APP_URL_API}/dataUser`
        );
        if (response.data.status === 1) {
            data.value = response.data.dataUser;
        } else if (response.data.status === 0) {
            console.log(response.data);
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
    router.push("/addNewUser");
};

const buttonSave = async () => {
    try {
        const response = await axios.post(
            `${import.meta.env.VITE_APP_URL_API}/chooseUserOrder`,
            {
                id: a.value,
            }
        );
        if (response.data.status === 1) {
            store.commit("setDataUserOrder", {
                dataUserOrder: response.data.dataUserOrder,
                userExpiry: response.data.userExpiry,
            });
            router.back();
        }
    } catch (e) {
        console.log("Lỗi: " + e);
    }
};
const filter = computed(() => {
    if (nameOrPhoneNumber.value) {
        return data.value.filter((user) => {
            return nameOrPhoneNumber.value
                .toLowerCase()
                .split(" ")
                .every(
                    (v) =>
                        user.name.toLowerCase().includes(v) ||
                        user.phoneNumber.toString().includes(v)
                );
        });
    } else {
        return data.value;
    }
});

const isFiltering = computed(() => {
    return !!nameOrPhoneNumber.value.trim();
});
</script>

<style scoped>
.mainChooseUser {
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
        overflow-y: scroll;
        padding-block: 20px;
        background-color: #f0f2f5;

        .search {
            padding: 10px 12px 10px 12px;
            border-bottom: 1px solid #d9d9dd;
            background-color: white;
        }

        .userInfor {
            background-color: white;
            display: flex;
            flex-direction: column;

            button {
                display: flex;
                flex: 1;
                align-items: center;
                padding: 10px;
                border-radius: 0;
                color: #1890ff;
                gap: 10px;
            }

            .userItems {
                display: flex;
                flex-direction: row;
                align-items: start;
                border-top: 1px solid #d9d9dd;
                margin-inline: 10px;
                padding-block: 10px;

                .userInforRadio {
                    display: flex;
                    flex-direction: column;
                }

                .nameUser {
                    font-size: 14px;
                }

                .phoneNumberUser {
                    font-size: 14px;
                    color: #00000073;
                }
            }
        }
    }

    .saveDive {
        position: fixed;
        display: flex;
        background-color: white;
        bottom: 0;
        width: 100%;
        padding: 10px;

        button {
            position: relative;
            width: 100%;
            border-radius: 0;
        }
    }
}
</style>
