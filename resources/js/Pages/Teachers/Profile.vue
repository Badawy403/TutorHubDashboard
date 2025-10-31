<template>
    <app-layout title="Profile">
        <div class="profile-cover py-5">
            <div class="container">
                <div class="row py-5">
                    <div class="col-12">
                        <img v-if="teacher.cover_image" class="img-fluid" :src="teacher.cover_image" alt="image" />
                        <div v-else class="d-flex justify-content-center align-items-center position-relative">
                            <!-- <div class="position-absolute top-50 start-0 translate-middle"> -->
                            <!-- <button class="btn btn-sm btn-light">{{ __('change cover') }}</button> -->
                            <!-- </div> -->
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="py-5">
            <div class="container">

                <div class="row">
                    <div class="col-lg-3">
                        <div class="profile-image position-relative shadow rounded-5 mb-4">
                            <img v-if="teacher.image" class="img-fluid w-100 rounded-5" :src="teacher.image" alt="image"
                                style="object-fit: contain;" />
                            <img v-else class="img-fluid mt-4" src="@/images/account/default_avatar_men.png" alt="image" />
                            <span class="d-flex align-items-center position-absolute top-0 end-0 m-3">

                                    <span v-if="teacher.is_online" class="d-flex fs-4" style="color:#08FA20">
                                                <i class="bi bi-circle-fill"></i>
                                            </span>
                                            <span v-else class="d-flex fs-4 text-muted">
                                                <i class="bi bi-circle-fill"></i>
                                    </span>

                            </span>
                        </div>

                        <!-- <h6 class="fw-bold text-center">{{ __("Share My Profile") }}</h6> -->
                            <div class="dropdown-center text-center">
                            <button class="btn btn-secondary position-relative fw-bold" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                           {{ __('Share My Profile') }}<i class="bi bi-share-fill ms-2"></i>
                            </button>
                            <ul class="dropdown-menu position-absolute border-0 bg-white mt-1 px-2 shadow-sm">
                            <div class="d-flex align-items-center social-share justify-content-center">
                                <li >
                                    <a :href="'mailto:?subject=See My Profile&amp;body=Check out this Profile ' + hostName() + '/teacher/profile/' + teacher.user_name"
                                    > <i class="bi bi-envelope"></i></a>
                                </li>
                                <li>
                                    <a target="_blank"
                                        :href="'https://www.facebook.com/sharer.php?u=' + hostName() + '/teacher/profile/' + teacher.user_name"><i
                                            class="bi bi-facebook"></i></a>
                                </li>
                                <li>
                                <a target="_blank"
                                    :href="'https://api.whatsapp.com/send?text=' + hostName() + '/teacher/profile/' + teacher.user_name"><i
                                        class="bi bi-whatsapp"></i></a>
                                </li>
                                <li>
                                        <input type="text" class="border-0" style="visibility:hidden; width:0;" id="copyProfile"
                                            :value="hostName() + '/profile/' + teacher.user_name">
                                        <button type="button" @click="copyProfile()" data-bs-container="body"
                                            data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Top popover"
                                            class="position-absolute"><i class="bi bi-link"></i></button>
                                </li>
                                <li>
                                <input type="url" id="website" class="border-0" style="visibility:hidden; width:0;" :value="hostName()+'/teacher/profile/'+teacher.user_name" name="website" :placeholder="hostName()" required />
                                        <button type="button" @click="generateQRCode()">
                                        <i class="bi bi-qr-code-scan"></i>
                                </button>
                                </li>
                            </div>
                            </ul>
                            </div>
                             </div>

                           <!-- </div> -->
                            <!-- <ul class="social-share justify-content-center">
                            <li>
                                <a :href="'mailto:?subject=See My Profile&amp;body=Check out this Profile ' + hostName() + '/teacher/profile/' + teacher.user_name"
                                > <i class="bi bi-envelope"></i></a>
                            </li>
                            <li>
                                <a target="_blank"
                                    :href="'https://www.facebook.com/sharer.php?u=' + hostName() + '/teacher/profile/' + teacher.user_name"><i
                                        class="bi bi-facebook"></i></a>
                            </li>
                            <li>

                                <a target="_blank"
                                    :href="'https://api.whatsapp.com/send?text=' + hostName() + '/teacher/profile/' + teacher.user_name"><i
                                        class="bi bi-whatsapp"></i></a>
                            </li>
                            <li>
                                <input type="text" class="border-0" style="visibility:hidden; width:0;" id="copyProfile"
                                    :value="hostName() + '/profile/' + teacher.user_name">
                                <button type="button" @click="copyProfile()" data-bs-container="body"
                                    data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Top popover"
                                    class="position-absolute"><i class="bi bi-link"></i></button>
                            </li>
                        </ul> -->



                    <div class="col-md-9">
                        <div class="card bg-transparent">
                            <div class="card-body mb-2">
                                <div class="d-flex align-items-center flex-wrap position-relative">
                                    <h2 class="fs-4 fw-bold text-dark d-flex align-items-center mb-2 text-capitalize">
                                        <i v-if="teacher.is_featured" class="bi bi-patch-check-fill me-1 text-primary"></i>

                                        <span class="fs-2 text-primary">{{ teacher.name }}</span>

                                        <!-- <small v-if="teacher.academy_name" class="text-muted">({{ teacher.academy_name
                                        }})</small> -->

                                        <!-- <span class="fw-normal small ps-1 ms-2" style="border-left:1px solid"
                                            v-if="teacher.distance"> ( {{ formatDecimal(teacher.distance) }} Km) Away</span> -->

                                        <img v-if="teacher.is_premium" src="@/images/icons/is_premium.svg" class="ms-5" alt="Icon">
                                    </h2>

                                    <!-- <div class="position-absolute end-0 d-none d-md-block">

                                        <input type="url" id="website" class="border-0" style="visibility:hidden; width:0;"
                                            :value="hostName() + '/teacher/profile/' + teacher.user_name" name="website"
                                            :placeholder="hostName()" required />
                                        <div id="qrcode-container" class="d-flex justify-content-center">
                                            <div id="qrcode" class="qrcode"></div>
                                        </div>
                                    </div> -->

                                    <div class="position-absolute end-0">
                                        <input type="url" id="website" class="border-0" style="display:none; width:0;"
                                        :value="hostName() + '/teacher/profile/' + teacher.user_name" name="website"
                                        :placeholder="hostName()" required />
                                        <div id="qrcode-container" class="d-flex justify-content-center">
                                            <div id="qrcode" class="qrcode"></div>
                                        </div>
                                    </div>

                                </div>


                                <ul class="list-unstyled d-flex flex-wrap mb-2">
                                <li
                                    class="me-2 mb-2 d-inline-block pe-2"
                                    style="font-size: 14px"
                                    v-for="(cat, i) in visibleCategories"
                                    :key="cat.id"
                                    :class="{ 'border-end': i != visibleCategories.length - 1 }"
                                >
                                    {{ cat.name }}
                                </li>
                                </ul>
                               <div v-if="teacher.teacher_categories.length > 6">
                                <a class="text-primary fw-bold text-decoration-none" style="cursor:pointer" v-if="!showAll"  @click="showAll = true">See More</a>
                                <a class="text-primary fw-bold text-decoration-none" style="cursor:pointer" v-if="showAll"  @click="showAll = false">See Less</a>
                               </div>



                                <div class="row align-items-center mb-3">
                                    <div class="col-auto">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <star-rating :rating="teacher.rating" :star-size="16" :read-only="true"
                                                :increment="0.01" :show-rating="false"></star-rating>
                                            <span class="small mt-2 ps-1">({{ teacher.rating }})</span>
                                        </div>
                                    </div>
                                    <!-- <div class="col-auto" v-if="teacher.experience">
                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                            <span class="fs-4 fw-bold me-2">{{ __("Experience:") }}</span>
                                            <span class="fs-4" v-if="teacher.experience == 1">{{ teacher.experience }} {{
                                                __("Years Of Experience") }}</span>
                                            <span class="fs-4" v-else>{{ teacher.experience }} {{ __("Years of experience") }}</span>
                                        </div>
                                    </div> -->

                                    <div class="col-auto" v-if="teacher.speciality">
                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                            <span class="fs-4 fw-bold me-2">{{ __("Speciality:") }}</span>
                                            <span class="fs-4">{{ teacher.speciality }}</span>
                                        </div>
                                    </div>
                                    <div class="d-flex col-auto align-items-start align-items-md-center mt-2 flex-column flex-md-row" v-if="checkObjectValuesIsNotNull(teacher.teacher_settings)">
                                    <span class="text-black fw-bold fs-4 me-2">{{ __('Socials:') }}</span>
                                    <ul class="d-flex ps-0 mb-0 social flex-wrap flex-md-nowrap gap-1 gap-md-0 mt-2 mt-md-0">
                                        <li class="list-group-item border-0" v-if="teacher.teacher_settings.facebook_url
                                            ">
                                            <a  target="_blank" :href="teacher.teacher_settings
                                                .facebook_url
                                                "><i class="bi bi-facebook"></i></a>
                                        </li>
                                        <li class="list-group-item border-0" v-if="teacher.teacher_settings.youtube_url
                                            ">
                                            <a  target="_blank" :href="teacher.teacher_settings
                                                .youtube_url
                                                "><i class="bi bi-youtube"></i></a>
                                        </li>
                                        <li class="list-group-item border-0" v-if="teacher.teacher_settings.twitter_url
                                            ">
                                            <a  target="_blank" :href="teacher.teacher_settings
                                                .twitter_url
                                                "><i class="bi  bi-twitter"></i></a>
                                        </li>
                                        <li class="list-group-item  border-0" v-if="teacher.teacher_settings.linkedin_url
                                            ">
                                            <a  target="_blank" :href="teacher.teacher_settings
                                                .linkedin_url
                                                "><i class="bi  bi-linkedin"></i></a>
                                        </li>
                                        <li class="list-group-item border-0" v-if="teacher.teacher_settings.whatsapp_url
                                            ">
                                            <a  target="_blank" :href="teacher.teacher_settings
                                                .whatsapp_url
                                                "><i class="bi bi-whatsapp"></i></a>
                                        </li>
                                        <li class="list-group-item border-0" v-if="teacher.teacher_settings.instagram_url
                                            ">
                                            <a  target="_blank" :href="teacher.teacher_settings
                                                .instagram_url
                                                "><i class="bi bi-instagram"></i></a>
                                        </li>
                                        <li class="list-group-item border-0"
                                            v-if="teacher.teacher_settings.tiktok_url">
                                            <a  target="_blank" :href="teacher.teacher_settings
                                                .tiktok_url
                                                "><i class="bi bi-tiktok"></i></a>
                                        </li>
                                        <li class="list-group-item border-0" v-if="teacher.teacher_settings.snapchat_url
                                            ">
                                            <a  target="_blank" :href="teacher.teacher_settings
                                                .snapchat_url
                                                "><i class="bi bi-snapchat"></i></a>
                                        </li>
                                        <li class="list-group-item border-0" v-if="teacher.teacher_settings.pinterest_url
                                            ">
                                            <a  target="_blank" :href="teacher.teacher_settings
                                                .pinterest_url
                                                "><i class="bi bi-pinterest"></i></a>
                                        </li>
                                    </ul>

                                </div>

                                </div>
                                <h3 class="text-primary fw-bold fs-2 mt-4">{{ __('About Me') }}</h3>
                                <div v-html="teacher.description" class="fs-4 text-secondary line-clamp"></div>
                            </div>

                        </div>


                        <div class="d-flex align-items-center flex-wrap">
                            <div class="d-flex align-items-center flex-column flex-md-row ms-2 ms-md-0" v-if="teacher.appointment_types">
                                <button type="button" v-for="(schedule_type, index) in teacher.appointment_types"
                                    :key="index" @click="checkLoginAndRedirect(teacher, schedule_type.appointment_type)"
                                    class="btn btn-light d-flex  px-4 py-3 align-items-center me-md-3 mb-2 mb-md-0 shadow-none">

                                    <div class="d-flex align-items-center justify-content-center">
                                        <i class="bi bi-camera-video-fill fs-5" v-if="schedule_type.type == 'video'"></i>
                                        <i class="bi bi-mic-fill fs-5" v-if="schedule_type.type == 'audio'"></i>
                                        <i class="bi bi-chat-dots-fill fs-5" v-if="schedule_type.type == 'chat'"></i>

                                    </div>
                                    <div class="d-flex ms-2">
                                        <span class="fs-5 fw-bold">{{ schedule_type.appointment_type.display_name }}</span>
                                        <span class="fs-5">
                                            &nbsp;- (
                                            {{ getDisplayAmount(schedule_type.fee) }}
                                            <!-- <span v-if="schedule_type.appointment_type.is_schedule_required"> - {{ schedule_type.slot_duration }} {{ __("minutes") }}</span> -->
                                            )
                                        </span>

                                    </div>
                                </button>
                            </div>
                            <button v-if="teacher.teacher_settings
                                .calendly_link
                                "
                                :onclick="`Calendly.initPopupWidget({url: '${teacher.teacher_settings.calendly_link}'});return false;`"
                                class="btn btn-light me-0 me-md-3 px-5 ms-2 ms-md-0 px-md-4 shadow-none fw-bold py-3">
                                {{ __("book with calendly") }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="py-md-5">
            <div class="container">
                <div class="row">
                    <ul class="nav nav-tabs profile-tabs gap-3 px-4 px-md-0 fw-medium mb-3" id="profile-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="profile-blog-tab" data-bs-toggle="pill" data-bs-target="#profile-blog"
                            type="button" role="tab" aria-controls="profile-blog" aria-selected="false">{{ __n('blog')}}</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-archive-tab" data-bs-toggle="pill" data-bs-target="#profile-archive"
                            type="button" role="tab" aria-controls="profile-archive" aria-selected="false">{{ __n('archive')}}</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-event-tab" data-bs-toggle="pill" data-bs-target="#profile-event"
                            type="button" role="tab" aria-controls="profile-event" aria-selected="false">{{ __n('event')}}</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-youtube-tab" data-bs-toggle="pill" data-bs-target="#profile-youtube"
                            type="button" role="tab" aria-controls="profile-youtube" aria-selected="false">{{ __('youtube')}}</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-review-tab" data-bs-toggle="pill" data-bs-target="#profile-review"
                            type="button" role="tab" aria-controls="profile-review" aria-selected="false" >{{ __('Reviews')}}</button>

                            <!-- :disabled="teacher.teacher_reviews == 0" -->
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-broadcast-tab" data-bs-toggle="pill"
                            data-bs-target="#profile-broadcast" type="button" role="tab" aria-controls="profile-broadcast"
                            aria-selected="true">{{ __n('broadcast') }}</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-podcast-tab" data-bs-toggle="pill"
                            data-bs-target="#profile-podcast" type="button" role="tab" aria-controls="profile-podcast"
                            aria-selected="false">{{ __n('podcast') }}</button>
                    </li>

                    <!-- <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-disabled-tab" data-bs-toggle="pill"
                            data-bs-target="#profile-disabled" type="button" role="tab" aria-controls="profile-disabled"
                            aria-selected="false" disabled>Disabled</button>
                    </li> -->
                </ul>
                </div>
                <div class="tab-content" id="profile-tabContent">
                    <div class="tab-pane fade" id="profile-broadcast" role="tabpanel"
                        aria-labelledby="profile-broadcast-tab" tabindex="0">
                        <profile-section :href="route('broadcasts.listing', { teacher: teacher.user_name })" v-if="hasModule(
                                'teacher-list-services',
                                'teacher',
                                teacher.teacher_modules
                            ) && teacher.teacher_broadcasts.length > 0
                            " :heading="teacher.name + ' ' + __n('broadcast')">
                            <broadcast-card v-for="broadcast in teacher.teacher_broadcasts" :broadcast="broadcast"
                                :key="broadcast.id"></broadcast-card>
                        </profile-section>
                    </div>
                    <div class="tab-pane fade" id="profile-podcast" role="tabpanel" aria-labelledby="profile-podcast-tab"
                        tabindex="0">

                        <profile-section :href="route('podcasts.listing', { teacher: teacher.user_name })"
                            v-if="teacher.teacher_podcasts.length > 0" :heading="teacher.name + ' ' + __n('podcast')">
                            <podcast-card v-for="podcast in teacher.teacher_podcasts" :podcast="podcast"
                                :key="podcast.id"></podcast-card>
                        </profile-section>
                    </div>

                    <div class="tab-pane fade show active" id="profile-blog" role="tabpanel" aria-labelledby="profile-blog-tab"
                        tabindex="0">
                        <profile-section :href="route('blogs.listing', { teacher: teacher.user_name })"
                            v-if="teacher.teacher_posts.length > 0" :heading="teacher.name + ' ' + __n('blog')">
                            <post-card v-for="post in teacher.teacher_posts" :post="post" :key="post.id"></post-card>
                        </profile-section>
                    </div>

                    <div class="tab-pane fade" id="profile-archive" role="tabpanel" aria-labelledby="profile-archive-tab"
                        tabindex="0">
                        <profile-section :href="route('archives.listing', { teacher: teacher.user_name })"
                        v-if="teacher.teacher_archives.length > 0" :heading="teacher.name + ' ' + __n('archive')">
                        <archive-card v-for="archive in teacher.teacher_archives" :archive="archive" :key="archive.id">
                        </archive-card>
                    </profile-section>
                                </div>
                                <div class="tab-pane fade" id="profile-event" role="tabpanel" aria-labelledby="profile-event-tab"
                                    tabindex="0">
                                    <profile-section :href="route('events.listing', { teacher: teacher.user_name })"
                        v-if="teacher.teacher_events.length > 0" :heading="teacher.name + ' ' + __n('event')">
                            <div class="d-flex flex-wrap align-items-center">
                            <event-card class="mb-4" :add_col="true" v-for="event in teacher.teacher_events" :event="event"
                            :key="event.id"></event-card>
                            </div>
                    </profile-section>
                    </div>
                    <div class="tab-pane fade" id="profile-youtube" role="tabpanel" aria-labelledby="profile-youtube-tab"
                        tabindex="0">
                        <profile-section :outer_href="teacher.teacher_settings.youtube_channel_link"
            v-if="teacher.teacher_settings.youtube_playlist_link" :heading="teacher.name + ' ' + __n('youtube')">
            <div class="row">
                <div class="col-12">
                <iframe width="560" height="315" :src="teacher.teacher_settings.youtube_playlist_link" frameborder="0" class="me-3"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                allowfullscreen></iframe>
                <iframe width="560" height="315" :src="teacher.teacher_settings.youtube_playlist_link" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                allowfullscreen></iframe>
                </div>
                </div>
        </profile-section>
                    </div>

                    <div class="tab-pane fade" id="profile-review" role="tabpanel" aria-labelledby="profile-review-tab"
                        tabindex="0">
                        <teacher-profile-reviews-section :teacher_id="teacher.id" :teacher="teacher"
                        :reviews="teacher.teacher_reviews"></teacher-profile-reviews-section>
                    </div>
                    <!-- <div class="tab-pane fade" id="profile-disabled" role="tabpanel" aria-labelledby="profile-disabled-tab"
                        tabindex="0">...</div> -->
                </div>
            </div>
        </div>

        <!-- <profile-section :outer_href="teacher.teacher_settings.instagram_profile_link"
            v-if="teacher.teacher_settings.instagram_access_token" :heading="teacher.name + ' ' + __n('instagram')">
            <InstagramFeed :count="10" :accessToken="teacher.teacher_settings.instagram_access_token" :pagination="false"
                :caption="true" />
        </profile-section> -->

    </app-layout>
