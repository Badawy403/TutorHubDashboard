<template>
  <app-layout title="My Profile">
    <template #header></template>

    <div class="row mx-0  py-5">
        <div class="col-md-12">
            <h2 class="text-center display-2 text-primary fw-bold mb-2">
                {{ __('navigate events') }}
              </h2>
            <div v-if="getPageContentType('events_page_description') == 'textarea'">
              <div class="fs-4 text-center text-secondary"  v-html="getPageContent('events_page_description')"></div>
            </div>
            <div v-else-if="
                getPageContentType('events_page_description') == 'text'"
              >
              <p>{{ getPageContent("events_page_description") ?? "-" }}</p>
            </div>
            <div v-else>

              <p class="fs-4 text-center text-secondary">Our team of highly skilled attorneys comprises seasoned
                professionals
                with extensive experience in their respective fields. We pride ourselves<br> on recruiting top legal
                talent,
                ensuring that you receive the highest standard of representation. From complex litigation to intricate.
              </p>
            </div>
            </div>
            </div>
      <!-- <div class="col-12 text-center"
            v-if="getPageContentType('events_page_description') == 'textarea'"
            >
              <div v-html="getPageContent('events_page_description')"></div>
            </div>
            <div class="col-12 text-center"
              v-else-if="
                getPageContentType('events_page_description') == 'text'
              "
            >
              <p>{{ getPageContent("events_page_description") ?? "-" }}</p>
            </div>


      <div v-else class="col-12 text-center">
        <p class="fs-2 mb-0">
          Search Events |
          <span class="fw-bold">{{ __('upcoming') }} {{ __n('event') }}</span>
        </p> -->
        <!-- <p>Discover The Best Teachers Near You</p> -->

      <!-- <breadcrums :breadcrums="breadcrums"></breadcrums> -->


    <div class="section p-0">
        <div class="container">
        <div class="row">
            <div class="col-md-12" style="background-color: #f0f0f0;">
            <div class="row align-items-center py-4 py-md-2">
              <div class="col-md-3">
              <div class="d-flex ps-3">
                  <button  class="btn p-0 me-2 bg-transparent border-0 shadow-none" @click="GridView()">
                    <i :class="grid_view ? 'text-primary' : 'text-dark'" class="bi bi-list-ul"  style="font-size: 40px;"></i>
                    <!-- {{ getPageContent("general_grid_btn_text") ?? "Grid View" }} -->
                </button>
                <button  class="btn p-0 bg-transparent border-0 shadow-none ms-1" @click="listView()">
                  <i :class="list_view ? 'text-primary' : 'text-dark'" class="bi bi-grid-fill" style="font-size: 36px;"></i>
                  <!-- {{ getPageContent("general_list_btn_text") ?? "List View" }} -->
                </button>
              </div>
            </div>
            <div class="col-md-9">
                <find-event-bar @getEvents="onSearch" :is_redirect="false"></find-event-bar>
            </div>
            </div>
          </div>
          </div>
        </div>
      </div>




          <div class="container">
            <div class="row">
            <div class="col-md-12">
            <div class="row mb-5 h-100" :class="list_view ? 'ListView' : 'GridView'">
              <!-- <div class="col-12 mb-5">
                            <h2 class="text-center">{{ __('upcoming') }} {{ __n('event') }}</h2>
              </div>-->

              <div class="col-12 mt-5" v-if="fetching">
                <div class="row h-100">
                    <div class="col-6">
                     <event-skeleton></event-skeleton>
                    </div>
                    <div class="col-6">
                        <event-skeleton></event-skeleton>
                    </div>
                    <div class="col-6">
                        <event-skeleton></event-skeleton>
                    </div>
                    <div class="col-6">
                        <event-skeleton></event-skeleton>
                    </div>
                </div>
              </div>
              <div class="col-12 px-0" :class="list_view ? 'p-0' : ''" v-if="!fetching">
                <div v-if="events.data.length > 0" class="row">
                  <div :class="list_view ? 'col-md-6' : 'col-md-6 mt-4'" v-for="(event,index) in events.data" :key="index">
                    <event-card v-if="grid_view" :add_col="false" :key="event.id" :event="event"></event-card>
                    <event-listing-card v-if="list_view" :add_col="false" :key="event.id" :event="event"></event-listing-card>
                </div>
                </div>

                <div v-else class="row h-100">
                    <div class="col-12 text-center mb-3">
                        <record-not-found></record-not-found>
                    </div>
                </div>
                <div class="row mt-5" v-if="events.meta.last_page != this.filter.page">
                  <div class="col-md-12 d-flex align-items-center justify-content-center">
                    <button
                      @click="loadMore()"
                      class="btn btn-primary  position-relative mt-3 mb-5"
                      :disabled="loading_more"
                    >
                      <span
                        :class="{
                                        'loader': loading_more
                                    }"
                        class="position-absolute"
                      ></span>
                      {{__('load more')}}
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          </div>
          </div>



  </app-layout>
</template>
<script>
import { defineComponent } from "vue";
import PaginationMixin from "@/Mixins/PaginationMixin.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import PageHeader from "@/Components/PageHeader.vue";
import Navbar from "@/Layouts/AppIncludes/Navbar.vue";
import FindEventBar from "@/Components/Events/FindEventBar.vue";
import EventCard from "@/Components/Events/EventCard.vue";
import EventListingCard from "@/Components/Events/EventListingCard.vue";
import RecordNotFound from "../../Components/Shared/RecordNotFound.vue";
import EventSkeleton from "../../Components/Skeleton/EventSkeleton.vue";
import Breadcrums from "../../Components/Shared/Breadcrums.vue";

export default defineComponent({
  mixins: [PaginationMixin],
  components: {
    AppLayout,
    Navbar,
    PageHeader,
    EventSkeleton,
    EventCard,
    FindEventBar,
    EventListingCard,
    RecordNotFound,

    Breadcrums
  },
  created() {},
  data() {
    return {
      events: {},
      teacher: route().params.teacher ?? "",
      academy: route().params.academy ?? "",
      grid_view: false,
      list_view: true,
      breadcrums:[
                {
                    id:1,
                    name:'Home',
                    link:'/'
                },
                {
                    id:2,
                    name:'Events',
                    link:''
                }
            ]
    };
  },
  methods: {
    async getPaginatedData(loading_more = false) {
      await this.getEvents(loading_more);
    },
    getEvents(loading_more) {
      // if(Object.keys(route().params).length > 0){
      //     this.$inertia.replace(route('events.listing'))
      // }
      this.filter.academy = this.academy;
      axios.post(this.route("getApiEvents"), this.filter).then(res => {
        const data = res.data.data;
        if (loading_more) {
          this.events.data = this.events.data.concat(data.data);
        } else {
          this.events.data = data.data;
        }
        this.events.links = data.links;
        this.events.meta = data.meta;
        this.fetching = false;
      });
    },
    listView() {
      this.list_view = true;
      this.grid_view = false;
    },

    GridView() {
      this.list_view = false;
      this.grid_view = true;
    }
  }
});
</script>
