require('./bootstrap');

window.Vue = require('vue');
Vue.component('users-list', require('./components/users/List.vue').default);

window.onload = function () {
    const app = new Vue({
	    el: '#app'
	});
}
