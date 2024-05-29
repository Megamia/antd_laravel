import "./bootstrap";
import App from "./App.vue";
import { createApp } from "vue";
import router from "./router";
import "ant-design-vue/dist/reset.css";
import {
    Alert,
    Calendar,
    Layout,
    Button,
    Badge,
    Result,
    Card,
    Divider,
    Drawer,
    Table,
    Form,
    InputNumber,
    Tag,
    Row,
    Col,
} from "ant-design-vue";

const app = createApp(App);

app.use(router)
    .use(Alert)
    .use(Calendar)
    .use(Layout)
    .use(Button)
    .use(Badge)
    .use(Result)
    .use(Card)
    .use(Divider)
    .use(Drawer)
    .use(Table)
    .use(Form)
    .use(InputNumber)
    .use(Tag)
    .use(Row)
    .use(Col)
    .mount("#app");
