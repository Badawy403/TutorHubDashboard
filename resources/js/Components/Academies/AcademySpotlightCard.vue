<template>
  <div class="w-100 h-100 mb-4 px-5" :class="{ 'item': add_col }">

        <div class="card spotlight-card shadow-sm p-4 item-h border-0">

            <div class="card-body p-0">
              <div class="row">
                <div class="col-md-3">
            <i v-if="academy.is_featured" class="bi bi-patch-check-fill position-absolute top-0 start-0 fs-2"
            style="z-index:9"></i>
              <Link :href="route('academy.profile', {  'user_name': academy.user_name })">
            <div class="d-flex mb-3 d-flex mb-3 justify-content-center card-avatar overflow-hidden position-relative" style="height: 205px;">

              <img v-if="academy.image" class="img-fluid m-3" :src="academy.image" alt="academy">
              <img v-if="!academy.image" class="img-fluid m-3" src="@/images/account/default_avatar_men.png" alt="academy">
              <!-- <div class="item-overlay top">
                <Link :href="route('academy.profile', { 'user_name': academy.user_name })"
                  class="btn rounded-5 border-0 text-white px-4 btn-primary">View Profile</Link>
              </div> -->

            </div>
          </Link>
          </div>
          <div class="col-md-9">
            <div class="card rounded-2xxl border-0 bg-transparent mb-4" style="border-radius: 20px;">
                <div class="card-body p-0">
                  <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex flex-column align-items-start">
                      <h2 class="mb-0 fs-6 text-capitalize">
                      <Link class="text-decoration-none" :href="route('academy.profile', {  'user_name': academy.user_name })">{{ academy.name }}</Link>
                    </h2>

                    <div class="mt-2">
                        <ul class="list-unstyled d-flex align-items-center">
                          <li class=" me-3 pe-3 border-end"
                            style="font-size: 12px;" v-for="(cat, i) in academy.academy_categories" :key="cat.id">
                          {{ cat.name }}
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="d-flex align-items-center">

                    <button class="btn btn-primary btn-sm ">
                      {{ __('book appointment') }}</button>
                  </div>

                </div>
              </div>
            </div>
            <div style="font-size:14px" v-html="academy.description" class=" text-start"></div>

            <div class="row mt-3">
                <div class="col-3 text-start">
                    <h6 class="fs-6 fw-bold">Experience</h6>
                    <p>9 years</p>
                </div>

                <div class="col-3 text-start">
                    <h6 class="fs-6 fw-bold">Experience</h6>
                    <p>9 years</p>
                </div>

                <div class="col-3 text-start">
                    <div class="d-flex flex-column align-items-start me-4">
                        <span>{{ __('rating') }} ({{ academy.rating }}/5)</span>
                        <span class="text-warning">
                          <star-rating :rating="academy.rating" :star-size="18" :read-only="true" :increment="0.01" :show-rating="false"></star-rating>
                        </span>
                      </div>
                </div>

                <div class="col-3 text-start">
                    <h6 class="fs-6 fw-bold">Social Links</h6>
                    <ul class="d-flex flex-wrap ps-0 mb-0 list-group list-group-horizontal">
                        <li class="list-group-item p-1 bg-transparent border-0" v-if="academy.academy_settings.facebook_url"><a
                            target="_blank" class="text-white" :href="academy.academy_settings.facebook_url"><i
                              class="bi bi-facebook"></i></a></li>
                        <li class="list-group-item p-1 bg-transparent border-0" v-if="academy.academy_settings.youtube_url"><a
                            target="_blank" class="text-white" :href="academy.academy_settings.youtube_url"><i
                              class="bi bi-youtube"></i></a></li>
                        <li class="list-group-item p-1 bg-transparent border-0" v-if="academy.academy_settings.twitter_url"><a
                            target="_blank" class="text-white" :href="academy.academy_settings.twitter_url"><i
                              class="bi bi-twitter"></i></a></li>
                        <li class="list-group-item p-1 bg-transparent border-0" v-if="academy.academy_settings.linkedin_url"><a
                            target="_blank" class="text-white" :href="academy.academy_settings.linkedin_url"><i
                              class="bi bi-linkedin"></i></a></li>
                        <li class="list-group-item p-1 bg-transparent border-0" v-if="academy.academy_settings.whatsapp_url"><a
                            target="_blank" class="text-white" :href="academy.academy_settings.whatsapp_url"><i
                              class="bi bi-whatsapp"></i></a></li>
                        <li class="list-group-item p-1 bg-transparent border-0" v-if="academy.academy_settings.instagram_url"><a
                            target="_blank" class="text-white" :href="academy.academy_settings.instagram_url"><i
                              class="bi bi-instagram"></i></a></li>
                        <li class="list-group-item p-1 bg-transparent border-0" v-if="academy.academy_settings.tiktok_url"><a
                            target="_blank" class="text-white" :href="academy.academy_settings.tiktok_url"><i
                              class="bi bi-tiktok"></i></a></li>
                        <li class="list-group-item p-1 bg-transparent border-0" v-if="academy.academy_settings.snapchat_url"><a
                            target="_blank" class="text-white" :href="academy.academy_settings.snapchat_url"><i
                              class="bi bi-snapchat"></i></a></li>
                        <li class="list-group-item p-1 bg-transparent border-0" v-if="academy.academy_settings.pinterest_url"><a
                            target="_blank" class="text-white" :href="academy.academy_settings.pinterest_url"><i
                              class="bi bi-pinterest"></i></a></li>

                      </ul>
                </div>
              </div>

          </div>
        </div>

      </div>

    </div>

  </div>
</template>
<script>
import { defineComponent } from "vue";
import { Link } from "@inertiajs/inertia-vue3";

export default defineComponent({
  components: {
    Link,
  },
  props: ['academy', 'add_col'],
  created() {

  },
  data() {
    return {
    };
  },
  methods: {
  },
});
</script>
