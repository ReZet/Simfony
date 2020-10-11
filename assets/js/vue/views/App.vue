<template>
	<div class="container">
		<div class="row">
			<div class="col">
				<nav class="navbar navbar-dark bg-primary navbar-expand-lg">
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarNav">
						<ul class="navbar-nav mr-auto">
							<li class="nav-item">
								<a href="/" class="nav-link">Home</a>
							</li>
							<router-link :to="{ name: 'orders' }" v-slot="{ href, route, navigate, isExactActive  }">
								<li :class="[isExactActive  && 'active', 'nav-item']">
									<a :href="href" @click="navigate" class="nav-link">Orders</a>
								</li>
							</router-link>
						</ul>
					
						<router-link :to="{name: 'sync'}" class="btn btn-outline-light">↺ Sync Orders</router-link>
					</div>
				</nav>
			</div>
		</div>
		<div class="row mt-3"> 
			<div class="col">
				<router-view></router-view>
			</div>
		</div>
	</div>
</template>
<script>
  export default {}
</script>