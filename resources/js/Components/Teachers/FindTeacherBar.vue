<template>
  <div class="mx-2 mx-md-0" v-if="home">
    <div class="row pt-2 pt-md-0">
      <div class="col-12 mt-md-3">
        <div class="row align-items-center bg-white py-2 rounded-4">
            <div class="col-md-4">
              <div class="d-flex align-items-center gap-2 ms-md-2 border-endi mb-3 mb-md-0">
                <img src="@/images/icons/nearest.svg" alt="" width="25">
                <Link class="text-decoration-none" :href="route('teachers.listing')"><span class="fs-4 fw-bold">{{ __('nearest tutors') }}</span></Link>
            </div>

            </div>

               <div class="col-md-8 px-md-0">
                <div class="row align-items-center">
                    <div class="col-md-8">
                    <div class="d-flex align-items-center gap-3 mb-3 mb-md-0 search-tutor">
                    <img src="@/images/icons/search.svg" alt="" width="22">

                    <input v-model.trim="form.search" type="search" :placeholder="__('Search Tutors')" class="bg-transparent border-0 shadow-none" data-bs-toggle="dropdown" aria-expanded="false">

                   </div>
                    </div>
                    <div class="col-md-4">
                        <span class="d-flex align-items-center">
                        <Link
                        :href="computedHref"
                        :disabled="isLoading"
                        class="btn btn-primary rounded-3 home-btn"
                        type="submit"
                        >
                        <SpinnerLoader v-if="isLoading" />
                        {{
                            getPageContent("general_search_btn_text") ?? __("search")
                        }}
                        </Link>
                        </span>
                    </div>
                </div>


                </div>

            </div>
        </div>

      </div>
    </div>




            <div v-else class="row align-items-center">

            <div class="col-md-4 pe-md-0">
            <Multiselect
                        class="border-0 h-100 fs-6 rounded-3 mb-2 mb-md-0 multi-cate"
                        v-model="form.teacher_category"
                        valueProp="id"
                        label="name"
                        groupLabel="name"
                        :placeholder="__('select category')"
                        groupOptions="categories"
                        :groupSelect="true"
                        :groups="true"
                        mode="tags"
                        :close-on-select="false"
                        :searchable="true"
                        :options="this.teacher_main_categories"
             />
            </div>

              <div class="col-md-3 border-multi">
                <Multiselect
                v-model="form.search_type"
                @change="searchTypeChanged"
                :close-on-select="true"
                :searchable="true"
                :options="[
                  {
                    value: 'country',
                    name: `${__('search by country')}`,
                  },
                  {
                    value: 'distance',
                    name: `${__('distance')}`,
                  },
                  {
                    value: 'location',
                    name: `${__('location')}`,
                  },
                  {
                    value: 'zip_code',
                    name: `${__('zip_code')}`,
                  },
                ]"
                valueProp="value"
                label="name"
                :placeholder="__('Search by')"
                class="form-control fs-6 p-0 rounded-3  mb-2 mb-md-0"
                style="height: 16px ;"
              />
              </div>

              <div class="col-md-3 px-md-0">
                <div class="d-flex align-items-center bg-white px-3 rounded-3 mb-2 mb-md-0" >
                <i class="bi bi-search me-2"></i>
                <input type="search" v-model="form.search" class="form-control fs-6 bg-transparent shadow-none"
                :placeholder="__('Search Tutors')"
                />

              </div>
              </div>


            <div class="col-md-2">
              <button
              :href="route('teachers.listing')"
              @click="submit"
              class="btn btn-primary w-100"
              type="submit"
              :disabled="isLoading"
            >
              <SpinnerLoader v-if="isLoading" />
              {{ __("Search") }}
            </button>
            </div>
           </div>




</template>

