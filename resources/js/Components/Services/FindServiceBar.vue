<template>
  <div v-if="home">
    <div class="row">
      <div class="col-md-4">
        <select
          v-model="form.type"
          class="form-select border-0 py-3"
          aria-label="Select Distance"
        >
          <option value="" selected>{{ __("select") }} {{ __("type") }}</option>
          <option value="audio">{{ __("audio") }}</option>
          <option value="video">{{ __("video") }}</option>
        </select>
      </div>
      <div class="col-md-4">
        <input
          v-model="form.search"
          type="text"
          class="form-control border-0 py-3"
          id="findPosdcastHome"
          :placeholder="__('search')"
        />
      </div>
      <div class="col-md-4">
        <div class="d-flex">
          <select class="form-select border-0 py-3" aria-label="Select Distance">
            <option value="" selected>{{ __("select") }} {{ __("tag") }}</option>
            <option v-for="tag in tags" :key="tag.id" :value="tag.slug">
              {{ tag.name }}
            </option>
          </select>

          <button
            :href="route('services.listing')"
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
  <div v-else class="section pt-4 pb-5">
    <!-- <div class="container">
      <div class="row pt-2">
        <div class="col-12">
            <h2>{{ __('find') }} {{ __n('service') }}</h2>
          </div>
    <div class="col-12">
        <div class="row">
            <div class="col-md-4">
                <select v-model="form.type" class="form-select">
                    <option value="" selected>{{ __('select') }} {{ __('type') }}</option>
                    <option value="audio">{{__('audio')}}</option>
                    <option value="video">{{ __('video') }}</option>
                </select>
            </div>
            <div class="col-md-4">
                <input type="text" v-model="form.search" class="form-control" id="findPosdcastListing2" :placeholder="__('search')">
            </div>
            <div class="col-md-4">
                <div class="d-flex">
                <select class="form-select" aria-label="Select Tag">
                    <option value="" selected>{{ __('select') }} {{ __('tag') }}</option>
                    <option v-for="tag in tags" :key="tag.id" :value="tag.slug"> {{ tag.name }}</option>
                </select>

                <button :href="route('services.listing')" @click="submit"
                    class="btn btn-primary text-white border-0 ms-3" type="submit">
                    <i class="bi bi-search"></i>
                </button>
                </div>
            </div>
            </div>
        </div>
      </div>
    </div> -->

    <div class="container">
      <div class="row pt-2">
        <div class="col-12">
          <h2>{{ __("find") }} {{ __n("service") }}</h2>
        </div>
        <div class="col-12">
          <div class="row flex-column">
            <div class="col-md-4 w-100 mb-4">
              <select
                v-model="form.service_category"
                class="form-select"
                aria-label="Select Tag"
              >
                <option value="" selected>
                  {{ __("select") }} {{ __('service') }} {{ __('category') }}
                </option>
                <option
                  v-for="service_category in service_categories"
                  :key="service_category.id"
                  :value="service_category.slug"
                >
                  {{ service_category.name }}
                </option>
              </select>
            </div>
            <div class="col-md-4 w-100 mb-4">
              <input
                type="text"
                v-model="form.search"
                class="form-control"
                id="findPosdcastListing2"
                :placeholder="__('search')"
              />
            </div>
            <div class="col-md-4 w-100 mb-4">
              <select v-model="form.tag" class="form-select" aria-label="Select Tag">
                <option value="" selected>{{ __("select") }} {{ __("tag") }}</option>
                <option v-for="tag in tags" :key="tag.id" :value="tag.slug">
                  {{ tag.name }}
                </option>
              </select>
            </div>

            <div class="d-grid">
              <button
                :href="route('services.listing')"
                @click="submit"
                class="btn btn-primary"
                :disabled="isLoading"
                type="submit"
              >
                <SpinnerLoader v-if="isLoading" />
                {{ __("search") }}
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { defineComponent } from "vue";
import ValidationErrors from "@/Components/ValidationErrors.vue";
import SpinnerLoader from "@/Components/Shared/SpinnerLoader.vue";
import { Link } from "@inertiajs/inertia-vue3";
import axios from "axios";
import { router } from "@inertiajs/inertia-vue3";
export default defineComponent({
  components: {
    ValidationErrors,
    SpinnerLoader,
    Link,
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
  },
  created() {
    this.getTags();
    this.getServiceCategories();
    this.$emit("getServices", this.form);
  },
  data() {
    return {
      form: {
        service_category: route().params.service_category ?? "",
        search: route().params.search ?? "",
        tag: route().params.tag ?? "",
        type: route().params.type ?? "",
      },
      isLoading: false,
      tags: [],
      service_categories: [],
    };
  },

  methods: {
    getTags() {
      axios.get(this.route("getApiTags")).then((res) => {
        this.tags = res.data.data;
      });
    },
    getServiceCategories() {
      axios.get(this.route("getApiServiceCategories")).then((res) => {
        this.service_categories = res.data.data;
      });
    },
    submit() {
      this.isLoading = true;
      const fetchDataPromise = new Promise((resolve, reject) => {
        setTimeout(() => {
          this.$inertia.replace(this.route("services.listing"), {
            data: this.form,
            replace: true,
            preserveScroll: true,
          });
          this.$emit("getServices", this.form);
          resolve();
        }, 1000);
      });
      fetchDataPromise
        .then((data) => {})
        .catch((error) => {})
        .finally(() => {
          this.isLoading = false;
        });
    },
  },
});
</script>
