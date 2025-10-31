<template>
  <div v-if="home">
    <div class="row">
      <div class="col-md-4">
        <select
          v-model="form.blog_category"
          class="form-select border-0 py-3"
          aria-label="Select Category"
        >
          <option value selected>{{ __('select') }} {{ __('category') }}</option>
          <option v-for="cat in blog_categories" :key="cat.id" :value="cat.slug">{{ cat.name }}</option>
        </select>
      </div>
      <div class="col-md-4">
        <input
          type="text"
          class="form-control border-0 py-3"
          v-model="form.search"
          id="findPostSearchHome"
          :placeholder="__('search')"
        />
      </div>
      <div class="col-md-4">
        <div class="d-flex">
          <select v-model="form.tag" class="form-select border-0 py-3" aria-label="Select Tag">
            <option value selected>{{ __('select') }} {{ __('tag') }}</option>
            <option v-for="tag in tags" :key="tag.id" :value="tag.slug">{{ tag.name }}</option>
          </select>

          <button
            :href="route('blogs.listing')"
            @click="submit"
            class="btn btn-primary ms-3"
            type="submit"
          >
            <i class="bi bi-search"></i>
          </button>
        </div>
      </div>
    </div>
  </div>
  <div v-else class="section py-4">
    <!-- <div class="container">
      <div class="row pt-2">
        <div class="col-12">
          <h2>{{ __('find') }} {{ __n('blog') }}</h2>
        </div>
        <div class="col-12">
          <div class="row">
            <div class="col-md-4">
              <select v-model="form.blog_category" class="form-select" aria-label="Select Category">
                <option value selected>{{ __('select') }} {{ __('category') }}</option>
                <option
                  v-for="cat in blog_categories"
                  :key="cat.id"
                  :value="cat.slug"
                >{{ cat.name }}</option>
              </select>
            </div>
            <div class="col-md-4">
              <input
                type="text"
                v-model="form.search"
                class="form-control"
                id="findPostSearchListing"
                :placeholder="__('search')"
              />
            </div>
            <div class="col-md-4">
              <div class="d-flex">
                <select v-model="form.tag" class="form-select" aria-label="Select Tag">
                  <option value selected>{{ __('select') }} {{ __('tag') }}</option>
                  <option v-for="tag in tags" :key="tag.id" :value="tag.slug">{{ tag.name }}</option>
                </select>

                <button
                  :href="route('blogs.listing')"
                  @click="submit"
                  class="btn btn-primary text-white border-0 ms-3"
                  type="submit"
                >
                  <i class="bi bi-search"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> -->


    <div class="container">
        <div class="row align-items-center" style="background-color: #f0f0f0;">
          <div class="col-12 d-flex flex-column flex-md-row align-items-start align-items-md-center p-3">
                <div class="col-md-4">
                <h3 class="text-primary mb-0 fw-medium py-3 py-md-0">{{ __('find') }} {{ __n('blog') }}</h3>
            </div>
            <div class="col-md-8 d-flex justify-content-end flex-column flex-md-row ">
                <div class="col-md-3 me-0 me-md-3 mb-2 mb-md-0">
                <select v-model="form.blog_category" class="form-select rounded-4" aria-label="Select Category">
                <option value selected>{{ __('select') }} {{ __('category') }}</option>
                <option
                  v-for="cat in blog_categories"
                  :key="cat.id"
                  :value="cat.slug"
                >{{ cat.name }}</option>
              </select>
              </div>
              <div class="col-md-3 me-0 me-md-3 mb-2 mb-md-0">
                <input
                type="text"
                v-model="form.search"
                class="form-control rounded-4"
                id="findPostSearchListing"
                :placeholder="__('search')"
              />
              </div>
              <div class="col-md-3 me-0 me-md-3 mb-3 mb-md-0">
                <select v-model="form.tag" class="form-select rounded-4" aria-label="Select Tag">
                <option value selected>{{ __('select') }} {{ __('tag') }}</option>
                <option v-for="tag in tags" :key="tag.id" :value="tag.slug">{{ tag.name }}</option>
              </select>
              </div>


              <button
                :href="route('blogs.listing')"
                @click="submit"
                class="btn btn-primary"
                type="submit"
                :disabled="isLoading"
              >
              <SpinnerLoader v-if="isLoading" />
                    {{ __('Search') }}
            </button>

            </div>

          </div>
          </div>

      </div>
  </div>
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
    }
  },
  created() {
    this.getBlogCategories();
    this.getTags();
    this.$emit("getPosts", this.form);
  },
  data() {
    return {
      form: {
        blog_category: route().params.blog_category ?? "",
        search: route().params.search ?? "",
        tag: route().params.tag ?? ""
      },
      isLoading:false,
      tags: [],
      blog_categories: []
    };
  },

  methods: {
    getBlogCategories() {
      axios.get(this.route("getApiBlogCategories")).then(res => {
        this.blog_categories = res.data.data;
      });
    },
    getTags() {
      axios.get(this.route("getApiTags")).then(res => {
        this.tags = res.data.data;
      });
    },
    submit() {
      this.isLoading = true;
      const fetchDataPromise = new Promise((resolve, reject) => {
        setTimeout(() => {
          this.$inertia.replace(this.route("blogs.listing"), {
            data: this.form,
            replace: true,
            preserveScroll: true
          });
        this.$emit("getPosts", this.form);
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
  }
});
</script>
