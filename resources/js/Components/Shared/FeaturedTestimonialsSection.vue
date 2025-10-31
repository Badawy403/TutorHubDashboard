<template>
    <Section class="py-5" v-if="testimonials.length > 0">
      <!-- <template #paragraph>
        <p class="text-center mb-4">Gratitude from Student in our community</p>
      </template> -->
      <div class="col-12" v-if="getPageContentType('testimonials_section_description') == 'textarea'">
                                      <div v-html="getPageContent('testimonials_section_description')"> </div>
                                    </div>
                        <div class="col-12" v-else-if="getPageContentType('testimonials_section_description') == 'text'">
                            <p> {{getPageContent('testimonials_section_description') ?? '-'}} </p>
                    </div>
      <div v-else>
        <span class="fs-3">{{ __('About our services') }}</span>
      <h2 class="display-6">{{ __('Student Says') }}</h2>
      </div>

      <Carousel :settings="settings" :breakpoints="breakpoints">
        <Slide v-for="testimonial in testimonials" :key="testimonial.id">
            <testimonial-card :testimonial="testimonial"></testimonial-card>
        </Slide>
        <template #addons>
          <Pagination />
        </template>
      </Carousel>
    </Section>
</template>
<script>
import { defineComponent } from "vue";
import {  Link } from "@inertiajs/inertia-vue3";
import axios from "axios";
import Section from "@/Components/Section.vue";
import TestimonialCard from "@/Components/Testimonials/TestimonialCard.vue";

import { Carousel, Navigation, Pagination, Slide } from 'vue3-carousel';

export default defineComponent({
  components: {
    Link,
    Section,
    Carousel,
    Navigation,
    Pagination,
    Slide,
    TestimonialCard
  },
  created(){
    this.getTestimonials()
  },
  data() {
    return {
      testimonials:[],
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
        itemsToShow: 1,
        snapAlign: 'start',
      },
    },

    };
  },
  methods: {
    getTestimonials(){
        axios.get(this.route('getApiTestimonials')).then(res => {
                this.testimonials = res.data.data
            });
    },
    submit() {
    },
  },
});
</script>
