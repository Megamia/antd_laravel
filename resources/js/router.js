import { createRouter, createWebHistory } from "vue-router";
import CreateNewOrderLayout from "./pages/createNewOrder/createNewOrderLayout.vue";
import inforUserOrder from "./pages/createNewOrder/inforUserOrder/inforUserOrder.vue";
import inforOrder from "./pages/createNewOrder/inforOrder/inforOrder.vue";
import voucherAndTax from "./pages/createNewOrder/voucher&tax/voucherAndTax.vue";
import noteOrder from "./pages/createNewOrder/note/noteOrder.vue";
import inforPayment from "./pages/createNewOrder/inforPayment/inforPayment.vue";

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
            path: "/inforUserOrder",
            component: inforUserOrder,
            name: "inforUserOrder",
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
            path: "/test",
            component: exPage,
            name: "exPage",
        },
    ],
});
export default router;
