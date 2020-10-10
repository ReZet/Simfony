<template>
    <div>
		<h1>Order {{ order.orderId }} Details</h1>
		<div class="row">
			<div class="col-3 text-right font-weight-bold">Order ID:</div>
			<div class="col-9">{{ order.orderId }}</div>
		</div>
		<div class="row">
			<div class="col-3 text-right font-weight-bold">Phone:</div>
			<div class="col-9"><a :href="`tel:${order.phone}`">{{ order.phone }}</a></div>
		</div>
		<div class="row">
			<div class="col-3 text-right font-weight-bold">Date:</div>
			<div class="col-9">{{ order.date }}</div>
		</div>
		<div class="row">
			<div class="col-3 text-right font-weight-bold">Amount:</div>
			<div class="col-9">{{ order.orderAmount }} {{ order.currency }}</div>
		</div>
		<div class="row">
			<div class="col-3 text-right font-weight-bold">Currency:</div>
			<div class="col-9">{{ order.currency }}</div>
		</div>
		<div class="row">
			<div class="col-3 text-right font-weight-bold">Shipping Status:</div>
			<div class="col-9">{{ order.shippingStatus }}</div>
		</div>
		<div class="row">
			<div class="col-3 text-right font-weight-bold">Shipping Price:</div>
			<div class="col-9">{{ order.shippingPrice }} {{ order.currency }}</div>
		</div>
		<div class="row">
			<div class="col-3 text-right font-weight-bold">Shipping Payment Status:</div>
			<div class="col-9">{{ order.shippingPaymentStatus }}</div>
		</div>
		<div class="row">
			<div class="col-3 text-right font-weight-bold">Payment Status:</div>
			<div class="col-9">{{ order.paymentStatus }}</div>
		</div>		

		<h3 class="mt-2 mb-2">Order Items:</h3> 

		<div class="table-responsive">
			<table class="table">
				<thead>
					<tr>
						<th class="col">Barcode</th>
						<th class="col">Price</th>
						<th class="col">Quantity</th>
						<th class="col">Tax Perc</th>
						<th class="col">Tax Amt</th>
						<th class="col">Tracking Number</th>
						<th class="col">Canceled</th>
						<th class="col w-100">Shipped Status Sku</th>
					</tr>
				</thead>
				<tr v-for="item, index in order.orderItems">
					<td style="width: 10em" class="col">{{ item.barcode }}</td>
					<td class="col">{{ item.price }}</td>
					<td class="col">{{ item.quantity }}</td>
					<td class="col">{{ item.tax_perc }}</td>
					<td class="col">{{ item.tax_amt }}</td>
					<td class="col">{{ item.tracking_number }}</td>
					<td class="col">{{ item.canceled }}</td>
					<td class="col">{{ item.shipped_status_sku }}</td>
				</tr>
			</table>
		</div>
	</div>
</template>
 
<script>
    export default {
        data: function () {
            return {
				orderId: 0,
                order: {
					id: '',
					phone: '',
					orderId: '',
					date: '',
					orderAmount: '',
					currency: '',
					shippingStatus: '',
					shippingPrice: '',
					shippingPaymentStatus: '',
					paymentStatus: ''
				}
            }
        },
        mounted() {
            var app = this;
			let id = app.$route.params.id;
            app.orderId = id;
			console.log(app);
			
            axios.get('/api/v1/orders/' + id)
                .then(function (resp) {
                    app.order = resp.data;
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load the order");
                });
        }
    }
</script>