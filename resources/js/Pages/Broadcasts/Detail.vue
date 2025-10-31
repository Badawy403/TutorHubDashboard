<template>
  <app-layout title="Dashboard">
    <template #header>
      <!-- <page-header>
                {{ __('broadcast') }}
            </page-header> -->
    </template>
    <template #default>
      <div class="py-5">
        <div class="container">
          <div class="row">
            <h2 class="text-center display-2 text-primary fw-bold mb-2">
                {{ __("broadcast") }} {{ __n("Details") }}
            </h2>
            <div class="col-12">
              <div
                v-if="
                  getPageContentType('media_page_description') == 'textarea'
                "
              >
                <div v-html="getPageContent('media_page_description')"></div>
              </div>
              <div
                v-else-if="
                  getPageContentType('media_page_description') == 'text'
                "
              >
                <p>{{ getPageContent("media_page_description") ?? "-" }}</p>
              </div>
              <div v-else>
                <p class="fs-4 text-center text-secondary">Our team of highly skilled attorneys comprises seasoned
                professionals
                with extensive experience in their respective fields. We pride ourselves<br> on recruiting top legal
                talent,
                ensuring that you receive the highest standard of representation. From complex litigation to intricate.
              </p>
                <!-- <p class="text-center mb-0">Discover The Best Teachers Near You</p> -->
              </div>

              <breadcrums :breadcrums="breadcrums"></breadcrums>
            </div>
          </div>
        </div>
      </div>
      <div class="section py-5">
        <div class="container">
          <div class="row">
            <div class="col-12">
                <div class="row">
            <div class="col-md-12">
                <div class="card rounded-4 p-md-5 ">
                    <div class="card-body">
                        <h1 class="display-6 text-primary mb-4">{{ broadcast.name }}</h1>
                        <div class="col-md-12">
                        <img
                        v-if="broadcast.image"
                        class="img-fluid rounded-4 detail-image"
                        :src="broadcast.image"
                        alt="image"
                        />
                       <img
                        v-else
                        class="img-fluid rounded-4 detail-image"
                        src="@/images/common/image.png"
                        alt="image"
                      />
                        </div>
                     <div class="col-md-12">
                        <div class="fs-3 pt-4" v-html="broadcast.description"></div>
                    </div>
                    <!-- <div class="d-flex">
                      <div class="" style="word-break: break-all">

                        <div
                          class="mb-3"
                          v-if="broadcast.link_type == 'internal'"
                        >
                          <video
                            v-if="broadcast.file_type == 'video'"
                            width="400"
                            controls
                          >
                            <source :src="broadcast.video" />
                          </video>
                          <audio v-if="broadcast.file_type == 'audio'" controls>
                            <source :src="broadcast.audio" />
                          </audio>
                        </div>
                        <div v-else>
                          <iframe
                            width="420"
                            height="315"
                            class="image-c"
                            :src="broadcast.file_url"
                            style="float: left;"
                          >
                        </iframe>

                        </div>
                    </div>
                    </div> -->
                    </div>
                </div>
                </div>
                </div>
              <!-- <div class="row">
                <div class="wrapper">
                  <div class="w-100">
                    <h1 class="text-start text-capitalize mb-3">
                      {{ broadcast.name }}
                    </h1>
                    <div class="d-flex">
                      <div class="" style="word-break: break-all">

                        <div
                          class="mb-3"
                          v-if="broadcast.link_type == 'internal'"
                        >
                          <video
                            v-if="broadcast.file_type == 'video'"
                            width="400"
                            controls
                          >
                            <source :src="broadcast.video" />
                          </video>
                          <audio v-if="broadcast.file_type == 'audio'" controls>
                            <source :src="broadcast.audio" />
                          </audio>
                        </div>
                        <div v-else>
                          <iframe
                            width="420"
                            height="315"
                            class="image-c"
                            :src="broadcast.file_url"
                            style="float: left;"
                          >
                        </iframe>
                        <div class="mb-3" v-html="broadcast.description"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div> -->
            </div>
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
import Breadcrums from "../../Components/Shared/Breadcrums.vue";
export default defineComponent({
  components: {
    AppLayout,
    Navbar,
    PageHeader,
    Breadcrums,
  },
  props: ["broadcast"],
  created() {},
  data() {
    return {
      broadcasts: {},
      breadcrums: [
        {
          id: 1,
          name: "Home",
          link: "/",
        },
        {
          id: 2,
          name: "Media",
          link: "",
        },
      ],
    };
  },
});
</script>
