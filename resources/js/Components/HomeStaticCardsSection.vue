<template>
  <div class="static-cards bg-white p-6">
    <div class="container">
      <div class="row">
        <div
          class="col-12"
          v-if="
            getPageContentType('category_section_description') == 'textarea'
          "
        >
          <div v-html="getPageContent('category_section_description')"></div>
        </div>
        <div
          class="col-12"
          v-else-if="
            getPageContentType('category_section_description') == 'text'
          "
        >
          <p>{{ getPageContent("category_section_description") ?? "-" }}</p>
        </div>

        <div v-else class="col-12">
          <h2
            class="display-6 text-center text-primary"
            data-aos="fade-down"
            data-aos-once="false"
            data-aos-duration="1500"
            data-aos-delay="200"
          >
            {{ __("Law Categories") }}
          </h2>
          <p class="mb-5 text-center">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem,
            quasi explicabo, animi, molestias cumque porro vel facere nostrum
            numquam aperiam ex harum non. Ullam, rem. Reprehenderit, tenetur
            eveniet. Molestias, culpa.
          </p>
        </div>
      </div>
    </div>
    <div class="container" v-if="fetching">
        <div class="row align-items-center">
          <div class="col-md-4">
            <categories-skeleton></categories-skeleton>
        </div>
          <div class="col-md-4">
            <categories-skeleton></categories-skeleton>
        </div>
          <div class="col-md-4">
            <categories-skeleton></categories-skeleton>
        </div>
        </div>
    </div>
    <div class="container" v-if="!fetching">
      <div class="row align-items-center">
        <div
          class="col-lg-4 hvr-float d-md-block d-flex align-items-center justify-content-center"
          v-for="(category, index) in teacher_main_categories"
          :key="index"
        >
          <Link
            v-if="index <= 2"
            class="text-decoration-none text-center"
           :href="`${route('teachers.listing')}?teacher_category_slug=${category.slug}`"
          >
            <div class="card bg-transparent">
              <div
                class="rounded-5 text-center overflow-hidden"
                style="width: 100%; height: 200px"
              >
                <img :src="category.image" class="img-fluid" alt="cardtopimg" />
              </div>

                  <div class="card-body text-start">
                    <h4 class="card-title">
                      <a href="#" class="text-decoration-none fs-3 text-black fw-bolder">
                        {{category.name}}</a>
                      </h4>
                    <div class="card-text d-flex flex-row align-content-center justify-content-between mb-1 details">
                      <span class="text-secondary fw-medium fs-5">{{ __('Courses') }}: <span style="color: #171CAA;">{{category.archive_count}}+</span></span>
                      <span class="text-secondary fw-medium fs-5">{{ __("Students") }}: <span style="color: #171CAA;">{{category.student_count}}+</span></span>
                      <span class="text-secondary fw-medium fs-5">{{ __("Instructors") }}: <span style="color: #171CAA;">{{category.teacher_count}}+</span></span>
                    </div>
                  </div>
                </div>
               </Link>
              </div>
        </div>
        <div class="row mt-5">
         <div class="col-12 text-center">
            <Link :href="route('categories')" class="btn btn-primary">{{ __('Explore More') }}</Link>
         </div>
        </div>
    </div>
    <!-- <categories-block-skeleton></categories-block-skeleton> -->
  </div>
</template>
<script>
import { defineComponent } from "vue";
import { Link } from "@inertiajs/inertia-vue3";
import CategoriesSkeleton from "@/Components/Skeleton/CategoriesSkeleton.vue";
export default defineComponent({
  components: {
    Link,
    CategoriesSkeleton

  },
  created() {
    this.getTeacherMainCategories();
    },
    data() {
        return {
            teacher_main_categories:[],
            fetching:true
        };
    },
    methods: {
        getTeacherMainCategories() {
      axios.get(this.route("getApiTeacherMainCategories")).then((res) => {
        this.teacher_main_categories = res.data.data;
        this.fetching = false
      });
    },
  },
});
</script>



