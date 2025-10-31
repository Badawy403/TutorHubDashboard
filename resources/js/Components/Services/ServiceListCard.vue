<template>
  <div :class="{ 'col-md-12': add_col, 'col-md-6': !add_col }">
    <div class="card mb-4 border-0">
      <div class="card-body">
        <div class="row ">
          <div class="col-md-4">
            <img
              v-if="service.image"
              class="img-fluid rounded-5 w-100"
              :src="service.image"
              alt="image"
            />
            <img
              v-else
              class="img-fluid m-3"
              src="@/images/account/default_avatar_men.png"
              alt="image"
            />
          </div>
          <div class="col-md-8">
            <h5 class="fixed-title mb-0">
              <a
                class="text-decoration-none text-dark"
                :href="route('services.detail', { slug: service.slug })"
                >{{ service.name }}</a
              >
            </h5>
            <p class="my-3 lineclamp-2" v-html="service.description"></p>

            <div
              class="d-flex bg-warning rounded-4 w-100 p-1 mb-4 justify-content-between align-items-center"

            >
              <span class="px-2 fw-bold"
                >Legal Consultation fees
                {{ getDisplayAmount(service.price) }}</span
              >
              <Link
                :href="route('services.detail', { slug: service.slug })"
                class="btn btn-primary fw-bold me-1"
                >{{ __("view details") }}</Link
              >
            </div>

              <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <span class="overflow-hidden d-flex  rounded-circle" style="height: 50px; width: 50px;">
                    <img v-if="service.teacher && service.teacher.image" :src="service.teacher.image" alt="Image">
                    <img v-else src="@/images/lock.png" alt="Image">
                </span>
                 <p class="mb-0 ms-3" v-if="service.teacher && service.teacher.name">Service by: <span class="fw-bold">{{ service.teacher.name }}</span></p>
                </div>
                <div
                class="d-flex align-items-center justify-content-center mb-2"
              >
                <star-rating
                  :rating="service.rating"
                  :star-size="18"
                  :read-only="true"
                  :increment="0.01"
                  :show-rating="false"
                ></star-rating>
                <span class="text-dark small mt-1 ps-1">
                  ({{ service.rating }}/5)</span
                >
              </div>
            </div>


          </div>
        </div>
      </div>
    </div>
    <!-- <div
        class="card item-h card-alt overflow-hidden border-0 rounded-ms shadow-sm mb-4"
      >
        <div
          class="d-flex justify-content-center overflow-hidden card-avatar rounded-2 position-relative"
          style="height: 250px"
        >
          <img
            v-if="service.image"
            class="img-fluid"
            :src="service.image"
            alt="image"
          />
           <img
            v-else
            class="img-fluid m-3"
            src="@/images/common/service.png"
            alt="image"
          /> -->
    <!-- <div class="item-overlay top"></div> -->
    <!-- <div class="block--text text-center">
            <Link
              :href="route('services.detail', { slug: services.slug })" class="btn btn-primary"
              >{{ __("view detail") }}</Link
            >
          </div> -->
    <!-- <div class="icon mx-3 position-absolute end-0 bottom-0 block--text text-center">
            <Link :href="route('services.detail', { slug: service.slug })" class="btn btn-primary">{{ getPageContent('general_book_btn_1_text') ?? __("book appointment") }}</Link>
          </div>
        </div>
        <div class="card-body">
          <h5 class="fixed-title mb-0">
            <a
              class="text-decoration-none text-dark"
              :href="route('services.detail', { slug: service.slug })"
              >{{ service.name }}</a
            >
          </h5>
          <span v-if="service.teacher_id" class="badge bg-secondary">teacher</span>
          <span v-else-if="service.academy_id" class="badge bg-secondary"
            >Academy</span
          >
          <span v-else class="badge bg-secondary">Admin</span>
          <p class="mb-0 mt-3 lineclamp-2" v-html="service.description"></p>
        </div>
      </div> -->
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

    service: {},
    add_col: {
      default: true,
    },
  },
  created() {},
  data() {
    return {};
  },
  methods: {},
});
</script>
