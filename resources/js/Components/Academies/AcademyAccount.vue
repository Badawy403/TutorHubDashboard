<template>
  <div class="py-5">
    <div class="container">
      <div class="row mb-5">
        <div class="col-12">
          <div class="bg-white shadow">
            <div class="d-flex position-relative">
              <img
                v-if="$page.props.academy.cover_image"
                class="img-fluid"
                :src="$page.props.academy.cover_image"
                alt="image"
                style="width: 100%; height: 290px"
              />
              <img
                v-else
                class="img-fluid"
                src="@/images/common/bg_profile.jpg"
                alt="image"
                style="width: 100%; height: 290px"
              />

              <!-- <div class="position-absolute end-0">
                <button
                  style="height: 40px; width: 40px"
                  class="btn p-0 btn-primary rounded-pill m-3"
                >
                  <i class="bi bi-pencil"></i>
                </button>
              </div> -->
            </div>

            <ul
              class="nav navs nav-pills position-relative fs-5 fw-semibold d-flex justify-content-between mt-3 mx-3"
              id="v-pills-tab"
              role="tablist"
              aria-orientation="vertical"
            >
              <li class="nav-item tabs" role="presentation">
                <button
                  class="nav-link"
                  :class="{ active: active_tab == 'general-info' }"
                  @click="changeTab('general-info')"
                  id="general-info-tab"
                  data-bs-toggle="tab"
                  data-bs-target="#general-info"
                  type="button"
                  role="tab"
                  aria-controls="general-info"
                  aria-selected="true"
                >
                  {{ __("general info") }}
                </button>
              </li>
              <li
                class="nav-item tabs"
                role="presentation"
                v-if="hasModule('academy-social-info', 'academy')"
              >
                <button
                  class="nav-link"
                  :class="{ active: active_tab == 'social-info' }"
                  @click="changeTab('social-info')"
                  id="social-info-tab"
                  data-bs-toggle="tab"
                  data-bs-target="#socialInfo"
                  type="button"
                  role="tab"
                  aria-controls="social-info"
                  aria-selected="false"
                >
                  {{ __("social info") }}
                </button>
              </li>
              <!-- v-if="hasModule('test')" -->
              <li
                class="nav-item tabs"
                role="presentation"
                v-if="hasModule('academy-certifications', 'academy')"
              >
                <button
                  class="nav-link"
                  :class="{ active: active_tab == 'certifications' }"
                  @click="changeTab('certifications')"
                  id="certifications-tab"
                  data-bs-toggle="tab"
                  data-bs-target="#certifications"
                  type="button"
                  role="tab"
                  aria-controls="certifications"
                  aria-selected="false"
                >
                  {{ __("certifications") }}
                </button>
              </li>

              <li
                class="nav-item tabs"
                role="presentation"
                v-if="hasModule('academy-broadcasts', 'academy')"
              >
                <button
                  class="nav-link"
                  :class="{ active: active_tab == 'broadcasts' }"
                  @click="changeTab('broadcasts')"
                  id="broadcasts-tab"
                  data-bs-toggle="tab"
                  data-bs-target="#broadcasts"
                  type="button"
                  role="tab"
                  aria-controls="broadcasts"
                  aria-selected="false"
                >
                  {{ __n("broadcast") }}
                </button>
              </li>

              <li
                class="nav-item tabs"
                role="presentation"
                v-if="hasModule('academy-podcasts', 'academy')"
              >
                <button
                  class="nav-link"
                  :class="{ active: active_tab == 'podcasts' }"
                  @click="changeTab('podcasts')"
                  id="podcasts-tab"
                  data-bs-toggle="tab"
                  data-bs-target="#podcasts"
                  type="button"
                  role="tab"
                  aria-controls="podcasts"
                  aria-selected="false"
                >
                  {{ __n("podcast") }}
                </button>
              </li>
              <li class="d-flex flex-column align-items-center profile-img">
                <img
                  class="rounded-3 img-fluid"
                  :src="$page.props.academy.image"
                  width="160"
                />
                <a
                  :href="route('teacher.my_profile')"
                  class="nav-link text-center"
                  target="_blank"
                >
                  <h2 class="text-primary fw-bold mt-2 mb-1 fs-2">
                    {{ $page.props.academy.first_name }}
                  </h2>
                  <h6 class="fs-6 text-secondary fw-semibold mb-0">
                    {{ __($page.props.auth.logged_in_as) }}
                  </h6>
                </a>
