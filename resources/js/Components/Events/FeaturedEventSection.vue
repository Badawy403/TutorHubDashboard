<template>
  <Section v-if="featured_events.length > 0" class='bg-white p-6' :heading="getPageContent('community_events_title') ?? __('our community events')"  :heading_type="getPageContentType('community_events_title')" >
    <template #paragraph>
      <div class="col-12" v-if="getPageContentType('community_events_description') == 'textarea'">
                                      <div v-html="getPageContent('community_events_description')"> </div>
                                    </div>
                        <div class="col-12" v-else-if="getPageContentType('community_events_description') == 'text'">
                            <p> {{getPageContent('community_events_description') ?? '-'}} </p>
                    </div>
                    <div v-else>
                      <p class="text-center mb-3">We believe in making a positive impact beyond the courtroom. We are active contributors to our community, volunteering our time and resources to support charitable organizations and pro bono initiatives. We strive to create a lasting legacy of excellence not only in the legal realm but also in the communities we serve.</p>
                    </div>
      </template>

      <!-- <div v-for="event in featured_events" :key="event.id" class="col-4">
        <event-card  :event="event"></event-card>
      </div> -->


    <Carousel class="my-3 event-carousel" v-bind="settings" :breakpoints="breakpoints">
    <Slide v-for="event in featured_events" :key="event.id">
        <event-card :event="event"></event-card>
    </Slide>
    <template #addons>
      <navigation />
    </template>
    </Carousel>





   <!--
    <div class="row pt-5 justify-content-center">
      <div class="col-md-3 d-flex justify-content-center">
        <Link :href="route('events.listing')" class="btn btn-primary rounded-pill">
             <span class="circle" aria-hidden="true">
              <span class="icon arrow"></span>
            </span>
            <span class="button-text">{{ getPageContent('general_view_more_btn_text') ?? __('Explore More') }}</span>
          </Link>
      </div>
    </div> -->

    <div class="row mt-5">
            <div class="col-12 text-center">
             <Link :href="route('events.listing')" class="btn btn-primary rounded-pill">{{ __('Explore More') }}</Link>
            </div>
    </div>
  </Section>
  <div v-else>
  </div>
</template>
<script>
import { defineComponent } from "vue";
import { Link } from "@inertiajs/inertia-vue3";
import EventCard from "@/Components/Events/EventCard.vue";
import axios from "axios";
import { Carousel, Navigation, Pagination, Slide } from 'vue3-carousel';
import Section from "@/Components/Section.vue";

export default defineComponent({
  components: {
    EventCard,
    Link,
    Carousel,
    Slide,
    Pagination,
    Navigation,
    Section
  },
  created() {
    this.getFeaturedEvents()
  },
  data() {
    return {
      form: this.$inertia.form({
      }),
      featured_events: [],
      settings: {
        // itemsToShow: 2,
        snapAlign: 'start',
      },
      breakpoints: {
        // 700px and up
        700: {
          itemsToShow: 1,
          snapAlign: 'start',
        },
        // 1024 and up
        1024: {
          itemsToShow: 2,
          snapAlign: 'start',
        },
      },
    };
  },
  methods: {
    getFeaturedEvents() {
      axios.get(this.route('getApiFeaturedEvents')).then(res => {
        this.featured_events = res.data.data
      });
    },
    submit() {
    },
  },
  props:[
    'findEvents'
  ]
});
</script>
