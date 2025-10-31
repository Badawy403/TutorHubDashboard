<template>

    <div class="col-12 text-center mb-3" v-if="appointments.data.length == 0">
        <record-not-found></record-not-found>

    </div>
   <div class="row">
   <div class="col-12">

   <div class="row">
    <div class="col-lg-6 mb-3" v-for="appointment in appointments.data" :key="appointment.id">
        <div class="card spotlight-card shadow-sm px-4 py-3 item-h border-0">
            <div class="card-body p-0">
                <div class="row align-items-center">
                    <div class="col-md-3">
                        <div class="d-flex justify-content-center card-avatar overflow-hidden position-relative rounded-3">
                            <img v-if="appointment.teacher_image" class="img-fluid" :src="appointment.teacher_image" alt="teacher" />
                            <img v-else-if="appointment.academy_image" class="img-fluid" :src="appointment.academy_image" alt="teacher" />
                            <img v-else class="img-fluid" src="@/images/account/default_avatar_men.png" alt="teacher" />
                        </div>
                    </div>
                    <div class="col-md-9">

                            <div class="card-body p-0">
                                <div class="row">
                                    <div class="col-md-9 align-content-start">
                                        <h2 class="mb-2 mt-4 mt-md-2 fs-4 fw-bold text-capitalize" v-if="appointment.teacher_name">
                                            {{ appointment.teacher_name }}
                                        </h2>
                                        <h2 class="mb-2 fs-5 text-capitalize" v-if="appointment.academy_name">
                                            {{ appointment.academy_name }}
                                        </h2>
<!--
                                        <div  class="text-start">
                                            <p style="font-size: 14px ;line-height: 15px;" class=" fw-regular text-secondary">
                                                Our team of highly skilled attorneys comprises seasoned professionals with extensive.
                                            </p>
                                        </div> -->
                                    </div>

                                    <div class="col-md-3 text-start text-md-end">
                                        <Link :href="route('student.appointment_log.detail',{id:appointment.id})" class="btn btn-outline-primary fw-bold px-3 py-2 shadow-sm mb-3 rounded-pill">
                                        {{ __("Details") }}
                                        </Link>

                                        <!-- <button class="btn btn-primary">
                                            {{ __("rescedule") }}
                                        </button> -->
                                    </div>


                                </div>

                        </div>
                        <div class="row mt-2 align-items-center">
                        <div class="col-md-7">
                            <div class="d-md-flex d-flex align-items-start">
                                <div class="d-flex flex-column align-items-start me-3">
                                    <h6 class="fs-4 fw-bold">{{ __("Date") }}</h6>
                                    <span class="fs-5">{{ appointment.date }}</span>
                                </div>
                                <div class="d-flex flex-column align-items-start ms-0 ms-md-2" v-if="appointment.is_schedule_required">
                                    <h6 class="fs-4 fw-bold">{{ __("Time") }}</h6>
                                    <span class="fs-5">{{ appointment.start_time }}
                                        - {{ appointment.end_time }}</span>
                                </div>
                                <div class="d-flex flex-column align-items-start me-3" v-else>
                                    <i class="bi bi-clock-fill me-3 fs-4"></i>
                                    <span class="">{{ __('available')}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="d-flex align-content-center justify-content-md-between mt-2 mt-md-0">
                            <div class="d-flex flex-column justify-content-start">

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


                                <div class="d-flex flex-column align-items-start ms-3 ms-md-0">
                                <span class="fs-4 fw-bold ms-1 ms-md-0">{{ __("fee") }}</span>
                                <span class="fs-5 mt-1 ms-1 ms-md-0"> {{getDisplayAmount(appointment.fee)}}</span>
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
   </div>

</template>

<script>
import { defineComponent } from "vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import RecordNotFound from "../Shared/RecordNotFound.vue";

export default defineComponent({
    components: {
    Head,
    Link,
    RecordNotFound
  },
    props: ['appointments'],
    data() {
        return {

        };
    },
});
</script>

<style>

</style>
