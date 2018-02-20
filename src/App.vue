<template>
  <div id="my-app" class="page-wrapper">
    <transition
    name="loader-animation"
    enter-active-class="animated fadeIn"
    leave-active-class="animated fadeOut">
    <div class="progress loader" v-if="showLoader">
      <div class="progress-bar" role="progressbar" :style="loaderStyle" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
  </transition>

  <app-header></app-header>

  <transition name="page-transition" mode="out-in" appear>
    <div class="page-content-wrapper">
      <router-view></router-view>
    </div>
  </transition>

  <app-footer></app-footer>

</div>
</template>

<script>
import { mapGetters, mapActions, mapMutations } from 'vuex'
import Header from './components/partials/Header'
import Footer from './components/partials/Footer'

export default {
  
  data() {
    return {
      showLoader: true,
      name: '',
      errors: []
    }
  },

  // Fetches posts when the component is created.
  created() {

    window.axios.get('/wp-json/')
    .then(response => {
      // JSON responses are automatically parsed.
      this.name = response.data[0].name

  })
    .catch(e => {
      this.errors.push(e)
    })

  },
  computed: {
    ...mapGetters({
      isLoading: 'isLoading',
      loadingProgress: 'loadingProgress'
    }),

    loaderStyle() {
      return `width: ${this.loadingProgress}%;`
    }
  },

  components: {
    appHeader: Header,
    appFooter: Footer
  },

  watch: {
    // watch the value of isLoading and once it's false hide the loader
    isLoading(val) {
      if (val == false) {
        let self = this
        setTimeout(function(){
          self.showLoader = false
        }, 1000)
      }
    }
  }
}
</script>
<style lang="scss">
@import './styles/app.scss';
</style>
