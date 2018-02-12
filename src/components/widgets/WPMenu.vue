<template>
	<b-navbar toggleable="md" type="dark" variant="dark" sticky=true>
		<b-nav-toggle target="nav_collapse"></b-nav-toggle>

		<b-collapse is-nav id="nav_collapse">

			<b-nav is-nav-bar class="mx-auto">
				<b-nav-item v-for="menuItem in menu" v-bind:to="menuItem.url" :key="menuItem.id" >{{menuItem.title}}</b-nav-item>
			</b-nav>

		</b-collapse>
	</b-navbar>
</template>
<script>

export default {
	props: ["name"],
	data() {
		return {
			origin: window.location.origin,
			menu: [],
			errors: []
		}
	},

  // Fetches posts when the component is created.
  created() {
  	window.axios.get('/wp-json/wp-api-menus/v2/menu-locations/'+this.name)
  	.then(response => {
      // JSON responses are automatically parsed.
      this.menu = response.data
      for(var i=0;i<this.menu.length;i++) {
      	this.menu[i].url = this.menu[i].url.replace(this.origin,'');
      }

  })
  	.catch(e => {
  		this.errors.push(e)
  	})

  }
}
</script>
