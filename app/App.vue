<template>
  <div class='container'>
    <a-typography-title>Vue Library App</a-typography-title>
    <router-view></router-view>
  </div>
</template>

<script>
import BooksList from './components/BooksList.vue';
import BookItem from './components/BookItem';

export default {
  components: {
    BooksList,
    BookItem
  }
}
</script>

<style scoped>
.container {
  padding: 2%;
}
</style>
