<template>
  <div>Logout</div>
</template>


<script>
export default {
  created() {
    localStorage.removeItem('token');
    this.$router.push({path: '/'});
    window.reload()
  }
}
</script>