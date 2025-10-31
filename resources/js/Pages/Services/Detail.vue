<template>
    <app-layout title="Quick by Services">
        <section class="quickbyservices">
            <div class="py-5">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="d-flex align-items-center flex-column">
                                <div class="avatar overflow-hidden mb-3 rounded-lg bg-light">
                                    <img class="w-100" v-if='service.image' :src="service.image" alt="ServiceImage">
                                    <img v-else style="width: 100%;" src="@/images/common/avatar.png" alt="Avatar">
                                </div>
                                <div v-if="service.teacher">
                                    <p>Service by:
                                        <span class="fw-bold">{{ service.teacher.name }}</span>
                                    </p>
                                    <!-- <Link :href="route('teacher.profile', { user_name: service.teacher.user_name })" class="btn rounded-pill btn-primary">
                                        View Profile
                                    </Link> -->
                                </div>
                                <div v-if="service.academy">
                                    <p>service by:
                                        <span class="fw-bold">{{ service.academy.name }}</span>
                                    </p>
                                    <Link :href="route('academy.profile', { user_name: service.academy.user_name })" class="btn rounded-pill btn-primary">
                                        View Profile
                                    </Link>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="d-flex align-items-start justify-content-center flex-column px-md-4 px-2">
                                <h3 style="font-size: 30px;">{{ service.name }}</h3>
                                <p v-html="service.description">
                                </p>

                                <div class="d-flex flex-md-row flex-column rounded-4 w-100 p-1 py-2 py-md-1 mb-4 justify-content-between align-items-md-center align-items-start bg-warning">
                                    <span class="px-2 mb-2 mb-md-0">Legal Consultation Fees {{ getDisplayAmount(service.price) }}</span>
                                    <Link :href="route('book_service_display',{service:service.slug})" class="btn btn-primary fw-bold px-4 me-1">buy now</Link>
                                </div>

                                <div class="d-flex w-100 justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <span class="me-2 d-flex">
                                            <span class="overflow-hidden d-flex border border-light rounded-circle" style="height: 40px; width: 40px; margin-right: -30px;"><img src="@/images/common/lock.png" alt="Image"></span>
                                            <span class="overflow-hidden d-flex border border-light rounded-circle" style="height: 40px; width: 40px;"><img src="@/images/common/lock.png" alt="Image"></span>
                                        </span>
                                        <span>{{ service.booked_services_count }} people purchased</span>
                                    </div>
                                    <div
                                        class="d-flex align-items-center justify-content-center mb-2"
                                        >
                                        <star-rating
                                            :rating="service.rating"
                                            :star-size="18"
                                            :read-only="true"
                                            :increment="0.01"
                                            :show-rating="false"
                                        ></star-rating>
                                        <span class="text-dark small mt-1 ps-1">
                                            ({{ service.rating }}/5)</span
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="py-5">
                <div class="container">
                    <div class="row">
                        <div class="col-12 mb-4">
                            <h4 class="text-center">How to buy this services</h4>
                            <h2 class="text-center">How it works?</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card mb-3 mb-md-0 rounded-lg">
                                <div class="card-body">
                                    <div class="d-flex align-items-center flex-column justify-content-center">
                                        <div class="mb-3">
                                            <img src="@/images/icons/self-service.png" alt="Icon">
                                        </div>
                                        <h5>Choose a Service</h5>
                                        <p class="text-center mb-0" style="font-size: 14px;">Lorem ipsum dolor sit amet,
                                            consectetur adipiscing elit,</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mb-3 mb-md-0 rounded-lg">
                                <div class="card-body">
                                    <div class="d-flex align-items-center flex-column justify-content-center">
                                        <div class="mb-3">
                                            <img src="@/images/icons/exam.png" alt="Icon">
                                        </div>
                                        <h5>Fill a Form</h5>
                                        <p class="text-center mb-0" style="font-size: 14px;">Lorem ipsum dolor sit amet,
                                            consectetur adipiscing elit,</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mb-3 mb-md-0 rounded-lg">
                                <div class="card-body">
                                    <div class="d-flex align-items-center flex-column justify-content-center">
                                        <div class="mb-3">
                                            <img src="@/images/icons/income.png" alt="Icon">
                                        </div>
                                        <h5>Make a Payment</h5>
                                        <p class="text-center mb-0" style="font-size: 14px;">Lorem ipsum dolor sit amet,
                                            consectetur adipiscing elit,</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="py-5" v-if="service.teacher">
                <div class="container">
                    <div class="row align-items-center">
                         <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-7">
                            <h2 class="mb-4">{{ service.teacher.name }}</h2>
                            <p v-html="service.teacher.description"></p>
                           </div>
                        <div class="col-md-5 text-md-end">
                            <img v-if="service.teacher.image" :src="service.teacher.image" class="rounded-4 w-50" alt="Image">
                            <img v-else src="@/images/sale-services.png" class="rounded-4"/>
                        </div>
                            </div>
                         </div>
                    </div>
                </div>
            </div>
            <div class="py-5" v-if="service.academy">
                <div class="container">
                    <div class="row">
                        <div class="col-md-7">
                            <h2>{{ service.academy.name }}</h2>
                            <p v-html="service.academy.description"></p>
                        </div>
                        <div class="col-md-5 text-end">
                            <img v-if="service.academy.image" :src="service.academy.image" class="rounded-4" alt="Image">
                            <img v-else src="@/images/sale-services.png" class="rounded-4" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="py-5" v-if="service.faqs.length > 0">
                <div class="container">
                    <div class="row">
                        <div class="text-center text-dark col-12 mb-5">
                            <h4 >Related this services</h4>
                            <h2 >Answer Questions</h2>
                        </div>
                        <div class="col-md-12">
                            <div class="accordion" id="accordionFlushExample">
                            <div class="accordion-item border-0 mb-3" v-for="faq in service.faqs" :key="faq.id">
                                <h2 class="accordion-header" >
                                    <button class="accordion-button bg-white rounded-4 collapsed" type="button"
                                        data-bs-toggle="collapse"  :data-bs-target="'#flush-collapse-'+faq.id"
                                            aria-expanded="false" :aria-controls="'flush-collapse-'+faq.id">
                                        <div
                                            class="d-flex w-100 flex-column flex-lg-row align-items-lg-center justify-content-between px-3">
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-question-octagon me-3 fs-3"></i>
                                                <span>{{ faq.question }}</span>
                                            </div>

                                        </div>
                                    </button>
                                </h2>
                                <div :id="'flush-collapse-'+faq.id" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <div class="px-3 text-black">{{faq.answer}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="py-5" v-if="service.reviews.length > 0">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <Carousel :settings="settings" :breakpoints="breakpoints">
                                <Slide v-for="review in service.reviews" :key="review.id">
                                    <div class="row align-items-center">
                                        <div class="col-lg-6">
                                            <h4 class="text-start">About our services</h4>
                                            <h2 class="text-start">Students Says</h2>

                                            <i class="my-4 text-start d-block">{{ review.comment }}</i>

                                            <h4 class="mb-0 text-start fw-bold">{{ review.student.name }}</h4>
                                            <p class="text-start">Category Name</p>
                                        </div>
                                        <div class="col-lg-6">
                                            <img style="width: 100%;" :src="review.student.image" alt="Image">
                                        </div>
                                    </div>
                                </Slide>
                            </Carousel>
                        </div>
                    </div>

                </div>
            </div>
            <div class="py-5" v-if="related_services.length > 0">
                <div class="container">
                    <div class="row">
                        <div class="col-12 mb-5">
                            <h4 class="text-center">You can check similar services</h4>
                            <!-- <h2 class="text-center">Check out other {{ service_category.name ?? "" }}</h2> -->
                        </div>

                        <div class="col-md-4" v-for="related_service in related_services" :key="related_service.id">
                            <div class="card rounded-lg">
                                <div class="card-body">
                                    <div class="avatar mb-3 rounded-lg overflow-hidden">
                                        <img v-if="related_service.image" style="width: 100%;" :src="related_service.image" alt="Image">
                                        <img v-else style="width: 100%;" src="@/images/property-s.png" alt="Image">
                                    </div>
                                    <div class="d-flex flex-column">
                                        <h5 style="font-size: 18px;">{{ related_service.name }}</h5>
                                        <p class="d-flex align-items-center justify-content-between mb-0">
                                            <span>Starting from ${{ related_service.price }}</span>
                                            <Link :href="route('services.detail',{'slug':related_service.slug})">
                                                <img style="width: 25px;" src="@/images/arrow.png" alt="Image">
                                            </Link>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </app-layout>
</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import Navbar from "@/Layouts/AppIncludes/Navbar.vue";
import PageHeader from "@/Components/PageHeader.vue";
import Breadcrums from "../../Components/Shared/Breadcrums.vue";
import { Carousel, Navigation, Pagination, Slide } from "vue3-carousel";
import { Link } from "@inertiajs/inertia-vue3";

export default defineComponent({
  components: {
    AppLayout,
    Navbar,
    PageHeader,
    Breadcrums,
    Carousel,
    Navigation,
    Pagination,
    Slide,
    Link
  },
  props: ["service","related_services","service_category"],
  created() {},
  data() {
    return {
        faqs: [],
        // carousel settings
        settings: {
            itemsToShow: 1,
            snapAlign: "start",
        },
        // breakpoints are mobile first
        // any settings not specified will fallback to the carousel settings
        breakpoints: {
            // 700px and up
            700: {
                itemsToShow: 1,
                snapAlign: "start",
            },
            // 1024 and up
            1024: {
                itemsToShow: 1,
                snapAlign: "start",
            },
        },
      posts: {},
      breadcrums: [
        {
          id: 1,
          name :this.__('home'),
          link: "/",
        },
        {
          id: 2,
         name :this.__('service'),
          link: "",
        },
      ],
    };
  },
});
</script>
