<template>
  <div>
    <div class="container-fluid py-5">
      <div class="row">
        <div class="col-12">
          <h2 class="fs-2 text-center">
            <!-- <span class="fw-normal">{{ __("Hello") }} {{ $page.props.auth.user.name }} |
            </span> -->
            <span class="fw-bold display-2 text-primary">{{ __("appointment detail") }}</span>
          </h2>
          <!-- <p class="text-center mb-0">{{ __("discover The Best Teachers Near You") }}</span> -->
        </div>
        <breadcrums :breadcrums="breadcrums"></breadcrums>
      </div>
    </div>
    <div class="section py-5">
      <div class="container">
        <div class="row">
             <div class="col-12">

                <div class="row">
                <div class="col-lg-7">
                   <div class="row mx-0 mb-4" v-if="appointment.appointment_status_code == 1">
                    <div class="col-12 py-3 rounded-4 d-flex align-items-center" style="background-color: #E7F3FA;">
                        <div class="col-md-6">
                            <p class="fw-bold text-center ms-1 mb-0 fs-5">{{ __("Please accept the appointment from student") }}</p>
                        </div>
                        <div class="col-md-6 d-flex justify-content-end">
                        <button type="updatenStatus" @click="updateAppointmentStatus(2)" class="btn btn-primary me-3">
                            {{ __("accept") }}
                        </button>
                        <button type="button" @click="updateAppointmentStatus(3)" class="btn btn-danger me-3">
                            {{ __("reject") }}
                        </button>
                        </div>
                    </div>
                   </div>
                    <div class="row justify-content-center py-3 rounded-4" style="background-color: #E7F3FA;" v-if="appointment.appointment_status_code == 5">
                        <div class="col-md-12">
                        <p class="mb-0 fw-bold fs-5 text-center">{{ __("appointment has been completed") }}</p>
                        </div>
                    </div>
                    <div v-if="appointment.appointment_type_id == 1 && appointment.appointment_status_code != 5">

                    <video-call-component @showCompletedButton="() => this.showMarkedAsCompletedButton = true" :appointment="appointment"></video-call-component>

                    </div>
                    <div v-if="appointment.appointment_type_id == 2 && appointment.appointment_status_code != 5">
                    <audio-call-component @showCompletedButton="() => this.showMarkedAsCompletedButton = true"  :appointment="appointment"></audio-call-component>
                    </div>
                    <div v-if="appointment.appointment_type_id == 3 && appointment.appointment_status_code == 2">
                    <chat-component @showCompletedButton="() => this.showMarkedAsCompletedButton = true"  :appointment="appointment"></chat-component>
                    </div>

                    <div class="row justify-content-end" v-if="showMarkedAsCompletedButton">
                    <div class="col-md-6 d-flex justify-content-end flex-wrap">
                    <div class="mt-4" v-if="appointment.appointment_status_code == 2">
                        <button type="updatenStatus" @click="updateAppointmentStatus(5)" class="btn btn-primary px-5">
                        {{ __("mark as complete") }}
                        </button>
                    </div>
                    </div>
                    </div>


                </div>
                <div class="col-lg-5">

                <div class="card px-2 pb-4 d-flex flex-column mt-3 mt-md-0">
                <div class="card-body">
                <div class="d-flex border-bottom border-info py-3 align-items-center justify-content-between">
                    <h4 class="text-primary fw-bolder fs-4">{{ __("your appointment summary") }}</h4>
                    <h4 class="badge" :style="{ backgroundColor: getBadgeBackgroundColor(appointment.appointment_status_name) }"> {{ __(appointment.appointment_status_name) }} </h4>
                </div>
                <div class="d-flex border-bottom border-info py-3 flex-column align-content-start">
                <h6 class="fs-5 mb-2 fw-bolder text-secondary">{{ __('booking date') }}</h6>
                <span class="fs-5 text-secondary">{{ appointment.date }}</span>
                </div>
                <div class="d-flex border-bottom border-info py-3 flex-column align-content-start"
                v-if="appointment.is_schedule_required"
                >
                <h5 class="mb-2 fs-5 fw-bolder text-secondary">{{ __('start and end time') }}</h5>
                <span class="fs-5 text-secondary">{{ appointment.start_time }} - {{ appointment.end_time }} </span>
                </div>
                <div class="d-flex flex-column border-bottom border-info py-2 align-content-start"
                v-if="appointment.teacher_name"
                >
                <h5 class="fs-5 text-secondary mb-2 fw-bolder">{{ __('selected tutor') }}</h5>
                <span class="fs-5 text-secondary">{{ appointment.teacher_name }}</span>
                </div>
                <div class="d-flex flex-column border-bottom border-info py-2 align-content-start"
                v-if="appointment.academy_name"
                >
                <h5 class="mb-2 fs-5 fw-bolder text-secondary">{{ __('academy') }}</h5>
                <span class="fs-5 text-secondary">{{ appointment.academy_name }}</span>
                </div>
                <div class="d-flex flex-column align-content-start py-2 border-bottom border-info">
                <h5 class="mb-2 fs-5 text-secondary fw-bolder">{{ __('appointment status') }}</h5>
                <span class="fs-5 text-secondary">{{ appointment.appointment_status_name }}</span>
                </div>
                <div class="d-flex flex-column align-content-start py-2 border-bottom border-info">
                <h5 class="mb-2 fs-5 text-secondary fw-bolder">{{ __('appointment type') }}</h5>
                <span class="fs-5 text-secondary">{{ appointment.appointment_type_name }}</span>
                </div>
                <div class="d-flex flex-column align-content-start py-2 border-bottom border-info ">
                <h5 class="mb-2 text-secondary fw-bolder fs-5">{{ __('payment status') }}</h5>
                <span class="fs-5 text-secondary">{{ appointment.is_paid ? __('paid') : __('Unpaid') }}</span>
                </div>
                <div class="d-flex flex-column align-content-start py-2 border-bottom border-info ">
                <h5 class="mb-2 text-secondary fw-bolder fs-5">{{ __('Payment Method') }}</h5>
                <span class="fs-5 text-secondary">{{  gateway?.name ?? "wallet" }}</span>
                </div>
                <div class="d-flex flex-column align-content-start py-2 border-bottom border-info">
                <h5 class="mb-2 fs-5 fw-bolder text-secondary">{{ __('fee') }}</h5>
                <span class="fs-5 text-secondary"> {{ getDisplayAmount(appointment.fee)  }}</span>
                </div>
                <div class="d-flex flex-column align-content-start py-2 border-bottom border-info">
                <h5 class="mb-2 fs-5 fw-bolder text-secondary">{{ __('question') }}</h5>
                <span class="fs-5 text-secondary">{{ appointment.question }}</span>
                </div>
                <div class="d-flex flex-column py-2 border-bottom border-info align-content-start">
                <h5 class="mb-2 text-secondary fs-5 fw-bolder">{{ __('attachment') }}</h5>
                <img :src="appointment.attachment_url" height="100" width="100"
                v-if="appointment.attachment_url" alt="">
                <span class="fs-5 text-secondary" v-else>{{ __('N/A') }}</span>
                </div>
                <div v-if="appointment.appointment_status_code == 5 && userRating">
                            <div class="d-flex flex-column align-content-start border-bottom border-info py-2">
                            <div>
                            <h5 class="mb-2 text-secondary fs-5 fw-bolder text-capitalize">
                                {{ __("your feedback") }}
                            </h5>
                           <div class="d-flex align-items-center gap-2 mb-2">
                            <b class="fs-5 text-secondary">{{ __("rating") }}: </b>
                            <star-rating
                                :rating="userRating.rating"
                                :star-size="20"
                                :read-only="true"
                                :increment="0.01"
                                :show-rating="false"
                                class="mb-1"
                            ></star-rating>
                           </div>
                            <b class="fs-5">{{ __("comment") }}: </b> {{ userRating.comment }}
                            </div>
                </div>
                </div>
                </div>
                </div>
                </div>
                <div class="row mt-5" v-if="appointment.appointment_status_code == 5 && !userRating">
                <div class="col-md-6"></div>
                <div class="col-md-6 d-flex justify-content-end">
                    <button type="updatenStatus" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#ratingModel">
                        {{ __("rate now") }}
                    </button>
                </div>
                    <!-- Modal -->

                    <Modal  ref="modal" class="rounded-0" maxWidth="lg" :id="'ratingModel'">
                    <div class="modal-content p-md-4">
                    <div class="modal-header border-0">
                        <h5 class="modal-title ms-2 text-primary fs-2 fw-bold" id="newsletterModalLabel"></h5>
                        <h5 class="modal-title" id="ratingModelLabel">
                            {{ __("rate now") }}
                        </h5>
                        <button :id="id+'close'" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                    </div>
                    </Modal>

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
                          @click="submit"
                          class="btn btn-primary"
                        >
                          {{ __("submit") }}
                        </button>
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
import AppLayout from "@/Layouts/AppLayout.vue";
import ValidationErrors from "@/Components/ValidationErrors.vue";
import ChatComponent from "@/Components/Shared/Appointment/ChatComponent.vue";
import VideoCallComponent from "@/Components/Shared/Appointment/VideoCallComponent.vue";
import AudioCallComponent from "@/Components/Shared/Appointment/AudioCallComponent.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import Breadcrums from "../../../Components/Shared/Breadcrums.vue";

