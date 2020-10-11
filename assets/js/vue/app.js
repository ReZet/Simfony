import Vue from 'vue'
import VueRouter from 'vue-router'

import App from './views/App'

Vue.use(VueRouter)
import Orders from './components/Orders'
import Order from './components/Order'
import Sync from './components/Sync'
import OrdersPage from './pages/OrdersPage'
import OrderPage from './pages/OrderPage'
import SyncPage from './pages/SyncPage'

Vue.component('order', Order);
Vue.component('orders', Orders);
Vue.component('sync', Sync);

const router = new VueRouter({
	mode: 'history',
	routes: [
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
		{
			path: '/spa/syncOrders',
			name: 'sync',
			component: SyncPage
		},
	],
});

const app = new Vue({
	el: '#app',
	components: { App },
	router
});
