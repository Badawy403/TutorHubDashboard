<template>

<div class="card bg-transparent">
  <div class="bg-secondary rounded-4 bg-opacity-25" style="height: 400px;"></div>
  <div class="card-body">
    <h5 class="card-title placeholder-glow">
      <span class="placeholder col-6 py-3 rounded-3 mb-2"></span>
    </h5>
    <p class="card-text placeholder-glow">

      <span class="placeholder col-3 py-3 rounded-3"></span>
      <span class="placeholder col-10 py-3 rounded-3 mt-3"></span>
    </p>
    <a class="btn btn-primary disabled placeholder col-3" aria-disabled="true"></a>
  </div>
</div>
</template>


<script>
import { defineComponent } from 'vue';
import { Link } from "@inertiajs/inertia-vue3";
export default defineComponent({
    components: {
        Link,
    },
})
</script>
