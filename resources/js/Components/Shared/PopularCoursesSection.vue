<template>
    <div class="container-fluid bg-white p-6 course-margin">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h3 class="text-primary fw-bold display-6" data-aos="fade-down" data-aos-delay="200" data-aos-duration="1500" data-aos-once="false">
                        {{ __("popular courses") }}
                    </h3>

                    <div
                    v-if="
                        getPageContentType('archives_page_description') == 'textarea'
                    "
                    >
                    <div v-html="getPageContent('archives_page_description')"></div>
                    </div>
                    <div
                    v-else-if="
                        getPageContentType('archives_page_description') == 'text'
                    "
                    >
                    <p>{{ getPageContent("archives_page_description") ?? "-" }}</p>
                    </div>

                    <p v-else class="text-secondary mt-4">
                        Our team of highly skilled attorneys comprises seasoned
                        professionals with extensive experience in their respective
                        fields. We pride ourselves on recruiting top legal talent,
                        ensuring that you receive the highest standard of representation.
                        From complex litigation to intricate.
                    </p>
                </div>
                <div class="col-md-12" v-if="fetching">
                    <div class="row py-5">
                     <div class="col-md-4">
                        <categories-skeleton></categories-skeleton>
                     </div>
                     <div class="col-md-4">
                        <categories-skeleton></categories-skeleton>
                     </div>
                     <div class="col-md-4">
                        <categories-skeleton></categories-skeleton>
                     </div>
                    </div>
                </div>
                <div class="col-md-12" v-if="!fetching">
                 <div class="row py-5">
                    <div class="col-lg-4 hvr-float" v-for="archive in archives" :key="archive.id">
                       <Link class="text-decoration-none" :href="route('archives.detail', { slug: archive.slug })">
                        <div class="card shadow text-decoration-none mb-md-0 mb-3">
                            <div class="rounded-5 text-center overflow-hidden mt-3 mx-3" style="height: 250px">
                            <img  :src="archive.image" class="img-fluid" alt="cardtopimg" />
                            <!-- <img class="img-fluid" src="@/images/common/courseimg.jpg" /> -->
                            </div>
                            <div class="card-body text-start mb-3 px-4">
                            <h4 class="card-title">
                                <span  class="text-decoration-none fs-3 text-black fw-bold">
                                    {{ archive.name }}
                                </span>
                            </h4>
                            <p class="card-text text-secondary line-clamp">
                                {{ archive.description }}
                            </p>
                        </div>
                        </div>
                    </Link>
                    </div>
                </div>
                 </div>
            </div>

            </div>
        <div class="col-12 text-center">
         <Link :href="route('archives.listing')" class="btn btn-primary rounded-pill">{{ __('Explore More') }}</Link>
        </div>
        </div>



</template>
<script>
import { defineComponent } from "vue";
import { Link } from "@inertiajs/inertia-vue3";
import axios from "axios";
import CategoriesSkeleton from "../Skeleton/CategoriesSkeleton.vue";


import { Carousel, Navigation, Pagination, Slide } from 'vue3-carousel';

export default defineComponent({
    components: {
        Link,
        CategoriesSkeleton,
        Carousel,
        Navigation,
        Pagination,
        Slide,
    },
    created() {
        this.getArchives()
    },
    data() {
        return {
            archives: [],
            fetching: true,
            settings: {
                itemsToShow: 1,
                snapAlign: 'start',
            },
            // breakpoints are mobile first
            // any settings not specified will fallback to the carousel settings
            breakpoints: {
                // 700px and up
                700: {
                    itemsToShow: 1,
                    snapAlign: 'start',
                },
                // 1024 and up
                1024: {
                    itemsToShow: 1,
                    snapAlign: 'start',
                },
            },

        };
    },
    methods: {
        getArchives() {
            axios.get(this.route('getApiCourses')).then(res => {
                console.log(res.data.data)
                this.archives = res.data.data
                this.fetching = false
            });
        },
        submit() {
        },
    },
});
</script>
