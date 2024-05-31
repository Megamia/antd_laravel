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
    Dropdown,
    Input,
    Checkbox,
    Image,
    Switch,
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
    .use(Dropdown)
    .use(Input)
    .use(Checkbox)
    .use(Image)
    .use(Switch)
    .mount("#app");
