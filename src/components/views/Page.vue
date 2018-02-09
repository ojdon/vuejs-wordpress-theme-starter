<template>
    <section class="home">
        <b-container class="">
            <h1 class="mt-5 mb-3">{{ page.title.rendered }}</h1>
            <div v-html="page.content.rendered"></div>

        </b-container>
    </section>
</template>

<script>
export default {
	data() {
		return {
			page: {},
			errors: []
		}
	},

  // Fetches posts when the component is created.
  created() {

  	window.axios.get('/wp-json/wp/v2/pages?slug='+this.$route.params.page)
  	.then(response => {
      // JSON responses are automatically parsed.
      this.page = response.data[0]
  	})
  	.catch(e => {
  		this.errors.push(e)
  	})

  }
}
</script>

<style lang="scss">
</style>
