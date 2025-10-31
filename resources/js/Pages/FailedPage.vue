<template>
    <app-layout title="My Profile">
        <template #header> </template>
        <div class="thank-you-section mt-2">
            <div class="p-3 mb-2 rounded-lg bg-primary-light">
                <div class="row align-items-center">
                    <div class="col-12 p-4 text-center">
                        <!-- <i class="bi bi-envelope fs-1"></i> -->
                        <h1 class="text-danger ">Oops!</h1>
                        <p class="fs-4 mb-0 fw-bold">{{ __("We really appreciate you giving us a moment of your time today but unfortunately the payment was unsuccessful due to it seems some issue in server to server communication. Kindly connect with administrator¸") }}</p>
                        <p class="fs-4 mb-0">
                            {{ __("For Your Payment") }}
                        </p>
                        <!-- <p class="fs-4 mb-0">
                            {{ __("Appointment No") }} {{ bookedAppointmentDetail.id }}
                        </p> -->
                        <p class="fs-4 mb-0">
                            {{ __("Payment Status") }}
                            Failed:
                        </p>
                    </div>
                    <div class="mt-2 text-center">
                <!-- <p class="fs-4 mb-0 fw-bold">Video Call starts in</p> -->
                <!-- <p class="fs-2 text-primary">00:52</p> -->
                <Link :href="route('home')" class="btn btn-primary">
                <span class="circle" aria-hidden="true">
                    <span class="icon arrow"></span>
                </span>
                <span class="button-text">{{ __("Back To Home") }}</span>
                </Link>
            </div>
                </div>
            </div>


        </div>
    </app-layout>
</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/inertia-vue3";

export default defineComponent({
    components: {
        AppLayout,
        Link,
    },
});
</script>

<style></style>
