<template>
    <div class="col-md-4 mb-3">
        <div class="card w-100 bg-white h-100 d-flex align-items-center justify-content-center overflow-hidden  shadow-sm rounded-md">

            <div class="card-body">
                <div class="d-flex align-items-center flex-column justify-content-between mb-3">
                    <div class="d-flex align-items-center overflow-hidden bg-light rounded-circle mb-2"
                        style="width: 70px; height: 70px;">
                        <img class="img-fluid" :src="review.student.image" alt="image">
                    </div>
                    <h5 class="ms-3 fw-bold text-black text-capitalize"> {{ review.student.name }}</h5>
                </div>

                <p class="text-center mb-2 px-3" style="color: #C5C4C7;">
                    {{ review.comment }}
                </p>

                <div class="d-flex align-items-center justify-content-center">
                    <span class="rating text-warning">
                        <star-rating :rating="review.rating" :star-size="18" :read-only="true" :increment="0.01" :show-rating="false"></star-rating>
                    </span>
                    <span class="ms-3 fw-medium mt-1">{{ getFormattedDateOnly(review.created_at) }}</span>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { defineComponent } from "vue";
import {  Link } from "@inertiajs/inertia-vue3";

export default defineComponent({
  components: {
    Link,
  },
  props:['review','add_col'],
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
