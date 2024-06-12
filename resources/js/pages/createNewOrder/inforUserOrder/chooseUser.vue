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
                    <a-button type="text" @click="addNewUser">
                        <CaAddAlt />Thêm mới khách hàng
                    </a-button>
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
import axios from "axios";

const a = ref(null);
const selectedUser = ref("");
const nameOrPhoneNumber = ref("");
const router = useRouter();

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

const data = ref({
    name: "",
    phoneNumber: "",
});

const fetchData = async () => {
    try {
        const response = await axios.get(
            `${import.meta.env.VITE_APP_URL_API}/dataUser`
        );
        data.value = response.data.dataUser;
        data.value.name = response.data.dataUser.name;
        data.value.phoneNumber = response.data.dataUser.phoneNumber;
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
        // if (a.value === "guest") {
        //     console.log("Đã chọn khách lẻ");
        // } else if (a.value && a.value != "guest") {
        //     selectedUser.value = data.value.find((user) => user.id === a.value);
        //     console.log("Đã chọn user: ", selectedUser.value);
        // }

        // router.back();

        const response = await axios.post(
            `${import.meta.env.VITE_APP_URL_API}/chooseUserOrder`,
            {
                id: a.value,
            }
        );
        if (response.data.status === 1) {
            // if (a.value === "guest") {
            //     console.log("Đã chọn: ", response.data.dataUserOrder);
            // } else {
            //     console.log("Đã chọn: ", response.data.dataUserOrder.name);
            // }
            router.back();
        } else {
            console.log("Faile");
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
                        user.phoneNumer.toLowerCase().includes(v)
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
    gap: 20px;

    .title {
        background-color: white;
        display: flex;
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

        .search {
            padding: 10px 12px 10px 12px;
            border-bottom: 1px solid #d9d9dd;
        }

        .userInfor {
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
        position: absolute;
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
