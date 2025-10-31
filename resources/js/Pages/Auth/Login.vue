<template>
  <guest-layout>

      <div class="container">
        <div class="row pt-6">
          <div class="col-12">
            <div class="row mb-2">
              <div class="col-12">
               <Link :href="route('home')"><span class="d-flex justify-content-center"><img src="@/images/icons/tutorhub.png" class="mb-4" alt="" style="width: 250px;"></span></Link>
                <img
                  class="image-fluid img my-2 mx-auto d-block"
                  src="@/images/auth/login.png"
                  width="170"
                />
                <h1 class="text-center text-primary fw-bold">
                 {{ __('welcome back!') }} {{ __("login") }}
                </h1>
                <p class="text-center fs-5 fw-semibold text-secondary">
                  Our team of highly skilled attorneys comprises seasoned
                  professionals <br />with extensive experience in their
                  respective fields.
                </p>
              </div>
            </div>
            <div class="row justify-content-center">
              <div class="col-md-6">
                <div class="card bg-transparent">
                  <div class="card-body">
                    <student-login
                      :active="tab == 'user'"
                      :redirectUrl="redirect_url"
                    ></student-login>
                  </div>
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
import AuthenticationCard from "@/Components/AuthenticationCard.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import AuthenticationCardLogo from "@/Components/AuthenticationCardLogo.vue";
import Button from "@/Components/Button.vue";
import Input from "@/Components/Input.vue";
import Checkbox from "@/Components/Checkbox.vue";
import Label from "@/Components/Label.vue";
import ValidationErrors from "@/Components/ValidationErrors.vue";
import StudentLogin from "@/Components/Students/StudentLogin.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import { Carousel, Navigation, Pagination, Slide } from "vue3-carousel";
import { ref } from "vue";
export default defineComponent({
  components: {
    Head,
    AuthenticationCard,
    AuthenticationCardLogo,
    Button,
    Input,
    Checkbox,
    Label,
    AppLayout,
    ValidationErrors,
    StudentLogin,
    GuestLayout,
    Link,
    Carousel,
    Slide,
    Pagination,
    Navigation,
  },

  props: {
    canResetPassword: Boolean,
    status: String,
    redirect_url: String,
  },

  data() {
    return {
      currentSlide: 0,
      tab: route().params.tab ?? "user",
      settings: {
        itemsToShow: 1,
        snapAlign: "center",
        autoplay: false,
        wrapAround: "true",
      },
      // breakpoints are mobile first
      // any settings not specified will fallback to the carousel settings
      breakpoints: {
        // 1024 and up
        1024: {
          itemsToShow: 1,
          snapAlign: "center",
        },
      },
    };
  },

  methods: {
    changeTab(tab, val) {
      this.tab = tab;
      this.$inertia.replace(route("login"), {
        data: { tab: this.tab },
        preserveScroll: true,
      });
      this.slideTo(val);
    },
    slideTo(val) {
      this.currentSlide = val;
    },
  },
});
</script>
