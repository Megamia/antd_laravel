import { createRouter, createWebHistory } from "vue-router";
import CreateNewOrderLayout from "./pages/createNewOrder/createNewOrderLayout.vue";
import detailInforUserOrder from "./pages/createNewOrder/inforUserOrder/detailInforUserOrder.vue";
import userOrder from "./pages/createNewOrder/inforUserOrder/userOrder.vue";
import inforOrder from "./pages/createNewOrder/inforOrder/inforOrder.vue";
import voucherAndTax from "./pages/createNewOrder/voucher&tax/voucherAndTax.vue";
import noteOrder from "./pages/createNewOrder/note/noteOrder.vue";
import inforPayment from "./pages/createNewOrder/inforPayment/inforPayment.vue";
import shippingMethod from "./pages/createNewOrder/shippingMethod/shippingMethod.vue";
import anotherInfor from "./pages/createNewOrder/anthoerInfor/anotherInfor.vue";
import costOrder from "./pages/createNewOrder/costOrder/costOrder.vue";
import modalCostOrder from "./pages/createNewOrder/inforOrder/modalCostOrder.vue";
import createOrderSuccess from "./pages/createNewOrder/createOrderSuccess.vue";
import addNewUser from "./pages/createNewOrder/inforUserOrder/addNewUser.vue";
import chooseUser from "./pages/createNewOrder/inforUserOrder/chooseUser.vue";
import swapAddress from "./pages/createNewOrder/inforUserOrder/swapAddress.vue";
import exPage from "./pages/client/exPage.vue";
const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: "/",
            component: CreateNewOrderLayout,
            name: "CreateNewOrderLayout",
        },
        {
            path: "/createOrderSuccess",
            component: createOrderSuccess,
            name: "createOrderSuccess",
        },

        {
            path: "/userOrder",
            component: userOrder,
            name: "userOrder",
        },
        {
            path: "/detailInforUserOrder",
            component: detailInforUserOrder,
            name: "detailInforUserOrder",
        },
        {
            path: "/inforOrder",
            component: inforOrder,
            name: "inforOrder",
        },
        {
            path: "/voucherAndTax",
            component: voucherAndTax,
            name: "voucherAndTax",
        },
        {
            path: "/noteOrder",
            component: noteOrder,
            name: "noteOrder",
        },
        {
            path: "/inforPayment",
            component: inforPayment,
            name: "inforPayment",
        },
        {
            path: "/shippingMethod",
            component: shippingMethod,
            name: "shippingMethod",
        },
        {
            path: "/anotherInfor",
            component: anotherInfor,
            name: "anotherInfor",
        },
        {
            path: "/costOrder",
            component: costOrder,
            name: "costOrder",
        },
        {
            path: "/modalCostOrder",
            component: modalCostOrder,
            name: "modalCostOrder",
        },
        {
            path: "/addNewUser",
            component: addNewUser,
            name: "addNewUser",
        },
        {
            path: "/chooseUser",
            component: chooseUser,
            name: "chooseUser",
        },
        {
            path: "/swapAddress",
            component: swapAddress,
            name: "swapAddress",
        },

        {
            path: "/test",
            component: exPage,
            name: "exPage",
        },
    ],
});
export default router;
