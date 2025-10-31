
<template>
  <div :class="{ 'col-md-3 col-academy': add_col, 'w-100': !add_col }">
    <!-- <div class="card academy-card item-h border-0 py-3" style="min-height:342px">

       <div class="card-body p-0">
        <div class="d-flex mb-3 justify-content-center card-avatar overflow-hidden position-relative">

          <div class="position-absolute d-flex flex-column end-0">
            <button type="button"
                class="btn btn-primary me-2 mt-2" v-for="(schedule_type,index) in academy.appointment_types" :key="index" @click="checkLoginAndRedirect(academy,schedule_type.appointment_type)">
                    <span class="bi bi-camera-video-fill small" v-if="schedule_type.type == 'video'"></span>
                    <span class="bi bi-telephone-fill small" v-if="schedule_type.type == 'audio'"></span>
                    <span class="bi bi-chat-fill small" v-if="schedule_type.type == 'chat'"></span>
                </button> <br>
          </div>

          <img v-if="academy.image" class="img-fluid" :src="academy.image" alt="academy">
          <img v-if="!academy.image" class="img-fluid m-3" src="@/images/account/default_avatar_men.png" alt="academy">

        </div>
        <h6 class="text-center mb-2">{{ academy.name }} </h6>
        <h2 class="fs-3 fw-bold d-flex align-items-center justify-content-center text-capitalize mb-1">
          <i v-if="academy.is_featured" class="bi bi-patch-check-fill fs-5 me-2 text-primary"></i>
          <Link class="text-decoration-none text-dark" :href="route('academy.profile', { user_name: academy.user_name, })">
          {{
            academy.name }}</Link>
        </h2>
          <span class="fw-bold small ps-1 ms-2" style="border-left:2px solid" v-if="academy.distance"> ( {{ formatDecimal(academy.distance) }} Km) Away</span>
        <div>
          <p class="text-center mb-0 small" v-if="academy.distance">
            ( {{ formatDecimal(academy.distance) }} Km) Away
          </p>
          <p class="text-center mb-0 small" v-else>

          </p>
        </div>
        <p class="fs-6 text-center px-3 mb-2" v-for="(cat, index) in academy.academy_categories" :key="index">{{ cat.name }}</p>

        <div class="d-flex justify-content-center my-2">

          <Link :href="route('academy.profile', { user_name: academy.user_name, })" class="btn btn-primary btn-sm rounded-3">
          {{ __("Book appointment") }}
          </Link>
        </div>

        <div class="d-flex align-items-center justify-content-center mb-2" style="color: white;">
          <star-rating :rating="academy.rating" :star-size="16" :read-only="true" :increment="0.01"
            :show-rating="false"></star-rating>
          <span class="text-dark small mt-1 ps-1"> ({{
            academy.rating
          }}/5)</span>
        </div>

        <div class="d-flex align-items-center justify-content-center">
          <span v-if="academy.is_online" class="d-flex text-warning" style="font-size: 14px;">
                            <i class="bi bi-circle-fill"></i> <span class="ms-1">{{ getPageContent('general_online_text') ?? 'Online' }}</span>
                           </span>
          <span v-else class="d-flex text-muted" style="font-size: 14px;">
            <i class="bi bi-circle-fill"></i> <span class="ms-1">{{ getPageContent('general_offline_text') ?? 'Offline' }}</span>
          </span>
        </div>

      </div>
    </div> -->

    <div class="card">
    <div class="px-3 pt-3">
      <Link class="text-decoration-none" :href="route('academy.profile', { user_name: academy.user_name, })">
      <div class="d-flex justify-content-center overflow-hidden position-relative rounded-4">
          <img v-if="academy.image" class="img-fluid" :src="academy.image" alt="academy">
          <img v-if="!academy.image" class="img-fluid m-3" src="@/images/account/default_avatar_men.png" alt="academy">
    </div>
    </Link>
    </div>
    <div class="card-body">
      <div class="d-flex align-items-center mb-3">

        <div class="d-flex justify-content-center align-items-center w-100">
          <h2 class="fs-3 fw-bold text-dark d-flex align-items-center justify-content-between mb-0 text-capitalize">
            <i v-if="academy.is_featured" class="bi bi-patch-check-fill me-1 text-primary"></i>
            <Link class="text-decoration-none text-dark" :href="route('academy.profile', { user_name: academy.user_name, })">
          {{
            academy.name }}</Link>
          </h2>
          <img v-if="academy.is_premium" src="@/images/icons/is_premium.svg" alt="Icon">
        </div>
      </div>

        <div class="d-flex align-items-center justify-content-center">
          <span v-if="academy.is_online" class="d-flex text-warning" style="font-size: 14px;">
                            <i class="bi bi-circle-fill"></i> <span class="ms-1">{{ getPageContent('general_online_text') ?? 'Online' }}</span>
                           </span>
          <span v-else class="d-flex text-muted" style="font-size: 14px;">
            <i class="bi bi-circle-fill"></i> <span class="ms-1">{{ getPageContent('general_offline_text') ?? 'Offline' }}</span>
          </span>
        </div>

       <div class="d-flex align-items-center justify-content-center mb-2" style="color: white;">
          <star-rating :rating="academy.rating" :star-size="16" :read-only="true" :increment="0.01"
            :show-rating="false"></star-rating>
          <span class="text-dark small mt-1 ps-1"> ({{
            academy.rating
          }}/5)</span>
        </div>

        <div class="d-flex justify-content-center my-3">

        <Link :href="route('academy.profile', { user_name: academy.user_name, })" class="btn btn-outline-primary rounded-pill">
        {{ __("View Detail") }}
        </Link>
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
  props: ['academy', 'add_col'],
  created() {
  },
  data() {
    return {
    };
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
  },
});
</script>
