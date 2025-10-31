<template>
    <app-layout title="My Profile">
        <!-- <template #header>
            <page-header>
                {{ __('find your favorite tag') }}
            </page-header>
        </template> -->

        <div class="section py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <h2 class="text-start">{{ __('all tags') }}</h2>
                            <div class="col-12" v-if="fetching">
                                {{ __('fetching') }}
                            </div>
                            <div class="col-12" v-if="!fetching">

                                <div v-if="tags.data.length > 0" class="row">
                                    <ul class="tags ps-0 mb-0">
                                        <li v-for="tag in tags" :key="tag.id" class="rounded-5 d-inline-block m-2 pt-2 pb-1 px-3">
                                            <Link class="text-decoration-none" :href="route('tags.detail',{slug:tag.slug})">
                                                {{ tag.name }}
                                            </Link>
                                        </li>
                                    </ul>
                                </div>
                                <div v-else class="row">
                                    <div class="col-12 text-center mb-3">
                                        <record-not-found></record-not-found>
                                    </div>
                                </div>
                                <div class="row mt-4" v-if="tags.meta.last_page != this.filter.page">
                                    <div class="col-md-12 d-flex align-items-center justify-content-center">
                                        <button @click="loadMore()"
                                            class="btn btn-primary  position-relative"
                                            :disabled="loading_more"><span :class="{
                                                'loader': loading_more
                                            }" class="position-absolute"></span> {{ __('load more') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        </div>
    </app-layout>
</template>
<script>
import { defineComponent } from "vue";
import PaginationMixin from "@/Mixins/PaginationMixin.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import PageHeader from "@/Components/PageHeader.vue";
import Navbar from "@/Layouts/AppIncludes/Navbar.vue";
import {  Link } from "@inertiajs/inertia-vue3";
import RecordNotFound from "../../Components/Shared/RecordNotFound.vue";




export default defineComponent({
    mixins: [PaginationMixin],
    components: {
        AppLayout,
        Navbar,
        PageHeader,
        Link,
        RecordNotFound
    },
    created() {
    },
    data() {
        return {
            tags: {}
        }
    },
    methods: {
        async getPaginatedData(loading_more = false) {
            await this.getTags(loading_more)
        },
        getTags(loading_more) {
            // if(Object.keys(route().params).length > 0){
            //     this.$inertia.replace(route('blogs.listing'))
            // }
            axios.tag(this.route('getApiTags'), this.filter).then(res => {
                const data = res.data.data
                if (loading_more) {
                    this.tags.data = this.tags.data.concat(data.data);
                } else {
                    this.tags.data = data.data;
                }
                this.tags.links = data.links
                this.tags.meta = data.meta
                this.fetching = false
            });
        },

    },
});
</script>
