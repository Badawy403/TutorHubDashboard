<template>
    <guest-layout>
        <div class="auth pt-6">
            <div class="container">
                <div class="row mb-2">
                    <div class="col-12 text-center">

                     <Link :href="route('home')"><img src="@/images/icons/tutorhub.png" class="mb-4" alt="" style="width: 250px;"></Link>
                        <h1 class="display-2 text-primary fw-bold">{{ __('Choose An Account Type') }}</h1>
                        <p class="text-center"></p>
                    </div>

                </div>
                <!-- <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="card w-75 h-100 text-decoration-none text-body" @click="selectRole('teacher')">
                                    <div class="card-body">
                                        <div class="text-center">
                                            <img class="img-fluid" src="@/images/auth/teacher.png" alt="Image" width="180">
                                        </div>
                                        <h4 class="fw-bold text-center">Tutor Account</h4>
                                        <p class="text-center fs-6">Our team of highly skilled attorneys comprises seasoned professionals with extensive experience in their respective fields. </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card w-75 h-100 text-decoration-none text-body"  @click="selectRole('student')">
                                    <div class="card-body">
                                        <div class="text-center">
                                            <img class="img-fluid" src="@/images/auth/student.png" alt="Image" width="140">
                                        </div>
                                        <h4 class="fw-bold text-center">Student Account</h4>
                                        <p class="text-center fs-6">Our team of highly skilled attorneys comprises seasoned professionals with extensive experience in their respective fields. </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="card w-75 h-100 text-decoration-none text-body"  @click="selectRole('academy')">
                                    <div class="card-body">
                                        <div class="text-center ">
                                            <img class="img-fluid" src="@/images/auth/acadmy.png" alt="Image" width="140">
                                        </div>
                                        <h4 class="fw-bold text-center">Academy Account</h4>
                                        <p class="text-center fs-6">Our team of highly skilled attorneys comprises seasoned professionals with extensive experience in their respective fields. </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">

                                <Link :href="route('login')" class="card w-75 h-100 text-decoration-none text-body">
                                    <div class="card-body">
                                        <div class="text-center">
                                            <img class="img-fluid" src="@/images/auth/login.png" alt="Image" width="140">
                                        </div>
                                        <h4 class="fw-bold text-center">{{ __('login') }}</h4>
                                        <p class="text-center fs-6">Already have an account?<br> click here to log in </p>
                                    </div>
                                </Link>
                            </div>
                        </div>
                    </div>
                </div> -->

                <div class="row justify-content-center">

                    <div class="col-md-5">

                    <div class="row">
                    <div class=" col-lg-6 mb-4">
                        <div class="card text-center py-1 shadow"  @click="selectRole('teacher')">
                        <div class="text-center">
                            <img class="img-fluid" src="@/images/auth/teacher.png" alt="Image" width="160">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title fw-bold">{{ __("tutor account") }}</h5>
                            <p class="card-text fs-6">Our team of highly skilled attorneys comprises seasoned professionals with extensive experience in their respective fields.</p>
                        </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <div class="card text-center py-1 shadow" @click="selectRole('student')">
                            <div class="text-center">
                            <img class="img-fluid" src="@/images/auth/student.png" alt="Image" width="120">
                            </div>
                        <div class="card-body">
                            <h5 class="card-title fw-bold">{{ __("student account") }}</h5>
                            <p class="card-text fs-6">Our team of highly skilled attorneys comprises seasoned professionals with extensive experience in their respective fields.</p>
                        </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <div class="card text-center py-1 shadow" @click="selectRole('academy')">
                            <div class="text-center">
                            <img class="img-fluid" src="@/images/auth/acadmy.png" alt="Image" width="100">
                            </div>
                        <div class="card-body">
                            <h5 class="card-title fw-bold">{{ __("academy account") }}</h5>
                            <p class="card-text fs-6">Our team of highly skilled attorneys comprises seasoned professionals with extensive experience in their respective fields.</p>
                        </div>
                        </div>
                    </div>
                    <div class="col-lg-6  mb-4">
                        <Link :href="route('login')" class=" text-decoration-none text-body">
                        <div class="card text-center pt-2 shadow">
                            <div class="text-center">
                            <img class="img-fluid" src="@/images/auth/login.png" alt="Image" width="100">
                            </div>
                        <div class="card-body">
                            <h5 class="card-title fw-bold">{{ __('login') }}</h5>
                            <p class="card-text fs-6">{{ __("already have an account?") }}<br>{{ __("click here to log in") }}</p>
                        </div>
                        </div>
                    </Link>
                    </div>
                    </div>

                    </div>

                </div>
            </div>
        </div>

    </guest-layout>
</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import Button from "@/Components/Button.vue";
import Input from "@/Components/Input.vue";
import Checkbox from "@/Components/Checkbox.vue";
import Label from "@/Components/Label.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";

export default defineComponent({
    components: {
        Head,
        Button,
        Input,
        Checkbox,
        Label,
        AppLayout,
        GuestLayout,
        Link,
    },

    props: {

    },

    data() {
        return {

        };
    },

    methods: {
        selectRole(role)
        {
            this.$emit('selectRole',role)
        }
    }

});
</script>
