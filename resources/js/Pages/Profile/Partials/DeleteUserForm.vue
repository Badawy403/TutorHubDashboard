<template>
  <action-section>
    <template #title> Delete Account </template>

    <template #description> Permanently delete your account. </template>

    <template #content>
      <div>
        Once your account is deleted, all of its resources and data will be
        permanently deleted. Before deleting your account, please download any
        data or information that you wish to retain.
      </div>

      <div class="mt-3">
        <danger-button @click="confirmUserDeletion">
          Delete Account
        </danger-button>
      </div>

      <!-- Delete Account Confirmation Modal -->
      <dialog-modal id="confirmingUserDeletionModal">
        <template #title> Delete Account </template>

        <template #content>
          Are you sure you want to delete your account? Once your account is
          deleted, all of its resources and data will be permanently deleted.
          Please enter your password to confirm you would like to permanently
          delete your account.

          <div class="mt-4">
            <input
              type="password"
              placeholder="Password"
              ref="password"
              v-model="form.password"
              :class="{ 'is-invalid': form.errors.password }"
              @keyup.enter="deleteUser"
            />

            <input-error :message="form.errors.password" />
          </div>
        </template>

        <template #footer>
          <secondary-button data-dismiss="modal" @click="closeModal">
            Cancel
          </secondary-button>

          <danger-button
            @click="deleteUser"
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

            Delete Account
          </danger-button>
        </template>
      </dialog-modal>
    </template>
  </action-section>
</template>

<script>
import { defineComponent } from "vue";
import ActionSection from "@/Components/ActionSection.vue";
import DialogModal from "@/Components/DialogModal.vue";
import DangerButton from "@/Components/DangerButton.vue";
import Input from "@/Components/Input.vue";
import InputError from "@/Components/InputError.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";

export default defineComponent({
  components: {
    ActionSection,
    DangerButton,
    DialogModal,
    Input,
    InputError,
    SecondaryButton,
  },

  data() {
    return {
      modal: null,
      form: this.$inertia.form({
        password: "",
      }),
    };
  },

  methods: {
    confirmUserDeletion() {
      this.form.password = "";

      let el = document.querySelector("#confirmingUserDeletionModal");
      this.modal = new bootstrap.Modal(el);
      this.modal.show();

      setTimeout(() => this.$refs.password.focus(), 250);
    },

    deleteUser() {
      this.form.delete(route("current-user.destroy"), {
        preserveScroll: true,
        onSuccess: () => this.closeModal(),
        onError: () => this.$refs.password.focus(),
        onFinish: () => this.form.reset(),
      });
    },

    closeModal() {
      this.form.reset();

      this.modal.hide();
    },
  },
});
</script>
