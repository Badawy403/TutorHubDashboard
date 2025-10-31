<template>
  <span>
    <span @click="startConfirmingPassword">
      <slot />
    </span>

    <dialog-modal id="confirmingPasswordModal">
      <template #title>
        {{ title }}
      </template>

      <template #content>
        {{ content }}

        <div class="mt-4">
          <input
            type="password"
            placeholder="Password"
            ref="password"
            v-model="form.password"
            :class="{ 'is-invalid': form.error }"
            @keyup.enter="confirmPassword"
          />

          <input-error :message="form.error" />
        </div>
      </template>

      <template #footer>
        <secondary-button data-bs-dismiss="modal"> Cancel </secondary-button>

        <button
          class="ms-2"
          @click="confirmPassword"
          :class="{ 'text-black-50': form.processing }"
          :disabled="form.processing"
        >
          <div
            v-show="form.processing"
            class="spinner-border spinner-border-sm"
            role="status"
          >
            <span class="visually-hidden">Loading...</span>
          </div>

          {{ button }}
        </button>
      </template>
    </dialog-modal>
  </span>
</template>

<script>
import { defineComponent } from "vue";
import Button from "./Button.vue";
import DialogModal from "./DialogModal.vue";
import Input from "./Input.vue";
import InputError from "./InputError.vue";
import SecondaryButton from "./SecondaryButton.vue";

export default defineComponent({
  emits: ["confirmed"],

  props: {
    title: {
      default: "Confirm Password",
    },
    content: {
      default: "For your security, please confirm your password to continue.",
    },
    button: {
      default: "Confirm",
    },
  },

  components: {
    Button,
    DialogModal,
    Input,
    InputError,
    SecondaryButton,
  },

  data() {
    return {
      modal: null,

      form: this.$inertia.form(
        {
          password: "",
          error: "",
        },
        {
          bag: "confirmPassword",
        }
      ),
    };
  },

  methods: {
    startConfirmingPassword() {
      this.form.error = "";
      let el = document.querySelector("#confirmingPasswordModal");
      this.modal = new bootstrap.Modal(el);

      axios.get(route("password.confirmation")).then((response) => {
        if (response.data.confirmed) {
          this.$emit("confirmed");
        } else {
          this.modal.toggle();
          this.form.password = "";

          setTimeout(() => {
            this.$refs.password.focus();
          }, 250);
        }
      });
    },

    confirmPassword() {
      this.form.processing = true;

      axios
        .post(route("password.confirm"), {
          password: this.form.password,
        })
        .then((response) => {
          this.bootstrap.modal("hide");
          this.form.password = "";
          this.form.error = "";
          this.form.processing = false;

          this.$nextTick(() => this.$emit("confirmed"));
        })
        .catch((error) => {
          this.form.processing = false;
          this.form.error = error.response.data.errors.password[0];
        });
    },
  },
});
</script>
