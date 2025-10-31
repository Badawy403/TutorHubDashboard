<template>
  <div class="section" :class="{'bg-section': background}">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div v-if="heading_type && heading_type == 'textarea'">
                <div v-html="heading"></div>
            </div>
          <h2 v-else class="text-center display-6">{{ heading }}</h2>
          <slot name="paragraph"></slot>
        </div>
      </div>
      <slot> </slot>
    </div>
  </div>
</template>
<script>
import { defineComponent } from 'vue'

export default defineComponent({
  props: {
    heading: {
      type: String
    },
    heading_type: {
          type: String
      },
    background:{
      type: Boolean
    }
  }
})
</script>
