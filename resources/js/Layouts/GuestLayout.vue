<template>
  <div class="loader-container" :class="{ 'd-none': !showLoader }">
    <div class="loader">
      <img width="200" :src="$page.props.settings.logo" alt="logo" />
    </div>
    <div class="lds-ellipsis">
      <div></div>
      <div></div>
      <div></div>
      <div></div>
    </div>
  </div>
  <main class="page-content">
    <slot></slot>
  </main>
</template>

<script>
import { Inertia } from "@inertiajs/inertia";
export default {

  components: {
  },

  data() {
    return {
      showLoader: false,
    };
  },
  watch: {
    "$page.props.flash.alert": {
      handler() {
        this.showAlert()
      },
      deep: true,
    }
  },
  created() {
    Inertia.on("start", (event) => {
      if (
        event.detail.visit.method == "get" &&
        event.detail.visit.url.pathname != this.path
      ) {
        this.showLoader = true;
      }
    });
    Inertia.on("finish", (event) => {
      this.showLoader = false;
    });
  },
  mounted() {
    this.showAlert()
  },
  methods: {
    logout() {
      this.$inertia.post(route("logout"));
    },
    showAlert() {
      if (this.$page.props.flash.alert) {
        if (this.$page.props.flash.alert.type == 'success') {
          this.$toast.success(this.$page.props.flash.alert.message)
        }
        else if (this.$page.props.flash.alert.type == 'error') {
          this.$toast.error(this.$page.props.flash.alert.message)
        }
        else if (this.$page.props.flash.alert.type == 'warning') {
          this.$toast.warning(this.$page.props.flash.alert.message)
        }
        else if (this.$page.props.flash.alert.type == 'info') {
          this.$toast.info(this.$page.props.flash.alert.message)
        } else {
          this.$toast.show(this.$page.props.flash.alert.message)
        }
      }
    }
  },

  computed: {
  }
}
</script>
