<template>

  <app-layout title="My Profile">
    <template #header>

      <Head title="Email Verification" />
      <!-- <page-header>
        {{ __('verify your email') }}
      </page-header> -->
    </template>
    <template #default>

      <section class="py-5">
        <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <h1>
                  <i class="bi bi-check-circle-fill text-primary"></i> Thanks for Signing Up!
                </h1>
                <div class="mb-3 text-muted">
                  Before getting started, could you verify your
                  email address by clicking on the link we just emailed to you? If you
                  didn't receive the email, we will gladly send you another.
                </div>

                <div class="alert alert-success" role="alert" v-if="verificationLinkSent">
                  A new verification link has been sent to the email address you provided
                  during registration.
                </div>

                <form @submit.prevent="submit">
                  <div class="mt-4 d-flex justify-content-between">
                    <button class="btn btn-primary " :class="{ 'text-white-50': form.processing }"
                      :disabled="form.processing">
                      <div v-show="form.processing" class="spinner-border spinner-border-sm" role="status">
                        <span class="visually-hidden">{{__('loading')}}...</span>
                      </div>

                      {{ __('resend verification email') }}
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      </section>
    </template>

  </app-layout>
</template>
<script>
import { defineComponent } from "vue";
import PageHeader from "@/Components/PageHeader.vue";
import AuthenticationCard from "@/Components/AuthenticationCard.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import AuthenticationCardLogo from "@/Components/AuthenticationCardLogo.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";

export default defineComponent({
  components: {
    Head,
    AuthenticationCard,
    AuthenticationCardLogo,
    AppLayout,
    PageHeader,
    Link,
  },
  data() {
    return {
      form: this.$inertia.form(),
    };
  },

  methods: {
    submit() {
      this.form.post(this.route("verification.send"));
    },
  },

  computed: {
    verificationLinkSent() {
      return this.$page.props.flash.status === "verification-link-sent";
    },
  },
});
</script>
