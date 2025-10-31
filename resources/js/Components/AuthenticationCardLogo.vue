<template>
  <Link :href="'/'" class="d-flex justify-content-center">
    <img width="200" src="@/images/home/logo.png" alt="logo">
  </Link>
</template>
<script>
import { defineComponent } from 'vue'
import { Link } from '@inertiajs/inertia-vue3';

export default defineComponent({
  components: {
    Link,
  },
})
</script>
