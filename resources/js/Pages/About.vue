<template>
    <app-layout title="Dashboard">
      <template #header>
        <!-- <page-header>
                  {{ about_page.name }}
        </page-header> -->
      </template>
      <template #default>
        <div class="py-5">
          <div class="container">
            <div class="row">
              <div class="col-lg-12">
                <h2 class="text-center display-2 text-primary">
                  <span>{{ about_page.heading ?? '' }}</span>
                </h2>
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item">
                      <a href="/" class="text-decoration-none">{{ __('home') }}</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">{{ about_page.name ?? '' }}</li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </div>
        <div class="section general-pages py-5">

          <div class="container">
            <div class="row">
              <div class="col-lg-12">
                <div class="row">

                <div class="col-md-6">
                  <div v-html="about_page.description"></div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex justify-content-end">
                        <img :src="about_page.image" class="rounded-4 img-about" alt="">
                    </div>
                    </div>
                </div>
              </div>
              <!-- <div class="col-lg-6" v-if="about_page.image">
                <img :src="about_page.image" alt="" class="w-100 h-auto img-fluid rounded overflow-hidden">
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

  export default defineComponent({
    components: {
      AppLayout,
      Navbar,
      PageHeader,
    },
    props: ["about_page"],
  });
  </script>
