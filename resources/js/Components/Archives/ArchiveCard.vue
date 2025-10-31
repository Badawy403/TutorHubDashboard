<template>
    <div class="col-md-4">
        <div class="card item-h border card-alt rounded-md shadow-sm  overflow-hidden border-0 mb-3">
            <div class="d-flex justify-content-center rounded-md overflow-hidden card-avatar position-relative"
                style="height: 300px;">
                <img v-if="archive.image" class="img-fluid w-100" :src="archive.image" alt="image">
                <img v-else class="img-fluid" src="@/images/common/course.png" alt="image">
                <div class="item-overlay top"></div>
                <div
          class="icon  position-absolute end-0 bottom-0 block--text text-center"
        >
          <Link
            :href="route('archives.detail', { slug: archive.slug })"
            class="btn btn-primary"
            >{{ __("view detail") }}</Link
          >
        </div>
            </div>
            <div class="card-body  bg-white ">
                <h4 class="fixed-title mb-1"><a class="text-decoration-none text-dark truncate fw-bold"
                        :href="route('archives.detail', { slug: archive.slug })">{{ archive.name }}</a></h4>
                <span v-if="archive.teacher_id" class="badge bg-primary fs-5">{{ __('teacher') }}</span>
                <span v-else-if="archive.academy_id" class="badge bg-primary fs-5">{{ __("academy") }}</span>
                <span v-else class="badge bg-primary fs-5">{{ __('admin') }}</span>
                <p class="mb-0 mt-3 line-clamp" v-html="archive.description"></p>


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
        'archive': {

        }

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
