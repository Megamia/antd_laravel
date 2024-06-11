import "./bootstrap";
import App from "./App.vue";
import { createApp } from "vue";
import router from "./router";
import VueAxios from "vue-axios";
import VueCookies from "vue-cookies";
import axios from "axios";
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
    Select,
    Radio,
} from "ant-design-vue";

axios.defaults.headers.common["X-CSRF-TOKEN"] = document
    .querySelector('meta[name="csrf-token"]')
    .getAttribute("content");

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
    .use(Select)
    .use(Radio)
    .use(VueAxios, axios)
    .use(VueCookies)
    .mount("#app");
