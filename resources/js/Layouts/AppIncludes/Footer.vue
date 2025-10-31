<template>
  <footer class="footer">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="row py-5">
            <div class="col-md-4">
              <Link class="d-block mb-4" :href="route('home')">
              <img v-if="$page.props && $page.props.settings && $page.props.settings.logo" width="150"
                :src="$page.props.settings.logo" alt="logo">
              <span v-else class="mt-4">
                {{ $page.props && $page.props.settings && $page.props.settings.site_title ?
                  $page.props.settings.site_title : __('teacher consultant') }}
              </span>
              </Link>
              <div v-if="getPageContentType('footer_section_description') == 'textarea'">
                <div class="fw-semibold lh-lg fs-5 text-start" v-html="getPageContent('footer_section_description')">
                </div>
              </div>
              <div v-else-if="getPageContentType('footer_section_description') == 'text'">
                <p> {{ getPageContent('footer_section_description') ?? '-' }}
                </p>
              </div>
              <div v-else>
                <p>{{ __('footer_tagline_1') }}</p>
              </div>
              <Link class="btn btn-primary mt-3" :href="route('contact')"> {{ __('Need a Support?') }}</Link>
            </div>
            <div class="col-md-8">
              <div class="row mt-3 mt-md-0">
                <div class="col-md-3 col-sm-6">
                  <div class="widget">
                    <h4 class="fw-bold mb-3 ps-3">{{ __("Browse") }}
                    </h4>
                    <ul>
                      <li>
                        <!-- <img src="@/images/common/bullter-1.png" alt="icon"> -->
                        <Link class="nav-link fs-5 mb-2 fw-semibold" :href="route('home')">{{ __("Home") }}</Link>
                      </li>
                      <li>
                        <!-- <img src="@/images/common/bullter-1.png" alt="icon"> -->
                        <Link class="nav-link fs-5 mb-2 fw-semibold"
                          :href="route('company_pages.display', { slug: 'about' })"> {{ __('About') }}</Link>
                      </li>
                      <li>
                        <!-- <img src="@/images/common/bullter-1.png" alt="icon"> -->
                        <Link class="nav-link fs-5 mb-2 fw-semibold" :href="route('events.listing')">{{ __("Events")
                        }}
                        </Link>
                      </li>
                      <!-- <li> -->
                      <!-- <img src="@/images/common/bullter-1.png" alt="icon"> -->
                      <!-- <Link class="nav-link" :href="route('our-story')">{{__("our success stories")}}</Link>
                          </li> -->
                      <li>
                        <!-- <img src="@/images/common/bullter-1.png" alt="icon"> -->
                        <Link class="nav-link fs-5 mb-2 fw-semibold" :href="route('academies.listing')">
                        {{ __("Academies") }}</Link>
                      </li>
                      <li>
                        <!-- <img src="@/images/common/bullter-1.png" alt="icon"> -->
                        <Link class="nav-link fs-5 mb-2 fw-semibold" :href="route('teachers.listing')">
                        {{ __("Tutors") }}</Link>
                      </li>
                      <li>
                        <!-- <img src="@/images/common/bullter-1.png" alt="icon"> -->
                        <Link class="nav-link fs-5 mb-2 fw-semibold" :href="route('archives.listing')">
                        {{ __("Courses") }}</Link>
                      </li>
                    </ul>
                  </div>
                </div>

                <div class="col-md-3 col-sm-6">
                  <div class="widget">
                    <h4 class="fw-bold mb-3 ps-3">{{ __("Links") }}
                    </h4>
                    <ul>
                      <li>
                        <!-- <img src="@/images/common/bullter-1.png" alt="icon"> -->
                        <Link class="nav-link fs-5 mb-2 fw-semibold" :href="route('broadcasts.listing')">{{ __("Media") }}</Link>
                      </li>
                      <li>
                        <!-- <img src="@/images/common/bullter-1.png" alt="icon"> -->
                        <!-- :href="route('company_pages.display', { slug: 'about' })" -->
                        <Link class="nav-link fs-5 mb-2 fw-semibold"
                          :href="route('blogs.listing')">{{ __('Blogs') }}</Link>
                      </li>
                      <li>
                        <!-- <img src="@/images/common/bullter-1.png" alt="icon"> -->
                        <Link class="nav-link fs-5 mb-2 fw-semibold" :href="route('archives.listing')">{{ __("Courses")
                        }}
                        </Link>
                      </li>
                      <!-- <li> -->
                      <!-- <img src="@/images/common/bullter-1.png" alt="icon"> -->
                      <!-- <Link class="nav-link" :href="route('our-story')">{{__("our success stories")}}</Link>
                          </li> -->
                      <li>
                        <!-- <img src="@/images/common/bullter-1.png" alt="icon"> -->
                        <Link class="nav-link fs-5 mb-2 fw-semibold" :href="route('podcasts.listing')">
                        {{ __("Podcast") }}</Link>
                      </li>
                      <li>
                        <!-- <img src="@/images/common/bullter-1.png" alt="icon"> -->
                        <Link class="nav-link fs-5 mb-2 fw-semibold" :href="route('contact')">
                        {{ __("Contact") }}</Link>
                      </li>
                      <li>
                        <!-- <img src="@/images/common/bullter-1.png" alt="icon"> -->
                        <Link class="nav-link fs-5 mb-2 fw-semibold" :href="route('company_pages.display', { slug: 'support-27' })">
                        {{ __("Support") }}</Link>
                      </li>
                    </ul>
                  </div>
                </div>

                <div class="col-md-3 col-sm-6">
                  <div class="widget">
                    <h4 class="fw-bold mb-3 ps-3">{{ __("Resources") }}</h4>
                    <ul>
                      <li>
                        <!-- <img src="@/images/common/bullter-1.png" alt="icon"> -->
                        <Link :href="route('teachers.listing')" class="nav-link fs-5 mb-2 fw-semibold">
                        {{ __n('Tutor') }}</Link>
                      </li>
                      <li>
                        <!-- <img src="@/images/common/bullter-1.png" alt="icon"> -->
                        <Link class="nav-link fs-5 mb-2 fw-semibold"
                          v-if="$page.props.auth && hasRole('teacher') && $page.props.auth.logged_in_as == 'teacher'"
                          :href="route('pricing', { type: 'teacher' })">{{ __('pricing plan') }}</Link>
                        <Link class="nav-link fs-5 mb-2 fw-semibold"
                          v-else-if="$page.props.auth && hasRole('academy') && $page.props.auth.logged_in_as == 'academy'"
                          :href="route('pricing', { type: 'academy' })">{{ __('pricing plan') }}</Link>
                        <Link class="nav-link fs-5 mb-2 fw-semibold" v-else :href="route('pricing', { type: 'teacher' })">
                        {{ __('Pricing Plan') }}</Link>

                      </li>

                      <li>
                        <!-- <img src="@/images/common/bullter-1.png" alt="icon"> -->
                        <Link class="nav-link fs-5 mb-2 fw-semibold" :href="route('faqs')">{{ __('FAQ') }}</Link>
                      </li>

                    </ul>


                  </div>
                </div>
                <div class="col-md-3 col-sm-6">
                  <div class="widget">
                    <h4 class="fw-bold mb-3 ps-3">{{ __('Company') }}</h4>
                    <ul>
                      <li>
                        <!-- <img src="@/images/common/bullter-1.png" alt="icon"> -->
                        <Link class="nav-link fs-5 mb-2 fw-semibold"
                          :href="route('company_pages.display', { slug: 'terms' })">{{ __('Terms of Use') }}</Link>
                      </li>
                      <li>
                        <!-- <img src="@/images/common/bullter-1.png" alt="icon"> -->
                        <Link class="nav-link fs-5 mb-2 fw-semibold"
                          :href="route('company_pages.display', { slug: 'privacy' })">{{ __('Privacy Policy') }}
                        </Link>
                      </li>
                      <li>
                        <!-- <img src="@/images/common/bullter-1.png" alt="icon"> -->
                        <Link class="nav-link fs-5 mb-2 fw-semibold"
                          :href="route('company_pages.display', { slug: 'cookies' })">{{ __('Cookies Policy') }}
                        </Link>
                      </li>
                      <li>
                        <!-- <img src="@/images/common/bullter-1.png" alt="icon"> -->
                        <Link class="nav-link fs-5 mb-2 fw-semibold"
                          :href="route('company_pages.display', { slug: 'disclaimer' })">{{ __('Disclaimer') }}</Link>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- <div class="row mb-4 align-items-center">
            <div class="col-md-12">
              <h4 class="mb-0 text-white">{{__("crisis support")}}</h4>
              <div class="d-flex align-items-center">
                <p class="text-white mb-0" ><b> {{ __('dont use this site if')}}:</b> {{ __('crisis_support_statement') }}. <Link :href="route('company_pages.display',{slug:'crisis-support'})">{{ __('use these resources') }} </Link></p>
                <Link :href="route('company_pages.display',{slug:'support'})" class="btn btn-sm ms-5 btn-primary">
                  {{('support')}} <i class="bi bi-headset"></i>
                </Link>
              </div>

            </div>

          </div> -->

        </div>
      </div>




    </div>
    <hr class="text-primary" />
    <div class="pb-3">
      <div class="container">
        <div class="row">
          <div class="col-md-6 mb-3 mb-lg-0">
            <div class="d-flex justify-content-center justify-content-lg-start">
              <span class="fs-4 mb-0 fw-bold">© {{ new Date().getFullYear() }} {{ __('copyright') }}
                <Link class="text-body fw-bold text-decoration-none" :href="route('home')"> {{ $page.props &&
                  $page.props.settings && $page.props.settings.site_title ? $page.props.settings.site_title : __(' Tutor - hub') }} </Link>
              </span>
            </div>

          </div>

          <div class="col-md-6">

            <div class="d-flex justify-content-center justify-content-lg-end">
              <ul class="d-flex align-items-center ps-0 mb-0 social-contact-icons">
                <li class="d-flex" v-if="$page.props.settings.web_facebook_link"><a target="_blank"
                    :href="$page.props.settings.web_facebook_link"><i class="bi bi-facebook  mx-1"></i></a></li>
                <!-- <li v-if="$page.props.settings.web_youtube_link"><a target="_blank"
                    :href="$page.props.settings.web_youtube_link"><i class="bi bi-youtube"></i></a></li> -->
                <li class="d-flex" v-if="$page.props.settings.web_twitter_link"><a target="_blank"
                    :href="$page.props.settings.web_twitter_link"><i class="bi bi-twitter  mx-1"></i></a></li>
                <li class="d-flex" v-if="$page.props.settings.web_linkedin_link"><a target="_blank"
                    :href="$page.props.settings.web_linkedin_link"><i class="bi bi-linkedin  mx-1"></i></a></li>
                <li class="d-flex" v-if="$page.props.settings.web_whatsapp_link"><a target="_blank"
                    :href="$page.props.settings.web_whatsapp_link"><i class="bi bi-whatsapp  mx-1"></i></a></li>
                <li class="d-flex" v-if="$page.props.settings.web_instagram_link"><a target="_blank"
                    :href="$page.props.settings.web_instagram_link"><i class="bi bi-instagram  mx-1"></i></a>
                </li>
                <li class="d-flex" v-if="$page.props.settings.web_tiktok_link"><a target="_blank"
                    :href="$page.props.settings.web_tiktok_link"><i class="bi bi-tiktok  mx-1"></i></a></li>
                <li class="d-flex" v-if="$page.props.settings.web_snapchat_link"><a target="_blank"
                    :href="$page.props.settings.web_snapchat_link"><i class="bi bi-snapchat mx-1"></i></a></li>
                <li class="d-flex" v-if="$page.props.settings.web_pinterest_link"><a target="_blank"
                    :href="$page.props.settings.web_pinterest_link"><i class="bi bi-pinterest mx-1"></i></a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- <div class="container-fluid">
      <div class="row  bg-primary h-75">
        <div class="col-12 py-5 text-center">
          <h2>Become an Instructor?</h2>
        </div>
      </div>
    </div> -->

  </footer>


</template>
<script>
import { Link } from "@inertiajs/inertia-vue3";
export default {
  components: {
    Link,
  },
  data() {
    return {

    }
  },
  methods: {
  }

};

</script>