</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import PageHeader from "@/Components/PageHeader.vue";
import Navbar from "@/Layouts/AppIncludes/Navbar.vue";
import TeacherAccount from "@/Components/Teachers/TeacherAccount.vue";
import BroadcastCard from "@/Components/Broadcasts/BroadcastCard.vue";
import PodcastCard from "@/Components/Podcasts/PodcastCard.vue";
import PostCard from "@/Components/Posts/PostCard.vue";
import TeacherProductCard from "@/Components/Teachers/TeacherProductCard.vue";
import ArchiveCard from "@/Components/Archives/ArchiveCard.vue";
import EventCard from "@/Components/Events/EventCard.vue";
import ProfileSection from "@/Components/Shared/ProfileSection.vue";
import TeacherProfileReviewsSection from "@/Components/Teachers/TeacherProfileReviewsSection.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
export default defineComponent({
    components: {
        AppLayout,
        Navbar,
        PageHeader,
        TeacherAccount,
        BroadcastCard,
        PodcastCard,
        ProfileSection,
        PostCard,
        TeacherProductCard,
        ArchiveCard,
        EventCard,
        TeacherProfileReviewsSection,
        Head,
        Link,
    },
    data() {
        return {
            teacher: this.$page.props.teacher,
            showAll: false,
        };
    },
    computed:{
    visibleCategories() {
      return this.showAll ? this.teacher.teacher_categories : this.teacher.teacher_categories.slice(0, 3);
    }
    },
    mounted() {

        this.generateQRCode();
    },
    props: ["appointment_types"],
    methods: {
        checkLoginAndRedirect(teacher, appointment_type) {
            if (this.$page.props.auth) {
                if (this.$page.props.auth.logged_in_as == 'student') {
                    this.$inertia.visit(route(
                        'teacher.book_appointment',
                        {
                            user_name: teacher.user_name,
                            type: appointment_type.type,
                        }
                    ))
                }
                else {
                    this.$toast.warning("You must log in as a student");
                }

            } else {
                this.$toast.warning("Please login first");
                this.$inertia.visit(route("login"), {
                    data: {
                        'is_redirect': 1
                    },
                });
            }
        },
        submit() { },
        logEvent(evt) {

            // Here you can handle the emitted events with custom code
            if (evt === "calendly.profile_page_viewed") {
            }
        },
        copyProfile() {
            // Get the text field
            var copyText = document.getElementById("copyProfile");

            // Select the text field
            copyText.select();
            copyText.setSelectionRange(0, 99999); // For mobile devices

            // Copy the text inside the text field
            navigator.clipboard.writeText(copyText.value);
            this.$toast.success("Profile link copied to Clipboard");

        },

        generateQRCode() {

            let website = document.getElementById("website").value;
            let qrcodeContainer = document.getElementById("qrcode");
            var isToggled = qrcodeContainer.innerHTML === "" ? false : true;
            if (website && !isToggled) {
                let qrcodeContainer = document.getElementById("qrcode");
                qrcodeContainer.innerHTML = "";
                new QRCode(qrcodeContainer, {
                    text: website,
                    width: 100,
                    height: 100,
                    colorDark: "#000000",
                    colorLight: "#F6F7FA",
                    correctLevel: QRCode.CorrectLevel.H
                });

                document.getElementById("qrcode-container").style.display = "block";
            } else {
                qrcodeContainer.innerHTML = "";
                // alert("Please enter a valid URL");
            }
        },
    },
});
</script>

