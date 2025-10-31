<template>
  <div
    class="teacher-tabs section p-6 position-relative"
    style="background-color: #0A93E2;
    height: 450px;
    "
  >
    <div class="container-fluid px-0 overflow-hidden">


      <div class="container">
        <div class="row ">
        <div class="col-12 mb-4 text-center">
          <div
            v-if="getPageContentType('teachers_tabs_description') == 'textarea'"
          >
            <div v-html="getPageContent('teachers_tabs_description')"></div>
          </div>
          <div
            v-else-if="getPageContentType('teachers_tabs_description') == 'text'"
          >
            <p>{{ getPageContent("teachers_tabs_description") ?? "-" }}</p>
          </div>
          <div v-else>
            <span class="fs-3">{{ __("Are you Looking") }}</span>
            <h2 class="display-6 text-primary">{{ __("Qualified Tutors") }}</h2>
          </div>
        </div>
      </div>
      </div>
            <ul class="nav nav-tabs bg-transparent mb-3  text-center d-flex align-items-center justify-content-center"
             style="margin: 0 auto;"  id="myTab" role="tablist">

             <li class="nav-item qualified-tabs" :class="{'active': index == 0}" role="presentation" v-for="(teacher_main_category, index) in teacher_main_categories" :key="teacher_main_category.id">
                <button v-if="index <= 6"
                    @click="selectCategory(teacher_main_category)"
                    class="nav-link btn border border-2 shadow-none bg-transparent border-white rounded-pill p-2 mb-2 mb-md-0 px-4 me-3 text-white"
                    :id="`${teacher_main_category.slug}-tab`"
                    data-bs-toggle="tab"
                    :data-bs-target="`#category-tab-pane`"
                    role="tab"
                    :aria-controls="`category-tab-pane`"
                    aria-selected="true">
                    {{ teacher_main_category.name }}
                </button>
</li>

            <!-- <li class="nav-item qualified-tabs" role="presentation">
                <button class="nav-link btn border border-2 shadow-none bg-transparent border-white rounded-pill p-2 px-4 me-3 text-white"
                 id="math-tab" data-bs-toggle="tab" data-bs-target="#math-tab-pane"  role="tab" aria-controls="math-tab-pane"
                aria-selected="true">
                {{ __('Mathematics') }}</button>
            </li> -->
            </ul>

            <div class="tab-content w-100 container-fluid featured px-0 position-absolute overflow-hidden" id="myTabContent">

            <div class="tab-pane fade show active" :id="`category-tab-pane`" role="tabpanel" :aria-labelledby="`category-tab`">
            <featured-teacher-section
                :category="selected_main_category"
                findTeachers="true"
                v-if="featured_tab"
            ></featured-teacher-section>
            </div>
            </div>
            </div>
            </div>

        <!-- <li class="nav-item" role="presentation">
          <button
            class="nav-link rounded-pill text-dark active"
            id="pills-featured-teachers-tab"
            data-bs-toggle="pill"
            data-bs-target="#pills-featured-teachers"
            type="button"
            @click="refreshSlider('featured')"
            role="tab"
            aria-controls="pills-featured-teachers"
            aria-selected="false"
          >
            {{ getPageContent("teachers_tabs_button_2") ?? "Featured Teachers" }}
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button
            class="nav-link rounded-pill me-3 text-dark"
            id="pills-top-rated-teachers-tab"
            data-bs-toggle="pill"
            data-bs-target="#pills-top-rated-teachers"
            type="button"
            @click="refreshSlider('top_rated')"
            role="tab"
            aria-controls="pills-top-rated-teachers"
            aria-selected="true"
          >
            {{ getPageContent("teachers_tabs_button_1") ?? "Top Rated Teachers" }}
          </button>
        </li> -->
        <!-- <li class="nav-item" role="presentation">
                <button
                    class="nav-link rounded-pill mx-3 text-dark fw-bolder"
                    id="pills-all-teachers-tab"
                    data-bs-toggle="pill"
                    data-bs-target="#pills-all-teachers"
                    type="button"
                    @click="refreshSlider('all')"
                    role="tab"
                    aria-controls="pills-all-teachers"
                    aria-selected="false"
                >
                    All Teachers
                </button>
            </li> -->

      <!-- </ul>


    </div>
    <div class="tab-content w-100" id="pills-tabContent">

        <div
          class="tab-pane fade show active"
          id="pills-featured-teachers"
          role="tabpanel"
          aria-labelledby="pills-featured-teachers-tab"
        >
                <div class="container-fluid featured px-0 position-absolute overflow-hidden">
                <featured-teacher-section
                  :refresh="featured_key"
                  findTeachers="true"
                  v-if="featured_tab"
                ></featured-teacher-section>
                </div>
        </div>
    </div>
    </div> -->

        <!-- <div
          class="tab-pane fade"
          id="pills-top-rated-teachers"
          role="tabpanel"
          aria-labelledby="pills-top-rated-teachers-tab"
        >
          <div class="container">
            <div class="row">
              <div class="col-12">
                <top-rated-teacher-section
                  class="py-2"
                  :refresh="top_rated_key"
                  background="true"
                  v-if="top_rated_tab"
                ></top-rated-teacher-section>
              </div>
            </div>
          </div>
        </div> -->


        <!-- <div
                class="tab-pane fade"
                id="pills-all-teachers"
                role="tabpanel"
                aria-labelledby="pills-all-teachers-tab"
            >
            <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <all-teacher-section
                                class="py-2"
                                findTeachers="true"
                                :refresh="all_teacher_key"
                                v-if="all_teacher_tab"

                            ></all-teacher-section>
                        </div>
                    </div>
                </div>
            </div> -->




