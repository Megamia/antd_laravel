import { createRouter, createWebHistory } from "vue-router";
import CreateNewOrderLayout from "./pages/CreateNewOrder/CreateNewOrderLayout.vue";
import DetailInforUserOrder from "./pages/CreateNewOrder/InforUserOrder/DetailInforUserOrder.vue";
import UserOrder from "./pages/CreateNewOrder/InforUserOrder/UserOrder.vue";
import InforOrder from "./pages/CreateNewOrder/InforOrder/InforOrder.vue";
import VoucherAndTax from "./pages/CreateNewOrder/Voucher&tax/VoucherAndTax.vue";
import NoteOrder from "./pages/CreateNewOrder/Note/NoteOrder.vue";
import InforPayment from "./pages/CreateNewOrder/InforPayment/InforPayment.vue";
import ShippingMethod from "./pages/CreateNewOrder/ShippingMethod/ShippingMethod.vue";
import AnotherInfor from "./pages/CreateNewOrder/AnotherInfor/AnotherInfor.vue";
import CostOrder from "./pages/CreateNewOrder/CostOrder/CostOrder.vue";
import ModalCostOrder from "./pages/CreateNewOrder/InforOrder/ModalCostOrder.vue";
import CreateOrderSuccess from "./pages/CreateNewOrder/CreateOrderSuccess.vue";
import AddNewUser from "./pages/CreateNewOrder/InforUserOrder/AddNewUser.vue";
import ChooseUser from "./pages/CreateNewOrder/InforUserOrder/ChooseUser.vue";
import SwapAddress from "./pages/CreateNewOrder/InforUserOrder/SwapAddress.vue";
import AddNewAddress from "./pages/CreateNewOrder/InforUserOrder/AddNewAddress.vue";
import AddNewProduct from "./pages/CreateNewOrder/InforOrder/AddNewProduct.vue";
import AddProduct from "./pages/CreateNewOrder/InforOrder/AddProduct.vue";
import Item1Modal from "./pages/CreateNewOrder/InforOrder/ItemModalFilterWithSelection/ItemModal1.vue";
import DetailVoucher from "./pages/CreateNewOrder/Voucher&tax/Details/DetailVoucher.vue";
import ExPage from "./pages/client/ExPage.vue";
const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: "/",
            component: CreateNewOrderLayout,
            name: "CreateNewOrderLayout",
        },
        {
            path: "/CreateOrderSuccess",
            component: CreateOrderSuccess,
            name: "CreateOrderSuccess",
        },

        {
            path: "/UserOrder",
            component: UserOrder,
            name: "UserOrder",
        },
        {
            path: "/DetailInforUserOrder",
            component: DetailInforUserOrder,
            name: "DetailInforUserOrder",
        },
        {
            path: "/InforOrder",
            component: InforOrder,
            name: "InforOrder",
        },
        {
            path: "/VoucherAndTax",
            component: VoucherAndTax,
            name: "VoucherAndTax",
        },
        {
            path: "/NoteOrder",
            component: NoteOrder,
            name: "NoteOrder",
        },
        {
            path: "/InforPayment",
            component: InforPayment,
            name: "InforPayment",
        },
        {
            path: "/ShippingMethod",
            component: ShippingMethod,
            name: "ShippingMethod",
        },
        {
            path: "/AnotherInfor",
            component: AnotherInfor,
            name: "AnotherInfor",
        },
        {
            path: "/CostOrder",
            component: CostOrder,
            name: "CostOrder",
        },
        {
            path: "/ModalCostOrder",
            component: ModalCostOrder,
            name: "ModalCostOrder",
        },
        {
            path: "/AddNewUser",
            component: AddNewUser,
            name: "AddNewUser",
        },
        {
            path: "/ChooseUser",
            component: ChooseUser,
            name: "ChooseUser",
        },
        {
            path: "/SwapAddress",
            component: SwapAddress,
            name: "SwapAddress",
        },
        {
            path: "/AddNewAddress",
            component: AddNewAddress,
            name: "AddNewAddress",
        },
        {
            path: "/AddNewProduct",
            component: AddNewProduct,
            name: "AddNewProduct",
        },
        {
            path: "/AddProduct",
            component: AddProduct,
            name: "AddProduct",
        },
        {
            path: "/Item1Modal",
            component: Item1Modal,
            name: "Item1Modal",
        },
        {
            path: "/DetailVoucher",
            component: DetailVoucher,
            name: "DetailVoucher",
        },
        {
            path: "/test",
            component: ExPage,
            name: "ExPage",
        },
    ],
});
export default router;
