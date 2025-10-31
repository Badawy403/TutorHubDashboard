<template>
    <Section class="bg-light p-6" :class="{ 'find-academys': findAcademies }">

        <div class="row">
            <div class="col-12 mb-4 text-center">
                <div class="col-12" v-if="getPageContentType('featured_academies_description') == 'textarea'">
                    <div v-html="getPageContent('featured_academies_description')"> </div>
                </div>
                <div class="col-12" v-else-if="getPageContentType('featured_academies_description') == 'text'">
                    <p> {{ getPageContent('featured_academies_description') ?? '-' }} </p>
                </div>
                <div v-else>
                    <span class="fs-3">{{
        __("Are you Looking For")
    }}</span>
                    <h2 class="display-6">{{ __("Featured Academy") }}</h2>
                </div>
            </div>
        </div>

        <!-- <template #paragraph>
      <p class="text-center mb-4">Your overall healing and well-being matters to us which is why we’re excited to partner with world renowned academies and integrated academies. When dealing with unresolved or unexplained physical or emotional issues and trauma, having a guide and community to help and support you along your path to finding a solution that works for you is something we all can benefit from! Connect with our top rated academies and academies.</p>
    </template> -->

        <div class="container-fluid spotlight-carousel px-0">
            <Carousel class="academy_carousel featured-academy-carousel" :wrapAround="true" :breakpoints="breakpoints" ref="carousel"
                v-model="currentSlide">
                <Slide v-for="academy in featured_academies" :key="academy.id">
                    <academy-card :academy="academy"></academy-card>
                </Slide>
                <template #addons>
                <navigation />
                </template>
            </Carousel>
        </div>

        <!-- <div class="container">
        <div class="row">
        <div class="col-12 d-flex align-items-center gap-3">
        <div class="col-6" v-for="academy in featured_academies" :key="academy.id">
            <academy-card :academy="academy"></academy-card>
        </div>
        </div>
        </div>

      </div> -->

        <!-- <div class="row pt-4 justify-content-center">
      <div class="col-md-3 d-flex justify-content-center">
        <Link :href="route('academies.listing')" class="learn-more btn position-relative" style="width:14rem">
            <span class="circle" aria-hidden="true">
              <span class="icon arrow"></span>
            </span>
            <span class="button-text">{{  getPageContent('general_view_more_btn_text') ??  __('view more') }}</span>
          </Link> -->
        <!-- <Link :href="route('academies.listing')" class="btn rounded-5 border-0 px-4 text-white btn-primary">{{ __('view more') }}</Link> -->
        <!-- </div>
    </div> -->
    </Section>

</template>
<script>
import { defineComponent } from "vue";
import { Link } from "@inertiajs/inertia-vue3";
import AcademyCard from "@/Components/Academies/AcademyCard.vue";
import axios from "axios";
import { Carousel, Navigation, Pagination, Slide } from 'vue3-carousel';
import Section from "@/Components/Section.vue";

export default defineComponent({
    components: {
        AcademyCard,
        Link,
        Carousel,
        Slide,
        Pagination,
        Navigation,
        Section
    },
    created() {
        this.getFeaturedAcademies()
    },
    data() {
        return {
            form: this.$inertia.form({
            }),
            featured_academies: [],
            settings: {
                itemsToShow: 1,
                snapAlign: 'start',
            },
            // breakpoints are mobile first
            // any settings not specified will fallback to the carousel settings
            breakpoints: {
                // 700px and up
                700: {
                    itemsToShow: 1,
                    snapAlign: 'start',
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
        getFeaturedAcademies() {
            axios.get(this.route('getApiFeaturedAcademies')).then(res => {
                this.featured_academies = res.data.data
            });
        },
        submit() {
        },
    },
    props: [
        'findAcademies'
    ]
});
</script>
