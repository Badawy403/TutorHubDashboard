<template>
  <div class="col-md-4">
    <div
      class="card item-h card-alt overflow-hidden border-0 shadow-sm rounded-md mb-4"
    >
      <div
        class="d-flex justify-content-center overflow-hidden card-avatar position-relative"
        style="height: 300px"
      >
        <!-- //for dynamic -->

        <img
          v-if="post.image"
          class="img-fluid w-100 rounded-md"
          style="object-fit: fill"
          :src="post.image"
          alt="image"
        />
        <img
          v-else
          class="img-fluid"
          src="@/images/common/image.png"
          alt="image"
        />
        <div class="item-overlay top"></div>
        <div
          class="icon position-absolute end-0 bottom-0 block--text text-center"
        >
          <Link
            :href="route('blogs.detail', { slug: post.slug })"
            class="btn btn-primary"
            >{{ __("view detail") }}</Link
          >
        </div>
      </div>
      <div class="card-body bg-white">
        <h4 class="fixed-title mb-1 truncate">
          <a
            class="text-decoration-none text-dark fw-bold"
            :href="route('blogs.detail', { slug: post.slug })"
            >{{ post.name }}</a
          >
        </h4>
        <span v-if="post.teacher_id" class="badge bg-primary fs-5">{{
          __("teacher")
        }}</span>
        <span v-else-if="post.academy_id" class="badge bg-primary fs-5">{{
          __("academy")
        }}</span>
        <span v-else class="badge bg-primary fs-5">{{ __("admin") }}</span>
        <p class="mb-0 mt-3 line-clamp" v-html="post.description"></p>
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
    background_color: {},
    add_col: {
      default: true,
    },
    post: {},
  },
  created() {},
  data() {
    return {};
  },
  methods: {},
});
</script>
