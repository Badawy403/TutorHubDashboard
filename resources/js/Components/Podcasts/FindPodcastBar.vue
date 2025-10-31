<template>

<div v-if="home">
    <div class="row">
        <div class="col-md-4">
            <select v-model="form.type" class="form-select border-0 py-3" aria-label="Select Distance">
                <option value="" selected>{{ __('select') }} {{ __('type') }}</option>
                    <option value="audio">{{__('audio')}}</option>
                    <option value="video">{{ __('video') }}</option>
            </select>
        </div>
        <div class="col-md-4">
            <input v-model="form.search" type="text" class="form-control border-0 py-3" id="findPosdcastHome" :placeholder="__('search')">
        </div>
        <div class="col-md-4">
            <div class="d-flex">
            <select class="form-select border-0 py-3" aria-label="Select Distance">
                <option value="" selected>{{ __('select') }} {{ __('tag') }}</option>
                <option v-for="tag in tags" :key="tag.id" :value="tag.slug"> {{ tag.name }}</option>
            </select>

            <button :href="route('podcasts.listing')" @click="submit"
                class="btn btn-primary  ms-3" type="submit">
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
            <h2>{{ __('find') }} {{ __n('podcast') }}</h2>
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

                <button :href="route('podcasts.listing')" @click="submit"
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
        <div class="row align-items-center" style="background-color: #f0f0f0;">
          <div class="col-12 d-flex flex-column flex-md-row align-items-start align-items-md-center p-3">
                <div class="col-md-4">
                <h3 class="text-primary mb-0 fw-medium py-3 py-md-0">{{ __('find') }} {{ __n('podcast') }}</h3>
            </div>
            <div class="col-md-8 d-flex justify-content-end flex-column flex-md-row ">
                <div class="col-md-3 me-0 me-md-3 mb-2 mb-md-0">
                <select v-model="form.type" class="form-select rounded-4">
                    <option value="" selected>{{ __('select') }} {{ __('type') }}</option>
                    <option value="audio">{{__('audio')}}</option>
                    <option value="video">{{ __('video') }}</option>
                </select>
              </div>
              <div class="col-md-3 me-0 me-md-3 mb-2 mb-md-0">
                <input type="text" v-model="form.search" class="form-control rounded-4" id="findPosdcastListing2" :placeholder="__('search')">
              </div>
              <div class="col-md-3 me-0 me-md-3 mb-2 mb-md-0">
                <select v-model="form.tag" class="form-select rounded-4" aria-label="Select Tag">
                    <option value="" selected>{{ __('select') }} {{ __('tag') }}</option>
                    <option v-for="tag in tags" :key="tag.id" :value="tag.slug"> {{ tag.name }}</option>
                </select>
              </div>


              <button :href="route('podcasts.listing')" @click="submit"
                class="btn btn-primary " :disabled="isLoading" type="submit">
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
import SpinnerLoader from "@/Components/Shared/SpinnerLoader.vue";
import { Link } from "@inertiajs/inertia-vue3";
import axios from "axios";
import { router } from '@inertiajs/inertia-vue3'
export default defineComponent({
  components: {
    ValidationErrors,
    SpinnerLoader,
    Link,
  },
  props: {
    is_redirect: {
      type: Boolean,
      default: true
    },
    home:{
        type: Boolean,
        default:false
    }
  },
  created() {
    this.getTags()
    this.$emit('getPodcasts', this.form)
  },
  data() {
    return {
      form: {
        search:route().params.search ?? "",
        tag:route().params.tag ?? "",
        type:route().params.type ?? "",
      },
      isLoading:false,
      tags: [],
    };
  },


  methods: {
    getTags() {
      axios.get(this.route('getApiTags')).then(res => {
        this.tags = res.data.data
      });
    },
    submit() {
      this.isLoading = true;
      const fetchDataPromise = new Promise((resolve, reject) => {
        setTimeout(() => {
          this.$inertia.replace(this.route("podcasts.listing"), { data: this.form, replace: true,preserveScroll:true });
        this.$emit('getPodcasts', this.form)
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
  },
});
</script>
