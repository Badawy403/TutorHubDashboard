<template>
    <div class="container px-4 px-md-3 mbl-height">
    <div class="row justify-content-center h-100">
        <div class="d-flex pt-4 mbl-logo">
            <slot name="logo"/>
        </div>
        <div class="">
          <slot />
        </div>
    </div>
  </div>
</template>

<script>

export default {
  components: {
  },
};

</script>