</template>
<script>
import { defineComponent } from "vue";
import { Link } from "@inertiajs/inertia-vue3";
import FeaturedTeacherSection from "@/Components/Teachers/FeaturedTeacherSection.vue";
import TopRatedTeacherSection from "@/Components/Teachers/TopRatedTeacherSection.vue";
import AllTeacherSection from "@/Components/Teachers/AllTeacherSection.vue";
import TeacherCard from "@/Components/Teachers/TeacherCard.vue";
import axios from "axios";
import { Carousel, Navigation, Pagination, Slide } from "vue3-carousel";
import Section from "@/Components/Section.vue";
import { ref } from "vue";

export default defineComponent({
  components: {
    // TeacherCard,
    FeaturedTeacherSection,
    TopRatedTeacherSection,
    AllTeacherSection,
    Link,
    Carousel,
    Slide,
    Pagination,
    Navigation,
    Section,
  },
  created() {
    this.getTeacherMainCategories();
  },
  data() {
    return {
      form: this.$inertia.form({}),
      top_rated_tab: false,
      teacher_main_categories:[],
      featured_tab: true,
      all_teacher_tab: false,
      top_rated_key: 1,
      featured_key: 1,
      all_teacher_key: 1,
      selected_main_category:null,
    };
  },
  methods: {
    refreshSlider(tab) {
      if (tab == "top_rated") {
        this.top_rated_tab = true;
        this.top_rated_key++;
      }
      if (tab == "featured") {
        this.featured_tab = true;
        this.featured_key++;
      }
      if (tab == "all") {
        this.all_teacher_tab = true;
        this.all_teacher_key++;
      }
    },
    selectCategory(category){
        this.selected_main_category = category.slug
        this.featured_key++;
        console.log('refreshed')
    },
    getTeacherMainCategories() {
      axios.get(this.route("getApiTeacherMainCategories")).then((res) => {
        this.teacher_main_categories = res.data.data;
        this.selected_main_category = this.teacher_main_categories[0].slug ?? null;
        this.fetching = false;
      });
    },
    submit(){},
  },
});
</script>
