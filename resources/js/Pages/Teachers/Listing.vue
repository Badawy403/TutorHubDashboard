<template>
  <app-layout title="Teachers">
    <div class="py-5">
      <div class="container">
        <div class="row">
            <div class="col-md-12">
            <h2 class="text-center display-2 text-primary fw-bold mb-2">
                {{ __('find a tutors') }}
              </h2>
              <div v-if="getPageContentType('teachers_page_description') == 'textarea'
              ">
              <div v-html="getPageContent('teachers_page_description')"></div>
            </div>
            <div v-else-if="getPageContentType('teachers_page_description') == 'text'
              ">
              <p>{{ getPageContent("teachers_page_description") ?? "-" }}</p>
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
                    <i :class="grid_view ? 'text-primary' : 'text-dark'" class="bi bi-grid-3x3-gap-fill" style="font-size: 35px;"></i>
                    <!-- {{ getPageContent("general_grid_btn_text") ?? "Grid View" }} -->
                </button>
                <button style="margin-top: 4px;"  class="btn p-0 bg-transparent border-0 shadow-none ms-1" @click="listView()">
                  <i :class="list_view ? 'text-primary' : 'text-dark'" class="bi bi-grid-fill" style="font-size: 35px;"></i>
                  <!-- {{ getPageContent("general_list_btn_text") ?? "List View" }} -->
                </button>
                <button style="margin-top: 6px;" class="btn p-0 bg-transparent border-0 shadow-none ms-2" @click="SingleView()">
                  <i :class="single_view ? 'text-primary' : 'text-dark'" class="bi bi-list-ul" style="font-size: 40px;"></i>
                </button>
              </div>
            </div>
            <div class="col-md-9">
            <find-teacher-bar @getTeachers="onSearch" :is_redirect="false" :is_teacher_page="true"></find-teacher-bar>
            </div>
            </div>

          </div>
        </div>
      </div>
    <div class="py-5">
      <div class="container">
        <div class="row">
          <div class="col-12" v-if="fetching" >
            <div class="row">
              <div class="col-md-6">
                <spotlight-card-skeleton></spotlight-card-skeleton>
              </div>
              <div class="col-md-6">
                <spotlight-card-skeleton></spotlight-card-skeleton>
              </div>
              <div class="col-md-6">
                <spotlight-card-skeleton></spotlight-card-skeleton>
              </div>
              <div class="col-md-6">
                <spotlight-card-skeleton></spotlight-card-skeleton>
              </div>
              <!-- <div class="col-12 p-0">
                <spotlight-card-skeleton></spotlight-card-skeleton>
              </div>
              <div class="col-12 p-0">
                <spotlight-card-skeleton></spotlight-card-skeleton>
              </div>
              <div class="col-12 p-0">
                <spotlight-card-skeleton></spotlight-card-skeleton>
              </div> -->
            </div>
          </div>
          <div class="col-12" v-if="!fetching">
            <div v-if="teachers.data.length > 0" class="row">
              <div :class="list_view ? 'col-md-6' : grid_view ? 'col-md-3': 'col-md-12' " class="mb-4" v-for="(teacher, index) in teachers.data" :key="index">
                <div v-if="list_view">
                  <teacher-listing-card  view_type="double" :key="teacher.id" :teacher="teacher"></teacher-listing-card>
                </div>

                <div v-if="grid_view">
                  <teacher-grid-card :key="teacher.id" :teacher="teacher"></teacher-grid-card>
                </div>

                <div  v-if="single_view" class="mb-4">
                    <teacher-listing-card view_type="single" :key="teacher.id" :teacher="teacher"></teacher-listing-card>
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
              <button v-if="teachers.meta.last_page != this.filter.page" @click="loadMore()"
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
import FindTeacherBar from "@/Components/Teachers/FindTeacherBar.vue";
import SpotlightTeacherSection from "@/Components/Teachers/SpotlightTeacherSection.vue";
import FeaturedTeacherSection from "@/Components/Teachers/FeaturedTeacherSection.vue";
import TeacherGridCard from "@/Components/Teachers/TeacherGridCard.vue";
import TeacherListingCard from "@/Components/Teachers/TeacherListingCard.vue";
import SpotlightCardSkeleton from "@/Components/Skeleton/SpotLightCardSkeleton.vue";
import RecordNotFound from "../../Components/Shared/RecordNotFound.vue";
import Breadcrums from "../../Components/Shared/Breadcrums.vue";

export default defineComponent({
  mixins: [PaginationMixin],
  components: {
    AppLayout,
    Navbar,
    PageHeader,
    FindTeacherBar,
    SpotlightTeacherSection,
    FeaturedTeacherSection,
    TeacherGridCard,
    TeacherListingCard,
    SpotlightCardSkeleton,
    RecordNotFound,
    Breadcrums,
  },
  created() {
    navigator.geolocation.getCurrentPosition(
      (position) => {
        let lat = position.coords.latitude;
        let lng = position.coords.longitude;
        (this.filter.latitude = lat), (this.filter.longitude = lng);
      },
      (error) => { }
    );
    this.filter.perPage = 12
  },
  data() {
    return {
      teachers: {},
      grid_view: false,
      list_view: true,
      single_view: false,
      fetching:true,
      breadcrums: [
        {
          id: 1,
          name: "Home",
          link: "/",
        },
        {
          id: 2,
          name: "Teachers",
          link: "",
        },
      ],
    };
  },
  methods: {
    async getPaginatedData(loading_more = false) {
      await this.getTeachers(loading_more);
    },
    getTeachers(loading_more) {
        // return
      // if(Object.keys(route().params).length > 0){
      //     this.$inertia.replace(route('teachers.listing'))
      // }
      axios.post(this.route("getApiTeachers"), this.filter).then((res) => {
        const data = res.data.data;
        if (loading_more) {
          this.teachers.data = this.teachers.data.concat(data.data);
        } else {
          this.teachers.data = data.data;
        }
        this.teachers.links = data.links;
        this.teachers.meta = data.meta;
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

    SingleView(){
        this.list_view = false;
        this.grid_view = false;
        this.single_view = true;
    }
  },
});
</script>
