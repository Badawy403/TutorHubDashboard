<template>
  <div v-if="home">
    <div class="row">
        <form @submit.prevent="submit" >
        <div class="col-12">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="input-group bg-white px-2 py-2  custom-search-panel">
                    <div class="d-flex align-items-center">
                        <!-- <span id="search_concept">
                          <i class="bi bi-search"></i>
                        </span> -->
                        <input
                        :placeholder="getPageContent('general_search_btn_text') ?? __('search')"
                          type="text"
                          class="border-0 py-2 ms-3 shadow-none search-field"
                          v-model="form.search"
                        id="findAcademyHome"
                        />
                      </div>

                      <span class="d-flex align-items-center">
                        <button
                        :disabled="isLoading"
                        :href="route('academies.listing')"
                        class="btn btn-primary ms-3"
                        type="submit"
                      >
                      <SpinnerLoader v-if="isLoading" />
                      {{ getPageContent('general_search_btn_text') ?? __('search') }}
                      </button>

                      </span>
                    </div>
                    </div>
        </div>
        </form>
      <!-- <div class="col-md-4">
        <select
          v-model="form.academy_category"
          class="form-select border-0 py-3"
          aria-label="Select Category"
        >
          <option value selected>{{ __('select') }} {{ __('category') }}</option>
          <option v-for="cat in academy_categories" :key="cat.id" :value="cat.slug">{{ cat.name }}</option>
        </select>
      </div>
      <div class="col-md-4">
        <input
          type="text"
          class="form-control border-0 py-3"
          v-model="form.search"
          id="findAcademyHome"
          :placeholder="__('search')"
        />
      </div> -->
      <!-- <div class="col-md-4">
        <div class="d-flex">
          <select
            v-model="form.country"
            class="form-select border-0 py-3"
            aria-label="Select Distance"
          >
            <option value selected>{{ __('select') }} {{ __('country') }}</option>
            <option
              v-for="country in countries"
              :key="country.id"
              :value="country.id"
            >{{ country.name }}</option>
          </select>

          <button
            :href="route('academies.listing')"
            @click="submit"
            class="btn btn-primary text-white border-0 ms-3 px-4"
            type="submit"
          >
            <i class="bi bi-search"></i>
          </button>
        </div>
      </div> -->
    </div>
  </div>


  <div v-else class="row align-items-center">


            <!-- <select
              class="form-select fs-6 fw-bold text-primary"
              style="width: 180px"
              aria-label="Default select example"
            >
              <option class="text-black" selected>Select Category</option>
              <option
                class="text-black"
                v-for="(main_category, ind) in this.teacher_main_categories"
                :key="ind"
              >
                {{ main_category.name }}
              </option>
            </select> -->
           <div class="col-md-4 mb-2 mb-md-0 ps-md-5">
            <select
                v-model="form.academy_category"
                class="form-select rounded-3 fs-5 w-100"
                :aria-label="__('select category')"
              >
                <option value selected>{{ __('select') }} {{ __('category') }}</option>
                <option
                  class="text-black"
                  v-for="cat in academy_categories"
                  :key="cat.id"
                  :value="cat.slug"
                >{{ cat.name }}</option>
            </select>
           </div>

           <div class="col-md-3 mb-2 mb-md-0 ps-md-0">
            <select v-model="form.country" class="form-select w-100 rounded-3 fs-5" :aria-label="__('select country')">
                  <option   value selected>{{ __('select') }} {{ __('country') }}</option>
                  <option class="text-black"
                    v-for="country in countries"
                    :key="country.id"
                    :value="country.id"
                  >{{ country.name }}</option>
                </select>
           </div>

           <div class="col-md-3 mb-2 mb-md-0 px-md-0">
            <div class="d-flex bg-white rounded-3 align-items-center">
                <i class="bi bi-search ps-3"></i>
                <input
                type="text"
                v-model="form.search"
                class="form-control shadow-none bg-transparent border-0 fs-5"
                id="findAcademyListing"
                :placeholder="__('search')"
                />
            </div>
           </div>

           <div class="col-md-2">
            <button
             :href="route('academies.listing')"
             @click="submit"
             class="btn btn-primary w-100"
             type="submit"
             :disabled="isLoading"
            >
            <SpinnerLoader v-if="isLoading" />
            {{ __('Search') }}
            </button>
           </div>
          </div>



    <!-- <div class="container">
      <div class="row pt-2">

        <div class="col-12">
          <div class="row">
            <div class="col-md-4 w-100 mb-4 px-0">
              <select
                v-model="form.academy_category"
                class="form-select"
                aria-label="Select Category"
              >
                <option value selected>{{ __('select') }} {{ __('category') }}</option>
                <option
                  v-for="cat in academy_categories"
                  :key="cat.id"
                  :value="cat.slug"
                >{{ cat.name }}</option>
              </select>
            </div>
            <div class="col-md-4 w-100 mb-4 px-0">
              <input
                type="text"
                v-model="form.search"
                class="form-control"
                id="findAcademyListing"
                :placeholder="__('search')"
              />
            </div>
            <div class="col-md-4 w-100 mb-4 px-0">
              <div class="d-flex">
                <select v-model="form.country" class="form-select" aria-label="Select Country">
                  <option value selected>{{ __('select') }} {{ __('country') }}</option>
                  <option
                    v-for="country in countries"
                    :key="country.id"
                    :value="country.id"
                  >{{ country.name }}</option>
                </select>
              </div>
            </div>

            <div class="col-12 px-0">
              <div class="d-grid">
                <button
                  :href="route('academies.listing')"
                  @click="submit"
                  class="btn btn-primary"
                  type="submit"
                  :disabled="isLoading"
                >
                <SpinnerLoader v-if="isLoading" />
                {{ __('Search') }}
                </button>
                 <button
                :disabled="isClearLoading"
                    @click="clearFilters"
                    class="btn btn-secondary mt-3"
                >
                <SpinnerLoader v-if="isClearLoading" />
                {{ __('Clear') }}
                </button> -->
              <!-- </div>
            </div>
          </div>
        </div>
      </div>
    </div>  -->

