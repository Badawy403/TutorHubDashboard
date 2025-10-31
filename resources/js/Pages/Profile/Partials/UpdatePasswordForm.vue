<template>
  <form-section @submitted="updatePassword">
    <template #title> Update Password </template>

    <template #description>
      Ensure your account is using a long, random password to stay secure.
    </template>

    <template #form>
      <action-message :on="form.recentlySuccessful"> Saved. </action-message>

      <div class="w-75">
        <div class="mb-3">
          <label for="current_password" value="Current Password" />
          <input
            id="current_password"
            type="password"
            :class="{ 'is-invalid': form.errors.current_password }"
            v-model="form.current_password"
            ref="current_password"
            autocomplete="current-password"
          />
          <input-error :message="form.errors.current_password" class="mt-2" />
        </div>

        <div class="mb-3">
          <label for="password" value="New Password" />
          <input
            id="password"
            type="password"
            :class="{ 'is-invalid': form.errors.password }"
            v-model="form.password"
            autocomplete="new-password"
          />
          <input-error :message="form.errors.password" class="mt-2" />
        </div>

        <div class="mb-3">
          <label for="password_confirmation" value="Confirm Password" />
          <input
            id="password_confirmation"
            type="password"
            :class="{ 'is-invalid': form.errors.password_confirmation }"
            v-model="form.password_confirmation"
            autocomplete="new-password"
          />
          <input-error
            :message="form.errors.password_confirmation"
            class="mt-2"
          />
        </div>
      </div>
    </template>

    <template #actions>
      <button
        :class="{ 'text-white-50': form.processing }"
        :disabled="form.processing"
      >
        <div
          v-show="form.processing"
          class="spinner-border spinner-border-sm"
          role="status"
        >
          <span class="visually-hidden">Loading...</span>
        </div>

        Save
      </button>
    </template>
  </form-section>
</template>

<script>
import { defineComponent } from "vue";
import ActionMessage from "@/Components/ActionMessage.vue";
import Button from "@/Components/Button.vue";
import FormSection from "@/Components/FormSection.vue";
import Input from "@/Components/Input.vue";
import InputError from "@/Components/InputError.vue";
import Label from "@/Components/Label.vue";

export default defineComponent({
  components: {
    ActionMessage,
    Button,
    FormSection,
    Input,
    InputError,
    Label,
  },

  data() {
    return {
      form: this.$inertia.form({
        current_password: "",
        password: "",
        password_confirmation: "",
      }),
    };
  },

  methods: {
    updatePassword() {
      this.form.put(route("user-password.update"), {
        errorBag: "updatePassword",
        preserveScroll: true,
        onSuccess: () => this.form.reset(),
        onError: () => {
          if (this.form.errors.password) {
            this.form.reset("password", "password_confirmation");
            this.$refs.password.focus();
          }

          if (this.form.errors.current_password) {
            this.form.reset("current_password");
            this.$refs.current_password.focus();
          }
        },
      });
    },
  },
});
</script>
