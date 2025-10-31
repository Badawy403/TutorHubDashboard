<template>
    <div class="section py-md-5" :style="[background_color ? 'background-color:'+ background_color+';':'']">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 mb-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <h2 class="text-capitalize text-primary fw-bold mb-0">{{ heading }}</h2>
                        <Link v-if="href" :href="href" class="btn btn-outline-primary fw-medium">
                            <span class="button-text">{{ __('view all') }}</span>
                          </Link>

                          <Link v-if="outer_href" :href="outer_href" target="_blank" class="btn btn-outline-primary fw-medium">
                            <span class="button-text">{{ __('view all') }}</span>
                          </Link>


                    </div>
                </div>
                <div class="col-12">
                    <div class="row">
                            <slot> </slot>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
  import { defineComponent } from 'vue'
  import { Link } from "@inertiajs/inertia-vue3";

  export default defineComponent({
    components:{
        Link
    },
    props: {
      heading: {
        type: String
      },
      background_color: {
        type: String
      },
      href:{
        default: null,
        type:String
      },
      outer_href:{
        default: null,
        type:String
      }
    }
  })
</script>

<style lang="scss" scoped>
@media screen and (max-width: 768px) {
h2{
    font-size: 20px !important;
}
}
</style>
