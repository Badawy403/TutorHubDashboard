<template>
  <div :class="{ 'col-md-3': add_col }">
    <div class="card card-product card-bg-alt border-0">

      <div class="card-body">
        <div class="overflow-hidden text-center position-relative">
          <!-- //for dynamic -->
          <!-- <img class="img-fluid" src="@/images/common/avatar.png" alt="image"> -->
          <img class="img-fluid mt-3" src="@/images/common/avatar.png" alt="image">
        </div>
        <div class="d-flex flex-column align-items-center">
          <h4 class="lh-1 fs-5 mb-0">Teacher Product Name</h4>
          <span class="rating text-warning mb-2">
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
          </span>
          <button class="btn btn-primary">Buy Now</button>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { defineComponent } from "vue";
import { Link } from "@inertiajs/inertia-vue3";

export default defineComponent({
  components: {
    Link,
  },
  props: {
    'background_color': {},
    'add_col': {
      default: true
    },

  },
  created() {

  },
  data() {
    return {
    };
  },
  methods: {
  },
});
</script>
