<template>
  <app-layout title="Categories">
    <!-- <div class="container-fluid">
      <div class="row pt-5">
          <div class="col-12 px-0">
              <div
                  class="card rounded-0 border-0 p-4"
                  style="background-color: #262e39"
              >
                  <div class="row justify-content-center">
                      <div
                          class="col-md-4"
                          v-if="form.search_type == 'country'"
                      >
                          <Multiselect
                              v-model="form.country"
                              :close-on-select="false"
                              :searchable="true"
                              :options="this.countries"
                              valueProp="id"
                              label="name"
                              :placeholder="__('select country')"
                              class="form-control p-0"
                          />
                      </div>
                      <div class="col-md-1">
                          <button class="btn btn-primary h-100">
                              {{ getPageContent('general_search_btn_text') ?? Search }}
                          </button>
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </div> -->

    <div class="container-fluid pt-5">
      <div class="container">
        <div class="row justify-content-center mb-4">

          <div class="col-md-12">
            <h2 class="text-center display-2 text-primary fw-bold mb-2">
                {{ __('navigate categories') }}
              </h2>
            <div v-if="getPageContentType('categories_page_description') == 'textarea'
              ">
              <div class="fs-4 text-center text-secondary" v-html="getPageContent('categories_page_description')"></div>
            </div>
            <div v-else-if="getPageContentType('categories_page_description') == 'text'
              ">
              <p>{{ getPageContent("categories_page_description") ?? "-" }}</p>
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


    <div class="section p-0">
      <div class="container">
        <div class="row py-2 px-3 px-md-0">
          <div class="col-12 p-0">
            <!-- <div class="card rounded-0 border-0"> -->

            <div v-if="fetching"  class="row">
              <div class="col-md-3 mb-4">
                <categories-skeleton></categories-skeleton>
              </div>
              <div class="col-md-3 mb-4">
                <categories-skeleton></categories-skeleton>
              </div>
              <div class="col-md-3 mb-4">
                <categories-skeleton></categories-skeleton>
              </div>
              <div class="col-md-3 mb-4">
                <categories-skeleton></categories-skeleton>
              </div>
              <div class="col-md-3 mb-4">
                <categories-skeleton></categories-skeleton>
              </div>
              <div class="col-md-3 mb-4">
                <categories-skeleton></categories-skeleton>
              </div>
              <div class="col-md-3 mb-4">
                <categories-skeleton></categories-skeleton>
              </div>
              <div class="col-md-3 mb-4">
                <categories-skeleton></categories-skeleton>
              </div>
            </div>

            <div v-else  class="row py-5">
              <div class="col-md-3 mb-4" v-for="(main_category, ind) in this.teacher_main_categories" :key="ind">
                <Link class="text-decoration-none" :href="`${route('teachers.listing')}?teacher_category_slug=${main_category.slug}`">
                <div class="card">
                  <div class="rounded-5 text-center overflow-hidden" style="width: 100%; height: 250px; background-color: #f4f4f4;">
                    <img :src="main_category.image" class="img-fluid" alt="cardtopimg" />
                    <!-- <img src="@/images/common/cardimg.png"> -->
                  </div>

                  <div class="card-body">
                    <h4 class="card-title">
                      <a href="#" class="text-decoration-none fs-4 text-black fw-bold">
                        {{ main_category.name }}</a>
                      </h4>
                    <div class="card-text d-flex flex-md-row flex-column align-content-center justify-content-between mb-1 details">
                      <span>{{ __("Courses") }}: <span style="color: #171CAA;">{{main_category.archive_count}}+</span></span>
                      <span>{{ __("Students") }}: <span style="color: #171CAA;">{{main_category.student_count}}+</span></span>
                      <span>{{ __("Instructors") }}: <span style="color: #171CAA;">{{main_category.teacher_count}}+</span></span>
                    </div>
                  </div>
                </div>
                </Link>
              </div>



              <!-- <div class="col-md-4"
                v-for="(main_category, ind) in this.teacher_main_categories"
                :key="ind"
                >
                <div class="card" style="width: 18rem;">
                <div class="card-body bg-white rounded-3 gx-4">
                <img   :src="main_category.icon" class="card-img-top" alt="..."/>
                <p class="card-title" >
                    <a
                    href="#"
                      class="text-decoration-none text-black fw-bold"
                    >
                      {{ main_category.name }}</a
                    >
                </p>
                </div>
                </div>



                </div> -->
              <!-- <div
                  class="col-md-4"
                  v-for="(main_category, ind) in this.teacher_main_categories"
                  :key="ind"
                >
                  <div
                    class="p-3 me-md-3 text-white d-flex align-items-center rounded-5 mb-4"
                    style="background-color: #006aff"
                  >
                    <span class="me-3 text-primary"
                      ><img
                        :src="main_category.icon"
                        style="width: 30px; max-height: 30px; filter: invert(1);"
                        alt="" /></span
                    ><a
                    href="#"
                      class="text-decoration-none"
                    >
                      {{ main_category.name }}</a
                    >
                  </div>
                  <ul class="list-unstyled mb-3 me-3">
                    <li
                      class="fw-normal mb-2 category-hover"
                      v-for="(sub_cat, sub_ind) in main_category.categories"
                      :key="sub_ind"
                    >
                      <Link
                        class="text-decoration-none text-black "
                        :href="
                          route('teachers.listing', {
                            teacher_category: sub_cat.slug,
                            main_category_slug: main_category.slug,
                          })
                        "
                      >
                        {{ sub_cat.name }}
                      </Link>
                    </li>
                  </ul>
                </div> -->
            </div>
            <!-- </div> -->
          </div>
        </div>
        <!-- v-if="events.meta.last_page != this.filter.page"      @click="loadMore()"
             :disabled="loading_more" -->
        <!-- <div class="row pb-5" >
          <div class="col-12 text-center">
            <button @click="loadMore()"
            class="btn btn-primary  position-relative"
            :disabled="loading_more"><span :class="{
                'loader': loading_more }" class="position-absolute"></span>
            {{ __('load more') }}</button>
          </div>
        </div> -->
      </div>
    </div>
  </app-layout>
