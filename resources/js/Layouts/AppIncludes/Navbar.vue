<template>

  <nav class="navbar shadow navbar-expand-lg navbar-light"  :class="{ 'opacity-90' : !view.topOfPage }">
    <div class="container">
      <Link class="navbar-brand" :href="route('home')">
        <img v-if="$page.props && $page.props.settings && $page.props.settings.logo" style="width: 200px;"
          :src="$page.props.settings.logo" alt="logo">
        <span v-else class="text-white mt-4">
          {{ $page.props && $page.props.settings && $page.props.settings.site_title ? $page.props.settings.site_title :
            __('teacher consultant') }}
        </span>
        </Link>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse bg-prim py-sm-3 py-md-0" id="navbarSupportedContent" style="flex-grow: inherit">
        <ul class="navbar-nav ml-auto fw-semibold fs-4 py-3 py-md-0">
          <li class="nav-item" :class="{ active: route().current('home') }">
            <Link class="nav-link" :href="route('home')">
            {{ __("Home") }}
            </Link>
          </li>
          <li class="nav-item">
            <Link class="nav-link" :href="route('company_pages.display', { slug: 'about' })">
            {{ __("About") }}
            </Link>
          </li>
          <li class="nav-item">
            <Link class="nav-link" :href="route('categories')">
            {{ __("Categories") }}
            </Link>
          </li>
          <li class="nav-item" :class="{ active: route().current('about') }">
            <Link class="nav-link" :href="route('teachers.listing')">
            {{ __n("Tutors") }}
            </Link>
          </li>
          <li class="nav-item">
            <Link class="nav-link" :href="route('events.listing')">
            {{ __n("Events") }}
            </Link>
          </li>
          <li class="nav-item">
            <Link class="nav-link" :href="route('services.listing')">
            {{ __n("services") }}
            </Link>
          </li>

          <li class="nav-item">
            <Link class="nav-link" :href="route('academies.listing')">
            {{ __n("Academy") }}
            </Link>
          </li>
          <li class="nav-item" v-if="$page.props.auth && $page.props.auth.logged_in_as != 'super_admin'
            ">
            <div class="dropdown">
              <button class="dropdown-toggle d-flex align-items-center nav-link position-relative bg-transparent border-0"
                type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="position-absolute badge rounded-pill bg-primary" style="right: 8px; top: -10px;">{{
                  $page.props.auth.logged_in_as == 'teacher' ? 'tutor' : $page.props.auth.logged_in_as }}</span>
                {{ $page.props.auth[$page.props.auth.logged_in_as].name }}
              </button>
              <ul class="dropdown-menu">
                <li>
                  <Link :href="route('account')" class="dropdown-item">
                  {{ __("account") }}
                  </Link>
                </li>
                <li v-if="($page.props.auth.user.email_verified_at &&
                    hasRole('student') &&
                    $page.props.auth.logged_in_as == 'student') ||
                  (hasRole('teacher') &&
                    $page.props.auth.logged_in_as == 'teacher') ||
                  (hasRole('academy') &&
                    $page.props.auth.logged_in_as == 'academy')
                  ">
                  <Link :href="route('appointment_log')" class="dropdown-item">{{ __("my appointments") }}</Link>
                </li>
                <li
                  v-if="
                    ($page.props.auth.user.email_verified_at &&
                      hasRole('student') &&
                      $page.props.auth.logged_in_as == 'student') ||
                    (hasRole('teacher') &&
                      $page.props.auth.logged_in_as == 'teacher') ||
                    (hasRole('academy') &&
                      $page.props.auth.logged_in_as == 'academy')
                  "
                >
                  <Link
                    :href="route('service_log')"
                    class="dropdown-item"
                    >{{ __("my services") }}</Link
                  >
                </li>
                <li v-if="$page.props.auth.user.email_verified_at &&
                  hasRole('teacher') &&
                  $page.props.auth.logged_in_as == 'teacher'
                  ">
                  <Link :href="route('pricing', { type: 'teacher' })" class="dropdown-item">{{ __("subscription") }}
                  </Link>
                </li>
                <li v-if="$page.props.auth.user.email_verified_at &&
                  hasRole('academy') &&
                  $page.props.auth.logged_in_as == 'academy'
                  ">
                  <Link :href="route('pricing', { type: 'academy' })" class="dropdown-item">{{ __("subscription") }}
                  </Link>
                </li>

                <li v-if="$page.props.auth.user.email_verified_at &&
                  hasRole('teacher') &&
                  $page.props.auth.logged_in_as != 'teacher'
                  ">
                  <button @click="switchRole('teacher')" class="dropdown-item">
                    {{ __("switch to tutor") }}
                  </button>
                </li>
                <li v-if="$page.props.auth.user.email_verified_at &&
                  !hasRole('teacher') &&
                  $page.props.auth.logged_in_as != 'teacher'
                  ">
                  <button @click="becomeTeacher()" class="dropdown-item">
                    {{ __("become a tutor") }}
                  </button>
                </li>

                <li v-if="$page.props.auth.user.email_verified_at &&
                  hasRole('student') &&
                  $page.props.auth.logged_in_as != 'student'
                  ">
                  <button @click="switchRole('student')" class="dropdown-item">
                    {{ __("switch to user") }}
                  </button>
                </li>
                <li v-if="$page.props.auth.user.email_verified_at &&
                  !hasRole('student') &&
                  $page.props.auth.logged_in_as != 'student'
                  ">
                  <button @click="becomeUser()" class="dropdown-item">
                    {{ __("become a user") }}
                  </button>
                </li>

                <li v-if="$page.props.auth.user.email_verified_at &&
                  hasRole('academy') &&
                  $page.props.auth.logged_in_as != 'academy'
                  ">
                  <button @click="switchRole('academy')" class="dropdown-item">
                    {{ __("switch to academy") }}
                  </button>
                </li>
                <li v-if="$page.props.auth.user.email_verified_at &&
                  !hasRole('academy') &&
                  $page.props.auth.logged_in_as != 'academy'
                  ">
                  <button @click="becomeAcademy()" class="dropdown-item">
                    {{ __("become a academy") }}
                  </button>
                </li>
                <li v-if="(parseInt(this.$page.props.settings.enable_wallet_system) && $page.props.auth.user.email_verified_at && hasRole('student') && $page.props.auth.logged_in_as == 'student') || (hasRole('teacher') && $page.props.auth.logged_in_as == 'teacher') || (hasRole('academy') && $page.props.auth.logged_in_as == 'academy')
                  ">
                  <Link :href="route('wallet')" class="dropdown-item">{{ __("wallet") }}</Link>
                </li>
                <li>
                  <!-- <Link :href="route('logout')" class="dropdown-item">
                  <i class="bi bi-box-arrow-in-left"></i>
                    {{__("logout")}}
                  </Link> -->
                  <button style="cursor: pointer" @click="logout()" class="dropdown-item">
                    <i class="bi bi-box-arrow-in-left"></i> {{ __("logout") }}
                  </button>
                </li>
              </ul>
            </div>
          </li>
          <!-- <li class="nav-item dropdown" v-if="$page.props.company_pages && $page.props.company_pages.length > 0">

            <a class="nav-link dropdown-toggle" href="#" id="companyPagesDropDown" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              {{ __("Company Pages") }}
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="companyPagesDropDown">
              <li v-for="company_page in $page.props.company_pages" :key="company_page.id">
                <Link class="dropdown-item" :href="route('company_pages.display', { slug: company_page.slug })">
                {{ company_page.name }}
                </Link>
              </li>

            </ul>
          </li> -->

          <li class="nav-item dropdown position-relative" v-if="$page.props.translation_languages">

            <a class="nav-link dropdown-toggle" href="#" id="langDropdown" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              {{ __(getSelectedLocate) }}
            </a>
            <ul class="dropdown-menu dropdown-menu-end position-absolute start-0 mt-2" aria-labelledby="langDropdown">
              <li v-for="lang in $page.props.translation_languages" :key="lang.id">
                <Link class="dropdown-item" :href="route('language', { language: lang.code })">
                {{ lang.name }}
                </Link>
              </li>

            </ul>

          </li>

          <li class="nav-item login-nav ms-md-5 ms-0 me-3 me-md-0"
          v-if="!$page.props.auth"
          >
            <Link :href="route('login')" class="btn btn-primary rounded-pill fw-medium"> <span class='px-md-3' >{{ __("login") }}</span></Link>
          </li>

        </ul>
      </div>
    </div>
  </nav>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";
