require('./bootstrap');
import Vue from 'vue';

import App from './vue/app'
import comment from './vue/comment'

const app = new Vue({
    el: '#app',
    components:{App,comment}
});

