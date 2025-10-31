<template>
  <div class="card">
    <div class="row g-0">
      <div :class="view_type == 'single' ? 'col-md-3' : 'col-md-4'">
        <div class="p-3">
          <Link class="text-decoration-none" :href="route('academy.profile', { user_name: academy.user_name })">
          <div class="d-flex justify-content-center overflow-hidden position-relative rounded-4">
            <img v-if="academy.image"  style="width: 100%;" class="img-fluid" :src="academy.image" alt="academy" />
            <img v-if="!academy.image" class="img-fluid" src="@/images/account/default_avatar_men.png" alt="academy" />
          </div>
          </Link>
          <div class="d-flex align-items-center justify-content-center mt-1">

            <star-rating :rating="academy.rating" :star-size="16" :read-only="true" :increment="0.01"
              :show-rating="false"></star-rating>
            <span class="text-dark small mt-1 ps-1">({{ academy.rating }})</span>
          </div>

        </div>

      </div>
      <div :class="view_type == 'double' ? 'col-md-8' : 'col-md-9'">
        <div class="card-body">

          <div class="d-flex align-items-center mb-1">

            <div class="d-flex align-items-center justify-content-between w-100">
              <h2 class="fs-4 fw-bold text-dark d-flex align-items-center mb-0 text-capitalize">
                <i v-if="academy.is_featured" class="bi bi-patch-check-fill me-1 text-primary"></i>
                <Link class="text-decoration-none text-body d-flex align-items-center" :href="route('academy.profile', { user_name: academy.user_name, })">
                  <span>{{ academy.name }}</span>
                </Link>
              </h2>

              <span class="d-flex align-items-center me-2">
                    <span v-if="academy.is_online" class="d-flex fs-5 text-warning me-2">
                      <i class="bi bi-circle-fill"></i>
                    </span>
                    <span v-else class="d-flex fs-5 text-muted me-2">
                      <i class="bi bi-circle-fill"></i>
                    </span>
               <img v-if="academy.is_premium"  src="@/images/icons/is_premium.svg" alt="Icon">
            </span>

            </div>
          </div>

          <div v-if="academy.academy_name" class="row align-items-center mb-2">
                <small  class="text-muted fw-bold fs-5">({{ academy.academy_name }})</small>
                <span class="fw-normal small ps-1 ms-2 fs-5" style="border-left:1px solid" v-if="academy.distance"> ( {{
                  formatDecimal(academy.distance) }} Km) Away</span>
         </div>

          <ul class="list-unstyled truncate" v-if="academy.academy_categories && academy.academy_categories.length > 0">
            <li class="me-2 lh-1 d-inline-block fs-5 pe-2" v-for="(cat, i) in academy.academy_categories" :key="cat.id"
              v-bind:class="{ 'border-end': i != academy.academy_categories.length - 1 }">
              {{ cat.name }}
            </li>
          </ul>

          <!-- <div class="row mb-3">
            <div class="col-md-6 text-start" v-if="academy.experience">
              <h6 class="fs-5 fw-bold">{{ __("experience") }}</h6>
              <span class="fs-5" v-if="academy.experience == 1">{{ academy.experience }} {{ __("year") }}</span>
              <span class="fs-5" v-else>{{ academy.experience }} {{ __("years") }}</span>
            </div>

            <div class="col-md-6 text-start" v-if="academy.speciality">
              <h6 class="fs-5 fw-bold">{{ __("speciality") }}</h6>
              <span class="fs-5">{{ academy.speciality }}</span>
            </div>


          </div> -->

          <div class="row">
            <div class="col-12" v-if="checkObjectValuesIsNotNull(academy.academy_settings)">
              <div class="d-flex justify-content-between align-items-start bg-warning px-2 px-lg-3 py-2 rounded-pill px-md-2 me-md-2" >
                <span class="fs-5 ms-md-1 ms-lg-0">{{ __("Follow me on:") }}</span>
                <ul class="d-flex flex-wrap justify-content-end ps-0 mb-0 list-group list-group-horizontal">
                  <li class="list-group-item p-1 py-0 bg-transparent border-0" v-if="academy.academy_settings.facebook_url
                    ">
                    <a target="_blank" class="text-dark" :href="academy.academy_settings
                      .facebook_url
                      "><i class="bi bi-facebook"></i></a>
                  </li>
                  <li class="list-group-item p-1 py-0  bg-transparent border-0" v-if="academy.academy_settings.youtube_url
                    ">
                    <a target="_blank" class="text-dark" :href="academy.academy_settings
                      .youtube_url
                      "><i class="bi bi-youtube"></i></a>
                  </li>
                  <li class="list-group-item p-1 py-0 bg-transparent border-0" v-if="academy.academy_settings.twitter_url
                    ">
                    <a target="_blank" class="text-dark" :href="academy.academy_settings
                      .twitter_url
                      "><i class="bi bi-twitter"></i></a>
                  </li>
                  <li class="list-group-item p-1 py-0 bg-transparent border-0" v-if="academy.academy_settings.linkedin_url
                    ">
                    <a target="_blank" class="text-dark" :href="academy.academy_settings
                      .linkedin_url
                      "><i class="bi bi-linkedin"></i></a>
                  </li>
                  <li class="list-group-item p-1 py-0 bg-transparent border-0" v-if="academy.academy_settings.whatsapp_url
                    ">
                    <a target="_blank" class="text-dark" :href="academy.academy_settings
                      .whatsapp_url
                      "><i class="bi bi-whatsapp"></i></a>
                  </li>
                  <li class="list-group-item p-1 py-0 bg-transparent border-0" v-if="academy.academy_settings.instagram_url
                    ">
                    <a target="_blank" class="text-dark" :href="academy.academy_settings
                      .instagram_url
                      "><i class="bi bi-instagram"></i></a>
                  </li>
                  <li class="list-group-item p-1 py-0 bg-transparent border-0" v-if="academy.academy_settings.tiktok_url">
                    <a target="_blank" class="text-dark" :href="academy.academy_settings
                      .tiktok_url
                      "><i class="bi bi-tiktok"></i></a>
                  </li>
                  <li class="list-group-item p-1 py-0 bg-transparent border-0" v-if="academy.academy_settings.snapchat_url
                    ">
                    <a target="_blank" class="text-dark" :href="academy.academy_settings
                      .snapchat_url
                      "><i class="bi bi-snapchat"></i></a>
                  </li>
                  <li class="list-group-item p-1 py-0 bg-transparent border-0" v-if="academy.academy_settings.pinterest_url
                    ">
                    <a target="_blank" class="text-dark" :href="academy.academy_settings
                      .pinterest_url
                      "><i class="bi bi-pinterest"></i></a>
                  </li>
                </ul>

              </div>
            <div class="row pb-4 pb-md-0" v-if="view_type == 'single'">
            <div class="col-12">
                <div v-html="academy.description" class="mt-3 fs-5 line-clamp text-start"></div>
            </div>
           </div>
            </div>

          </div>
        </div>
        <div class="row pb-4 pb-md-0" v-if="view_type == 'double'">
            <div class="col-12">
                <div v-html="academy.description" class="px-3 fs-5 line-clamp text-start"></div>
            </div>
        </div>
      </div>

    </div>



    <!-- <div class="row px-3 mb-3" v-if="academy.appointment_types">

      <div class="col-lg-4" v-for="(schedule_type, index) in academy.appointment_types" :key="index">

        <div class="d-flex justify-content-center p-3 rounded-pill appointment_types" role="button"
          @click="checkLoginAndRedirect(academy, schedule_type.appointment_type)">

          <div class="d-flex align-items-center justify-content-center">
            <i class="bi bi-camera-video-fill fs-6" v-if="schedule_type.type == 'video'"></i>
            <i class="bi bi-telephone-fill fs-6" v-if="schedule_type.type == 'audio'"></i>
            <i class="bi bi-chat-fill fs-6" v-if="schedule_type.type == 'chat'"></i>

          </div>
          <div class="d-flex ms-2">
            <span class="fs-6">{{ schedule_type.appointment_type.display_name }}</span>
            <span class="fs-6 text-muted">
              &nbsp;- (
              {{ getDisplayAmount(schedule_type.fee) }}
              )
            </span>

          </div>
        </div>
      </div>
    </div> -->

  </div>
</template>
<script>
import { defineComponent } from "vue";
import { Link } from "@inertiajs/inertia-vue3";

export default defineComponent({
  components: {
    Link
  },
  props: ["academy","view_type"],
  created() { },
  data() {
    return {};
  },
  methods: {
    checkLoginAndRedirect(academy, appointment_type) {
      if (this.$page.props.auth) {
        if (this.$page.props.auth.logged_in_as == 'student') {
          this.$inertia.visit(route(
            'academy.book_appointment',
            {
              user_name: academy.user_name,
              type: appointment_type.type,
            }
          ))
        }
        else {
          this.$toast.warning("You must log in as a student");
        }

      } else {
        this.$toast.warning("Please login first");
        this.$inertia.visit(route("login"), {
          data: {
            'is_redirect': 1
          },
        });
      }
    },
  }
});
</script>
