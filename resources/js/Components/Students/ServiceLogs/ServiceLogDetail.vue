<template>
    <div>
        <div class="container-fluid py-5">
            <div class="row">
                <div class="col-12">
                    <h2 class="fs-2 text-center">
                        <span class="fw-normal">{{ __("Hello") }} {{ $page.props.auth.user.name }} | </span>
                        <span class="fw-bold">{{ __("service detail") }}</span>
                    </h2>
                    <!-- <p class="text-center mb-0">{{ __("discover The Best Teachers Near You") }}</span> -->
                </div>
                <breadcrums :breadcrums="breadcrums"></breadcrums>
            </div>
        </div>
        <div class="section py-5">
            <div class="container">
                <div class="px-4 mb-0 rounded py-4">
                    <div class="row">
                        <div class="col-12">

                            <div class="col-lg-7">
                   <div class="row mb-2">
                    <div class="col-12 text-center">
                            <div v-if="service.service_status_code != 5">
                                <video-call-component :service="service"></video-call-component>
                            </div>
                            <div v-if="service.service_status_code != 5">
                                <audio-call-component :service="service"></audio-call-component>
                            </div>
                            <div v-if="service.service_status_code != 5">

                                    <div class="py-3 col-12 text-center rounded-4 " v-if="service.service_status_code == 1"  style="background-color: #E7F3FA;">
                                        <p class="fw-bold fs-5">{{ __("waiting for service acceptance") }}</p>
                                    </div>

                                <div v-if="service.service_status_code == 2">

                                    <chat-component :service="service"></chat-component>
                                </div>
                            </div>
                        </div>

                   </div>


                </div>
                <div class="col-lg-5">

