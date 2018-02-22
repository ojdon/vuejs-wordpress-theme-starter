<template>
    <section class="home">
         <vue-headful v-if="loaded === true"
            :title="post.yoast_meta.yoast_wpseo_title"
            :description="post.yoast_meta.yoast_wpseo_metadesc"
            :url="post.yoast_meta.yoast_wpseo_canonical"
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
      loaded: false,
      methods: {
        getData: function(slug, callback) {
          window.axios.get('/wp-json/wp/v2/posts?slug='+slug)
          .then(response => {
            // JSON responses are automatically parsed.
            callback(response.data[0])
          })
          .catch(e => {
            console.log(e)
          })
        }
      },
    }
  },
  watch: {
    '$route' (to, from) {
      var _this = this
      this.methods.getData(to.params.post, function(data){
        _this.post = data
        _this.loaded = true
      })
    }
  },
  // Fetches posts when the component is created.
  created() {
    var _this = this
    this.methods.getData(this.$route.params.post, function(data){
      _this.post = data 
      _this.loaded = true
    })
  },
}
</script>

<style lang="scss">
</style>
