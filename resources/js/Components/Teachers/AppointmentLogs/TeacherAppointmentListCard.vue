<template>
  <div class="row">
    <div class="col-12 text-center mb-3" v-if="appointments.data.length == 0">
      <record-not-found></record-not-found>
    </div>

    <div
      class="col-lg-6 mb-3"
      v-for="appointment in appointments.data"
      :key="appointment.id"
    >
      <div class="card spotlight-card shadow-sm px-4 py-3 item-h border-0">
        <div class="card-body p-0">
          <div class="row align-items-center">
            <div class="col-md-3">
              <div
                class="d-flex justify-content-center card-avatar overflow-hidden position-relative rounded-3"
              >
                <img
                  v-if="appointment.student_image"
                  class="img-fluid"
                  :src="appointment.student_image"
                  alt="teacher"
                />
                <!-- <img

                            class="img-fluid rounded-3"
                            src="@/images/common/tutor.jpg"
                            alt="teacher"
                            /> -->
              </div>
            </div>
            <div class="col-md-9">
              <div class="card-body p-0">
                <div class="row mb-3">
                  <div
                    class="col-md-12 d-flex align-items-center justify-content-between"
                  >
                    <h2 class="fs-4 mb-0 fw-bold text-capitalize">
                      {{ appointment.student_name }}
                    </h2>
                    <div class="d-flex align-items-center me-md-3">
                      <Link
                        :href="
                          route('teacher.appointment_log.detail', {
                            id: appointment.id,
                          })
                        "
                        class="btn btn-outline-primary fw-bold px-3 py-2 shadow-sm rounded-pill"
                      >
                        {{ __("Details") }}
                      </Link>

                      <div v-if="appointment.appointment_status_code == 5">
                        <button
                          v-if="isShowRateBtn(appointment)"
                          data-bs-toggle="modal"
                          :data-bs-target="'#ratingModel'"
                          id="rate_now_button"
                          @click="setAppointment(appointment)"
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
                      </div>
                      <Modal :id="'ratingModel'" :aria-labelledby="'ratingModelLabel'">
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
                                @click="submit(appointment)"
                                class="btn btn-primary"
                              >
                                {{ __("submit") }}
                              </button>
                            </div>
                          </div>
                      </Modal>
                      <!-- <div
                        class="modal fade"
                        id="ratingModel"
                        tabindex="-1"
                        aria-labelledby="ratingModelLabel"
                        aria-hidden="true"
                      >
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="ratingModelLabel">
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
                                id="close"
                                data-bs-dismiss="modal"
                              >
                                {{ __("close") }}
                              </button>
                              <button
                                type="button"
                                @click="submit(appointment)"
                                class="btn btn-primary"
                              >
                                {{ __("submit") }}
                              </button>
                            </div>
                          </div>
                        </div>
                      </div> -->
                      <!-- <div
                  class="modal fade"
                  id="ratingModel"
                  tabindex="-1"
                  aria-labelledby="ratingModelLabel"
                  aria-hidden="true"
                >
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="ratingModelLabel">
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
                          <label for="comment">{{ __("comment") }}:</label>
                          <textarea
                            v-model="form.comment"
                            class="form-control"
                            id=""
                            cols="30"
                            rows="3"
                          ></textarea>
                          <span v-if="form.errors.comment">
                            {{ form.errors.comment }}
                          </span>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button
                          type="button"
                          class="btn btn-secondary"
                          id="close"
                          data-bs-dismiss="modal"
                        >
                          {{ __("close") }}
                        </button>
                        <button
                          type="button"
                          @click="submit(appointment)"
                          class="btn btn-primary"
                        >
                          {{ __("submit") }}
                        </button>
                      </div>
                    </div>
                  </div>
                </div> -->

                      <!-- <button class="btn btn-primary">
                                            {{ __("rescedule") }}
                                        </button> -->
                    </div>
                  </div>
                </div>
              </div>
              <!-- <div class="text-start">
                                            <p style="font-size: 14px ;line-height: 15px;" class=" fw-regular text-secondary">
                                                Our team of highly skilled attorneys comprises seasoned professionals with extensive
                                            </p>
                        </div> -->
              <div class="row mt-3 align-items-center">
                <div class="col-12 d-flex">
                  <div class="col-md-7">
                    <div class="d-md-flex align-items-start">
                      <div class="d-flex flex-column align-items-start me-4">
                        <h6 class="fs-4 fw-bold">{{ __("Date") }}</h6>
                        <span class="fs-5">{{ appointment.date }}</span>
                      </div>
                      <div
                        class="d-flex flex-column align-items-start mt-3 mt-md-0"
                        v-if="appointment.is_schedule_required"
                      >
                        <h6 class="fs-4 fw-bold">{{ __("Time") }}</h6>
                        <span class="fs-5"
                          >{{ appointment.start_time }} -
                          {{ appointment.end_time }}</span
                        >
                      </div>
                      <div
                        class="d-flex flex-column align-items-start me-3"
                        v-else
                      >
                        <i class="bi bi-clock-fill me-3 fs-4"></i>
                        <span class="">{{ __("Available") }}</span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-5 ms-5 ms-md-0">
                    <div class="d-flex flex-column flex-md-row">
                      <div class="d-flex flex-column align-items-start me-4">
                        <!-- <i class="bi bi-camera-video-fill me-2 fs-4 text-primary" v-if="appointment.appointment_type == 'video'"></i>
                            <i class="bi bi-telephone-fill me-2 fs-4 text-primary" v-if="appointment.appointment_type == 'audio'"></i>
                            <i class="bi bi-chat-fill me-2 fs-4 text-primary" v-if="appointment.appointment_type == 'chat'"></i> -->
                        <span class="fw-bold fs-4">{{
                          __('Type')
                        }}</span>
                        <span class="me-2 mt-1 fs-5">{{
                          appointment.appointment_type_name
                        }}</span>
                      </div>

                      <div
                        class="d-flex flex-column align-items-start mt-3 mt-md-0"
                      >
                        <span class="fs-4 fw-bold">{{ __("fee") }}</span>
                        <span class="fs-5 mt-1">
                          {{ getDisplayAmount(appointment.fee) }}</span
                        >
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

    <!-- <div
      class="col-12 mb-3"
      v-for="appointment in appointments.data"
      :key="appointment.id"
    >
      <div class="card spotlight-card shadow-sm p-4 item-h border-0">
        <div class="card-body p-0">
          <div class="row">
            <div class="col-lg-3">
              <div
                class="d-flex mb-3 d-flex mb-3 justify-content-center card-avatar overflow-hidden position-relative"
                style="height: 150px"
              >
              <img
                 v-if="appointment.student_image"
                  class="img-fluid"
                  :src="appointment.student_image"
                  alt="teacher"
                />
                <img
                v-else
                  class="img-fluid"
                  src="@/images/account/default_avatar_men.png"
                  alt="teacher"
                />
              </div>
            </div>
            <div class="col-lg-9">
              <div>
                <div class="card-body p-0">
                  <div class="row">
                    <div class="col-lg-8">
                      <h2 class="mb-3 fs-6 text-capitalize">
                        {{ appointment.student_name }}
                      </h2>

                      <div style="font-size: 14px" class="text-start me-5">
                        <p>
                          {{ appointment.question }}
                        </p>
                      </div>
                    </div>

                    <div class="col-lg-4 text-end">
                      <Link
                        :href="
                          route('teacher.appointment_log.detail', {
                            id: appointment.id,
                          })
                        "
                        class="btn btn-outline-primary fw-bold shadow-sm mb-3 rounded w-100"
                      >
                        {{ __("view details") }}
                      </Link>
                      <div v-if="appointment.appointment_status_code == 5">
                        <button v-if="isShowRateBtn(appointment)"
                            data-bs-toggle="modal"
                            data-bs-target="#ratingModel"
                            id="rate_now_button"
                             @click="setAppointment(appointment)"
                        class="btn btn-outline-primary fw-bold shadow-sm mb-3 rounded w-100"
                      >
                        Rate Us
                      </button>
                      <button v-else
                        class="btn btn-success fw-bold shadow-sm mb-3 rounded w-100"
                      >
                        Rated
                      </button>
                      </div>

                      <div
                  class="modal fade"
                  id="ratingModel"
                  tabindex="-1"
                  aria-labelledby="ratingModelLabel"
                  aria-hidden="true"
                >
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="ratingModelLabel">
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
                          <label for="comment">{{ __("comment") }}:</label>
                          <textarea
                            v-model="form.comment"
                            class="form-control"
                            id=""
                            cols="30"
                            rows="3"
                          ></textarea>
                          <span v-if="form.errors.comment">
                            {{ form.errors.comment }}
                          </span>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button
                          type="button"
                          class="btn btn-secondary"
                          id="close"
                          data-bs-dismiss="modal"
                        >
                          {{ __("close") }}
                        </button>
                        <button
                          type="button"
                          @click="submit(appointment)"
                          class="btn btn-primary"
                        >
                          {{ __("submit") }}
                        </button>
                      </div>
                    </div>
                  </div>
                </div> -->

    <!-- <button class="btn btn-primary">
                                            {{ __("rescedule") }}
                                        </button> -->
    <!-- </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row mx-0 py-3 bg-primary-light rounded-lg">
              <div class="col-lg-5">
                <div class="d-md-flex align-items-center">
                  <div class="d-flex align-items-center me-3">
                    <i class="bi bi-calendar3 me-3 fs-4 text-primary"></i>
                    <span class="">{{ appointment.date }}</span>
                  </div>
                  <div
                    class="d-flex align-items-center me-3"
                    v-if="appointment.is_schedule_required"
                  >
                    <i class="bi bi-clock-fill me-3 fs-4 text-primary"></i>
                    <span class=""
                      >{{ appointment.start_time }} -
                      {{ appointment.end_time }}</span
                    >
                  </div>
                  <div class="d-flex align-items-center me-3" v-else>
                    <i class="bi bi-clock-fill me-3 fs-4 text-primary"></i>
                    <span class="">{{ __("available") }}</span>
                  </div>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="d-flex align-items-center justify-content-end justify-content-md-start me-4">
                  <i class="bi bi-camera-video-fill me-2 fs-4 text-primary" v-if="appointment.appointment_type == 'video'"></i>
                  <i class="bi bi-telephone-fill me-2 fs-4 text-primary" v-if="appointment.appointment_type == 'audio'"></i>
                  <i class="bi bi-chat-fill me-2 fs-4 text-primary" v-if="appointment.appointment_type == 'chat'"></i>
                  <span class="me-3">{{
                    appointment.appointment_type_name
                  }}</span>
                  <span class="fw-bold">{{
                    appointment.is_paid ? __("paid") : __("un Paid")
                  }}</span>
                </div>
              </div>
              <div class="col-lg-3">
                <div class="d-flex align-items-center justify-content-end justify-content-md-start me-4">
                    <i class="bi bi-coin me-2 fs-4 text-primary"></i>
                  <span class="me-3">{{ __("fee") }}</span>
                  <span> {{ getDisplayAmount(appointment.fee)}}</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> -->
  </div>
