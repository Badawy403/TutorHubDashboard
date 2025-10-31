<template>
    <div class="section spotlight premium p-6">
        <div class="container-fluid px-0 overflow-hidden">
          <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="position-relative text-center">
                        <!-- <img src="@/images/home/premium.png" alt="" class="img-fluid mb-3" /> -->
                        <div class="col-12" v-if="getPageContentType('premium_teachers_description') == 'textarea'">
                                      <div v-html="getPageContent('premium_teachers_description')"> </div>
                                    </div>
                        <div class="col-12" v-else-if="getPageContentType('premium_teachers_description') == 'text'">
                            <p> {{getPageContent('premium_teachers_description') ?? '-'}} </p>
                    </div>
                    <div v-else>
                        <h2 class="text-center display-6"
                           data-aos="fade-down"
                            data-aos-once="false"
                            data-aos-duration="1500"
                            data-aos-delay="200">
                            {{ __("Premium Tutors") }}
                        </h2>

                        <p class="text-center mb-5">
                            Our team of highly skilled attorneys comprises seasoned professionals with extensive experience
                            in their respective fields. We pride ourselves on recruiting top legal talent, ensuring that you
                            receive the highest standard of representation. From complex litigation to intricate
                            transactional matters, we have the depth of knowledge and breadth of skills to handle even the
                            most challenging cases.
                        </p>
                    </div>

                        <!-- <div class="position-absolute top-0" style="right: 15%;">

                <button @click="prev" class="btn">
                  <i class="bi bi-chevron-left"></i>
                </button>
                <button @click="next" class="btn">
                  <i class="bi bi-chevron-right"></i>
                </button>
              </div> -->
                    </div>
                </div>
            </div>
          </div>


            <div class="container-fluid spotlight-carousel px-0" v-if="!fetching && premium_teachers.length > 0">
                <Carousel  :wrapAround="true"  :breakpoints="breakpoints" ref="carousel" v-model="currentSlide">
                    <Slide v-for="teacher in premium_teachers" :key="teacher.id">
                        <teacher-spotlight-card :teacher="teacher"></teacher-spotlight-card>
                    </Slide>
                    <!-- <template #addons>
                        <Pagination />
                    </template> -->
                </Carousel>
            </div>
            <Section v-else-if="!fetching && premium_teachers.length == 0">
                <record-not-found></record-not-found>
            </Section>
            <div class="container-fluid spotlight-carousel px-0" v-else>
                <Carousel v-bind="settings" :breakpoints="breakpoints"  ref="carousel">
                    <Slide v-for="slide in 4" :key="slide">
                        <spotlight-card-skeleton class="px-md-5"></spotlight-card-skeleton>
                    </Slide>
                </Carousel>
            </div>


            <div class="row mt-5">
            <div class="col-12 text-center">
             <Link :href="route('teachers.listing')" class="btn btn-primary rounded-pill">{{ __('Explore More') }}</Link>
            </div>
            </div>

            <!-- <div class="row pt-4 justify-content-center">
          <div class="col-md-3 d-flex justify-content-center">
            <Link :href="route('teachers.listing')" class="btn rounded-5 border-0 px-4 text-white btn-primary">{{ __('view all teachers') }}</Link>
          </div>
        </div> -->
        </div>
    </div>
</template>
<script>
import { defineComponent } from "vue";
import { Link } from "@inertiajs/inertia-vue3";
import TeacherSpotlightCard from "@/Components/Teachers/TeacherSpotlightCard.vue";
import axios from "axios";
import SpotlightCardSkeleton from "@/Components/Skeleton/SpotLightCardSkeleton.vue";
import { Carousel, Navigation, Pagination, Slide } from "vue3-carousel";
import RecordNotFound from "../Shared/RecordNotFound.vue";

export default defineComponent({
    components: {
        TeacherSpotlightCard,
        Link,
        Carousel,
        Slide,
        Pagination,
        Navigation,
        SpotlightCardSkeleton,
        RecordNotFound,
    },
    created() {
        this.getFeaturedTeachers();
    },
    data() {
        return {
            form: this.$inertia.form({}),
            premium_teachers: [],
            fetching:true,
            settings: {
      snapAlign: 'center',
    },
    breakpoints: {
      // 700px and up
      700: {
        itemsToShow: 1,
        snapAlign: 'center',
      },
      // 1024 and up
      1024: {
        itemsToShow: 2,
        snapAlign: 'center',
      },
    },
        };
    },
    methods: {
        getFeaturedTeachers() {
            axios.get(this.route("getApiPremiumTeachers")).then((res) => {
                this.fetching = false
                this.premium_teachers = res.data.data;
            });
        },
        submit() { },

        next() {
            this.$refs.carousel.next();
        },
        prev() {
            this.$refs.carousel.prev();
        },
    },

});
</script>
