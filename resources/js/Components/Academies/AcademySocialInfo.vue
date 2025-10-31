<template>
  <div class="tab-pane" :class="{ active: active }" id="socialInfo" role="tabpanel" aria-labelledby="social-info-tab"
    tabindex="0">
    <form @submit.prevent="submit" class="profileForm">
      <div class="row">
        <div class="col-md-12">
          <validation-errors></validation-errors>
          <div class="col-md-12">
          <div class="card bg-transparent border border-info">

            <div class="card-body">
                <h4 class="text-primary ms-2 fs-2 fw-bold">{{ __("Social Media Info") }}</h4>
                <hr>
                <validation-errors></validation-errors>
                <div class="col-12">
                    <div class="row">
                    <div v-for="(setting, i) in form.settings" :key="i" class="col-md-12 mb-1" :class="{'bg' : i % 2 == 0 }" >
                       <div class="col-md-6 py-2 mx-auto">
                        <div  class="form-group d-flex align-items-center gap-3">
                        <img :src="'/assets/icons/'+setting.image_url" width="40" alt="">
                        <label class="col-3" :for="setting.display_name">{{setting.display_name}}</label>
                        <input  v-model="setting.value" placeholder="Please Enter" class="w-100 form-control px-3"
                            type="text" />
                        </div>
                       </div>

                    </div>
                    </div>
                <div class="row mt-2 align-items-center">
                <div class="col-md-9 text-end">
                    <button type="submit" :disabled="form.processing" class="submit btn btn-primary">
                    <SpinnerLoader v-if="form.processing" />
                    {{__('Save Changes')}}
                    </button>
                </div>
                </div>
            </div>

            </div>

          </div>

        </div>


        </div>
      </div>
    </form>
  </div>
</template>
<script>
import { defineComponent } from "vue";
import ValidationErrors from "@/Components/ValidationErrors.vue";
import SpinnerLoader from "@/Components/Shared/SpinnerLoader.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import axios from "axios";

export default defineComponent({
  components: {
    Head,
    SpinnerLoader,
    ValidationErrors,
    Link,
  },
  props: ['active'],
  data() {
    return {
      form: this.$inertia.form({
        settings: [{
          'name': 'facebook_url',
          'display_name': "Facebook Url",
          'image_url':"facebook.png",
          'value': this.$page.props.academy.academy_settings['facebook_url'] ?? "",
        },
        {
          'name': 'twitter_url',
          'display_name': "Twitter Url",
          'image_url':"twitter.png",
          'value': this.$page.props.academy.academy_settings['twitter_url'] ?? "",
        },
        {
          'name': 'youtube_url',
          'display_name': "Youtube Url",
          'image_url':"youtube.png",
          'value': this.$page.props.academy.academy_settings['youtube_url'] ?? "",
        },
        {
          'name': 'tiktok_url',
          'display_name': "TikTok Url",
          'image_url':"tiktok.png",
          'value': this.$page.props.academy.academy_settings['tiktok_url'] ?? "",
        },
        {
          'name': 'linkedin_url',
          'display_name': "LinkedIn Url",
          'image_url':"linkedin.png",
          'value': this.$page.props.academy.academy_settings['linkedin_url'] ?? "",
        },
        {
          'name': 'whatsapp_url',
          'display_name': "Whatsapp Url",
          'image_url':"whatsapp.png",
          'value': this.$page.props.academy.academy_settings['whatsapp_url'] ?? "",
        },
        {
          'name': 'snapchat_url',
          'display_name': "Snapchat Url",
          'image_url':"snapchat.png",
          'value': this.$page.props.academy.academy_settings['snapchat_url'] ?? "",
        },
        {
          'name': 'instagram_url',
          'display_name': "Instagram Url",
          'image_url':"instagram.png",
          'value': this.$page.props.academy.academy_settings['instagram_url'] ?? "",
        },
        {
          'name': 'pinterest_url',
          'display_name': "PinTerest Url",
          'image_url':"pinterest.png",
          'value': this.$page.props.academy.academy_settings['pinterest_url'] ?? "",
        }
        ]
      }),
    };
  },
  methods: {
    submit() {
      this.form
        .transform((data) => ({
          ...data,
          remember: this.form.remember ? "on" : "",
        }))
        .post(this.route("academies.update_settings"), {
            onSuccess: () => {
                         this.goToNextTab()
                    }
        });
    },
    goToNextTab(){
            this.$inertia.visit(route('account'),{data:{active_tab:'broadcasts'}})
        }
  },
});
</script>

<style scoped>
.bg {
 background-color: #E7F3FA;
}
</style>
