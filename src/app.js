window.SETTINGS = {
  // How many different dispatched actions determine loading progress
  // This is likely determined by how many dispatched actions you have below
  // in the created() method
  LOADING_SEGMENTS: 2,
  API_BASE_PATH: '/wp-json/wp/v2/'
}

require('./bootstrap')

import 'babel-polyfill'
import Vue from 'vue'
import VueRouter from 'vue-router'
import VueLazyload from 'vue-lazyload'

import BootstrapVue from 'bootstrap-vue'

import router from './router'
// import { auth, database } from './firebase.config.js' - Uncomment if you need firebase
import App from './App.vue'
import store from './store'
import * as types from './store/mutation-types'
import WPMenu from './components/widgets/WPMenu.vue'
Vue.use(VueLazyload)
Vue.use(BootstrapVue)

// Global Components
Vue.component('wpmenu', WPMenu)

new Vue({
  el: '#app',
  store,
  router,
  render: h => h(App),
  created () {
    this.$store.commit(types.RESET_LOADING_PROGRESS)
    this.$store.dispatch('getAllCategories')
    this.$store.dispatch('getAllPages')
  }
})