<div class="card px-2 pb-4 d-flex flex-column mt-3 mt-md-0">
<div class="card-body">
    <div class="d-flex border-bottom border-info py-3 align-items-center justify-content-between">
        <h4 class="text-primary fw-bolder fs-4">{{ __("your service summary") }}</h4>
        <h4 class="badge" :style="{ backgroundColor: getBadgeBackgroundColor(service.service_status_name) }"> {{ __(service.service_status_name) }} </h4>
    </div>
    <div class="d-flex border-bottom border-info py-3 flex-column align-content-start">
    <h6 class="fs-5 mb-2 fw-bolder text-secondary">{{ __('booking date') }}</h6>
    <span class="fs-5 text-secondary">{{ service.date }}</span>
    </div>
    <div class="d-flex flex-column border-bottom border-info py-3 align-content-start"
    v-if="service.teacher_name"
    >
    <h5 class="fs-5 text-secondary mb-2 fw-bolder">{{ __('selected tutor') }}</h5>
    <span class="fs-5 text-secondary">{{ service.teacher_name }}</span>
    </div>
    <div class="d-flex flex-column border-bottom border-info py-3 align-content-start"
    v-if="service.academy_name"
    >
    <h5 class="mb-2 fs-5 fw-bolder text-secondary">{{ __('academy') }}</h5>
    <span class="fs-5 text-secondary">{{ service.academy_name }}</span>
    </div>
    <div class="d-flex flex-column align-content-start py-3 border-bottom border-info">
    <h5 class="mb-2 fs-5 text-secondary fw-bolder">{{ __('Service status') }}</h5>
    <span class="fs-5 text-secondary">{{ service.service_status_name }}</span>
    </div>
    <div class="d-flex flex-column align-content-start py-3 border-bottom border-info ">
    <h5 class="mb-2 text-secondary fw-bolder fs-5">{{ __('payment status') }}</h5>
    <span class="fs-5 text-secondary">{{ service.is_paid ? __('paid') : __('Unpaid') }}</span>
    </div>
    <div class="d-flex flex-column align-content-start py-3 border-bottom border-info">
    <h5 class="mb-2 fs-5 fw-bolder text-secondary">{{ __('fee') }}</h5>
    <span class="fs-5 text-secondary"> {{ getDisplayAmount(service.price)  }}</span>
    </div>
    <div class="d-flex flex-column align-content-start py-3 border-bottom border-info">
    <h5 class="mb-2 fs-5 fw-bolder text-secondary">{{ __('question') }}</h5>
    <span class="fs-5 text-secondary">{{ service.question }}</span>
    </div>
    <div class="d-flex flex-column py-3 border-bottom border-info align-content-start">
    <h5 class="mb-2 text-secondary fs-5 fw-bolder">{{ __('attachment') }}</h5>
    <img :src="service.attachment_url" height="100" width="100"
    v-if="service.attachment_url" alt="">
    <span class="fs-5 text-secondary" v-else>{{ __('N/A') }}</span>
    </div>
    <div v-if="service.service_status_code == 5 && userRating">
        <div class="d-flex flex-column align-content-start border-bottom border-info py-2">
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
<div class="row mt-5" v-if="service.service_status_code == 5 && !userRating">
                            <div class="col-md-6"></div>
                            <div class="col-md-6 d-flex justify-content-end">
                                <button type="updatenStatus" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#ratingModel">
                                    {{ __("rate now") }}
                                </button>
                            </div>
                             <!-- Modal -->
                             <Modal class="modal fade" id="ratingModel" tabindex="-1"
                                aria-labelledby="ratingModelLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="ratingModelLabel">Rate Now</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <label for="rating">{{ __('rating') }}:</label>
                                            <div class="rating text-center fs-3 text-warning">
                                                <star-rating v-model="form.rating" @update:rating="setRating"
                                                    :star-size="25"></star-rating>
                                            </div>
                                            <div class="form-group">
                                                <label for="comment">{{ __('comment') }}:</label>
                                                <textarea v-model="form.comment" class="form-control" id=""
                                                    cols="30" rows="3"></textarea>
                                                <span v-if="form.errors.comment">
                                                    {{ form.errors.comment }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" id="close"
                                                data-bs-dismiss="modal">{{ __('close') }}</button>
                                            <button type="button" @click="submit" class="btn btn-primary">{{
                                                __('submit') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </Modal>
                        </div>
                        </div>

                    </div>
                </div>

                <!-- <div class="row">
                    <div class="col-12">

                        <div class="pt-4">
                            <div class="row">
                                <div class="col-md-4 d-flex">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="me-3">
                                            <i class="bi bi-calendar-x fs-1 text-primary"></i>
                                        </div>
                                        <div>
                                            <h5 class="mb-0 text-capitalize">{{ __('booking date') }}</h5>
                                            <span>{{ service.date }}</span>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-4 d-flex" v-if="service.teacher_name">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="me-3">
                                            <i class="bi bi-person-circle fs-1 text-primary"></i>
                                        </div>
                                        <div>
                                            <h5 class="mb-0 text-capitalize">{{ __('Teacher') }}</h5>
                                            <span>{{ service.teacher_name }}</span>
                                        </div>
                                    </div>


                                </div>
                                <div class="col-md-4 d-flex" v-if="service.academy_name">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="me-3">
                                            <i class="bi bi-person-circle fs-1 text-primary"></i>
                                        </div>
                                        <div>
                                            <h5 class="mb-0 text-capitalize">{{ __('academy') }}</h5>
                                            <span>{{ service.academy_name }}</span>
                                        </div>
                                    </div>


                                </div>
                                <div class="col-md-4 d-flex">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="me-3">
                                            <i class="bi bi-clipboard-check fs-1 text-primary"></i>
                                        </div>
                                        <div>
                                            <h5 class="mb-0 text-capitalize">{{ __('service status') }}</h5>
                                            <span>{{ service.service_status_name }}</span>
                                        </div>
                                    </div>


                                </div>
                                <div class="col-md-4 d-flex">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="me-3">
                                            <i class="bi bi-webcam fs-1 text-primary"></i>
                                        </div>
                                        <div>
                                            <h5 class="mb-0 text-capitalize">{{ __('service category') }}</h5>
                                            <span>{{ service.service_category_name }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 d-flex">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="me-3">
                                            <i class="bi bi-check2-square fs-1 text-primary"></i>
                                        </div>
                                        <div>
                                            <h5 class="mb-0 text-capitalize">{{ __('payment status') }}</h5>
                                            <span>{{ service.is_paid ? __('paid') : __('un Paid') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 d-flex">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="me-3">
                                            <i class="bi bi-coin fs-1 text-primary"></i>
                                        </div>
                                        <div>
                                            <h5 class="mb-0 text-capitalize">{{ __('price') }}</h5>
                                            <span> {{ getDisplayAmount(service.price)  }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 d-flex">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="me-3">
                                            <i class="bi bi-question-circle fs-1 text-primary"></i>
                                        </div>
                                        <div>
                                            <h5 class="mb-0 text-capitalize">{{ __('question') }}</h5>
                                            <span>{{ service.question }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 d-flex">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="me-3">
                                            <i class="bi bi-file-earmark-post fs-1 text-primary"></i>
                                        </div>
                                        <div>
                                            <h5 class="mb-0 text-capitalize">{{ __('attachment') }}</h5>
                                            <img :src="service.attachment_url" height="100" width="100"
                                                v-if="service.attachment_url" alt="">
                                            <span v-else>{{ __('n/a') }}</span>
                                        </div>
                                    </div>

                                </div>
                                <div class="row mt-5" v-if="service.service_status_code == 5 && !userRating">
                                    <div class="col-md-6"></div>
                                    <div class="col-md-6 d-flex justify-content-end">
                                        <button type="updatenStatus" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#ratingModel">
                                            {{ __("rate now") }}
                                        </button>
                                    </div>

                                    <div class="modal fade" id="ratingModel" tabindex="-1"
                                        aria-labelledby="ratingModelLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="ratingModelLabel">Rate Now</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <label for="rating">{{ __('rating') }}:</label>
                                                    <div class="rating text-center fs-3 text-warning">
                                                        <star-rating v-model="form.rating" @update:rating="setRating"
                                                            :star-size="25"></star-rating>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="comment">{{ __('comment') }}:</label>
                                                        <textarea v-model="form.comment" class="form-control" id=""
                                                            cols="30" rows="3"></textarea>
                                                        <span v-if="form.errors.comment">
                                                            {{ form.errors.comment }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" id="close"
                                                        data-bs-dismiss="modal">{{ __('close') }}</button>
                                                    <button type="button" @click="submit" class="btn btn-primary">{{
                                                        __('submit') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div v-if="service.service_status_code == 5 && userRating">
                                    <div class="col-md-4 d-flex">
                                        <div class="d-flex align-items-center mb-3">
                                            <div>
                                                <h5 class="mb-0 text-capitalize">{{ __('feedback') }}</h5>
                                                <b>{{ __('rating') }}: </b>
                                                <star-rating :rating="userRating.rating" :star-size="20" :read-only="true"
                                                    :increment="0.01" :show-rating="false"></star-rating>
                                                <b>{{ __('comment') }}: </b> {{ userRating.comment }}
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->

            </div>
        </div>
    </div>
</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import ValidationErrors from "@/Components/ValidationErrors.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import ChatComponent from "@/Components/Shared/Service/ChatComponent.vue";
import Breadcrums from "@/Components/Shared/Breadcrums.vue";
import Modal from "@/Components/Modal.vue"

export default defineComponent({
    components: {
        Head,
        AppLayout,
        ValidationErrors,
        ChatComponent,
        Link,
        Breadcrums,
        Modal,
    },
    props: ['service'],
    data() {
        return {
            form: this.$inertia.form({
                comment: "",
                rating: 0,
                teacher_id: this.service.teacher_id,
                booked_service_id: this.service.id
            }),
            breadcrums: [
                {
                    id: 1,
                    name: 'Home',
                    link: '/'
                },
                {
                    id: 2,
                    name: 'My Services',
                    link: '/service_log'
                },
                {
                    id: 3,
                    name: 'Service Detail',
                    link: ''
                }
            ]
        };
    },
    async created() {
    },
    mounted() {

    },
    computed: {
        userRating() {
            var variable = this.service.reviews && this.service.reviews.find(rating => rating.student_id == this.$page.props.auth.user[this.$page.props.auth.logged_in_as].id);
            return variable;
        },


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
        submit() {
            this.form.post(this.route('add_service_rating'), {
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
            this.close();
        },
    },
});
</script>

