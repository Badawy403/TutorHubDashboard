<template>
  <div class="py-5">
    <div class="container">
      <div class="row mb-5">
        <div class="col-12">
          <div class="bg-white shadow">
            <div class="d-flex position-relative">
              <img v-if="$page.props.teacher.cover_image" style="width: 100%; height: 290px" :src='$page.props.teacher.cover_image' alt="image" />
              <img v-else  class="img-fluid" style="width: 100%; height: 290px" src="@/images/common/bg_profile.jpg" alt="image" />

              <!-- <div class="position-absolute end-0">
                <button style="height: 40px; width: 40px;" class="btn p-0 btn-primary rounded-pill m-3">
                  <i class="bi bi-pencil"></i>
                </button>
            </div> -->
            </div>


            <ul class="nav navs nav-pills position-relative fs-5 fw-semibold d-flex justify-content-between mt-3 mx-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">


              <li class="nav-item tabs" role="presentation">
                <button class="nav-link" :class="{ active: active_tab == 'general-info' }"
                  @click="changeTab('general-info')" id="general-info-tab" data-bs-toggle="tab"
                  data-bs-target="#general-info" type="button" role="tab" aria-controls="general-info"
                  aria-selected="true">{{ __('general info') }}</button>
              </li>
              <li class="nav-item tabs " role="presentation" v-if="hasModule('teacher-social-info', 'teacher')">
                <button class="nav-link" :class="{ active: active_tab == 'social-info' }"
                  @click="changeTab('social-info')" id="social-info-tab" data-bs-toggle="tab"
                  data-bs-target="#social-info" type="button" role="tab" aria-controls="social-info"
                  aria-selected="true">{{ __('social info') }}</button>
              </li>
              <!-- v-if="hasModule('test')" -->
              <li class="nav-item tabs" role="presentation" v-if="hasModule('teacher-certifications', 'teacher')">
                <button class="nav-link" :class="{ active: active_tab == 'certifications' }"
                  @click="changeTab('certifications')" id="certifications-tab" data-bs-toggle="tab"
                  data-bs-target="#certifications" type="button" role="tab" aria-controls="certifications"
                  aria-selected="false">{{ __('certifications') }}</button>
              </li>
              <li class="nav-item tabs" role="presentation" v-if="hasModule('teacher-broadcasts', 'teacher')">
                <button class="nav-link" :class="{ active: active_tab == 'broadcasts' }" @click="changeTab('broadcasts')"
                  id="broadcasts-tab" data-bs-toggle="tab" data-bs-target="#broadcasts" type="button" role="tab"
                  aria-controls="broadcasts" aria-selected="false">{{ __n('broadcast') }}</button>
              </li>

              <li class="nav-item tabs " role="presentation" v-if="hasModule('teacher-podcasts', 'teacher')">
                <button class="nav-link" :class="{ active: active_tab == 'podcasts' }" @click="changeTab('podcasts')"
                  id="podcasts-tab" data-bs-toggle="tab" data-bs-target="#podcasts" type="button" role="tab"
                  aria-controls="podcasts" aria-selected="false">{{ __n('podcast') }}</button>
              </li>
              <li class="nav-item tabs " role="presentation">
                <button class="nav-link" :class="{ active: active_tab == 'services' }" @click="changeTab('services')"
                  id="services-tab" data-bs-toggle="tab" data-bs-target="#services" type="button" role="tab"
                  aria-controls="services" aria-selected="false">{{ __n('services') }}</button>
              </li>
               <!-- <li class="nav-item mb-3" role="presentation"
                            v-if="!isSubscriptionEnabled() || hasModule('teacher-services', 'teacher')">
                            <button class="nav-link w-100 text-dark" :class="{ active: active_tab == 'services' }"
                                @click="changeTab('services')" id="services-tab" data-bs-toggle="tab"
                                data-bs-target="#services" type="button" role="tab" aria-controls="services"
                                aria-selected="false">{{ __n('service') }}</button>
                        </li> -->

                <li class="d-flex flex-column profile-img align-items-center">
                <img class="rounded-3 img-fluid" :src="$page.props.teacher.image" width="160" />
                <a :href="route('teacher.my_profile')" class="nav-link text-center" target="_blank">
                <h2 class="text-primary fw-bold mt-2 mb-1 fs-2">{{  $page.props.teacher.first_name }}</h2>
                <h6 class="fs-6  text-secondary fw-semibold mb-0">{{ __($page.props.auth.logged_in_as) }}</h6>
                 </a>
                <!-- <div class="position-absolute start-0 ms-1">
                <button style="height: 30px; width: 30px;" class="btn p-0 btn-primary rounded-pill mt-2 mx-3">
                  <i class="bi bi-pencil"></i>
                </button>
               </div> -->
               </li>
              <li class="nav-item tabs" role="presentation" v-if="hasModule('teacher-events', 'teacher')">
                <button class="nav-link" :class="{ active: active_tab == 'events' }" @click="changeTab('events')"
                  id="events-tab" data-bs-toggle="tab" data-bs-target="#events" type="button" role="tab"
                  aria-controls="events" aria-selected="false">{{ __n('event') }}</button>
              </li>

              <!-- <li class="nav-item" role="presentation">
                <button class="nav-link" :class="{ active: active_tab == 'youtube' }" @click="changeTab('youtube')"
                  id="youtube-tab" data-bs-toggle="tab" data-bs-target="#youtube" type="button" role="tab"
                  aria-controls="youtube" aria-selected="false">{{ __('youtube') }}</button>
              </li> -->
              <!-- <li class="nav-item" role="presentation">
              <button class="nav-link" :class="{ active: active_tab == 'instagram' }"
                @click="changeTab('instagram')" id="instagram-tab" data-bs-toggle="tab" data-bs-target="#instagram"
                type="button" role="tab" aria-controls="instagram" aria-selected="false">{{ __('instagram') }}</button>
            </li> -->
               <li class="nav-item tabs" role="presentation" v-if="hasModule('teacher-calendly', 'teacher')">
                <button class="nav-link" :class="{ active: active_tab == 'calendly' }" @click="changeTab('calendly')"
                  id="calendly-tab" data-bs-toggle="tab" data-bs-target="#calendly" type="button" role="tab"
                  aria-controls="calendly" aria-selected="false">{{ __('calendly') }}</button>
               </li>
               <li class="nav-item tabs" role="presentation" v-if="hasModule('teacher-appointment', 'teacher')">
                <button class="nav-link" :class="{ active: active_tab == 'appointment' }"
                  @click="changeTab('appointment')" id="appointment-tab" data-bs-toggle="tab"
                  data-bs-target="#appointment" type="button" role="tab" aria-controls="appointment"
                  aria-selected="false">{{ __('appointment')
                  }}</button>
               </li>
               <li class="nav-item tabs" role="presentation" v-if="hasModule('teacher-blogs', 'teacher')">
                <button class="nav-link" :class="{ active: active_tab == 'blogs' }" @click="changeTab('blogs')"
                  id="blogs-tab" data-bs-toggle="tab" data-bs-target="#blogs" type="button" role="tab"
                  aria-controls="blogs" aria-selected="false">{{ __n('blog') }}</button>
               </li>
               <li class="nav-item tabs" role="presentation" v-if="hasModule('teacher-archives', 'teacher')">
                  <button class="nav-link" :class="{ active: active_tab == 'archives' }" @click="changeTab('archives')"
                  id="archives-tab" data-bs-toggle="tab" data-bs-target="#archives" type="button" role="tab"
                  aria-controls="archives" aria-selected="false">{{ __n('archive') }}</button>
               </li>

            </ul>
          </div>

        </div>
      </div>

      <div class="row">
        <div class="col-12">
          <!-- v-if="hasModule('test')" -->
          <!-- Tab panes -->
            <div class="tab-content" id="v-pills-tabContent">
            <teacher-general-info v-if="active_tab == 'general-info'"
              :active="active_tab == 'general-info'"></teacher-general-info>
            <teacher-social-info v-if="hasModule('teacher-social-info', 'teacher') && active_tab == 'social-info'"
              :active="active_tab == 'social-info'"></teacher-social-info>
            <teacher-certifications
              v-if="hasModule('teacher-certifications', 'teacher') && active_tab == 'certifications'"
              :active="active_tab == 'certifications'"></teacher-certifications>
            <teacher-broadcasts v-if="hasModule('teacher-broadcasts', 'teacher') && active_tab == 'broadcasts'"
              :active="active_tab == 'broadcasts'"></teacher-broadcasts>
            <teacher-podcasts v-if="hasModule('teacher-podcasts', 'teacher') && active_tab == 'podcasts'"
              :active="active_tab == 'podcasts'"></teacher-podcasts>
               <!-- <teacher-services
                            v-if="!isSubscriptionEnabled() || hasModule('teacher-services', 'teacher') && active_tab == 'services'"
                            :active="active_tab == 'services'"></-services> -->
                            <teacher-services

