<template>
  <app-layout title="Academies">
    <div class="py-5">
      <div class="container">
        <div class="row">
            <div class="col-md-12">
            <h2 class="text-center display-2 text-primary fw-bold mb-2">
                {{ __('find') }} {{ __('academies') }}
              </h2>
            <div v-if="getPageContentType('academies_page_description') == 'textarea'">
              <div class="fs-4 text-center text-secondary"  v-html="getPageContent('academies_page_description')"></div>
            </div>
            <div v-else-if="
                getPageContentType('academies_page_description') == 'text'"
              >
              <p>{{ getPageContent("academies_page_description") ?? "-" }}</p>
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
      </div>
    </div>
    <div class="container">
        <div class="row">
          <div class="col-md-12" style="background-color: #f0f0f0;">
            <div class="row align-items-center py-4 py-md-2">
              <div class="col-md-3">
              <div class="d-flex ps-3">
                  <button style="margin-top: 3px;" class="btn p-0 me-1 bg-transparent border-0 shadow-none" @click="GridView()">
                    <i :class="grid_view ? 'text-primary' : 'text-dark'" class="bi bi-grid-3x3-gap-fill" style="font-size: 36px;"></i>
                    <!-- {{ getPageContent("general_grid_btn_text") ?? "Grid View" }} -->
                </button>
                <button style="margin-top: 4px;"  class="btn p-0 bg-transparent border-0 shadow-none ms-1" @click="listView()">
                  <i :class="list_view ? 'text-primary' : 'text-dark'" class="bi bi-grid-fill" style="font-size: 36px;"></i>
                  <!-- {{ getPageContent("general_list_btn_text") ?? "List View" }} -->
                </button>
                <button style="margin-top: 6px;" class="btn p-0 bg-transparent border-0 shadow-none ms-2" @click="SingleView()">
                  <i :class="single_view ? 'text-primary' : 'text-dark'" class="bi bi-list-ul" style="font-size: 40px;"></i>
                </button>
              </div>
            </div>
            <div class="col-md-9">
            <find-academy-bar @getAcademies="onSearch"  :is_academy_page="true" :is_redirect="false"></find-academy-bar>
            </div>
            </div>
          </div>
        </div>
      </div>


    <div class="py-5">
      <div class="container">
        <div class="row">
          <div class="col-12" v-if="fetching">
            <div class="row">
              <div class="col-6">
                <spotlight-card-skeleton></spotlight-card-skeleton>
              </div>
              <div class="col-6">
                <spotlight-card-skeleton></spotlight-card-skeleton>
              </div>
              <div class="col-6">
                <spotlight-card-skeleton></spotlight-card-skeleton>
              </div>
              <div class="col-6">
                <spotlight-card-skeleton></spotlight-card-skeleton>
              </div>
            </div>
          </div>
          <div class="col-12" v-if="!fetching">
            <div v-if="academies.data.length > 0" class="row">
              <div :class="list_view ? 'col-md-6' : grid_view ? 'col-md-4' : 'col-md-12'" class="mb-4" v-for="(academy, index) in academies.data" :key="index">
                  <div v-if="list_view">
                      <academy-listing-card
                          view_type="double"
                          :add_col="true"
                          :list_card="true"
                          :key="academy.id"
                          :academy="academy"
                      ></academy-listing-card>
                  </div>

                  <div class="h-100" v-if="grid_view">
                      <academy-grid-card
                          :add_col="false"
                          :key="academy.id"
                          :academy="academy"
                      ></academy-grid-card>
                  </div>

                  <div v-if="single_view">
                      <academy-listing-card
                          view_type="single"
                          :add_col="true"
                          :list_card="true"
                          :key="academy.id"
                          :academy="academy"
                      ></academy-listing-card>
                  </div>
              </div>
            </div>

            <div v-else class="row">
              <div class="col-12 mb-3">
                <record-not-found></record-not-found>
              </div>
            </div>
          </div>
          <div class="col-12" v-if="!fetching">
            <div class="d-flex align-items-center justify-content-center mt-5">
              <button v-if="academies.meta.last_page != this.filter.page" @click="loadMore()"
                class="btn btn-primary position-relative mb-5" :disabled="loading_more">
                <span :class="{
                  loader: loading_more,
                }" class="position-absolute"></span>
                {{
                  getPageContent("general_load_btn_text") ?? __("load more")
                }}
              </button>
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
import FindAcademyBar from "@/Components/Academies/FindAcademyBar.vue";
import SpotlightAcademySection from "@/Components/Academies/SpotlightAcademySection.vue";
import FeaturedAcademySection from "@/Components/Academies/FeaturedAcademySection.vue";
import AcademyCard from "@/Components/Academies/AcademyCard.vue";
import AcademyListingCard from "@/Components/Academies/AcademyListingCard.vue";
import RecordNotFound from "../../Components/Shared/RecordNotFound.vue";
import SpotlightCardSkeleton from "@/Components/Skeleton/SpotLightCardSkeleton.vue";
import AcademyGridCard from "@/Components/Academies/AcademyGridCard.vue";
import Breadcrums from "../../Components/Shared/Breadcrums.vue";

export default defineComponent({
  mixins: [PaginationMixin],
  components: {
    AppLayout,
    Navbar,
    PageHeader,
    FindAcademyBar,
    SpotlightAcademySection,
    FeaturedAcademySection,
    AcademyListingCard,
    AcademyCard,
    RecordNotFound,
    SpotlightCardSkeleton,
    AcademyGridCard,
    Breadcrums
  },
  created() {
    this.getPaginatedData();
  },
  data() {
    return {
      academies: {},
      grid_view: false,
      list_view: true,
      single_view : false,
      breadcrums:[
                {
                    id:1,
                    name:'Home',
                    link:'/'
                },
                {
                    id:2,
                    name:'Academies',
                    link:''
                }
            ]
    };
  },
  methods: {
    async getPaginatedData(loading_more = false) {
      await this.getAcademies(loading_more);
    },
    getAcademies(loading_more) {
      // if(Object.keys(route().params).length > 0){
      //     this.$inertia.replace(route('academies.listing'))
      // }
      axios.post(this.route("getApiAcademies"), this.filter).then(res => {
        const data = res.data.data;
        if (loading_more) {
          this.academies.data = this.academies.data.concat(data.data);
        } else {
          this.academies.data = data.data;
        }
        this.academies.links = data.links;
        this.academies.meta = data.meta;
        this.fetching = false;
      });
    },
    listView() {
      this.list_view = true;
      this.grid_view = false;
      this.single_view = false;
    },

    GridView() {
      this.list_view = false;
      this.grid_view = true;
      this.single_view = false;
    },
    SingleView() {
      this.list_view = false;
      this.grid_view = false;
      this.single_view = true;
    }
  }
});
</script>
