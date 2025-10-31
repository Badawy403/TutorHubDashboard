<template>
  <action-section>
    <template #title> Two Factor Authentication </template>

    <template #description>
      Add additional security to your account using two factor authentication.
    </template>

    <template #content>
      <h3 class="h5 font-weight-bold" v-if="twoFactorEnabled">
        You have enabled two factor authentication.
      </h3>

      <h3 class="h5 font-weight-bold" v-else>
        You have not enabled two factor authentication.
      </h3>

      <div class="mt-3">
        <p>
          When two factor authentication is enabled, you will be prompted for a
          secure, random token during authentication. You may retrieve this
          token from your phone's Google Authenticator application.
        </p>
      </div>

      <div v-if="twoFactorEnabled">
        <div v-if="qrCode">
          <div class="mt-3">
            <p>
              Two factor authentication is now enabled. Scan the following QR
              code using your phone's authenticator application.
            </p>
          </div>

          <div class="mt-3" v-html="qrCode"></div>
        </div>

        <div v-if="recoveryCodes.length > 0">
          <div class="mt-3">
            <p>
              Store these recovery codes in a secure password manager. They can
              be used to recover access to your account if your two factor
              authentication device is lost.
            </p>
          </div>

          <div class="w-75 bg-light rounded p-3">
            <div v-for="code in recoveryCodes">
              {{ code }}
            </div>
          </div>
        </div>
      </div>

      <div class="mt-3">
        <div v-if="!twoFactorEnabled">
          <confirms-password @confirmed="enableTwoFactorAuthentication">
            <button
              type="button"
              :class="{ 'text-white-50': enabling }"
              :disabled="enabling"
            >
              <div
                v-show="enabling"
                class="spinner-border spinner-border-sm"
                role="status"
              >
                <span class="visually-hidden">Loading...</span>
              </div>

              Enable
            </button>
          </confirms-password>
        </div>

        <div v-else>
          <confirms-password @confirmed="regenerateRecoveryCodes">
            <secondary-button class="me-3" v-if="recoveryCodes.length > 0">
              Regenerate Recovery Codes
            </secondary-button>
          </confirms-password>

          <confirms-password @confirmed="showRecoveryCodes">
            <secondary-button class="me-3" v-if="recoveryCodes.length == 0">
              Show Recovery Codes
            </secondary-button>
          </confirms-password>

          <confirms-password @confirmed="disableTwoFactorAuthentication">
            <danger-button
              :class="{ 'text-white-50': disabling }"
              :disabled="disabling"
            >
              <div
                v-show="form.processing"
                class="spinner-border spinner-border-sm"
                role="status"
              >
                <span class="visually-hidden">Loading...</span>
              </div>

              Disable
            </danger-button>
          </confirms-password>
        </div>
      </div>
    </template>
  </action-section>
</template>

<script>
import { defineComponent } from "vue";
import ActionSection from "@/Components/ActionSection.vue";
import Button from "@/Components/Button.vue";
import ConfirmsPassword from "@/Components/ConfirmsPassword.vue";
import DangerButton from "@/Components/DangerButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";

export default defineComponent({
  components: {
    ActionSection,
    Button,
    ConfirmsPassword,
    DangerButton,
    SecondaryButton,
  },

  data() {
    return {
      enabling: false,
      disabling: false,

      qrCode: null,
      recoveryCodes: [],
    };
  },

  methods: {
    enableTwoFactorAuthentication() {
      this.enabling = true;

      this.$inertia.post(
        "/user/two-factor-authentication",
        {},
        {
          preserveScroll: true,
          onSuccess: () =>
            Promise.all([this.showQrCode(), this.showRecoveryCodes()]),
          onFinish: () => (this.enabling = false),
        }
      );
    },

    showQrCode() {
      return axios.get("/user/two-factor-qr-code").then((response) => {
        this.qrCode = response.data.svg;
      });
    },

    showRecoveryCodes() {
      return axios.get("/user/two-factor-recovery-codes").then((response) => {
        this.recoveryCodes = response.data;
      });
    },

    regenerateRecoveryCodes() {
      axios.post("/user/two-factor-recovery-codes").then((response) => {
        this.showRecoveryCodes();
      });
    },

    disableTwoFactorAuthentication() {
      this.disabling = true;

      this.$inertia.delete("/user/two-factor-authentication", {
        preserveScroll: true,
        onSuccess: () => (this.disabling = false),
      });
    },
  },

  computed: {
    twoFactorEnabled() {
      return !this.enabling && this.$page.props.user.two_factor_enabled;
    },
  },
});
</script>
