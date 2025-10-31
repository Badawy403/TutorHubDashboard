<template>
        <div :class="{'col-md-4':add_col}">
            <div class="card item-h card-alt overflow-hidden border-0 shadow-sm rounded-md mb-4" >
                <div class="d-flex justify-content-center overflow-hidden card-avatar position-relative" style="height: 300px;">
                    <img v-if="broadcast.image" class="img-fluid w-100" :src="broadcast.image" alt="image">
                    <img v-else class="img-fluid" src="@/images/common/media.png" alt="image">
                    <div class="item-overlay top"></div>
                    <div class="icon end-0 bottom-0 block--text text-center">
                        <Link :href="route('broadcasts.detail',{slug:broadcast.slug})"  class="btn btn-primary">{{ __('view detail') }}</Link>
                    </div>
                </div>
                <div class="card-body bg-white">

                    <h4 class="fixed-title mb-1"><a class="text-decoration-none text-dark fw-bold" :href="route('broadcasts.detail', { slug: broadcast.slug })">{{ broadcast.name }}</a></h4>
                    <span v-if="broadcast.teacher_id" class="badge bg-primary fs-5">{{ __('teacher') }}</span>
                    <span v-else-if="broadcast.academy_id" class="badge bg-primary fs-5">{{ __('academy') }}</span>
                    <span v-else class="badge bg-primary fs-5">{{ __('admin') }}</span>
                    <p class="mb-0 mt-3 line-clamp" v-html="broadcast.description"></p>
                </div>
            </div>
        </div>
</template>
<script>
import { defineComponent } from "vue";
import {  Link } from "@inertiajs/inertia-vue3";
import CardSkeleton from "@/Components/Skeleton/CardSkeleton.vue";

export default defineComponent({
  components: {
    Link,
    CardSkeleton
  },
  props:{
    'broadcast':{},
    'add_col':{
        default:true
    },

},
  created(){

  },
  data() {
    return {
    };
  },
  methods: {
  },
});
</script>
