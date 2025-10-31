<template>
  <div class="container py-5">
    <div class="row">
      <div class="col-12">
        <h2 class="fs-2 text-center d-flex flex-column align-items-center">

          <span class="fw-normal">Hello {{ $page.props.auth.user.student.first_name }} {{ $page.props.auth.user.student.last_name }}</span>
          <span class="fw-bold text-primary mt-2">{{ __("Set Your Profile") }}</span>
        </h2>
        <!-- <p class="text-center mb-0">Discover The Best Teachers Near You</p> -->
      </div>
      <!-- <breadcrums :breadcrums="breadcrums"></breadcrums> -->
    </div>
  </div>
  <div class="section py-0">

    <div class="container">

      <div class="row g-0 flex-column align-items-center">
        <div class="col-md-12 p-4">
          <div
            class="nav nav-pills student-profile ms-4"
            id="v-pills-tab"
            role="tablist"
            aria-orientation="vertical"
          >
            <li class="nav-item me-4" role="presentation">
              <button
                class="nav-link w-100  fw-bold"
                :class="{active: active_tab == 'general-info'}"
                @click="changeTab('general-info')"
                id="general-info-tab"
                data-bs-toggle="tab"
                data-bs-target="#general-info"
                type="button"
                role="tab"
                aria-controls="general-info"
                aria-selected="true"
              >{{ __('general info') }}</button>
            </li>
            <li class="nav-item" role="presentation">
              <button
                class="nav-link w-100 fw-bold"
                :class="{active: active_tab == 'bookings'}"
                @click="changeTab('bookings')"
                id="bookings-tab"
                data-bs-toggle="tab"
                data-bs-target="#bookings"
                type="button"
                role="tab"
                aria-controls="bookings"
                aria-selected="true"
              >{{ __n('booking') }}</button>
            </li>
        </div>
        </div>
       <div class="row pb-5">
        <div class="col-md-12">
          <!-- Nav tabs -->

          <div class="tab-content w-100 p-md-4" id="v-pills-tabContent">
            <student-general-info :active="active_tab == 'general-info'"></student-general-info>
            <div v-if="active_tab == 'bookings'">
                <record-not-found :active="active_tab == 'bookings'"></record-not-found>
            </div>

          </div>


        </div>
       </div>
      </div>
    </div>
  </div>
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
import { Head, Link } from "@inertiajs/inertia-vue3";
import StudentGeneralInfo from "@/Components/Students/StudentGeneralInfo.vue";
import Breadcrums from "../../Components/Shared/Breadcrums.vue";
import RecordNotFound from "../Shared/RecordNotFound.vue";

export default defineComponent({
  components: {
    Head,
    AuthenticationCard,
    RecordNotFound,
    AuthenticationCardLogo,
    Button,
    Input,
    Checkbox,
    Label,
    AppLayout,
    ValidationErrors,
    Link,
    StudentGeneralInfo,
    Breadcrums
  },

  props: {
    canResetPassword: Boolean,
    status: String
  },
  data() {
    return {
      active_tab: route().params.active_tab ?? "general-info",
      breadcrums:[
                {
                    id:1,
                    name:'Home',
                    link:'/'
                },
                {
                    id:2,
                    name:'Account',
                    link:''
                }
            ]
    };
  },

  methods: {
    changeTab(tab) {
      this.active_tab = tab;
      this.$inertia.replace(route("account"), {
        data: { active_tab: this.active_tab },
        preserveScroll: true
      });
    },
    submit() {}
  }
});
</script>
