<template>
    <div class="card border-0 card-reviews">
        <div class="card-body p-0">
            <div class="row">
                <div
                  class="col-md-8 text-start"
                >
                  <p class="lead qoutes font-italic" v-html="testimonial.description">

                  </p>
                  <div class="my-4 d-flex align-items-center">
                    <div class="">
                      <p class="fs-4 fw-bolder mb-0">{{testimonial.name }}</p>
                      <p class="text-muted mb-0">{{ testimonial.category }}</p>
                    </div>
                  </div>
                </div>
                <div
                  class="col-md-4"
                >
                <img v-if="testimonial.image" height="260" class="img-fluid rounded-md h-100" :src="testimonial.image" alt="User Image">
                <img v-else class="img-fluid  rounded-md" height="260" src="@/images/account/default_avatar_men.png" alt="User Image">
                </div>
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
        'testimonial': {
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
