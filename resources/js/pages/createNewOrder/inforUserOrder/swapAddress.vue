<template>
    <div class="mainSwapAddress">
        <div class="title">
            <AnOutlinedArrowLeft @click="back" />
            <span > Đổi địa chỉ </span>
        </div>
        <div class="content">
            <div class="userInfor">
                <a-radio-group v-model:value="a">
                    <div style="display: flex; flex: 1">
                        <a-button type="text" @click="addNewAddress">
                            <CaAddAlt />Thêm địa chỉ mới
                        </a-button>
                    </div>
                    <ModalSwapAddress
                        v-if="open"
                        @cancel="Cancel"
                        @apply="Apply"
                        :idUser="idUser"
                    />

                    <div v-if="address">
                        <div
                            class="userItems"
                            v-for="items in address"
                            :key="items.id"
                        >
                            <a-radio :value="items.id">
                                <div class="spanUserItems">
                                    <div class="userInforRadio">
                                        <div class="nameAndPhone">
                                            <span class="nameUser">
                                                {{ items.name }}
                                            </span>
                                            <span>|</span>
                                            <span class="phoneUser">
                                                {{ items.phoneNumber }}
                                            </span>
                                        </div>
                                        <div class="address">
                                            <span class="addressUser">
                                                {{ items.address }},
                                                {{ items.ward }},
                                                {{ items.district }},
                                                {{ items.city }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a-radio>
                            <div class="iconTrashDiv">
                                <BxTrashAlt
                                    class="iconTrash"
                                    @click="showModal(items.id)"
                                />
                                <!-- @click="deleteAddress(items.id)" -->
                            </div>
                        </div>
                    </div>
                    <div v-else style="padding: 10px">
                        <span style="font-size: 20px">No Data Address</span>
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
import {
    AnOutlinedArrowLeft,
    CaAddAlt,
    BxTrashAlt,
} from "@kalimahapps/vue-icons";
import { useRouter, useRoute } from "vue-router";
import { ref, onMounted } from "vue";
import axios from "axios";
import eventBus from "../../../eventBus";
import ModalSwapAddress from "./ModalSwapAddress.vue";

const a = ref(null);
const router = useRouter();
const route = useRoute();
const open = ref(false);
let idUser = 0;
// const showModal = () => {
//     open.value = true;
// };
const address = ref("");

const id = route.params.id;


const Cancel = () => {
    open.value = false;
};
const Apply = async (id) => {
    try {
        const response = await axios.delete(
            `${import.meta.env.VITE_APP_URL_API}/deleteAddress/${id}`
        );
        if (response.data.status === 1) {
            alert("Delete address success");
            await fetchData();
            open.value = false;
        } else {
            alert("Faile to delete address");
            return;
        }
    } catch (e) {
        console.log("Error: ", e);
    }
    // deleteAddress();
};

const showModal = (id) => {
    open.value = true;
    idUser = id;
};

// const deleteAddress = async (id) => {
//     try {
//         const response = await axios.delete(
//             `${import.meta.env.VITE_APP_URL_API}/deleteAddress/${id}`
//         );
//         if (response.data.status === 1) {
//             console.log("Delete address success");
//             await fetchData();
//         } else {
//             console.log("Faile to delete address");
//         }
//     } catch (e) {
//         console.log("Error: ", e);
//     }
// };

const fetchData = async () => {
    try {
        const response = await axios.post(
            `${import.meta.env.VITE_APP_URL_API}/AddressUserWithId`,
            {
                id: id,
            }
        );
        // console.log("id: ", id);
        if (response.data.status === 1) {
            // console.log("data: ", response.data.DetailAddress);
            address.value = response.data.DetailAddress;
            // console.log("address.value: ", address.value);
        } else {
            // console.log(response.data.DetailAddress);
            // console.log(response.data.AddressUserWithId);
            return (address.value = null);
        }
    } catch (e) {
        console.log("Error: ", e);
    }
};
onMounted(() => fetchData());

const back = () => {
    router.back();
};

const addNewAddress = () => {
    // console.log(id);
    router.push({
        name: "AddNewAddress",
        params: { id },
    });
    // console.log(address.value);
};

const buttonSave = async () => {
    try {
        if (a.value) {
            eventBus.id = a.value;
            try {
                const response = await axios.post(
                    `${import.meta.env.VITE_APP_URL_API}/AddNewInforUser`,
                    {
                        idUser: id,
                        idAddress: a.value,
                    }
                );
                if (response.data.status === 1) {
                    // console.log(response.data.AddNewInforUser);
                } else {
                    // console.log(response.data.InforUser);
                }
            } catch (e) {
                console.log("Error: ", e);
            }
            router.back();
        } else {
            alert("Chưa chọn địa chỉ mới");
        }
    } catch (e) {
        console.log("Lỗi: " + e);
    }
};
</script>

<style scoped>
.mainSwapAddress {
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
                flex: 1;
                flex-direction: row;
                align-items: center;
                border-top: 1px solid #d9d9dd;
                margin-inline: 10px;
                padding-block: 10px;

                label {
                    display: flex;
                    flex-direction: row;
                }

                .userInforRadio {
                    display: flex;
                    flex-direction: column;
                }
                .spanUserItems {
                    display: flex;
                    flex: 1;
                    flex-direction: row;
                }
                .nameAndPhone {
                    display: flex;
                    flex-direction: row;
                    font-size: 14px;
                    gap: 10px;
                    /* .nameUser {
                    } */
                    .phoneUser {
                        color: #00000073;
                    }
                }

                .address {
                    font-size: 14px;
                    .addressUser {
                        color: #00000073;
                    }
                }
                .iconTrashDiv {
                    display: flex;
                    flex: 1;
                    justify-content: end;
                    svg {
                        font-size: 16px;
                    }
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
