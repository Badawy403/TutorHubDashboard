<template>
  <div class="card">
    <div class="row g-0">
      <div :class="view_type == 'single' ? 'col-md-3' : 'col-md-4'">
        <div class="p-3">
          <Link class="text-decoration-none" :href="route('teacher.profile', { user_name: teacher.user_name })">
          <div class="d-flex justify-content-center overflow-hidden position-relative rounded-4">
            <img v-if="teacher.image"  style="width: 100%;" class="img-fluid" :src="teacher.image" alt="teacher" />
            <img v-if="!teacher.image" class="img-fluid" src="@/images/account/default_avatar_men.png" alt="teacher" />
          </div>
          </Link>
          <!-- <div class="d-flex align-items-center justify-content-center mt-1">

            <star-rating :rating="teacher.rating" :star-size="16" :read-only="true" :increment="0.01"
              :show-rating="false"></star-rating>
            <span class="text-dark small mt-1 ps-1">({{ teacher.rating }})</span>
          </div> -->

        </div>

      </div>
      <div :class="view_type == 'single' ? 'col-md-9' : 'col-md-8'">
        <div class="card-body">

          <div class="d-flex align-items-center mb-1">

            <div class="d-flex align-items-center justify-content-between w-100">
              <h2 class="fs-4 fw-bold text-dark d-flex align-items-center mb-0 text-capitalize">
                <i v-if="teacher.is_featured" class="bi bi-patch-check-fill me-1 text-primary"></i>
                <Link class="text-decoration-none text-body d-flex align-items-center" :href="route('teacher.profile', { user_name: teacher.user_name, })">
                  <span class="fs-3">{{ teacher.name }}</span>
                  <span class="d-flex align-items-center mx-2">
                    <span v-if="teacher.is_online" class="d-flex fs-5 text-success">
                      <i class="bi bi-circle-fill"></i>
                    </span>
                    <span v-else class="d-flex fs-5 text-muted">
                      <i class="bi bi-circle-fill"></i>
                    </span>
                  </span>
                </Link>

              </h2>
              <img  v-if="teacher.is_premium" src="@/images/icons/is_premium.svg" alt="Icon">
            </div>
          </div>
          <div class="row align-items-center justify-content-between mb-2">
           <div class="col-12">
            <small v-if="teacher.academy_name" class="text-muted fs-5 fw-bold">({{ teacher.academy_name }})</small>
            <span class="fw-normal fs-5 small ps-1 ms-2 fw-bold" style="border-left:1px solid" v-if="teacher.distance">
             ( {{ formatDecimal(teacher.distance) }} Km) Away
            </span>
           </div>

          </div>
          <ul class="list-unstyled truncate" v-if="teacher.teacher_categories && teacher.teacher_categories.length > 0">
            <li class="me-2 lh-1 d-inline-block fs-5 pe-2" v-for="(cat, i) in teacher.teacher_categories" :key="cat.id"
              v-bind:class="{ 'border-end': i != teacher.teacher_categories.length - 1 }">
              {{ cat.name }}
            </li>
          </ul>

          <div class="row d-flex mb-3">
            <div class="col-md-4 text-start mb-2 mb-md-0" v-if="teacher.experience">
              <h6 class="fs-5 fw-bold">{{ __("experience") }}</h6>
              <span class="fs-5" v-if="teacher.experience == 1">{{ teacher.experience }} {{ __("year") }}</span>
              <span class="fs-5" v-else>{{ teacher.experience }} {{ __("years") }}</span>
            </div>

            <div class="col-md-4 text-start mb-2 mb-md-0" v-if="teacher.speciality">
              <h6 class="fs-5 fw-bold">{{ __("speciality") }}</h6>
              <span class="fs-5">{{ teacher.speciality }}</span>
            </div>

            <div class="col-md-4 text-start mb-2 mb-md-0">
                <h6 class="fs-5 fw-bold">{{ __("rating") }}</h6>
                <div class="d-flex align-items-center">
                <star-rating :rating="teacher.rating" :star-size="15" :read-only="true" :increment="0.01"
                :show-rating="false"></star-rating>
                <span class="text-dark small mt-1 ps-1 fs-5">({{ teacher.rating }})</span>
                </div>
            </div>


          </div>

          <div class="row">
            <div class="col-12 ps-2 ps-md-0 pe-md-4" v-if="checkObjectValuesIsNotNull(teacher.teacher_settings)">
              <div class="d-flex justify-content-between align-items-start bg-warning px-2 py-2 rounded-pill">
                <span class="fs-5 ps-2 fw-medium">{{ __("Follow me on:") }}</span>
                <ul class="d-flex flex-wrap justify-content-end ps-0 mb-0 list-group list-group-horizontal">
                  <li class="list-group-item p-1 py-0 bg-transparent border-0" v-if="teacher.teacher_settings.facebook_url
                    ">
                    <a target="_blank" class="text-dark" :href="teacher.teacher_settings
                      .facebook_url
                      "><i class="bi bi-facebook"></i></a>
                  </li>
                  <li class="list-group-item p-1 py-0  bg-transparent border-0" v-if="teacher.teacher_settings.youtube_url
                    ">
                    <a target="_blank" class="text-dark" :href="teacher.teacher_settings
                      .youtube_url
                      "><i class="bi bi-youtube"></i></a>
                  </li>
                  <li class="list-group-item p-1 py-0 bg-transparent border-0" v-if="teacher.teacher_settings.twitter_url
                    ">
                    <a target="_blank" class="text-dark" :href="teacher.teacher_settings
                      .twitter_url
                      "><i class="bi bi-twitter"></i></a>
                  </li>
                  <li class="list-group-item p-1 py-0 bg-transparent border-0" v-if="teacher.teacher_settings.linkedin_url
                    ">
                    <a target="_blank" class="text-dark" :href="teacher.teacher_settings
                      .linkedin_url
                      "><i class="bi bi-linkedin"></i></a>
                  </li>
                  <li class="list-group-item p-1 py-0 bg-transparent border-0" v-if="teacher.teacher_settings.whatsapp_url
                    ">
                    <a target="_blank" class="text-dark" :href="teacher.teacher_settings
                      .whatsapp_url
                      "><i class="bi bi-whatsapp"></i></a>
                  </li>
                  <li class="list-group-item p-1 py-0 bg-transparent border-0" v-if="teacher.teacher_settings.instagram_url
                    ">
                    <a target="_blank" class="text-dark" :href="teacher.teacher_settings
                      .instagram_url
                      "><i class="bi bi-instagram"></i></a>
                  </li>
                  <li class="list-group-item p-1 py-0 bg-transparent border-0" v-if="teacher.teacher_settings.tiktok_url">
                    <a target="_blank" class="text-dark" :href="teacher.teacher_settings
                      .tiktok_url
                      "><i class="bi bi-tiktok"></i></a>
                  </li>
                  <li class="list-group-item p-1 py-0 bg-transparent border-0" v-if="teacher.teacher_settings.snapchat_url
                    ">
                    <a target="_blank" class="text-dark" :href="teacher.teacher_settings
                      .snapchat_url
                      "><i class="bi bi-snapchat"></i></a>
                  </li>
                  <li class="list-group-item p-1 py-0 bg-transparent border-0" v-if="teacher.teacher_settings.pinterest_url
                    ">
                    <a target="_blank" class="text-dark" :href="teacher.teacher_settings
                      .pinterest_url
                      "><i class="bi bi-pinterest"></i></a>
                  </li>
                </ul>

              </div>
            </div>
            <div class="row mb-3" v-if="this.view_type == 'single'">
            <div class="col-12">
                <div v-html="teacher.description" class="mt-3 fs-5 line-clamp"></div>
            </div>
            </div>

          </div>
        </div>
      </div>
    </div>
    <div class="row mb-3" v-if="this.view_type == 'double'">
      <div class="col-12">
        <div v-html="teacher.description" class="px-3 fs-5 line-clamp"></div>
      </div>
    </div>

    <div class="row mx-2 mb-3" v-if="teacher.appointment_types">

      <div class="col-md-4 pe-md-2 p-0 mb-2 mb-md-0" v-for="(schedule_type, index) in teacher.appointment_types" :key="index">

        <div class="d-flex justify-content-center shadow-none btn btn-light px-2 py-3 align-items-center" role="button"
          @click="checkLoginAndRedirect(teacher, schedule_type.appointment_type)">


              <i class="bi bi-camera-video-fill fs-5 me-2" v-if="schedule_type.type == 'video'"></i>
              <i class="bi bi-mic-fill fs-5 me-2" v-if="schedule_type.type == 'audio'"></i>
              <i class="bi bi-chat-dots-fill fs-5 me-2" v-if="schedule_type.type == 'chat'"></i>

          <div class="d-flex ">
            <span class="fs-6 fw-bold">{{ schedule_type.appointment_type.display_name }}</span>
            <span class="fs-6">
              &nbsp;- (
              {{ getDisplayAmount(schedule_type.fee) }}
              <!-- <span v-if="schedule_type.appointment_type.is_schedule_required"> - {{ schedule_type.slot_duration }} {{ __("minutes") }}</span> -->
              )
            </span>

          </div>
        </div>

      </div>

    </div>
  </div>
</template>
<script>
import { defineComponent } from "vue";
import { Link } from "@inertiajs/inertia-vue3";

export default defineComponent({
  components: {
    Link,
  },
  props: ['teacher','view_type'],
  created() {

  },
  data() {
    return {
    };
  },
  methods: {
    checkLoginAndRedirect(teacher, appointment_type) {
      if (this.$page.props.auth) {
        if (this.$page.props.auth.logged_in_as == 'student') {
          this.$inertia.visit(route(
            'teacher.book_appointment',
            {
              user_name: teacher.user_name,
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
  },
});
</script>
