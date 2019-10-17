
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
const SocialSharing = require('vue-social-sharing');


window.Vue = require('vue');
window.Vue.use(SocialSharing);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import {TinkerComponent} from 'botman-tinker';
import SimpleWebview from './simple_webview';
// Vue.use(SocialSharing);
Vue.component('botman-tinker', TinkerComponent);
Vue.component('simple-webview', SimpleWebview);

const app = new Vue({
    el: '#app'
});