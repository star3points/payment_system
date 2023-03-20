import {createApp} from "vue";
import App from "./App.vue";
import pinia from "./store/store";
import router from "./router/router";

// Vuetify
import 'vuetify/styles'
import {createVuetify} from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'

const vuetify = createVuetify({
    components,
    directives,
})

const app = createApp(App);

app.use(pinia);
app.use(router);
app.use(vuetify);

router.isReady().then(() => {
    app.mount("#app");
});
