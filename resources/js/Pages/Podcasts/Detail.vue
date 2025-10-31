<template>
  <app-layout title="podcast">
    <template #default>
      <div class="py-5">
        <div class="container">
          <div class="row">
            <h2 class="text-center display-2 text-primary fw-bold mb-2">
                {{ __("podcast") }} {{ __n("Details") }}
            </h2>
            <div class="col-12">
              <div
                v-if="
                  getPageContentType('podcasts_page_description') == 'textarea'
                "
              >
                <div v-html="getPageContent('podcasts_page_description')"></div>
              </div>
              <div
                v-else-if="
                  getPageContentType('podcasts_page_description') == 'text'
                "
              >
                <p>{{ getPageContent("podcasts_page_description") ?? "-" }}</p>
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
                        <h1 class="display-6 text-primary mb-4">{{ podcast.name }}</h1>
                        <div class="col-md-12">
                        <img
                        v-if="podcast.image"
                        class="img-fluid rounded-4 detail-image"
                        :src="podcast.image"
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
                        <div class="fs-3 pt-4" v-html="podcast.description"></div>
                    </div>
                    <div class="d-flex justify-content-start mt-3">
                    <div v-if="podcast.link_type == 'internal'">
                      <video
                        v-if="podcast.file_type == 'video'"
                        width="400"
                        controls
                      >
                        <source :src="podcast.video" />
                      </video>
                      <audio v-if="podcast.file_type == 'audio'" controls>
                        <source :src="podcast.audio" />
                      </audio>
                    </div>
                    <div v-else>
                      <iframe width="420" height="315" :src="podcast.file_url">
                      </iframe>
                    </div>
                  </div>

                    </div>
                </div>
                </div>
                </div>
              <!-- <div class="row">
                <div class="col-md-12">
                  <div class="mb-4" style="height: 400px">
                    <img
                      v-if="podcast.image"
                      class="img-fluid  rounded-5"
                      :src="podcast.image"
                      alt="image"
                      style="height: 400px; object-fit: cover"
                    />
                    <img
                      v-else
                      class="img-fluid  rounded-5"
                      src="@/images/common/podcast.png"
                      alt="image"
                      style="height: 400px; object-fit: cover"
                    />
                  </div>
                </div>
                <div class="col-md-12 pb-4">
                  <h1 class="text-start text-capitalize text-primary">{{ podcast.name }}</h1>
                  <div class="mb-3 line-clamp" v-html="podcast.description"></div>
                  <div class="d-flex justify-content-start mt-3">
                    <div v-if="podcast.link_type == 'internal'">
                      <video
                        v-if="podcast.file_type == 'video'"
                        width="400"
                        controls
                      >
                        <source :src="podcast.video" />
                      </video>
                      <audio v-if="podcast.file_type == 'audio'" controls>
                        <source :src="podcast.audio" />
                      </audio>
                    </div>
                    <div v-else>
                      <iframe width="420" height="315" :src="podcast.file_url">
                      </iframe>
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
  props: ["podcast"],
  created() {},
  data() {
    return {
      posts: {},
      breadcrums: [
        {
          id: 1,
          name: "Home",
          link: "/",
        },
        {
          id: 2,
          name: "Podcasts",
          link: "",
        },
      ],
    };
  },
});
</script>
