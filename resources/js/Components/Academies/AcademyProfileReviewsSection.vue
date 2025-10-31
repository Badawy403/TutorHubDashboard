<template>
    <div class="section py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <h2 class="text-primary text-capitalize fw-bold">{{ __('rating and reviews') }}</h2>
                        <Link :href="route('academy.reviews', { user_name: academy.user_name })" class="btn btn-outline-primary fw-medium">
                        <span>{{ __('view all') }}</span>
                        </Link>
                    </div>
                </div>

                <div class="col-12 mb-5">
                    <div class="row align-items-center">
                        <div class="col-md-7">
                            <div class="row align-items-center">
                                <div class="col-md-5">
                                    <div class="rating fs-3 text-warning" v-if="academy.rating > 0">
                                        <h2 class="display-3 mb-0 lh-1 text-primary">{{ academy.rating }}/5</h2>
                                        <star-rating :rating="academy.rating" :star-size="25" :read-only="true"
                                            :increment="0.01" :show-rating="false"></star-rating>
                                    </div>

                                </div>
                                    <ul class="user-rating p-0">
                                    <li class="list-unstyled" v-for="(rating, i) in rating_group_keys" :key="i">
                                        <div class="rating mt-2 ms-3">
                                            <star-rating :rating="rating" :star-size="18" :read-only="true"
                                                :increment="0.01" :show-rating="false"></star-rating>
                                        </div>
                                        <div class="d-flex mx-2 align-items-center">
                                        <div style="width: 40%;" class="progress mt-2" role="progressbar" aria-label="rating-bar"
                                            :aria-valuenow="rating" aria-valuemin="0" aria-valuemax="2">
                                            <div class="progress-bar bg-primary"
                                                :style="{ 'width': rating * 5 + '%' }">
                                        </div>
                                        </div>
                                        <span class="mt-2 ms-2 fw-bold fs-3">{{ rating_groups[rating].length }}</span>
                                        </div>

                                    </li>
                                </ul>
                                </div>
                        </div>
                        <div v-if="$page.props.auth && $page.props.auth.user.email_verified_at && $page.props.auth.logged_in_as == 'student'"
                            class="col-md-5 d-flex justify-content-end">
                            <button class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#RatingModal">{{ __('write a review') }}</button>
                        </div>
                        <!-- <div v-else class="col-md-5 d-flex justify-content-end">
                                <Link :href="route('login')" class="btn btn-primary text-white border-0" >{{ __('write a review') }}</Link>
                            </div> -->
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row" v-if="reviews.length > 0">
                        <Carousel :items-to-show="4" ref="carousel" v-model="currentSlide">
                            <Slide v-for="review in reviews" :key="review.id">
                                <academy-review-card :review="review"></academy-review-card>
                            </Slide>
                            <template #addons>
                                <Navigation />
                            </template>
                        </Carousel>
                    </div>
                    <div v-else class="row">
                        <div class="col-12 text-center">
                            <h4 class="text-capitalize">{{ __('no review found') }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <add-review-modal :academy_id="academy_id"></add-review-modal>
    </div>
</template>
<script>
import { defineComponent } from "vue";
import { Link } from "@inertiajs/inertia-vue3";
import AcademyReviewCard from "@/Components/Academies/AcademyReviewCard.vue";
import AddReviewModal from "@/Components/Academies/AddReviewModal.vue";
import axios from "axios";
import { Carousel, Navigation, Pagination, Slide } from 'vue3-carousel';

export default defineComponent({
    components: {
        AcademyReviewCard,
        AddReviewModal,
        Link,
        Carousel,
        Slide,
        Pagination,
        Navigation
    },
    created() {
        // group by rating
        this.rating_groups = this.reviews.reduce((x, y) => {
            (x[y.rating] = x[y.rating] || []).push(y);
            return x;
        }, {});

        this.rating_group_keys = Object.keys(this.rating_groups).sort((a, b) => b.localeCompare(a));

    },
    props: ['reviews', 'academy', 'academy_id'],
    data() {
        return {
            rating_groups: [],
            rating_group_keys: [],
            form: this.$inertia.form({
            }),
            featured_academies: [],
            settings: {
                itemsToShow: 4,
                snapAlign: 'start',
            },
            // breakpoints are mobile first
            // any settings not specified will fallback to the carousel settings
            breakpoints: {
                // 700px and up
                700: {
                    itemsToShow: 4,
                    snapAlign: 'start',
                },
                // 1024 and up
                1024: {
                    itemsToShow: 4,
                    snapAlign: 'start',
                },
            },
        };
    },
    methods: {
        submit() {
        },

        next() {
            this.$refs.carousel.next()
        },
        prev() {
            this.$refs.carousel.prev()
        },
    },
});
</script>

