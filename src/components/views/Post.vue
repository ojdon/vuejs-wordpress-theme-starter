<template>
    <section class="home">
         <vue-headful v-if="loaded === true"
            :title="post.title.rendered"
            :description="post.title.rendered"
            :url="$route.path"
        />
        <b-container class="">
            <h1 v-if="loaded === true" class="mt-5 mb-3">{{ post.title.rendered }}</h1>
            <div v-if="loaded === true" v-html="post.content.rendered"></div>

        </b-container>
    </section>
</template>

<script>
export default {
	data() {
		return {
			post: {},
			errors: [],
      loaded: false
		}
	},

  // Fetches posts when the component is created.
  beforeCreate() {

  	window.axios.get('/wp-json/wp/v2/posts?slug='+this.$route.params.post)
  	.then(response => {
      // JSON responses are automatically parsed.
      this.post = response.data[0]
      this.loaded = true
      //document.title = this.post.title.rendered +' | '+ document.title
  	})
  	.catch(e => {
  		this.errors.push(e)
  	})

    

  }
}
</script>

<style lang="scss">
</style>