:active="active_tab == 'services'"></teacher-services>
            <teacher-events v-if="hasModule('teacher-events', 'teacher') && active_tab == 'events'"
              :active="active_tab == 'events'"></teacher-events>
            <teacher-products v-if="hasModule('teacher-products', 'teacher') && active_tab == 'products'"
              :active="active_tab == 'products'"></teacher-products>
            <teacher-youtube v-if="active_tab == 'youtube'" :active="active_tab == 'youtube'"></teacher-youtube>
            <teacher-instagram v-if="active_tab == 'instagram'" :active="active_tab == 'instagram'"></teacher-instagram>
            <teacher-calendly v-if="hasModule('teacher-calendly', 'teacher') && active_tab == 'calendly'"
              :active="active_tab == 'calendly'"></teacher-calendly>
            <teacher-appointment v-if="hasModule('teacher-appointment', 'teacher') && active_tab == 'appointment'"
              :active="active_tab == 'appointment'"></teacher-appointment>
            <teacher-posts v-if="hasModule('teacher-blogs', 'teacher') && active_tab == 'blogs'"
              :active="active_tab == 'blogs'"></teacher-posts>
            <teacher-archives v-if="hasModule('teacher-archives', 'teacher') && active_tab == 'archives'"
              :active="active_tab == 'archives'"></teacher-archives>
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
import TeacherGeneralInfo from "@/Components/Teachers/TeacherGeneralInfo.vue";
import TeacherSocialInfo from "@/Components/Teachers/TeacherSocialInfo.vue";
import TeacherBroadcasts from "@/Components/Teachers/Broadcasts/TeacherBroadcasts.vue";
import TeacherPodcasts from "@/Components/Teachers/Podcasts/TeacherPodcasts.vue";
import TeacherEvents from "@/Components/Teachers/Events/TeacherEvents.vue";
import TeacherPosts from "@/Components/Teachers/Posts/TeacherPosts.vue";
import TeacherProducts from "@/Components/Teachers/TeacherProducts.vue";
import TeacherYoutube from "@/Components/Teachers/TeacherYoutube.vue";
import TeacherInstagram from "@/Components/Teachers/TeacherInstagram.vue";
import TeacherCalendly from "@/Components/Teachers/TeacherCalendly.vue";
import TeacherAppointment from "@/Components/Teachers/Appointments/TeacherAppointment.vue";
import TeacherCertifications from "@/Components/Teachers/Certifications/TeacherCertifications.vue";
import Breadcrums from "../../Components/Shared/Breadcrums.vue";
import TeacherServices from "@/Components/Teachers/Services/TeacherServices.vue";


import TeacherArchives from "@/Components/Teachers/Archives/TeacherArchives.vue";

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
    Link,
    TeacherGeneralInfo,
    TeacherSocialInfo,
    TeacherBroadcasts,
    TeacherPodcasts,
    TeacherEvents,
    TeacherProducts,
    TeacherPosts,
    TeacherArchives,
    TeacherYoutube,
    TeacherInstagram,
    TeacherCalendly,
    TeacherAppointment,
    TeacherCertifications,
    Breadcrums,
    TeacherServices
  },

  data() {
    return {
      active_tab: route().params.active_tab ?? "general-info",
      breadcrums: [
        {
          id: 1,
          name: 'Home',
          link: '/'
        },
        {
          id: 2,
          name: 'Account',
          link: ''
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
    submit() { }
  }
});
</script>
