<template>
  <div class="row">
    <div class="col-md-4">
      <section-title>
        <template #title><slot name="title"></slot></template>
        <template #description><slot name="description"></slot></template>
      </section-title>
    </div>

    <div class="col-md-8">
      <div class="card shadow-sm">
        <div class="card-body">
          <slot name="content"></slot>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { defineComponent } from "vue";
import SectionTitle from "./SectionTitle.vue";

export default defineComponent({
  components: {
    SectionTitle,
  },
});
</script>
