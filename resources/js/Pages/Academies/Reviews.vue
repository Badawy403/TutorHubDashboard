<template>

    <app-layout title="My Profile">
        <!-- <template #header>
            <page-header>
                {{__('academy')}} {{ __n('review') }}
            </page-header>
        </template> -->

        <div class="section py-5">
            <div class="container">
                <div class="row">
                    <div class="col-12 mb-5">
                        <h2 class="text-center">{{ academy.name }} {{ __n('review') }}</h2>
                    </div>
                    <div class="col-12" v-if="fetching">
                        <div class="row">
                            {{__('fetching')}}
                        </div>
                    </div>
                    <div class="col-12" v-if="!fetching">
                        <div v-if="reviews.data.length > 0" class="row mb-5 mx-0">
                            <academy-review-card :add_col="true" v-for="review in reviews.data" :key="review.id" :review="review"></academy-review-card>

                        </div>
                        <div v-else class="row mb-5 mx-0">
                            <div class="col-12 text-center mb-3">
                                <record-not-found></record-not-found>
                            </div>
                        </div>
                        <div class="row" v-if="reviews.meta.last_page != this.filter.page">
                            <div class="col-md-12 d-flex align-items-center justify-content-center">
                                <button @click="loadMore()" class="btn btn-primary position-relative"  :disabled="loading_more"><span :class="{
                                    'loader': loading_more
                                }" class="position-absolute"></span> {{__('load more')}}</button>
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
import AcademyReviewCard from "@/Components/Academies/AcademyReviewCard.vue";
import RecordNotFound from "../../Components/Shared/RecordNotFound.vue";

export default defineComponent({
    mixins:[PaginationMixin],
    components: {
        AppLayout,
        Navbar,
        PageHeader,
        AcademyReviewCard,
        RecordNotFound
    },
    props:['academy'],
    created(){
    },
    mounted(){
        this.onSearch();
    },
    data() {
        return {
            reviews:{}
        }
    },
    methods: {
        async getPaginatedData(loading_more = false){
         await this.getAcademyReviews(loading_more)
         },
        getAcademyReviews(loading_more){
              axios.post(this.route('getApiAcademyReviews',{user_name:this.academy.user_name}),this.filter).then(res => {
                const data = res.data.data
                if(loading_more){
                    this.reviews.data = this.reviews.data.concat(data.data);
                }else{
                    this.reviews.data = data.data;
                }
                this.reviews.links = data.links
                this.reviews.meta = data.meta
                this.fetching = false
            });
     },

    },
});
</script>
