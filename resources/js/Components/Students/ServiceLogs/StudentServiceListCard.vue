<template>
<div class="row">
    <div class="col-12 text-center mb-3" v-if="services.data.length == 0">
        <record-not-found></record-not-found>

    </div>
    <div class="col-lg-6 mb-3" v-for="service in services.data" :key="service.id">
        <div class="card spotlight-card shadow-sm p-4 item-h border-0">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-md-3">
                        <div class="d-flex justify-content-center card-avatar overflow-hidden position-relative rounded-3">
                            <img v-if="service.teacher_image" class="img-fluid" :src="service.teacher_image" alt="teacher" />
                            <img v-else-if="service.academy_image" class="img-fluid" :src="service.academy_image" alt="teacher" />
                            <img v-else class="img-fluid" src="@/images/account/default_avatar_men.png" alt="teacher" />
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-12 d-flex align-items-center justify-content-between">
                                <h2 class="fs-4 mb-0 fw-bold text-capitalize" v-if="service.teacher_name">
                                    {{ service.teacher_name }}
                                </h2>
                                <h2 class="mb-0 fw-bold fs-4 text-capitalize" v-if="service.academy_name">
                                    {{ service.academy_name }}
                                </h2>
                                <Link :href="route('student.service_log.detail',{id:service.id})" class="btn btn-outline-primary fw-bold px-3 py-2 shadow-sm rounded-pill">
                                {{ __("Details") }}
                                </Link>
                            </div>

                        </div>
                        <div class="row mt-3 align-items-center">
                <div class="col-12 d-flex">
                  <div class="col-md-6">
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
                                <!-- <div class="row mx-0 py-3 bg-primary-light rounded-lg">
                        <div class="col-md-3">
                            <div class="d-md-flex align-items-center">
                                <div class="d-flex align-items-center me-3">
                                    <i class="bi bi-calendar3 me-3 fs-4 text-primary"></i>
                                    <span class="">{{ service.date }}</span>
                                </div>
                                <div class="d-flex align-items-center me-3">
                                    <i class="bi bi-clock-fill me-3 fs-4 text-primary"></i>
                                    <span class="">{{ __('available')}}</span>
                                </div>
                            </div>
                        </div>
                    <div class="col-md-3">
                        <div class="d-flex align-items-center justify-content-end justify-content-md-start me-4">
                        <i class="bi bi-camera-video-fill me-2 fs-4 text-primary" v-if="service.service_type == 'video'"></i>
                        <i class="bi bi-telephone-fill me-2 fs-4 text-primary" v-if="service.service_type == 'audio'"></i>
                        <i class="bi bi-chat-fill me-2 fs-4 text-primary" v-if="service.service_type == 'chat'"></i>
                        <span class="me-3">{{
                            service.service_type_name
                        }}</span>
                        <span class="fw-bold">{{
                            service.is_paid ? __("paid") : __("un Paid")
                        }}</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="d-flex align-items-center justify-content-end justify-content-md-start me-4">
                            <i class="bi bi-coin me-2 fs-4 text-primary"></i>
                        <span class="me-3">{{ __("price") }}</span>
                        <span> {{getDisplayAmount(service.price)}}</span>
                        </div>
                    </div>
                    </div> -->
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
