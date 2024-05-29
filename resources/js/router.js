import { createRouter, createWebHistory } from "vue-router";
// import HelloWorld from "./components/HelloWorld.vue";
import TestAbc from "./components/TestAbc.vue";
import TestBcd from "./components/TestBcd.vue";
import CreateNewOrderLayout from "./pages/createNewOrder/createNewOrderLayout.vue";
import inforUserOrder from "./pages/createNewOrder/inforUserOrder/inforUserOrder.vue";
import inforOrder from "./pages/createNewOrder/inforOrder/inforOrder.vue";
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
            path: "/TestAbc",
            component: TestAbc,
            name: "TestAbc",
        },
        {
            path: "/TestBcd",
            component: TestBcd,
            name: "TestBcd",
        },
    ],
});
export default router;
