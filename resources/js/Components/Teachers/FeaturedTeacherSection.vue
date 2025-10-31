<template>
  <div class="row h-100 pt-4" v-if="!fetching && featured_teachers.length > 0" >


    <Carousel :breakpoints="breakpoints">
      <Slide v-for="teacher in featured_teachers" :key="teacher.id">
        <teacher-card :teacher="teacher"></teacher-card>
      </Slide>
    </Carousel>



    </div>

  <!-- <div class="row mt-5 justify-content-center">
      <div class="col-md-3 d-flex justify-content-center">
        <Link :href="route('teachers.listing')" class="learn-more btn position-relative" style="width:14rem">
            <span class="circle" aria-hidden="true">
              <span class="icon arrow"></span>
            </span>
            <span class="button-text">{{ getPageContent('general_find_teacher_btn_text') ?? __('find teacher') }}</span>
          </Link>
      </div>
    </div> -->
    <!-- -->
  <Section  v-else-if="!fetching && featured_teachers.length == 0">
    <record-not-found></record-not-found>
    </Section>
    <!-- -->
  <div class="pt-4" v-else>
    <Carousel key="02323232" :breakpoints="breakpoints">
        <Slide v-for="slide in 4" :key="slide">
          <teacher-card-skeleton></teacher-card-skeleton>
        </Slide>
      </Carousel>
    </div>
</template>
<script>
import { defineComponent } from "vue";
import { Link } from "@inertiajs/inertia-vue3";
import TeacherCard from "@/Components/Teachers/TeacherCard.vue";
// import CardSkeleton from "@/Components/Skeleton/CardSkeleton.vue";
import axios from "axios";
import { Carousel, Navigation, Pagination, Slide } from 'vue3-carousel';
import Section from "@/Components/Section.vue";
import RecordNotFound from "../Shared/RecordNotFound.vue";
import CategoriesSkeleton from "../Skeleton/CategoriesSkeleton.vue";
import TeacherCardSkeleton from "../Skeleton/TeacherCardSkeleton.vue"


export default defineComponent({
  components: {
    TeacherCard,
    Link,
    Carousel,
    Slide,
    Pagination,
    Navigation,
    Section,
    CategoriesSkeleton,
    TeacherCardSkeleton,

    // CardSkeleton,
    RecordNotFound
  },
  created() {
    if (this.featured_teachers.length == 0) {
        this.getFeaturedTeachers();
    }
  },
  data() {
    return {
      form: this.$inertia.form({
      }),
      featured_teachers: [],
      key:1,
      fetching:true,
      settings: {
        itemsToShow: 3.95,
        snapAlign: 'center',
        autoplay:false,
          wrapAround:'true'
      },
    // breakpoints are mobile firstTop Featured Teachers
    // any settings not specified will fallback to the carousel settings
    breakpoints: {
      // 700px and up
      700: {
        itemsToShow: 1,
        snapAlign: 'center',
        wrapAround:'true'
      },
      // 1024 and up
      1024: {
        itemsToShow: 3.95,
        snapAlign: 'center',
        wrapAround:'true'
      },
      },
    };
  },
  methods: {
    getFeaturedTeachers() {
      axios.get(this.route('getApiFeaturedTeachers',{category:this.category})).then(res => {
        this.fetching = false
        this.featured_teachers = res.data.data
      });
    },
    submit() {
    },
  },
  props: [
    'findTeachers',
    'refresh',
    'category'
  ],
  watch: {
    refresh(newVal,oldVal){
        this.key ++
    },
    category(newVal,oldVal){
        this.fetching = true
        this.key ++
        this.getFeaturedTeachers()
    }
    }
});
</script>