</template>

<script>
import { defineComponent } from "vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import RecordNotFound from "../../Shared/RecordNotFound.vue";
import Modal from "@/Components/Modal.vue";

export default defineComponent({
  components: {
    Head,
    Link,
    RecordNotFound,
    Modal,
  },
  props: ["appointments"],
  data() {
    return {
      form: this.$inertia.form({
        comment: "",
        rating: 0,
        teacher_id: null,
        booked_appointment_id: null,
      }),
      showRatingObj: [],
    };
  },
  methods: {
    setAppointment(appointment) {
      this.form.booked_appointment_id = appointment.id;
      this.form.teacher_id = appointment.teacher_id;
    },
    close() {
      document.getElementById("close").click();
    },
    resetForm() {
      this.form = this.$inertia.form({
        comment: "",
        rating: 0,
        teacher_id: null,
        booked_appointment_id: null,
      });
    },
    checkUserAlreadyRated(appointment) {
      var variable = appointment.ratings.find(
        (rating) =>
          rating.fromable_type == this.$page.props.auth.logged_in_as &&
          rating.fromable_id ==
            this.$page.props.auth.user[this.$page.props.auth.logged_in_as].id
      );
      return variable ? false : true;
    },
    isShowRateBtn(appointment) {
      var variable = this.showRatingObj.find(
        (rating) => rating.appointment_id == appointment.id
      );
      return variable ? variable.isShow : false;
    },
    setRating(rating) {
      this.form.rating = rating;
    },
    submit() {
      this.form.post(this.route("add_appointment_rating"), {
        preserveState: true,
        preserveScroll: true,
        onSuccess: () => {
          const modalBackdrop = document.querySelector(".modal-backdrop");
          if (modalBackdrop) {
            modalBackdrop.classList.remove("modal-backdrop");
          }
          this.close();
          var index = this.showRatingObj.findIndex(
            (rating) =>
              rating.appointment_id === this.form.booked_appointment_id
          );
          if (index >= 0) {
            this.showRatingObj[index].isShow = false;
          }
          this.resetForm();
        },
      });
    },
  },
  mounted() {
    for (let index = 0; index < this.appointments.data.length; index++) {
      const element = this.appointments.data[index];
      var y = {
        appointment_id: element.id,
        isShow: this.checkUserAlreadyRated(element),
      };
      this.showRatingObj.push(y);
    }
  },
});
</script>

<style>
</style>
