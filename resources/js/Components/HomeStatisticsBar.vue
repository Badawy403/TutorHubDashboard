<template>
    <div class="px-5 py-4 p-md-5  stats">
        <div class="container">
            <div class="row mx-lg-1">
              <div class="col-12 px-0 d-flex justify-content-sm-center justify-content-lg-between flex-wrap flex-lg-nowrap">
                <div
                        class="d-flex align-items-center justify-content-start item mb-4 mb-md-0"
                        data-aos="fade-right"
                        data-aos-once="false"
                        data-aos-duration="1500"
                        data-aos-delay="500"
                    >
                    <img src="@/images/icons/student_1.svg" alt="student">

                        <div class="d-flex flex-column ms-3">
                            <h3 class="mb-0 text-customblue fw-bold">
                                {{ $page.props.dashboard_data.total_users}}<span v-if="$page.props.dashboard_data.total_users > 0">+</span>
                            </h3>
                            <span class="home-subheading">{{  __('online students') }}</span>
                        </div>
                    </div>

                    <div
                        class="d-flex align-items-center justify-content-start item mb-4 mb-md-0"
                        data-aos="fade-right"
                        data-aos-once="false"
                        data-aos-duration="1500"
                        data-aos-delay="700"
                    >
                    <img src="@/images/icons/teacher_1.svg" alt="teacher">
                        <div class="d-flex flex-column ms-3">
                            <h3 class="mb-0 mb-0 text-customblue fw-bold">
                                {{ $page.props.dashboard_data.total_teachers }}<span v-if="$page.props.dashboard_data.total_teachers > 0">+</span>
                            </h3>
                            <span class="home-subheading">{{ __('expert instructors') }}</span>
                        </div>
                    </div>


                    <div
                        class="d-flex align-items-center justify-content-start item mb-4 mb-md-0"
                        data-aos="fade-right"
                        data-aos-once="false"
                        data-aos-duration="1500"
                        data-aos-delay="900"
                    >
                    <img src="@/images/icons/like_1.svg" alt="like">
                        <div class="d-flex flex-column ms-3">
                            <h3 class="mb-0 mb-0 text-customblue fw-bold">
                                {{$page.props.dashboard_data.total_appointments }}<span v-if="$page.props.dashboard_data.total_appointments > 0">+</span>
                            </h3>
                            <span class="home-subheading">{{
                               __('consultations booked')
                            }}</span>
                        </div>
                    </div>

                    <div
                        class="d-flex align-items-center justify-content-start item mb-4 mb-md-0"
                        data-aos="fade-right"
                        data-aos-once="false"
                        data-aos-duration="1500"
                        data-aos-delay="1100"
                    >
                        <img src="@/images/icons/school_1.svg" alt="school">
                        <div class="d-flex flex-column ms-3">
                            <h3 class="mb-0 mb-0 text-customblue fw-bold">
                                {{ $page.props.dashboard_data.total_law_frims }}<span v-if="$page.props.dashboard_data.total_law_frims > 0">+</span>
                            </h3>
                            <span class="home-subheading">{{
                               __('online academies')
                            }}</span>
                        </div>
                    </div>


                    <div
                        class="d-flex align-items-center justify-content-start item"
                        data-aos="fade-right"
                        data-aos-once="false"
                        data-aos-duration="1500"
                        data-aos-delay="1300"
                    >
                        <img src="@/images/icons/event_1.svg" alt="event">
                        <div class="d-flex flex-column ms-3">
                            <h3 class="mb-0 mb-0 text-customblue fw-bold">
                                {{ $page.props.dashboard_data.total_events }}<span v-if="$page.props.dashboard_data.total_events > 0">+</span>
                            </h3>
                            <span class="home-subheading">{{ __('events') }}</span>
                        </div>
                   </div>

              </div>
            </div>
        </div>
    </div>
</template>
<script>
import { defineComponent } from "vue";
import { Link } from "@inertiajs/inertia-vue3";

export default defineComponent({
    components: {
        Link,
    },
    created() {
    },
    data() {
        return {};
    },
    methods: {},
});
</script>
