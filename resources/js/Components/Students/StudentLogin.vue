<template>
  <div class="tab-pane" :class="{ active: active }" id="student-login-pane" role="tabpanel"
    aria-labelledby="student-login-tab" tabindex="0">

    <div class="col-12">
      <div class="row">
        <form @submit.prevent="submit" class="loginForm">
          <div class="col-12">

            <div class="row mb-3">

             <div class="col-lg-6 mb-3 mb-md-0">
               <input id="email" class="form-control rounded-3 px-3 shadow-sm auth-input" :class="{ 'is-invalid': form.errors.email }"
                placeholder="example@domain.com" type="email" v-model="form.email" required />
                <div v-if="form.errors.email" class="invalid-feedback">
                <span>{{ form.errors.email }}</span>
                </div>
             </div>

            <div class="col-lg-6">
            <input id="pass_log_log" class="form-control rounded-3 px-3 shadow-sm auth-input " :class="{ 'is-invalid': form.errors.Invalid }" type="password"
            v-model="form.password" name="password" placeholder="••••••••••" required />
            <div v-if="form.errors.Invalid" class="invalid-feedback">
            <span>{{ form.errors.Invalid }}</span>
            </div>
            </div>

            </div>

            <div class="d-flex mb-4 align-items-center justify-content-between">

            <div class="form-check">
            <input class="form-check-input shadow-sm" type="checkbox" value="" id="flexCheckDefault">
            <label class="form-check-label text-secondary fs-5" for="flexCheckDefault">{{ __("remember me") }}</label>
            </div>


            <div class="text-end">
              <Link class="fs-5" :href="route('forgot_password')">{{ __('forgot password') }}?
              </Link>
            </div>

            </div>
            <div class="d-grid gap-2 mb-4">
              <button class="submit btn btn-primary fw-semibold" :class="{ 'text-white-50': form.processing }"
                :disabled="form.processing">
                <SpinnerLoader v-if="form.processing" />
                {{ __('login') }}
              </button>
            </div>
            <p class="text-center text-secondary">
              {{ __('if you dont have an account') }}?
              <Link :href="route('register')" class="text-decoration-none fw-semibold">{{ __('register') }}
              </Link>
            </p>
          </div>
        </form>
      </div>
      <hr />
      <div class="row">
        <div class="col-md-12">
            <div class="d-flex align-items-center justify-content-center gap-0">
              <span class="me-3 text-secondary">{{ __('login with') }}</span>

              <Link :href="route('social_redirect', { provider: 'facebook', login_as: this.form.login_as })"
                class="me-1">
                <img src="@/images/icons/facebook.png" width="35" class="rounded-circle"/>
              </Link>

              <Link :href="route('social_redirect', { provider: 'google', login_as: this.form.login_as })"
                class="mx-2">
                <img src="@/images/icons/google.png" width="37" class="rounded-circle"/>
              </Link>

              <Link class="ms-1">
               <img src="@/images/icons/twitter.png" width="35" class="rounded-circle"/>
              </Link>
            </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { defineComponent } from "vue";
import Button from "@/Components/Button.vue";
import Input from "@/Components/Input.vue";
import Checkbox from "@/Components/Checkbox.vue";
import Label from "@/Components/Label.vue";
import ValidationErrors from "@/Components/ValidationErrors.vue";
import SpinnerLoader from "@/Components/Shared/SpinnerLoader.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";

export default defineComponent({
  components: {
    Button,
    Input,
    Checkbox,
    SpinnerLoader,
    Label,
    ValidationErrors,
    Link
  },

  props: {
    canResetPassword: Boolean,
    status: String,
    active: Boolean,
    redirectUrl: String
  },

  data() {
    return {
      form: this.$inertia.form({
        email: "",
        password: "",
        remember: false,
        login_as: "student",
        redirectUrl: null
      }),
      errors: {
        email: null,
        password: null,
      }
    };
  },

  methods: {
    submit() {
      this.emptyErrors();
      if (this.form.email && this.form.password) {
        if (this.redirectUrl && this.redirectUrl != '') {
          this.form.redirectUrl = this.redirectUrl
        }
        this.form
          .transform(data => ({
            ...data,
            remember: this.form.remember ? "on" : ""
          }))
          .post(this.route("submit.login"), {
            onFinish: () => {
              this.form.reset("password")
              if (this.redirectUrl && this.redirectUrl != '') {
                this.$inertia.visit(this.redirectUrl)
              }
            },
          });
      }

      if (!this.form.email) {
        this.errors.email = 'Email is required.';
      }
      if (!this.form.password) {
        this.errors.password = 'Password is required.';
      }
    },
    emptyErrors() {
      this.errors.email = null;
      this.errors.password = null;
    }
  }
});
</script>
