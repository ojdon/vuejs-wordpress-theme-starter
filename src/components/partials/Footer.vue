<template>
    <footer class="footer text-center">
      <wpmenu name="header_menu" class="my-5 "></wpmenu>
       <p class="mb-5">&copy; {{ new Date().getFullYear() }} - {{name}}</p>
    </footer>
</template>
<script>
import axios from 'axios';

export default {
  data() {
    return {
      name: '',
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
  }
}
</script>
