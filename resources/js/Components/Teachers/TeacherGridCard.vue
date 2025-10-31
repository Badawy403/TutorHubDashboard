<template>
  <div class="card">
    <div class="px-3 pt-3">
      <Link class="text-decoration-none" :href="route('teacher.profile', { user_name: teacher.user_name })">
      <div class="d-flex justify-content-center overflow-hidden position-relative rounded-4">
        <img v-if="teacher.image" style="width: 100%;" class="img-fluid" :src="teacher.image" alt="teacher" />
        <img v-if="!teacher.image"  class="img-fluid" src="@/images/account/default_avatar_men.png" alt="teacher" />
        <span class="d-flex align-items-center mx-1 position-absolute end-0 p-3">
                  <span v-if="teacher.is_online" class="d-flex fs-3" style="color: #08FA20;">
                    <i class="bi bi-circle-fill"></i>
                  </span>
                  <span v-else class="d-flex fs-3 text-muted">
                    <i class="bi bi-circle-fill"></i>
                  </span>
        </span>

    </div>


      </Link>
    </div>
    <div class="card-body">
      <div class="d-flex align-items-center mb-1">

        <div class="d-flex justify-content-between align-items-center w-100">
          <h2 class="fs-3 fw-bold text-dark d-flex align-items-center justify-content-between mb-0 text-capitalize">
            <i v-if="teacher.is_featured" class="bi bi-patch-check-fill me-1 text-primary"></i>
            <Link class="text-decoration-none text-body d-flex align-items-center" :href="route('teacher.profile', { user_name: teacher.user_name, })">
              <span>{{ teacher.name }} </span>
              <!-- <small v-if="teacher.academy_name" class="text-muted">({{ teacher.academy_name }})</small> -->
            </Link>
          </h2>
          <img v-if="teacher.is_premium" src="@/images/icons/is_premium.svg" alt="Icon">
        </div>
      </div>


      <div class="d-flex align-items-center mb-2">
        <star-rating :rating="teacher.rating" :star-size="16" :read-only="true" :increment="0.01"
          :show-rating="false"></star-rating>
        <span class="text-dark small mt-1 ps-1"> ({{
          teacher.rating
        }})</span>
      </div>

      <div class="d-flex align-items-center">
        <span class="fs-4" v-if="teacher.experience == 1">{{ teacher.experience }} {{ __("Years experience") }}</span>
        <span class="fs-4" v-else>{{ teacher.experience }} {{ __("Years Experience") }}</span>

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
  props: ['teacher'],
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
