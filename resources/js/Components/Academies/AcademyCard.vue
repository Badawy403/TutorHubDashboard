<template>
    <!-- :class="{ 'col-md-4 col-academy': add_col, 'w-100': !add_col }" -->


    <div class="card shadow p-4 mx-3">
        <div class="card-body p-0">
            <div class="row">
                <div class="col-lg-4">
                    <!-- <i v-if="academy.is_featured" class="bi text-primary bi-patch-check-fill position-absolute top-0 start-0 ms-2 fs-2" style="z-index: 2;"></i> -->
                    <Link :href="route('academy.profile', { 'user_name': academy.user_name })">
                    <div class="d-flex justify-content-center rounded-4 overflow-hidden position-relative"
                        style="height: 190px">
                        <img v-if="academy.image" class="img-fluid" :src="academy.image" alt="law" />
                        <img v-if="!academy.image" class="img-fluid" src="@/images/account/default_avatar_men.png"
                            alt="law" />
                    </div>
                    </Link>
                </div>
                <div class="col-lg-8">
                    <div class="d-flex align-items-center justify-content-between mt-3 mt-md-0 mb-1">
                        <div class="d-flex mb-0 mb-md-2 flex-column align-items-start">
                            <h2 class="mb-0 fs-5 text-capitalize">
                                <Link :href="route('academy.profile', { 'user_name': academy.user_name })"
                                    class="text-decoration-none text-dark fw-bold fs-3">{{ academy.name }}</Link>
                            </h2>

                        </div>
                        <div class="text-end">
                            <Link :href="route('academy.profile', { user_name: academy.user_name, })"
                                class="btn btn-primary px-4 py-2 rounded-pill">
                            {{ getPageContent('general_book_btn_1_text') ?? __("book appointment") }}
                            </Link>
                        </div>
                    </div>


                    <ul class="list-unstyled d-flex flex-wrap mb-3" v-if="academy.academy_categories.length > 0">
                        <li class="me-2 fs-5 pe-2 text-secondary fw-lightbold mb-1 border-end"
                            v-for="(category, index) in academy.academy_categories" :key="index">
                            {{ category.name }}
                        </li>
                    </ul>


                    <!-- <div
                            style="font-size: 14px"
                            class="text-start"
                        >
                            <p> {{ academy.description }}</p>
                        </div> -->

                    <div class="row d-flex mb-3">
                        <!-- <div class="col-md-4 text-start" v-if="academy.experience"> -->
                        <div class="col-md-4 text-start mb-2 mb-md-0">
                            <h6 class="fs-5 fw-bold">{{ __("experience") }}</h6>
                            <span class="fs-5 text-lightsecondary">{{ __('5') }} {{ __("years") }}</span>
                            <!-- <span class="fs-5 text-lightsecondary" v-if="academy.experience == 1">{{ academy.experience }} {{ __("year") }}</span>
                            <span class="fs-5 text-lightsecondary" v-else>{{ academy.experience }} {{ __("years") }}</span> -->
                        </div>

                        <!-- <div class="col-md-4 text-start" v-if="academy.speciality"> -->
                        <div class="col-md-4 text-start mb-2 mb-md-0">
                            <h6 class="fs-5 fw-bold">{{ __("speciality") }}</h6>
                            <span class="fs-5 text-lightsecondary">{{ __('Real Estate Law') }}</span>
                            <!-- <span class="fs-5 text-lightsecondary">{{ academy.speciality }}</span> -->
                        </div>

                        <div class="col-md-4 text-start mb-2 mb-md-0">
                            <h6 class="fs-5 fw-bold">{{ __("rating") }}</h6>
                            <div class="d-flex align-items-center">
                                <star-rating :rating="academy.rating" :star-size="15" :read-only="true"
                                    :increment="0.01" :show-rating="false"></star-rating>
                                <span class="text-secondary small mt-1 ps-1 fs-5">({{ academy.rating }})</span>
                            </div>
                        </div>


                    </div>

                    <!-- <div class="row mt-3">

                            <div class="col-lg-4 text-start">
                                <div
                                    class="d-flex align-items-center justify-content-start me-4"
                                >
                                    <span class="mt-1 me-2"
                                        >{{
                                            __("rating")
                                        }}
                                        ({{academy.rating}}/5)</span
                                    >
                                    <span class="text-white" style="color: #f5d812;">
                                        <star-rating :rating="academy.rating" :star-size="18" :read-only="true" :increment="0.01"
                                        :show-rating="false"></star-rating>
                                    </span>
                                </div>
                            </div>


                        </div> -->
                    <div class="col-md-12 text-start" v-if="checkObjectValuesIsNotNull(academy.academy_settings)">
                        <div
                            class="d-flex justify-content-between align-items-center bg-warning px-3 py-2 rounded-pill">
                            <h6 class="fs-5 fw-medium  mb-0">{{ __("Follow me on:") }}</h6>
                            <ul class="d-flex flex-wrap justify-content-end ps-0 mb-0 list-group list-group-horizontal">
                                <li class="list-group-item p-1 py-0 bg-transparent border-0" v-if="academy.academy_settings.facebook_url
                        ">
                                    <a target="_blank" class="text-dark" :href="academy.academy_settings
                        .facebook_url
                        "><i class="bi bi-facebook"></i></a>
                                </li>
                                <li class="list-group-item p-1 py-0  bg-transparent border-0" v-if="academy.academy_settings.youtube_url
                        ">
                                    <a target="_blank" class="text-dark" :href="academy.academy_settings
                        .youtube_url
                        "><i class="bi bi-youtube"></i></a>
                                </li>
                                <li class="list-group-item p-1 py-0 bg-transparent border-0" v-if="academy.academy_settings.twitter_url
                        ">
                                    <a target="_blank" class="text-dark" :href="academy.academy_settings
                        .twitter_url
                        "><i class="bi bi-twitter"></i></a>
                                </li>
                                <li class="list-group-item p-1 py-0 bg-transparent border-0" v-if="academy.academy_settings.linkedin_url
                        ">
                                    <a target="_blank" class="text-dark" :href="academy.academy_settings
                        .linkedin_url
                        "><i class="bi bi-linkedin"></i></a>
                                </li>
                                <li class="list-group-item p-1 py-0 bg-transparent border-0" v-if="academy.academy_settings.whatsapp_url
                        ">
                                    <a target="_blank" class="text-dark" :href="academy.academy_settings
                        .whatsapp_url
                        "><i class="bi bi-whatsapp"></i></a>
                                </li>
                                <li class="list-group-item p-1 py-0 bg-transparent border-0" v-if="academy.academy_settings.instagram_url
                        ">
                                    <a target="_blank" class="text-dark" :href="academy.academy_settings
                        .instagram_url
                        "><i class="bi bi-instagram"></i></a>
                                </li>
                                <li class="list-group-item p-1 py-0 bg-transparent border-0"
                                    v-if="academy.academy_settings.tiktok_url">
                                    <a target="_blank" class="text-dark" :href="academy.academy_settings
                        .tiktok_url
                        "><i class="bi bi-tiktok"></i></a>
                                </li>
                                <li class="list-group-item p-1 py-0 bg-transparent border-0" v-if="academy.academy_settings.snapchat_url
                        ">
                                    <a target="_blank" class="text-dark" :href="academy.academy_settings
                        .snapchat_url
                        "><i class="bi bi-snapchat"></i></a>
                                </li>
                                <li class="list-group-item p-1 py-0 bg-transparent border-0" v-if="academy.academy_settings.pinterest_url
                        ">
                                    <a target="_blank" class="text-dark" :href="academy.academy_settings
                        .pinterest_url
                        "><i class="bi bi-pinterest"></i></a>
                                </li>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>

            <div class="row pt-4 pb-2 align-items-center">
                <div class="col-md-12">
                    <div class="row">
                    <div class="col-lg-4 mb-3 mb-md-0" v-for="(teacher,index) in academy.academy_teachers" :key="teacher.id">
                    <Link class="text-decoration-none text-black" :href="route('teacher.profile', { user_name: teacher.user_name })">
                        <div class="card p-2 shadow-sm rounded-5" v-if="index<=2">
                        <img :src="teacher.image" class="img-fluid rounded-5 m-1  position-relative"
                            alt="..." style="height: 130px;">
                        <i class="bi bi-circle-fill position-absolute  end-0 my-3 me-4" style="color: #08FA20;"></i>
                        <div class="card-body text-decoration-none text-start p-1 mt-1">
                            <h5 class="card-title fs-5 fw-bold mb-0">{{ teacher.name }}</h5>
                            <span class="card-subtitle fs-5">{{ teacher.experience }} {{ __('year') }} {{ __('experience') }}</span>
                        </div>
                    </div>
                    </Link>
                </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
    <!-- <div class="row pt-3 academy-teacher" v-if="academy.academy_teachers.length>0">
                    <div class="col-12 text-start text-capitalize">
                        <h3>{{ academy.name }} {{__('teachers') }}</h3>
                    </div>
                    <div class="col-12">
                        <featured-academy-teacher-section
                        class="pt-2"
                        findTeachers="true"
                        :academy_teachers="academy.academy_teachers"
                    ></featured-academy-teacher-section>
                    </div>
                </div>
                </div>
                </div> -->





</template>
<script>
import { defineComponent } from "vue";
import axios from "axios";

import { Link } from "@inertiajs/inertia-vue3";
import FeaturedLawfirmTeacherSection from "@/Components/Academies/FeaturedAcademyTeacherSection.vue";
export default defineComponent({
    components: {
        Link,
        FeaturedLawfirmTeacherSection
    },
    props: ['academy', 'add_col'],
    created() {
        this.getFeaturedAcademies()
    },
    data() {
        return {
            featured_academies: [],
        };
    },
    methods: {
        getFeaturedAcademies() {
            axios.get(this.route('getApiFeaturedAcademies')).then(res => {
                this.featured_academies = res.data.data
            });
        },
    },
});
</script>
