<template>
  <app-layout title="Dashboard">
    <template #header>
      <!-- <page-header>
                {{ company_page.name }}
            </page-header> -->
    </template>
    <template #default>
      <div class="py-5">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <h2 class="text-center display-2 text-primary">
                <span>{{ company_page.heading ?? '' }}</span>
              </h2>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center mb-0 fw-bold">
                  <li class="breadcrumb-item">
                    <Link class="text-decoration-none" :href="route('home')">{{ __('home') }}</Link>
                  </li>
                  <li class="breadcrumb-item" aria-current="page">{{ company_page.name ?? '' }}</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
      <div class="section general-pages py-0">

        <div class="container">
          <div class="row py-5">
            <div class="col-lg-12">
              <div class="d-flex justify-content-center flex-column">
                <div v-html="company_page.description"></div>
              </div>
            </div>
            <!-- <div class="col-lg-6" v-if="company_page.image">
              <img :src="company_page.image" alt="" class="w-100 h-auto img-fluid rounded overflow-hidden">
            </div> -->

          </div>
        </div>
      </div>
    </template>
  </app-layout>
</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import Navbar from "@/Layouts/AppIncludes/Navbar.vue";
import PageHeader from "@/Components/PageHeader.vue";
import { Link } from "@inertiajs/inertia-vue3";

export default defineComponent({
  components: {
    AppLayout,
    Navbar,
    PageHeader,
    Link,
  },
  props: ["company_page"],
});
</script>
