<template>
	<div>
		<table class="table">
			<thead>
				<tr>
					<th scope="col">Id</th>
					<th scope="col">Order ID</th>
					<th scope="col">Date</th>
					<th scope="col">Amount</th>
					<th scope="col"></th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="order, index in orders" class="align-middle">
					<td class="align-middle">{{ order.id }}</td>
					<td class="align-middle">{{ order.orderId }}</td>
					<td class="align-middle">{{ order.date|date }}</td>
					<td class="align-baseline">{{ order.orderAmount }} {{ order.currency }}</td>
					<td>
						<router-link :to="{name: 'order', params: {id: order.id}}" class="btn btn-primary">Details</router-link>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</template>
<script>
    export default {
        data: function () {
            return {
                orders: []
            }
        },
        mounted() {
            var app = this;
            axios.get('/api/v1/orders')
                .then(function (resp) {
                    app.orders = resp.data;
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load orders");
                });
        }
    }
</script>