<template>
  <div
    class="d-md-flex flex-column align-items-center justify-content-center"
    style="height: 300px"
  >
    <img
      src="@/images/common/error404.png"
      width="200"
      class="img-fluid mb-3"
    />
    <h3>
      {{ __("no record found") }}
    </h3>
  </div>
</template>
<script>
import { defineComponent } from "vue";

export default defineComponent({
    components: {
    },
    created(){
    },
    mounted(){
    },
    data() {
        return {
        }
    },
    methods: {
    },
});
</script>
