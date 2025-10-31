<template>
    <app-layout title="Quick by Services">
        <section class="quickbyservices">
            <div class="py-5" style="background-color: #fef3db;">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="d-flex align-items-center flex-column">
                                <div class="avatar overflow-hidden mb-3 rounded-lg bg-light">
                                    <img style="width: 100%;" src="@/images/common/avatar.png" alt="Avatar">
                                </div>
                                <p>service by: <span class="fw-bold">John Doe</span></p>
                                <button class="btn rounded-pill btn-primary">View Profile</button>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="d-flex align-items-start justify-content-center flex-column px-4">
                                <h3 style="font-size: 30px;">Sale deed drafting for your property</h3>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices
                                    gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis.
                                </p>

                                <div class="d-flex rounded w-100 p-1 mb-4 justify-content-between align-items-center"
                                    style="background-color: #fee8ba;">
                                    <span class="px-2">Legal Consultation fees $50,000</span>
                                    <button class="btn btn-primary">buy now</button>
                                </div>

                                <div class="d-flex w-100 justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <span class="me-2 d-flex">
                                            <span class="overflow-hidden d-flex border border-light rounded-circle" style="height: 40px; width: 40px; margin-right: -30px;"><img src="@/images/lock.png" alt="Image"></span>
                                            <span class="overflow-hidden d-flex border border-light rounded-circle" style="height: 40px; width: 40px;"><img src="@/images/lock.png" alt="Image"></span>
                                        </span>
                                        <span>1500 people purchased</span>
                                    </div>
                                    <div
                                        class="d-flex align-items-center justify-content-center mb-2"
                                        >
                                        <star-rating
                                            :rating="2"
                                            :star-size="18"
                                            :read-only="true"
                                            :increment="0.01"
                                            :show-rating="false"
                                        ></star-rating>
                                        <span class="text-dark small mt-1 ps-1">
                                            ({{ '3.0' }}/5)</span
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
                            <div class="card rounded-lg">
                                <div class="card-body">
                                    <div class="d-flex align-items-center flex-column justify-content-center">
                                        <div class="mb-3">
                                            <img src="@/images/person.png" alt="Icon">
                                        </div>
                                        <h5>choose a service</h5>
                                        <p class="text-center mb-0" style="font-size: 14px;">Lorem ipsum dolor sit amet,
                                            consectetur adipiscing elit,</p>
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
                        <div class="col-md-7">
                            <h2>SALE DEED DRAFTING <br>for your property</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                                ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipiscing
                                elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum
                                dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                                et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                                eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet,
                                consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
                                aliqua.</p>
                        </div>
                        <div class="col-md-5">
                            <img src="@/images/sale-services.png" alt="Image">
                        </div>
                    </div>
                </div>
            </div>

            <div class="py-5" style="background-image: url('@/images/queries-bg.png'); background-color: black;">
                <div class="container">
                    <div class="row">
                        <div class="col-12 mb-5">
                            <h4 class="text-white text-center">Related this services</h4>
                            <h2 class="text-white text-center">Answer Questions</h2>
                        </div>
                        <div class="col-md-12">
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                <div class="accordion-item mb-2">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button justify-content-between collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                                            aria-expanded="false" aria-controls="flush-collapseOne">
                                            <span>
                                                <img style="width: 25px;" src="@/images/chat-q.png" alt="Image">
                                                <span class="ms-3">2023 De qué manera avisa un cliente que está interesado en ...</span>
                                            </span>

                                            <span>
                                                <span class="text-muted me-3">16293 total</span>
                                                <i class="bi bi-eye-fill"></i>
                                            </span>
                                        </button>
                                    </h2>
                                    <div id="flush-collapseOne" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">Placeholder content for this accordion, which is
                                            intended to demonstrate the <code>.accordion-flush</code> class. This is the
                                            first item's accordion body.</div>
                                    </div>
                                </div>
                                <div class="accordion-item mb-2">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button justify-content-between collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo"
                                            aria-expanded="false" aria-controls="flush-collapseTwo">
                                            <span>
                                                <img style="width: 25px;" src="@/images/chat-q.png" alt="Image">
                                                <span class="ms-3">2023 De qué manera avisa un cliente que está interesado en ...</span>
                                            </span>

                                            <span>
                                                <span class="text-muted me-3">16293 total</span>
                                                <i class="bi bi-eye-fill"></i>
                                            </span>
                                        </button>
                                    </h2>
                                    <div id="flush-collapseTwo" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">Placeholder content for this accordion, which is
                                            intended to demonstrate the <code>.accordion-flush</code> class. This is the
                                            second item's accordion body. Let's imagine this being filled with some
                                            actual content.</div>
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
                        <div class="col-12">
                            <Carousel :settings="settings" :breakpoints="breakpoints">
                                <Slide key="1">
                                    <div class="row align-items-center">
                                        <div class="col-lg-6">
                                            <h4 class="text-start">About our services</h4>
                                            <h2 class="text-start">Student Says</h2>

                                            <i class="my-4 text-start d-block">"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. "</i>

                                            <h4 class="mb-0 text-start fw-bold">Jhon Doe</h4>
                                            <p class="text-start">Category Name</p>
                                        </div>
                                        <div class="col-lg-6">
                                            <img style="width: 100%;" src="@/images/rating.png" alt="Image">
                                        </div>
                                    </div>
                                </Slide>
                                <Slide key="2">
                                    <div class="row align-items-center">
                                        <div class="col-lg-6">
                                            <h4 class="text-start">About our services</h4>
                                            <h2 class="text-start">Student Says</h2>

                                            <i class="my-4 text-start d-block">"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. "</i>

                                            <h4 class="mb-0 text-start fw-bold">Jhon Doe</h4>
                                            <p class="text-start">Category Name</p>
                                        </div>
                                        <div class="col-lg-6">
                                            <img style="width: 100%;" src="@/images/rating.png" alt="Image">
                                        </div>
                                    </div>
                                </Slide>
                            </Carousel>
                        </div>
                    </div>

                </div>
            </div>
            <div class="py-5">
                <div class="container">
                    <div class="row">
                        <div class="col-12 mb-5">
                            <h4 class="text-center">You can check similar services</h4>
                            <h2 class="text-center">Check out other Property Services</h2>
                        </div>

                        <div class="col-md-4">
                            <div class="card rounded-lg">
                                <div class="card-body">
                                    <div class="avatar mb-3 rounded-lg overflow-hidden">
                                        <img style="width: 100%;" src="@/images/property-s.png" alt="Image">
                                    </div>
                                    <div class="d-flex flex-column">
                                        <h5 style="font-size: 18px;">Legal Consultant</h5>
                                        <p class="d-flex align-items-center justify-content-between mb-0">
                                            <span>Starting from $10.99</span>
                                            <a href="#">
                                                <img style="width: 25px;" src="@/images/arrow.png" alt="Image">
                                            </a>
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
import { Head, Link } from "@inertiajs/inertia-vue3";
import { Carousel, Navigation, Pagination, Slide } from "vue3-carousel";
import AppLayout from "@/Layouts/AppLayout.vue";
import Navbar from "@/Layouts/AppIncludes/Navbar.vue";

export default defineComponent({
    components: {
        Head,
        Link,
        Carousel,
        Slide,
        Pagination,
        Navigation,
        AppLayout,
        Navbar,
    },
    created() {

    },
    data: () => ({
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
    }),

    methods: {

    },
});
</script>
