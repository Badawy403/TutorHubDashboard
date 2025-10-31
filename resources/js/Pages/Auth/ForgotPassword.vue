<template>
  <guest-layout>
    <div class="py-5">
      <div class="container">
        <div class="row mb-5">
          <div class="col-12">
            <h1 class="text-center text-primary fw-bold text-body">{{ __('forgot password') }}</h1>
            <p class="text-center">Our team of highly skilled attorneys comprises seasoned professionals <br>with extensive experience in their respective fields. </p>
          </div>

        </div>
        <div class="row justify-content-center">
          <div class="col-md-6">
            <div class="card bg-transparent">
              <div class="card-body">
                <div class="col-12">
                  <div class="row">
                    <form @submit.prevent="submit">
                      <div class="col-12">

                        <div class="mb-4">
                          <input id="email" class="form-control" :class="{ 'is-invalid': form.errors.email }"
                            placeholder="example@domain.com" type="email" v-model="form.email" required autofocus />
                          <div v-if="form.errors.email" class="invalid-feedback">
                            <span>{{ form.errors.email }}</span>
                          </div>

                        </div>

                        

                        <div class="d-grid gap-2 mb-4">
                          <button class="submit btn btn-primary"
                            :class="{ 'text-white-50': form.processing }" :disabled="form.processing">
                            <SpinnerLoader v-if="form.processing" />
                            {{ __('submit') }}
                          </button>
                        </div>
                        <p class="text-center">
                          {{ __('if you don’t have an account') }}?
                          <Link :href="route('register')" class="link ms-1 text-capitalize">{{ __('register') }}
                          </Link>
                        </p>
                      </div>
                    </form>
                  </div>
                  <hr />
                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- <div class="section login py-5">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-6">
            <div>
              <div v-if="getPageContentType('forgot_password_page') == 'textarea'">
                <div v-html="getPageContent('forgot_password_page')"> </div>
              </div>
              <div v-else-if="getPageContentType('forgot_password_page') == 'text'">
                <p> {{ getPageContent('forgot_password_page') ?? '-' }} </p>
              </div>
              <div v-else>
                <p class="fs-3 mb-0 text-white">
                  Welcome to |
                  <span class="text-primary">Law Consulting</span>
                </p>

                <p class="mb-0 text-muted">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eligendi sequi ex
                  velit. Hic ut numquam blanditiis est sunt ullam tenetur aspernatur facilis inventore, quaerat id eaque
                  ipsum voluptas adipisci esse!</p>
              </div>

              <div class="text-white py-5">
                <h1 class="fw-bold display-1 mb-4 text-capitalize">{{ __('forgot password') }}?</h1>
                <div v-if="status" class="alert alert-success" role="alert">{{ status }}</div>

                <form @submit.prevent="submit">
                  <validation-errors class="mb-2" />
                  <div class="col-12">
                    <div class="row">
                      <div class="col-12">
                        <div class="form-group mb-4">
                          <div class="form-floating">

                            <input id="email" type="email" placeholder="Email Address"
                              class="form-control border border-primary" v-model="form.email" required autofocus />
                            <label for="password" class="text-muted">{{ __('Email Addres') }}</label>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row align-items-center">
                      <div class="col-md-5">
                        <button :class="{ 'text-white-50': form.processing }" class="submit btn btn-primary "
                          :disabled="form.processing">
                          <SpinnerLoader v-if="form.processing" />
                          {{ __('reset password') }}
                        </button>
                      </div>
                      <div class="col-md-7 text-end">
                        <Link :href="route('login')">{{ __('return to login') }}</Link>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>

          </div>

        </div>
      </div>
    </div> -->

    
  </guest-layout>
</template>

<script>
import { defineComponent } from "vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import Button from "@/Components/Button.vue";
import Input from "@/Components/Input.vue";
import Label from "@/Components/Label.vue";
import ValidationErrors from "@/Components/ValidationErrors.vue";
import SpinnerLoader from "@/Components/Shared/SpinnerLoader.vue";
export default defineComponent({
  components: {
    Head,
    Button,
    Input,
    Label,
    ValidationErrors,
    GuestLayout,
    AppLayout,
    SpinnerLoader,
    Link,
  },

  props: {
    status: String
  },

  data() {
    return {
      form: this.$inertia.form({
        email: ""
      }),
      
    };
  },

  methods: {
    submit() {
      this.form.post(this.route("password.forgot"));
    }
  }
});
</script>
