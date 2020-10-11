<template>
    <div>
		<div v-if='in_proccess'>Loading...</div>
		<div v-if='!in_proccess'>New orders: {{ orders.length }}</div>
	</div>
</template>
 
<script>
    export default {
        data: function () {
            return {
				in_proccess: true,
				orders: null,
            }
        },
        mounted() {
            var app = this;
			
            axios.get('/api/v1/sync_orders')
                .then(function (resp) {
					app.in_proccess = false;
                    app.orders = resp.data;
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load the order");
                });
        }
    }
</script>