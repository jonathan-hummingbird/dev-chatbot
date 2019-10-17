import Vue from 'vue';
import VueRouter from 'vue-router';
import SimpleWebview from "./simple_webview";
Vue.use(VueRouter);

const routes = [
    {
        path: "/webview",
        component: () => SimpleWebview,
        children: [
            {
                path: "simple_webview",
                component: () => SimpleWebview
            }
        ]
    }
];

export default new VueRouter({
    routes,
    mode: 'history',
});
