<template>
  <header>
    <b-container class="py-3">

      <router-link to='/'><img fluid :src="logo" :alt="name" /></router-link>

    </b-container>
    <wpmenu name="header_menu"></wpmenu>
  </header>
</template>
<script>
export default {
  data() {
    return {
      name: '',
      logo: '',
      errors: []
    }
  },

  // Fetches posts when the component is created.
  created() {

    window.axios.get('/wp-json/')
    .then(response => {
      // JSON responses are automatically parsed.
      this.name = response.data.name
    })
    .catch(e => {
      this.errors.push(e)
    })

    window.axios.get('/wp-json/theme/v1/logo/url')
    .then(response => {
      // JSON responses are automatically parsed.

      this.logo = response.data
    })
    .catch(e => {
      this.errors.push(e)
    })

  }
}
</script>
