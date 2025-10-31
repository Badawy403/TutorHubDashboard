<template>
  <app-layout title="My Profile">
    <!-- <template #header>
            <page-header>
                {{__('teacher')}} {{ __n('review') }}
            </page-header>
        </template> -->
    <div class="row mx-0 pt-5 mt-4">
      <div class="col-12 text-center">
        <h2 class="text-center text-primary fw-bold">{{ teacher.name }} {{ __n("review") }}</h2>
        <!-- <p>Discover The Best Teachers Near You</p> -->
        <!-- <nav aria-label="breadcrumb">
          <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#" class="text-dark text-decoration-none">Home</a></li>
            <li class="breadcrumb-item text-dark" aria-current="page">reviews</li>
          </ol>
        </nav> -->
      </div>
    </div>

    <div class="section pb-5">
      <div class="container">
        <div class="row">
          <div class="col-12 mb-5"></div>
          <div class="col-12" v-if="fetching">
            <div class="row">
              {{ __("fetching") }}
            </div>
          </div>
          <div class="col-12" v-if="!fetching">
            <div v-if="reviews.data.length > 0" class="row mb-5 mx-0">
              <teacher-review-card
                :add_col="true"
                v-for="review in reviews.data"
                :key="review.id"
                :review="review"
              ></teacher-review-card>
            </div>
            <div v-else class="row mb-5 mx-0">
              <div class="col-12 text-center mb-3">
                <record-not-found></record-not-found>
              </div>
            </div>
            <div class="row" v-if="reviews.meta.last_page != this.filter.page">
              <div
                class="col-md-12 d-flex align-items-center justify-content-center"
              >
                <button
                  @click="loadMore()"
                  class="btn btn-primary position-relative"
                  :disabled="loading_more"
                >
                  <span
                    :class="{
                      loader: loading_more,
                    }"
                    class="position-absolute"
                  ></span>
                  {{ __("load more") }}
                </button>
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
import TeacherReviewCard from "@/Components/Teachers/TeacherReviewCard.vue";
import RecordNotFound from "../../Components/Shared/RecordNotFound.vue";

export default defineComponent({
  mixins: [PaginationMixin],
  components: {
    AppLayout,
    Navbar,
    PageHeader,
    TeacherReviewCard,
    RecordNotFound,
  },
  props: ["teacher"],
  created() {},
  mounted() {
    this.onSearch();
  },
  data() {
    return {
      reviews: {},
    };
  },
  methods: {
    async getPaginatedData(loading_more = false) {
      await this.getTeacherReviews(loading_more);
    },
    getTeacherReviews(loading_more) {
      axios
        .post(
          this.route("getApiTeacherReviews", {
            user_name: this.teacher.user_name,
          }),
          this.filter
        )
        .then((res) => {
          const data = res.data.data;
          if (loading_more) {
            this.reviews.data = this.reviews.data.concat(data.data);
          } else {
            this.reviews.data = data.data;
          }
          this.reviews.links = data.links;
          this.reviews.meta = data.meta;
          this.fetching = false;
        });
    },
  },
});
</script>
