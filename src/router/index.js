import Vue from 'vue'
import Router from 'vue-router'
import vueHeadful from 'vue-headful';

// Components
import Home from '../components/views/Home'
import Page from '../components/views/Page'
import Post from '../components/views/Post'

Vue.use(Router)
Vue.component('vue-headful', vueHeadful);

const router = new Router({
  routes: [
    {
      path: '/',
      name: 'Home',
      component: Home,
      // props: { pageContentID: 383 }
    },
    {
      path: '/:page',
      component: Page,
      props: true
    },
    {
      path: '/news/:post',
      name: 'Post',
      component: Post,
      props: true
    }
  ],
  mode: 'history',
  base: '',
  scrollBehavior (to, from, savedPosition) {
    if (savedPosition) {
      return savedPosition
    } else {
      return { x: 0, y: 0 }
    }
  }


})

export default router
