<template>
  <div class="tab-pane" :class="{ active: active }" id="youtube" role="tabpanel" aria-labelledby="youtube-tab"
    tabindex="0">
    <form @submit.prevent="submit" class="profileForm">
      <div class="row">
        <div class="col-md-12">
          <validation-errors></validation-errors>
          <div class="col-12">
            <div class="row">
              <div v-for="(setting, i) in form.settings" :key="i" class="col-md-6">
                <div  class="form-group mb-3">
                  <label class="mb-2 fs-4 fw-bold" :for="setting.display_name">{{setting.display_name}}</label>
                  <input v-model="setting.value" placeholder="Please Enter" class="w-100 form-control  px-3 rounded-3"
                    type="text" />
                </div>

              </div>

            </div>
            <div class="row align-items-center">
              <div class="col-md-4">
                <button type="submit" :disabled="form.processing" class="submit btn btn-primary">
                  <SpinnerLoader v-if="form.processing" />
                  {{__('Save')}}
                </button>
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
          'name': 'youtube_playlist_link',
          'display_name': "Youtube PlayList Link",
          'value': this.$page.props.academy.academy_settings['youtube_playlist_link'] ?? "",
        },
        {
          'name': 'youtube_channel_link',
          'display_name': "Youtube Channel Link",
          'value': this.$page.props.academy.academy_settings['youtube_channel_link'] ?? "",
        },
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
                        //  this.goToNextTab()
                    }
        });
    },
    goToNextTab(){
            this.$inertia.visit(route('account'),{data:{active_tab:'broadcasts'}})
        }
  },
});
</script>
