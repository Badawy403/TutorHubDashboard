<template>
  <app-layout title="blogs">
    <template #default>
        <div class="pt-5">
            <div class="container">
                <div class="row">
                    <h2 class="text-center display-2 text-primary fw-bold mb-2">
                {{ __("blog") }} {{ __n("Details") }}
            </h2>
                    <div class="col-12 text-center">
                        <div v-if="getPageContentType('blogs_page_description') == 'textarea'
                            ">
                            <div v-html="getPageContent('blogs_page_description')"></div>
                        </div>
                        <div v-else-if="getPageContentType('blogs_page_description') == 'text'
                            ">
                            <p>{{ getPageContent("blogs_page_description") ?? "-" }}</p>
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
            <div class="col-md-12">
                <div class="card rounded-4 p-md-5 ">
                    <div class="card-body">
                        <h1 class="display-6 text-primary mb-4">{{ post.name }}</h1>
                        <div class="col-md-12">
                        <img
                        v-if="post.image"
                        class="img-fluid rounded-4 detail-image"
                        :src="post.image"
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
                        <div class="fs-3 pt-4" v-html="post.description"></div>
                    </div>
                    </div>
                </div>
              <!-- <div class="row">
                <div class="col-12">
                  <div class="row">
                    <div class="col-md-4">
                    <div class="mb-4 d-flex justify-content-md-end padding-end" style="height: 350px">
                        <img
                        v-if="post.image"
                        class="img-fluid rounded-5"
                        :src="post.image"
                        alt="image"
                        style="height: 350px; object-fit: cover"
                        />
                       <img
                        v-else
                        class="img-fluid"
                        src="@/images/common/image.png"
                        alt="image"
                      />
                    </div>
                    </div>
                    <div class="col-md-8 pb-4">
                        <h1 class="text-start mb-3 text-primary">{{ post.name }}</h1>
                        <div v-html="post.description"></div>
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
  props: ["post"],
  created() {
    },
    data() {
        return {
            posts: {},
            breadcrums:[
                {
                    id:1,
                    name:'Home',
                    link:'/'
                },
                {
                    id:2,
                    name:'Blogs',
                    link:''
                }
            ]
        }
    },
});
</script>
