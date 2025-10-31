<template>

  <guest-layout>
    <div v-if="!selected_role">
      <select-role
        @selectRole="
          (role) => {
            selected_role = role;
          }
        "
      ></select-role>
    </div>
      <div  v-else class="container">
        <div class="row pt-6">
          <div class="col-12">
            <div class="row">
              <div class="col-12">
                <Link :href="route('home')"><span class="d-flex justify-content-center"><img src="@/images/icons/tutorhub.png" class="mb-4" alt="" style="width: 250px;"></span></Link>
                <div class="text-center">

                  <img
                    class="image-fluid mb-2"
                    src="@/images/auth/teacher.png"
                    alt=""
                    width="220"
                  />
                </div>
                <h1 class="text-center display-2 text-primary fw-bold">
                   {{ __("welcome back!") }}{{ __("register") }}
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
                    <student-register
                      :selected_role="selected_role"
                    ></student-register>
                  </div>
                </div>
              </div>

          </div>
        </div>

        <!-- <div class="row align-items-center">
          <div class="col-md-6">
            <div>

              <div v-if="getPageContentType('register_page_description') == 'textarea'">
                <div v-html="getPageContent('register_page_description')"> </div>
              </div>
              <div v-else-if="getPageContentType('register_page_description') == 'text'">
                <p> {{ getPageContent('register_page_description') ?? '-' }} </p>
              </div>
              <div v-else>
                <p class="fs-3 mb-0 text-white mt-3">
                  Welcome to |
                  <span class="text-primary fw-bold">Law Consulting</span>
                </p>

                <p class="mb-0 text-muted">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eligendi sequi ex
                  velit. Hic ut numquam blanditiis est sunt ullam tenetur aspernatur facilis inventore, quaerat id eaque
                  ipsum voluptas adipisci esse!</p>

              </div>
              <div class="text-white">
                <div v-if="getPageContentType('register_page_signup_text') == 'textarea'">
                  <div v-html="getPageContent('register_page_signup_text')"></div>
                </div>
                <div class="tab-content" id="myTabContent">

                </div>
              </div>
            </div>

          </div>

        </div> -->
      </div>
    </div>
  </guest-layout>
</template>

<script>
import { defineComponent } from "vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import Button from "@/Components/Button.vue";
import Input from "@/Components/Input.vue";
import Checkbox from "@/Components/Checkbox.vue";
import Label from "@/Components/Label.vue";
import ValidationErrors from "@/Components/ValidationErrors.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import StudentRegister from "@/Components/Students/StudentRegister.vue";
import SelectRole from "@/Components/SelectRole.vue";

export default defineComponent({
  components: {
    GuestLayout,
    Head,
    Button,
    Input,
    Checkbox,
    Label,
    ValidationErrors,
    StudentRegister,
    Link,
    SelectRole,
  },

  props: {
    canResetPassword: Boolean,
    status: String,
  },
  data() {
    return {
      currentSlide: 0,
      selected_role: route().params.logged_in_as ?? null,
    };
  },

  methods: {},
});
</script>
