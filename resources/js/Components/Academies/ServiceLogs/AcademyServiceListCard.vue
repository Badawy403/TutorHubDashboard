<template>
 <div class="row">
    <div class="col-12 text-center mb-3" v-if="services.data.length == 0">
      <record-not-found></record-not-found>
    </div>
    <div
      class="col-lg-6 mb-3"
      v-for="service in services.data"
      :key="service.id"
    >
      <div class="card spotlight-card shadow-sm px-4 py-3 item-h border-0">
        <div class="row align-items-center">
          <div class="row">
            <div class="col-md-3">
              <div
                class="d-flex justify-content-center card-avatar overflow-hidden position-relative rounded-3"
              >
                <img
                  v-if="service.student_image"
                  class="img-fluid"
                  :src="service.student_image"
                  alt="academy"
                />
                <img
                  v-else
                  class="img-fluid"
                  src="@/images/account/default_avatar_men.png"
                  alt="academy"
                />
              </div>
            </div>
            <div class="col-md-9">
              <div class="card-body p-0">
                <div class="row mb-3">
                  <div
                    class="col-md-12 d-flex align-items-center justify-content-between"
                  >
                    <h2 class="fs-4 mb-0 fw-bold text-capitalize">
                      {{ service.student_name }}
                    </h2>
                    <div class="d-flex align-items-center me-md-3">
                      <Link
                        :href="
                          route('academy.service_log.detail', {
                            id: service.id,
                          })
                        "
                        class="btn btn-outline-primary fw-bold px-3 py-2 shadow-sm rounded-pill"
                      >
                        {{ __("Details") }}
                      </Link>

                      <div v-if="service.service_status_code == 5">
                        <button
                          v-if="isShowRateBtn(service)"
                          data-bs-toggle="modal"
                          :data-bs-target="'#ratingModel'"
                          id="rate_now_button"
                          @click="setService(service)"
                          class="btn btn-primary fw-bold shadow-sm px-3 py-2 ms-3 rounded"
                        >
                          {{ __("rate us") }}
                        </button>
                        <button
                          v-else
                          class="btn btn-success fw-bold shadow-sm px-3 py-2 ms-3 rounded"
                        >
                          {{ __("rated") }}
                        </button>
                        <Modal
                          :id="'ratingModel'"
                          :aria-labelledby="'ratingModelLabel'"
                        >
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" :id="ratingModelLabel">
                                {{ __("rate now") }}
                              </h5>
                              <button
                                type="button"
                                class="btn-close"
                                data-bs-dismiss="modal"
                                aria-label="Close"
                              ></button>
                            </div>
                            <div class="modal-body">
                              <label for="rating">{{ __("rating") }}:</label>
                              <div class="rating text-center fs-3 text-warning">
                                <star-rating
                                  v-model="form.rating"
                                  @update:rating="setRating"
                                  :star-size="25"
                                ></star-rating>
                              </div>
                              <div class="form-group">
                                <label for="comment"
                                  >{{ __("comment") }}:</label
                                >
                                <textarea
                                  v-model="form.comment"
                                  class="form-control"
                                  id=""
                                  cols="30"
                                  rows="3"
                                ></textarea>
                                <span v-if="form.errors.comment">{{
                                  form.errors.comment
                                }}</span>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button
                                type="button"
                                class="btn btn-secondary"
                                :id="ratingModel"
                                data-bs-dismiss="modal"
                              >
                                {{ __("close") }}
                              </button>
                              <button
                                type="button"
                                @click="submit(service)"
                                class="btn btn-primary"
                              >
                                {{ __("submit") }}
                              </button>
                            </div>
                          </div>
                        </Modal>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row mt-3 align-items-center">
                <div class="col-12 d-flex">
                  <div class="col-md-7">
                    <div class="d-md-flex align-items-start">
                      <div class="d-flex flex-column align-items-start me-4">
                        <h6 class="fs-4 fw-bold">{{ __("Date") }}</h6>
                        <span class="fs-5">{{ service.date }}</span>
                      </div>
                      <!-- <div
                        class="d-flex flex-column align-items-start mt-3 mt-md-0"

                      >
                        <h6 class="fs-4 fw-bold">{{ __("Time") }}</h6>
                        <span class="fs-5"
                          >{{ service.start_time }} -
                          {{ service.end_time }}</span
                        >
                      </div> -->
                      <div class="d-flex flex-column align-items-start me-3">
                        <i class="bi bi-clock-fill me-3 fs-4"></i>
                        <span class="">{{ __("Available") }}</span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-5 ms-5 ms-md-0">
                    <div class="d-flex flex-column flex-md-row">
                      <div class="d-flex flex-column align-items-start mt-0">
                        <span class="fs-4 fw-bold">{{ __("fee") }}</span>
                        <span class="fs-5 mt-1">
                          {{ getDisplayAmount(service.price) }}</span
                        >
                      </div>

                      <div
                        class="d-flex flex-column align-items-start ms-0 ms-md-4"
                      >
                        <span class="fs-4 fw-bold">{{ __("Status") }}</span>
                        <span class="fs-5 mt-1">{{
                          service.is_paid ? __("paid") : __("un Paid")
                        }}</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { defineComponent } from "vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import RecordNotFound from "@/Components/Shared/RecordNotFound.vue";

export default defineComponent({
    components: {
    Head,
    Link,
    RecordNotFound
  },
    props: ['services'],
    data() {
        return {

        };
    },
});
</script>

<style>

</style>
