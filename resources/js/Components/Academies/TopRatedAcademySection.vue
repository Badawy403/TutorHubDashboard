<template>
    <Section v-if="featured_academies.length > 0" :heading="__n('academy')">
      <template #paragraph>
        <p class="text-center mb-4">The Top Rated section highlights positive healing professionals and academies  who have built a strong reputation on the GHCN platform. All ratings are 100% user generated, these academies represent some of the top talent in this global community. Top rated academies have the highest positive feedback from other users like yourself, time after time. Each academy has been highly rated for their well rounded skills, compassion, support, and ability to help transform the lives of their clients.</p>
      </template>
        <Carousel :settings="settings" :breakpoints="breakpoints">
              <Slide v-for="academy in featured_academies" :key="academy.id">
                 <!-- <academy-card :academy="academy"></academy-card> -->
             </Slide>
        <template #addons>
            <Navigation />
        </template>
        </Carousel>
        <div class="row pt-4 justify-content-center">
          <div class="col-md-3 d-flex justify-content-center">
            <Link :href="route('academies.listing')" class="btn btn-primary">{{ __('view more') }}</Link>
          </div>
        </div>
    </Section>
    <div v-else>
    </div>
</template>
<script>
import { defineComponent } from "vue";
import {  Link } from "@inertiajs/inertia-vue3";
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
  created(){
    this.getFeaturedAcademies()
  },
  data() {
    return {
      form: this.$inertia.form({
      }),
      featured_academies:[],
      settings: {
        itemsToShow: 1,
        snapAlign: 'start',
      },
    // breakpoints are mobile firstTop Featured Academies
    // any settings not specified will fallback to the carousel settings
    breakpoints: {
      // 700px and up
      700: {
        itemsToShow: 2,
        snapAlign: 'start',
      },
      // 1024 and up
      1024: {
        itemsToShow: 4,
        snapAlign: 'start',
      },
    },
    };
  },
  methods: {
    getFeaturedAcademies(){
        axios.get(this.route('getApiFeaturedAcademies')).then(res => {
            console.log(res.data.data)
                this.featured_academies = res.data.data
            });
    },
    submit() {
    },
  },
});
</script>