</template>

<script>
import { defineComponent } from "vue";
import ValidationErrors from "@/Components/ValidationErrors.vue";
import { Link } from "@inertiajs/inertia-vue3";
import SpinnerLoader from "@/Components/Shared/SpinnerLoader.vue";
import axios from "axios";
import { router } from "@inertiajs/inertia-vue3";
export default defineComponent({
  components: {
    ValidationErrors,
    SpinnerLoader,
    Link
  },
  props: {
    is_redirect: {
      type: Boolean,
      default: true
    },
    home: {
      type: Boolean,
      default: false
    },
    is_academy_page: {
            type: Boolean,
            default: false,
        },
  },
  created() {

    if (this.is_academy_page) {
        this.getAcademyCategories();
        this.getCountries();
        }
    this.$emit("getAcademies", this.form);
  },
  data() {
    return {
      isLoading:false,
            isClearLoading:false,
      form: {
        academy_category: route().params.academy_category ?? "",
        search: route().params.search ?? "",
        country: route().params.country ?? ""
      },
      countries: [],
      academy_categories: []
    };
  },

  methods: {
    getAcademyCategories() {
      axios.get(this.route("getApiAcademyCategories")).then(res => {
        this.academy_categories = res.data.data;
      });
    },
    getCountries() {
      axios.get(this.route("getApiCountries")).then(res => {
        this.countries = res.data.data;
      });
    },
    submit() {
      this.$inertia.replace(this.route("academies.listing"), {
        data: this.form,
        replace: true,
        preserveScroll: true
      });
      this.$emit("getAcademies", this.form);

      //   if (this.is_redirect) {
      //     this.$inertia.replace(this.route("academies.listing"), { data: this.form, replace: true });
      //   } else {
      //     this.$emit('getAcademies', this.form)
      //   }
    },
    submit() {
            this.isLoading = true;
            const fetchDataPromise = new Promise((resolve, reject) => {
                setTimeout(() => {
                  this.$inertia.replace(this.route("academies.listing"), {
                    data: this.form,
                    replace: true,
                    preserveScroll: true
                  });
              this.$emit("getAcademies", this.form);
                resolve();
                }, 1000);
            });
            fetchDataPromise
                .then((data) => {
                })
                .catch((error) => {
                })
                .finally(() => {
                this.isLoading = false;
                });
        },
        clearFilters() {
            this.isClearLoading = true;
            const fetchDataPromise = new Promise((resolve, reject) => {
                setTimeout(() => {
                  this.form.academy_category = "";
            this.form.search = "";
            this.form.country = "";
            this.$inertia.replace(this.route("academies.listing"));
            this.$emit("getAcademies", this.form);
                resolve();
                }, 1000);
            });
            fetchDataPromise
                .then((data) => {
                })
                .catch((error) => {
                })
                .finally(() => {
                this.isClearLoading = false;
                });
        },
  }
});
</script>
