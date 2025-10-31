<template>
    <app-layout title="My Profile">
        <template #header>

        </template>
        <div class="py-5">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div v-if="getPageContentType('services_page_description') == 'textarea'
                            ">
                            <div v-html="getPageContent('services_page_description')"></div>
                        </div>
                        <div v-else-if="getPageContentType('services_page_description') == 'text'
                            ">
                            <p>{{ getPageContent("services_page_description") ?? "-" }}</p>
                        </div>
                        <div v-else>

                            <h2 class="fs-2 text-center">
                                <span class="fw-normal">{{__('explore') }}| </span>
                                <span class="fw-bold">{{__('all service') }}</span>
                            </h2>
                            <!-- <p class="text-center mb-0">Discover The Best Teachers Near You</p> -->
                        </div>

                        <breadcrums :breadcrums="breadcrums"></breadcrums>
                    </div>
                </div>
            </div>
        </div>



        <div class="section py-0">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="search-side-bar">
                            <div class="d-flex mt-3 flex-wrap">
                            <button
                            :class="list_view ? 'btn-primary' : 'btn-dark'"
                            class="btn me-2 mt-3"
                            @click="listView()"
                            >
                            <i class="bi bi-list"></i>
                            {{ getPageContent("general_list_btn_text") ?? "List View" }}
                            </button>
                            <button
                            :class="grid_view ? 'btn-primary' : 'btn-dark'"
                            class="btn mt-3"
                            @click="GridView()"
                            >
                            <i class="bi bi-grid"></i>
                            {{ getPageContent("general_grid_btn_text") ?? "Grid View" }}
                            </button>
                        </div>
                            <find-service-bar @getServices="onSearch" :is_redirect="false"></find-service-bar>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="row mx-0 mt-4">

                            <div class="col-12" v-if="fetching">
                                <div class="row">

                                    <div class="col-md-12 mb-4">
                                        <spotlight-card-skeleton></spotlight-card-skeleton>
                                    </div>
                                    <div class="col-md-12 mb-4">
                                        <spotlight-card-skeleton></spotlight-card-skeleton>
                                    </div>
                                    <div class="col-md-12 mb-4">
                                        <spotlight-card-skeleton></spotlight-card-skeleton>
                                    </div>
                                    <div class="col-md-12 mb-4">
                                        <spotlight-card-skeleton></spotlight-card-skeleton>
                                    </div>

                                </div>
                            </div>
                            <div class="col-12" v-if="!fetching">
                                <div v-if="services.data.length > 0" class="row">
                                        <div
                                            :class="
                                            list_view
                                                ? 'col-12 p-0'
                                                : 'col-md-6'
                                            "
                                             v-for="service in services.data" :key="service.id"
                                        >
                                            <div v-if="list_view">
                                            <service-list-card
                                                :add_col="true"
                                                :list_card="true"
                                                :key="service.id"
                                                :service="service"
                                            >
                                            </service-list-card>
                                            </div>

                                            <div class="h-100" v-if="grid_view">
                                                <service-card :add_col="false"
                                                 :service="service"></service-card>
                                            </div>
                                        </div>
                                        </div>
                                <!-- <div v-if="services.data.length > 0" class="row">
                                    <service-card :add_col="false" v-for="service in services.data" :key="service.id"
                                    :service="service"></service-card>
                                </div> -->
                                <div v-else class="row">
                                    <div class="col-12 text-center mb-3">
                                        <record-not-found></record-not-found>
                                    </div>
                                </div>
                                <div class="row my-4" v-if="services.meta.last_page != this.filter.page">
                                    <div class="col-md-12 d-flex align-items-center justify-content-center">
                                        <button @click="loadMore()" class="btn btn-primary  position-relative"
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
import FindServiceBar from "@/Components/Services/FindServiceBar.vue";
import ServiceCard from "@/Components/Services/ServiceCard.vue";
import ServiceListCard from "@/Components/Services/ServiceListCard.vue";
import RecordNotFound from "../../Components/Shared/RecordNotFound.vue";
import Breadcrums from "../../Components/Shared/Breadcrums.vue";
import SpotlightCardSkeleton from "@/Components/Skeleton/SpotLightCardSkeleton.vue";
export default defineComponent({
    mixins: [PaginationMixin],
    components: {
        AppLayout,
        Navbar,
        PageHeader,
        ServiceCard,
        ServiceListCard,
        FindServiceBar,
        RecordNotFound,
        Breadcrums,
        SpotlightCardSkeleton,

    },
    created() {
    },
    data() {
        return {
            services: {},
            grid_view: false,
            list_view: true,
            breadcrums: [
                {
                    id: 1,
                    name: this.__('home'),
                    link: '/'
                },
                {
                    id: 2,
                    name:  this.__('service'),
                    link: ''
                }
            ]
        }
    },
    methods: {
        async getPaginatedData(loading_more = false) {
            await this.getServices(loading_more)
        },
        getServices(loading_more) {
            // if(Object.keys(route().params).length > 0){
            //     this.$inertia.replace(route('services.listing'))
            // }
            axios.post(this.route('getApiServices'), this.filter).then(res => {
                const data = res.data.data
                if (loading_more) {
                    this.services.data = this.services.data.concat(data.data);
                } else {
                    this.services.data = data.data;
                }
                this.services.links = data.links
                this.services.meta = data.meta
                this.fetching = false
            });
        },
            listView() {
        this.list_view = true;
        this.grid_view = false;
        },

        GridView() {
        this.list_view = false;
        this.grid_view = true;
        },

    },
});
</script>
