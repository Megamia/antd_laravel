import { createRouter, createWebHistory } from "vue-router";
// import HelloWorld from "./components/HelloWorld.vue";
import TestAbc from "./components/TestAbc.vue";
import TestBcd from "./components/TestBcd.vue";
import CreateNewOrder from "./pages/createNewOrder.vue";

const router = createRouter({
  history: createWebHistory(),
  routes: [
    {
      path: "/",
      component: CreateNewOrder,
      name: "CreateNewOrder",
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
