<template>
  <section class="home">
    <vue-headful v-if="loaded === true"
            :title="page.yoast_meta.yoast_wpseo_title"
            :description="page.yoast_meta.yoast_wpseo_metadesc"
            :url="page.yoast_meta.yoast_wpseo_canonical"
        />
    <b-container class="">
      <h1 v-if="loaded === true" class="mt-5 mb-3" >{{ page.title.rendered }}</h1>
      <div v-if="loaded === true" v-html="page.content.rendered"></div>
    </b-container>
  </section>
</template>

<script>
export default {
	data() {
		return {
			page: {},
			errors: [],
      loaded: false
    }
  },

  // Fetches posts when the component is created.
  beforeCreate() {
  	window.axios.get('/wp-json/wp/v2/pages?slug='+this.$route.params.page)
  	.then(response => {
      // JSON responses are automatically parsed.
      this.page = response.data[0]
      this.loaded = true

    })
  	.catch(e => {
  		this.errors.push(e)
  	})
  },

}

</script>

<style lang="scss">
</style>