export default defineComponent({
    components: {
        Head,
        AppLayout,
        AudioCallComponent,
        VideoCallComponent,
        ChatComponent,
        ValidationErrors,
        Link,
        Breadcrums
    },
    props: ["appointment","gateway"],
    computed: {
        userRating() {
            var variable = this.appointment.ratings.find(rating => rating.fromable_type == this.$page.props.auth.logged_in_as && rating.fromable_id == this.$page.props.auth.user[this.$page.props.auth.logged_in_as].id);
            return variable;
        },
    },
    data() {
        return {
            appointmentStatusForm: this.$inertia.form({
                appointment_id: this.appointment.id,
                status_code: "",
            }),
            form: this.$inertia.form({
                comment: "",
                rating: 0,
                teacher_id: this.appointment.teacher_id,
                booked_appointment_id: this.appointment.id
            }),
            showMarkedAsCompletedButton:false,
            breadcrums: [
                {
                    id: 1,
                    name: 'Home',
                    link: '/'
                },
                {
                    id: 2,
                    name: 'My Appointments',
                    link: '/appointment_log'
                },
                {
                    id: 3,
                    name: 'Appointment Detail',
                    link: ''
                }
            ]
        };
    },
    async created() {
        if (this.appointment.is_started) {
            this.showMarkedAsCompletedButton = true
        }
    },
    methods: {
        getBadgeBackgroundColor(statusName) {
      switch (statusName) {
        case 'Pending':
          return '#ffc107'; // Yellow background color for Pending
        case 'Accepted':
          return '#28a745'; // Green background color for Accepted
        case 'Rejected':
          return '#dc3545'; // Red background color for Rejected
        case 'Cancelled':
          return '#6c757d'; // Grey background color for Cancelled
        case 'Completed':
          return '#007bff'; // Blue background color for Completed
        default:
          return ''; // Default background color or class if status name doesn't match
      }
    },
        close() {
            document.getElementById('close').click()
        },
        resetForm() {
            this.form = this.$inertia.form({
                comment: "",
                rating: 0,

            })
        },
        setRating(rating) {
            this.form.rating = rating
        },
        updateAppointmentStatus(status_code) {
            this.appointmentStatusForm.status_code = status_code;
            this.appointmentStatusForm
                .transform((data) => ({
                    ...data,
                }))
                .post(this.route("academy.appointment_detail.updateStatus"), {
                    onSuccess: () => {
                        if (status_code == 5) {
                            document.getElementById("rate_now_button").click();
                        }
                    },
                });
        },
        submit() {
            this.form.post(this.route('add_appointment_rating'), {
                preserveState: true,
                preserveScroll: true,
                onSuccess: () => {
                    const modalBackdrop = document.querySelector('.modal-backdrop');
                    if (modalBackdrop) {
                        modalBackdrop.classList.remove('modal-backdrop');
                    }
                    this.resetForm()
                },
            })
        },
    },
});
</script>