<script>
import { computed, defineComponent } from "vue";
import ValidationErrors from "@/Components/ValidationErrors.vue";
import { Link } from "@inertiajs/inertia-vue3";
import axios from "axios";
import { router } from "@inertiajs/inertia-vue3";
import Multiselect from "@vueform/multiselect";
import SpinnerLoader from "@/Components/Shared/SpinnerLoader.vue";
import VueGoogleAutocomplete from "vue-google-autocomplete";
export default defineComponent({
  components: {
    ValidationErrors,
    Link,
    SpinnerLoader,
    Multiselect,
    VueGoogleAutocomplete,
  },
  props: {
    is_redirect: {
      type: Boolean,
      default: true,
    },
    home: {
      type: Boolean,
      default: false,
    },
    is_teacher_page: {
      type: Boolean,
      default: false,
    },
  },
  created() {
      this.getTeacherMainCategories();
    if (this.is_teacher_page) {
      this.getCountries();
    }

    if (this.$page.props.main_category_slug) {
      this.teacher_category_selected = this.$page.props.main_category_slug;
    }
    if (this.$page.props.teacher_category) {
      this.form.teacher_category.push(this.$page.props.teacher_category);
    }
    // this.form.teacher_category = [6,7];
    this.$emit("getTeachers", this.form);
    this.formDistanceOptions();
  },
  data() {

    return {

    search:'',
      form: {
        teacher_category: this.$page.props.category
          ? this.$page.props.category
            ? [this.$page.props.category]
            : []
          : [],
        search: this.$page.props ? this.$page.props.search : "",
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
        main_category: this.$page.props.main_category
          ? this.$page.props.main_category.slug
          : "all",
      },
      isLoading: false,
      isClearLoading: false,
      countries: [],
      categoryIds:[],
      teacher_categories: [],
      teacher_main_categories: [],
      distanceOptions: [],
      teacher_category_selected: this.$page.props.teacher_category ?? "",
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
    this.$emit("getteachers", this.form);
    this.formDistanceOptions();
  },
  computed: {
    computedHref() {
      if (this.form.search) {
        return this.route('teachers.listing') + '?search=' + encodeURIComponent(this.form.search);
      }
      return this.route('teachers.listing');
    },
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

        if(this.$page.props.teacher_category_slug){
        const categoryIds = this.teacher_main_categories
            .filter(category => category.slug === this.$page.props.teacher_category_slug)
            .flatMap(category => category.categories)
            .map(category => category.id);
        this.form.teacher_category = categoryIds;
        this.submit();
        }


      });

    },
    getCountries() {
      axios.get(this.route("getApiCountries")).then((res) => {
        this.countries = res.data.data;
      });
    },
    submit() {
      this.isLoading = true;
      const fetchDataPromise = new Promise((resolve, reject) => {
        setTimeout(() => {
          var payload = {
            data: this.form,
            replace: true,
            preserveScroll: true,
          };
          const data = this.$inertia.post(
            this.route("teachers.listing"),
            payload
          );
          this.$emit("getTeachers", this.form);
          resolve(data);
        }, 1000);
      });
      fetchDataPromise
        .then((data) => {})
        .catch((error) => {})
        .finally(() => {
          this.isLoading = false;
        });
    },
    checkIsAllSelected(slug) {
      if (slug == "all") {
        if (event && event.target && event.target.checked == false) {
          this.form.teacher_category = [];
        } else {
          this.form.teacher_category = [];
          for (let i = 0; i < this.teacher_main_categories.length; i++) {
            for (
              let j = 0;
              j < this.teacher_main_categories[i].categories.length;
              j++
            ) {
              this.form.teacher_category.push(
                this.teacher_main_categories[i].categories[j].slug
              );
            }
          }
        }
      } else {
        var index = this.form.teacher_category.findIndex(
          (obj) => obj === "all"
        );
        if (index >= 0) {
          var removed = this.form.teacher_category.splice(index, 1);
          this.$page.props.selected_category = this.form.teacher_category;
        }
      }
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
    teacherCategoryChange(val) {
      this.checkIsAllSelected(val);
      // console.log(val.target.value);
      // if(val.target.value == 'all'){
      //   for (let i = 0; i < this.cars.teacher_categories.lenght; i++) {
      //     text += cars[i] + "<br>";
      //   }
      // }

      var selected_cat = this.teacher_main_categories.find((cat) => {
        return cat.categories.find((sub_cat) => sub_cat.slug == val);
      });
      if (selected_cat) {
        this.form.main_category = selected_cat.slug;
      } else {
        this.form.main_category = "all";
      }
    },
    searchTypeChanged() {
      this.form.distance = "";
      this.form.location = "";
      this.form.country = "";
      this.form.zip_code = "";
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
    clearFilters() {
      this.isClearLoading = true;
      const fetchDataPromise = new Promise((resolve, reject) => {
        setTimeout(() => {
          this.form.latitude = "";
          this.form.longitude = "";
          this.form.location = "";
          this.form.distance = "";
          this.form.location = "";
          this.form.country = "";
          this.form.zip_code = "";
          this.form.teacher_category = "";
          this.form.search = "";
          this.form.search_type = "";

          this.$inertia.replace(this.route("teachers.listing"));
          this.$emit("getTeachers", this.form);
          resolve();
        }, 1000);
      });
      fetchDataPromise
        .then((data) => {})
        .catch((error) => {})
        .finally(() => {
          this.isClearLoading = false;
        });
    },

  },
});
</script>
<style src="@vueform/multiselect/themes/default.css"></style>
