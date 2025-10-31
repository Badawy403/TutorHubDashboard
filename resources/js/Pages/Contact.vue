<template>
  <app-layout title="Contact">
    <div class="page section py-0">
      <div class="py-5">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <h2 class="text-center fw-bold text-primary display-6">
                {{ __('contact us') }}
              </h2>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center mb-0 fw-bold">
                  <li class="breadcrumb-item">
                    <a href="#" class="text-decoration-none">{{ __('home') }}</a>
                  </li>
                  <li class="breadcrumb-item" aria-current="page">{{ __('contact') }}</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row justify-content-center py-5">
            <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <div
              class="card bg-transparent border-0"

            >

              <validation-errors class="mb-3" />
              <div class="card-body p-md-4">
                <div class="mb-4">
                  <label for="exampleFormControlInput0" class="form-label fs-4 text-secondary fw-medium"
                    >{{ __('whats your name?') }}</label
                  >
                  <input
                    type="text"
                    class="form-control px-4"
                    id="exampleFormControlInput0"
                    v-model="form.name"
                    :placeholder='__("Please Enter")'
                  />
                </div>
                <div class="mb-4">
                  <label for="exampleFormControlInput1" class="form-label fs-4 text-secondary fw-medium"
                    >{{ __('what email address can we reach you at?') }}</label
                  >
                  <input
                    type="email"
                    class="form-control px-4"
                    id="exampleFormControlInput1"
                    v-model="form.email"
                    placeholder="name@example.com"
                  />
                </div>
                <div class="mb-4">
                  <label for="exampleFormControlInput2" class="form-label fs-4 text-secondary fw-medium"
                    >{{ __('what phone number can we reach you at?') }}</label
                  >
                  <input
                    type="text"
                    class="form-control px-4"
                    id="exampleFormControlInput2"
                    v-model="form.phone"
                    :placeholder="__('Please Enter')"
                  />
                </div>
                <div class="mb-4">
                  <label for="exampleFormControlTextarea1" class="form-label fs-4 text-secondary fw-medium"
                    >{{ __('how can we help?write us a message') }}</label
                  >
                  <textarea
                    class="form-control"
                    id="exampleFormControlTextarea1"
                    v-model="form.message"
                    rows="3"
                  ></textarea>
                </div>

                <button
                  @click="submit()"
                  :class="{ 'text-white-50': form.processing }"
                  :disabled="form.processing"
                  class="btn btn-primary"
                >
                  <div
                    v-show="form.processing"
                    class="spinner-border spinner-border-sm"
                  >
                    <span class="visually-hidden">{{ __("loading") }}...</span>
                  </div>
                  {{ __("send message") }}
                </button>
              </div>
            </div>
                </div>
            <div class="col-md-6 ps-md-5 ps-0">
            <img src="@/images/icons/file.png"  style="height: 340px; width: 500px;" alt="">
                <div
              v-if="
                getPageContentType('contact_page_description') == 'textarea'
              "
            >
              <div v-html="getPageContent('contact_page_description')"></div>
            </div>
            <p
              v-else-if="
                getPageContentType('contact_page_description') == 'text'
              "
            >
              {{ getPageContent("contact_page_description") ?? __(" ") }}
            </p>
            <div v-else>
              -------------------------------------
            </div>
            </div>
            </div>
          </div>
          <!-- <div class="col-md-12">
            <div
              v-if="
                getPageContentType('contact_page_description') == 'textarea'
              "
            >
              <div v-html="getPageContent('contact_page_description')"></div>
            </div>
            <p
              v-else-if="
                getPageContentType('contact_page_description') == 'text'
              "
            >
              {{ getPageContent("contact_page_description") ?? __(" ") }}
            </p>
            <div v-else>
              -------------------------------------
            </div>
          </div> -->

        </div>
      </div>
    </div>
  </app-layout>
</template>
<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import PageHeader from "@/Components/PageHeader.vue";
import ValidationErrors from "@/Components/ValidationErrors.vue";
import Navbar from "@/Layouts/AppIncludes/Navbar.vue";

export default defineComponent({
  components: {
    AppLayout,
    Navbar,
    PageHeader,
    ValidationErrors,
  },
  data() {
    return {
      form: this.$inertia.form({
        name: "",
        email: "",
        phone: "",
        message: "",
        agree_terms: 0,
      }),
    };
  },
  methods: {
    submit() {
      this.form.post(this.route("contact.store"), {
        onSuccess: () =>
          this.form.reset("name", "email", "phone", "message", "agree_terms"),
      });
    },
  },
});
</script>
