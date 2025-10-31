<template>
  <div class="col-md-4">
    <div
      class="card bg-white item-h card-alt overflow-hidden border-0 rounded-ms shadow-sm mb-5"
    >
      <div
        class="d-flex justify-content-center overflow-hidden card-avatar rounded-2 position-relative"
        style="height: 240px"
      >
        <img
          v-if="podcast.image"
          class="img-fluid card-img-top"
          :src="podcast.image"
          alt="image"
        />
        <img
          v-else
          class="img-fluid card-img-top"
          src="@/images/common/podcast.png"
          alt="image"
        />
        <div class="item-overlay top"></div>
        <!-- <div class="block--text text-center">
          <Link
            :href="route('podcasts.detail', { slug: podcasts.slug })" class="btn btn-primary"
            >{{ __("view detail") }}</Link
          >
        </div> -->
        <div class="icon  position-absolute end-0 bottom-0 block--text text-center">
          <Link :href="route('podcasts.detail', { slug: podcast.slug })" class="btn btn-primary">{{ __("view detail") }}</Link>
        </div>
      </div>
      <div class="card-body bg-white">
        <h4 class="fixed-title mb-1 truncate fw-bold">
          <a
            class="text-decoration-none text-dark"
            :href="route('podcasts.detail', { slug: podcast.slug })"
            >{{ podcast.name }}</a
          >
        </h4>
        <span v-if="podcast.teacher_id" class="badge bg-primary fs-5">{{ __("teacher") }}</span>
        <span v-else-if="podcast.academy_id" class="badge bg-primary fs-5"
          >{{ __("academy") }}</span
        >
        <span v-else class="badge bg-primary fs-5">{{ __('admin') }}</span>
        <p class="mb-0 mt-3 line-clamp" v-html="podcast.description"></p>
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
    podcast: {},
    add_col: {
      default: true,
    },
  },
  created() {
    console.log(this.podcast);
  },
  data() {
    return {};
  },
  methods: {},
});
</script>
