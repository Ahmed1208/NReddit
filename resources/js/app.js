
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import Vue from 'vue';
window.Vue = require('vue');
window.Event = new Vue();
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import Notification from './components/Notification.vue';
Vue.component('notification', Notification);

import Addcomment from './components/Addcomment.vue';
Vue.component('add-comment', Addcomment);

import Comment from './components/Comment.vue';
Vue.component('comment-show', Comment);


//Vue.component('notification', require('./components/Notification.vue'));

const app = new Vue({
    el: '#app',
    data: {
        notifications: ''
    },
    created() {
        axios.post('/notification/get').then(response => {
            this.notifications = response.data;
        });

        var userId = $('meta[name="userId"]').attr('content');
        Echo.private('App.User.' + userId).notification((notification) => {
            this.notifications.push(notification);
        });
    }
});
