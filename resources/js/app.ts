import {createApp} from "vue";
import App from "./App.vue";
import pinia from "./store/store";
import router from "./router/router";

const app = createApp(App);

app.use(pinia);
app.use(router);

router.isReady().then(() => {
    app.mount("#app");
});