<!--
                <div class="position-absolute start-0">
                  <button
                    style="height: 30px; width: 30px"
                    class="btn p-0 btn-primary rounded-pill mt-2 mx-5"
                  >
                    <i class="bi bi-pencil"></i>
                  </button>
                </div> -->
              </li>
              <li class="nav-item tabs" role="presentation" v-if="!isSubscriptionEnabled() || hasModule('academy-services', 'academy')"  >

                <button class="nav-link" :class="{ active: active_tab == 'services' }"
                    @click="changeTab('services')" id="services-tab" data-bs-toggle="tab"
                    data-bs-target="#services" type="button" role="tab" aria-controls="services"
                    aria-selected="false">{{ __n('Services') }}</button>
            </li>
              <li
                class="nav-item tabs"
                role="presentation"
                v-if="hasModule('academy-events', 'academy')"
              >
                <button
                  class="nav-link"
                  :class="{ active: active_tab == 'events' }"
                  @click="changeTab('events')"
                  id="events-tab"
                  data-bs-toggle="tab"
                  data-bs-target="#events"
                  type="button"
                  role="tab"
                  aria-controls="events"
                  aria-selected="false"
                >
                  {{ __n("event") }}
                </button>
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

              <li
                class="nav-item tabs"
                role="presentation"
                v-if="hasModule('academy-appointment', 'academy')"
              >
                <button
                  class="nav-link"
                  :class="{ active: active_tab == 'appointment' }"
                  @click="changeTab('appointment')"
                  id="appointment-tab"
                  data-bs-toggle="tab"
                  data-bs-target="#appointment"
                  type="button"
                  role="tab"
                  aria-controls="appointment"
                  aria-selected="false"
                >
                  {{ __("appointment") }}
                </button>
              </li>
              <li
                class="nav-item tabs"
                role="presentation"
                v-if="hasModule('academy-blogs', 'academy')"
              >
                <button
                  class="nav-link"
                  :class="{ active: active_tab == 'blogs' }"
                  @click="changeTab('blogs')"
                  id="blogs-tab"
                  data-bs-toggle="tab"
                  data-bs-target="#blogs"
                  type="button"
                  role="tab"
                  aria-controls="blogs"
                  aria-selected="false"
                >
                  {{ __n("blog") }}
                </button>
              </li>
              <li
                class="nav-item tabs"
                role="presentation"
                v-if="hasModule('academy-archives', 'academy')"
              >
                <button
                  class="nav-link"
                  :class="{ active: active_tab == 'archives' }"
                  @click="changeTab('archives')"
                  id="archives-tab"
                  data-bs-toggle="tab"
                  data-bs-target="#archives"
                  type="button"
                  role="tab"
                  aria-controls="archives"
                  aria-selected="false"
                >
                  {{ __n("archive") }}
                </button>
              </li>
              <li class="nav-item tabs">
                <button
                  class="nav-link"
                  :class="{ active: active_tab == 'youtube' }"
                  @click="changeTab('youtube')"
                  id="youtube-tab"
                  data-bs-toggle="tab"
                  data-bs-target="#youtube"
                  type="button"
                  role="tab"
                  aria-controls="youtube"
                  aria-selected="false"
                >
                  {{ __("youtube") }}
                </button>
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
            <academy-general-info
              :active="active_tab == 'general-info'"
            ></academy-general-info>
            <academy-social-info
              v-if="
                hasModule('academy-social-info', 'academy') &&
                active_tab == 'social-info'
              "
              :active="active_tab == 'social-info'"
            ></academy-social-info>
            <academy-certifications
              v-if="
                hasModule('academy-certifications', 'academy') &&
                active_tab == 'certifications'
              "
              :active="active_tab == 'certifications'"
            ></academy-certifications>



              <academy-services
             :active="active_tab == 'services'"></academy-services>
            <academy-teachers
              :active="active_tab == 'teachers'"
            ></academy-teachers>

            <academy-broadcasts
              v-if="
                hasModule('academy-broadcasts', 'academy') &&
                active_tab == 'broadcasts'
              "
              :active="active_tab == 'broadcasts'"
            ></academy-broadcasts>
            <academy-podcasts
              v-if="
                hasModule('academy-podcasts', 'academy') &&
                active_tab == 'podcasts'
              "
              :active="active_tab == 'podcasts'"
            ></academy-podcasts>
            <academy-events
              v-if="
                hasModule('academy-events', 'academy') && active_tab == 'events'
              "
              :active="active_tab == 'events'"
            ></academy-events>
            <academy-products
              v-if="
                hasModule('academy-events', 'academy') &&
                active_tab == 'products'
              "
              :active="active_tab == 'products'"
            ></academy-products>
            <academy-youtube
              :active="active_tab == 'youtube'"
            ></academy-youtube>
            <academy-instagram
              :active="active_tab == 'instagram'"
            ></academy-instagram>
            <academy-calendly
              v-if="
                hasModule('academy-calendly', 'academy') &&
                active_tab == 'calendly'
              "
              :active="active_tab == 'calendly'"
            ></academy-calendly>
            <academy-appointment
              v-if="
                hasModule('academy-appointment', 'academy') &&
                active_tab == 'appointment'
              "
              :active="active_tab == 'appointment'"
            ></academy-appointment>
            <academy-posts
              v-if="
                hasModule('academy-blogs', 'academy') && active_tab == 'blogs'
              "
              :active="active_tab == 'blogs'"
            ></academy-posts>
            <academy-archives
              v-if="
                hasModule('academy-archives', 'academy') &&
                active_tab == 'archives'
              "
              :active="active_tab == 'archives'"
            ></academy-archives>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- <div class="container-fluid py-5 border-bottom border-dark">
    <div class="row">
      <div class="col-12">
        <h2 class="fs-2 text-center">
          <span class="fw-normal"
            >Hello {{ $page.props.auth.user.name }} |</span
          >
          <span class="fw-bold"> Set Profile</span>
        </h2> -->
  <!-- <p class="text-center mb-0">Discover The Best Teachers Near You</p> -->
  <!-- </div>
      <breadcrums :breadcrums="breadcrums"></breadcrums>
    </div>
  </div>
  <div class="section p-0 profile">
    <div class="container">
      <div class="row g-0">
        <div class="col-md-3 p-4">
          <div
            class="nav flex-column nav-pills account-tabs"
            id="v-pills-tab"
            role="tablist"
            aria-orientation="horizontal"
          >
            <li class="nav-item mb-3" role="presentation" >
              <button
                class="nav-link w-100 text-dark"
                :class="{ active: active_tab == 'general-info' }"
                @click="changeTab('general-info')"
                id="general-info-tab"
                data-bs-toggle="tab"
                data-bs-target="#general-info"
                type="button"
                role="tab"
                aria-controls="general-info"
                aria-selected="true"
              >
                {{ __("general info") }}
              </button>
            </li> -->
  <!-- v-if="hasModule('test')" -->

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
import AcademyGeneralInfo from "@/Components/Academies/AcademyGeneralInfo.vue";
import AcademySocialInfo from "@/Components/Academies/AcademySocialInfo.vue";
import AcademyBroadcasts from "@/Components/Academies/Broadcasts/AcademyBroadcasts.vue";
import AcademyPodcasts from "@/Components/Academies/Podcasts/AcademyPodcasts.vue";
import AcademyEvents from "@/Components/Academies/Events/AcademyEvents.vue";
import AcademyPosts from "@/Components/Academies/Posts/AcademyPosts.vue";
import AcademyProducts from "@/Components/Academies/AcademyProducts.vue";
import AcademyYoutube from "@/Components/Academies/AcademyYoutube.vue";
import AcademyInstagram from "@/Components/Academies/AcademyInstagram.vue";
import AcademyCalendly from "@/Components/Academies/AcademyCalendly.vue";
import AcademyAppointment from "@/Components/Academies/Appointments/AcademyAppointment.vue";
import AcademyCertifications from "@/Components/Academies/Certifications/AcademyCertifications.vue";
import AcademyTeachers from "@/Components/Academies/Teachers/AcademyTeachers.vue";
import Breadcrums from "../../Components/Shared/Breadcrums.vue";
import AcademyServices from "@/Components/Academies/Services/AcademyServices.vue";
import AcademyArchives from "@/Components/Academies/Archives/AcademyArchives.vue";

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
    AcademyGeneralInfo,
    AcademySocialInfo,
    AcademyBroadcasts,
    AcademyPodcasts,
    AcademyEvents,
    AcademyProducts,
    AcademyPosts,
    AcademyArchives,
    AcademyYoutube,
    AcademyInstagram,
    AcademyCalendly,
    AcademyAppointment,
    AcademyCertifications,
    AcademyTeachers,
    Breadcrums,
    AcademyServices
  },

  data() {
    return {
      active_tab: route().params.active_tab ?? "general-info",
      breadcrums: [
        {
          id: 1,
          name: "Home",
          link: "/",
        },
        {
          id: 2,
          name: "Account",
          link: "",
        },
      ],
    };
  },

  methods: {
    changeTab(tab) {
      this.active_tab = tab;
      this.$inertia.replace(route("account"), {
        data: { active_tab: this.active_tab },
        preserveScroll: true,
      });
    },
    submit() {},
  },
});
</script>
