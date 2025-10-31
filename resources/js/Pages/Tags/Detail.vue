<template>
    <app-layout title="Dashboard">
        <!-- <template #header>
            <page-header>
                {{tag.name }}
            </page-header>
        </template> -->
        <template #default>
            <profile-section :href="route('broadcasts.listing')" v-if="tag.broadcasts.length > 0" :heading="__n('broadcast')">
             <broadcast-card  v-for="broadcast in tag.broadcasts" :broadcast="broadcast"
                :key="broadcast.id"></broadcast-card>
              </profile-section>

            <profile-section :href="route('podcasts.listing')" v-if="tag.podcasts.length > 0" :heading="__n('podcast')">
                <podcast-card v-for="podcast in tag.podcasts" :podcast="podcast" :key="podcast.id"></podcast-card>
            </profile-section>

            <profile-section :href="route('blogs.listing')" v-if="tag.posts.length > 0" :heading="__n('blog')">
                <post-card v-for="post in tag.posts" :post="post" :key="post.id"></post-card>
            </profile-section>

            <profile-section :href="route('events.listing')" v-if="tag.events.length > 0" :heading="__n('event')">
                <event-card :add_col="true" v-for="event in tag.events" :event="event" :key="event.id"></event-card>
            </profile-section>

            <profile-section :href="route('archives.listing')" v-if="tag.archives.length > 0" background_color="#EDE6F2"
                :heading="__n('archive')">
                <archive-card v-for="archive in tag.archives" :archive="archive" :key="archive.id"> </archive-card>
            </profile-section>

            <div class="section py-5" v-if="tag.archives.length == 0 && tag.events.length == 0 && tag.posts.length == 0 && tag.podcasts.length == 0 && tag.broadcasts.length == 0">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <h2 class="text-start">{{ __('sorry') }}</h2>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12">
                                        <span>{{ __('no record found') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        </div>

        </template>
    </app-layout>
</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import Navbar from "@/Layouts/AppIncludes/Navbar.vue";
import PageHeader from "@/Components/PageHeader.vue";
import BroadcastCard from "@/Components/Broadcasts/BroadcastCard.vue";
import PodcastCard from "@/Components/Podcasts/PodcastCard.vue";
import PostCard from "@/Components/Posts/PostCard.vue";
import ArchiveCard from "@/Components/Archives/ArchiveCard.vue";
import EventCard from "@/Components/Events/EventCard.vue";
import ProfileSection from "@/Components/Shared/ProfileSection.vue";
export default defineComponent({
    components: {
        AppLayout,
        Navbar,
        PageHeader,
        BroadcastCard,
        PodcastCard,
        PostCard,
        ArchiveCard,
        EventCard,
        ProfileSection
    },
    props: ['tag']
});
</script>
