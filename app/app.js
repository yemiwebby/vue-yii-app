import { createApp } from 'vue';
import router from './router';
import App from './App.vue';
import Antd from 'ant-design-vue';
import 'ant-design-vue/dist/antd.css';

const app = createApp(App);

app.use(Antd);
app.use(router);
app.mount('#app');
