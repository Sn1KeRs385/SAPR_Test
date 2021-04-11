<template>
  <div>
    <form class="login" @submit.prevent="login">
      <h1>Sign in</h1>
      <label>Email</label>
      <input required v-model="email" type="email" placeholder="Name"/>
      <label>Password</label>
      <input required v-model="password" type="password" placeholder="Password"/>
      <hr/>
      <button type="submit">Login</button>
    </form>
  </div>
</template>


<script>
import axios from 'axios'
export default {
  data(){
    return {
      email : "",
      password : ""
    }
  },
  methods: {
    login: async function () {
      let data = {
        email: this.email,
        password: this.password,
      }
      axios({url: 'http://localhost:8000/api/auth/login', data: data, method: 'POST' })
          .then(resp => {
            const token = resp.data.access_token
            localStorage.setItem('token', token)
            this.$router.push({path: '/'})
            window.reload()
          })
    }
  }
}
</script>