/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */
 
require('bootstrap')

window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

import Vue from 'vue'
import VueRouter from 'vue-router'

import App from './views/App'

Vue.use(VueRouter)
import Home from './views/Home'
import Orders from './views/Orders'
import Order from './views/Order'
import OrdersPage from './views/OrdersPage'
import OrderPage from './views/OrderPage'

Vue.component('order', Order);
Vue.component('orders', Orders);


const router = new VueRouter({
	mode: 'history',
		routes: [
		{
			path: '/spa',
			name: 'home',
			component: Home
		},
		{
			path: '/spa/orders',
			name: 'orders',
			component: OrdersPage
		},
		{
			path: '/spa/orders/:id',
			name: 'order',
			component: OrderPage
		},
	],
});

const app = new Vue({
	el: '#app',
	components: { App },
	router
});