export default {
  components: {
    Link,
  },
  data() {
    return {
      locale: this.$page.props.locale,
      view: {
        topOfPage: true,
        pusherDeviceId: "",
      },
    };
  },
  beforeMount() {
    window.addEventListener("scroll", this.handleScroll);
  },
  created() {
    console.log('$page.props.settings.', parseInt(this.$page.props.settings.enable_wallet_system));
  },
  methods: {
    logout() {
      if (this.$page.props.settings.pusher_beams_instance_id) {
        const VITE_PUSHER_BEAMS_INSTANCE_ID = this.$page.props.settings.pusher_beams_instance_id;
        const beamsClient = new PusherPushNotifications.Client({
          instanceId: VITE_PUSHER_BEAMS_INSTANCE_ID,
        });
        //   beamsClient
        //     .start()
        //     .then((beamsClient) => beamsClient.getDeviceId())
        //     .then((deviceId) => {
        //         console.log("Successfully registered with Beams. Device ID:", deviceId);
        //         this.pusherDeviceId = deviceId
        //     })
        beamsClient
          .clearAllState()
          .then(async () => {
            console.log("Beams state has been cleared");
          })
          .catch((e) => console.error("Could not clear Beams state", e));
      }

      this.$inertia.get(route("logout"));
    },
    switchLanguage() {
      this.$inertia.get(route("language", { language: this.locale }));
    },
    switchRole(role) {
      this.$emit('showLoaderEvent', 1);
      if (this.$page.props.settings.pusher_beams_instance_id) {

        const VITE_PUSHER_BEAMS_INSTANCE_ID = this.$page.props.settings.pusher_beams_instance_id;
        const beamsClient = new PusherPushNotifications.Client({
          instanceId: VITE_PUSHER_BEAMS_INSTANCE_ID,
        });
        beamsClient
          .clearAllState()
          .then(() => {
            console.log("Beams state has been cleared");
          })
          .catch((e) => console.error("Could not clear Beams state", e));
      }
      this.$inertia.post(this.route("account.switch_role", { role: role }), {
        onFinish: () => this.$toast.show("Switched To " + role),
      });
    },
    becomeTeacher() {
      this.$emit('showLoaderEvent', 1);
      this.$inertia.post(this.route("account.become_teacher"), {
        onFinish: () => this.$toast.show("You are now a Teacher"),
      });
    },
    becomeUser() {
      this.$emit('showLoaderEvent', 1);
      this.$inertia.post(this.route("account.become_user"), {
        onFinish: () => this.$toast.show("You are now a Student"),
      });
    },
    becomeAcademy() {
      this.$emit('showLoaderEvent', 1);
      this.$inertia.post(this.route("account.become_academy"), {
        onFinish: () => this.$toast.show("You are now a academy User"),
      });
    },
    handleScroll() {
      if (window.pageYOffset > 0) {
        if (this.view.topOfPage) this.view.topOfPage = false;
      } else {
        if (!this.view.topOfPage) this.view.topOfPage = true;
      }
    },
  },
  computed: {
    getSelectedLocate() {
      var index = this.$page.props.translation_languages.findIndex((obj) => obj.code === this.locale);
      if (index >= 0) {
        return this.$page.props.translation_languages[index].name
      }
    }
  }
};
</script>

<style lang="scss" scoped>
.opacity-90{
    opacity: 0.9;
}
</style>


