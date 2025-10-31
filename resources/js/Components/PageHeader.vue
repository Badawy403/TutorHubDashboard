<template>
    <div>

    <!-- Page Heading -->
        <div class="page-heading d-flex py-3">
        <div class="container">
            <h1 class="display-1 text-white"><slot></slot></h1>
        </div>
        </div>
    </div>
</template>

<script>
  import { defineComponent } from 'vue'

  export default defineComponent({
      props: [],
  })
</script>
