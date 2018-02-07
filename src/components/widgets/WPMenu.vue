<template>
	<b-navbar toggleable="md" type="dark" variant="dark" sticky=true>
		<b-nav-toggle target="nav_collapse"></b-nav-toggle>

		<b-collapse is-nav id="nav_collapse">

			<b-nav is-nav-bar class="mx-auto">
				<b-nav-item v-for="menuItem in menu" :href="menuItem.url" :key="menuItem.id">{{menuItem.title}}</b-nav-item>
			</b-nav>

		</b-collapse>
	</b-navbar>
</template>
<script>

export default {
	props: ["name"],
	data() {
		return {
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
  })
  	.catch(e => {
  		this.errors.push(e)
  	})

  }
}
</script>