</template>

<style src="@vueform/multiselect/themes/default.css"></style>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import PageHeader from "@/Components/PageHeader.vue";
import ValidationErrors from "@/Components/ValidationErrors.vue";
import { Link } from "@inertiajs/inertia-vue3";
import axios from "axios";
import { router } from "@inertiajs/inertia-vue3";
import Multiselect from "@vueform/multiselect";
import CategoriesSkeleton from "@/Components/Skeleton/CategoriesSkeleton.vue";
import VueGoogleAutocomplete from "vue-google-autocomplete";
import Breadcrums from "../../Components/Shared/Breadcrums.vue";
export default defineComponent({
  components: {
    ValidationErrors,
    Link,
    Multiselect,
    VueGoogleAutocomplete,
    AppLayout,
    Breadcrums,
    CategoriesSkeleton,
  },
  props: {
    is_redirect: {
      type: Boolean,
      default: true,
    },
  },
  created() {
    this.getTeacherMainCategories();
    // this.getCountries();
  },
  data() {
    return {
      form: {
        teacher_category: route().params.teacher_category ?? "",
        search: route().params.search ?? "",
        country: route().params.country ?? "",
        location:
          route().params.search_type == "location" && route().params.location
            ? route().params.location
            : "",
        latitude: route().params.latitude ?? "",
        longitude: route().params.longitude ?? "",
        search_type: route().params.search_type ?? "country",
        distance:
          route().params.search_type == "distance" && route().params.distance
            ? route().params.distance
            : "",
        zip_code:
          route().params.search_type == "zip_code" && route().params.zip_code
            ? route().params.zip_code
            : "",
      },
      countries: [],
      teacher_categories: [],
      teacher_main_categories: [],
      distanceOptions: [],
      fetching: true,
      breadcrums: [
        {
          id: 1,
          name: "Home",
          link: "/",
        },
        {
          id: 2,
          name: "Categories",
          link: "",
        },
      ],
    };
  },
  async mounted() {
    await this.locatorButtonPressed();
    if (route().params.search) {
      this.$refs.address.update(route().params.search ?? "");
      if (!this.form.location) {
        this.$refs.address.focus();
        this.form.latitude = this.location_data.lat ?? "";
        this.form.longitude = this.location_data.lng ?? "";
      }
    }

    this.formDistanceOptions();
  },
  methods: {
    // getTeacherCategories() {
    //   axios.get(this.route("getApiTeacherCategories")).then((res) => {
    //     this.teacher_categories = res.data.data;
    //   });
    // },
    getTeacherMainCategories() {
      axios.get(this.route("getApiTeacherMainCategories")).then((res) => {
        this.teacher_main_categories = res.data.data;
        this.fetching = false;
      });
    },
    getCountries() {
      axios.get(this.route("getApiCountries")).then((res) => {
        this.countries = res.data.data;
      });
    },

    async formDistanceOptions() {
      var options = [
        { value: "", name: this.__("select distance") },
        // { value: "all", name: this.__("select all") },
      ];
      for (let i = 1; i < 1000; i++) {
        var obj = { value: i, name: i + " km" };
        options.push(obj);
      }
      this.distanceOptions = options;
    },

    updateLocation(address) {
      this.form.location = address.newVal;
    },

    async getCurrentLocation() {
      this.form.latitude = this.location_data.lat ?? "";
      this.form.longitude = this.location_data.lng ?? "";
      if (this.form.latitude && this.form.longitude) {
        var user_address = await this.getStreetAddressFrom(
          this.form.latitude,
          this.form.longitude
        );
        this.$refs.address.update(user_address);
      }
    },

    getAddressData: function (addressData, placeResultData, id) {
      this.form.latitude = addressData.latitude;
      this.form.longitude = addressData.longitude;
      this.form.location = addressData.route;
      // this.address = addressData;
    },
  },
});
</script>


<style scoped>
.details span{
  font-size: 12px;
  font-weight: 600;
  color: #575757;
}
</style>
