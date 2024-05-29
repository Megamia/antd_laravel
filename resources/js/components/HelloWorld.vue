<template>
  <div class="hello">
    <h1>Hello world</h1>
    <!-- <RouterLink to="/TestAbc">test1</RouterLink>
    <RouterLink to="/TestBcd">test2</RouterLink> -->
     <span @click="test1">test1</span>
    <span @click="test2">test2</span> 
    <RouterView />
  </div>
</template>

<script setup>
import { useRouter } from "vue-router";
// import { RouterLink } from "vue-router";

const router = useRouter();
const test1 = () => {
  router.push("/TestAbc");
};
const test2 = () => {
  router.push("/TestBcd");
};
</script>

<style scoped>
h3 {
  margin: 40px 0 0;
}
ul {
  list-style-type: none;
  padding: 0;
}
li {
  display: inline-block;
  margin: 0 10px;
}
a {
  color: #42b983;
}
</style>
