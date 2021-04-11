<template>
  <div id="app">
    <div id="nav">
      <router-link to="/" v-if="isLogin">Home | </router-link>
      <router-link to="/register" v-if="!isLogin">Register | </router-link>
      <router-link to="/login" v-if="!isLogin">Login</router-link>
      <router-link to="/logout" v-if="isLogin">Logout | </router-link>
    </div>
    <router-view/>
  </div>
</template>

<script>
export default {
  data(){
    return {
      token : localStorage.getItem('token')
    }
  },
  computed: {
    isLogin: function() {
      return this.token !== null && this.token !== undefined
    }
  }
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

#nav {
  padding: 30px;
}

#nav a {
  font-weight: bold;
  color: #2c3e50;
}

#nav a.router-link-exact-active {
  color: #42b983;
}
</style>
