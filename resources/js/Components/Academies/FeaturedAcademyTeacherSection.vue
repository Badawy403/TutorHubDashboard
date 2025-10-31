<template>
    <!-- v-if="academy_teachers.length > 0" -->

    <div class="col-md-3 mb-3" v-for="teacher in academy_teachers" :key="teacher.id">
            <teacher-card :teacher="teacher"></teacher-card>
    </div>

    <!-- v-if="academy_teachers.length > 0" -->
    <!-- <div >
        <div class="row teacher-academy">
            <div class="col-3">
                <card-skeleton></card-skeleton>
            </div>
            <div class="col-3">
                <card-skeleton></card-skeleton>
            </div>
            <div class="col-3">
                <card-skeleton></card-skeleton>
            </div>
            <div class="col-3">
                <card-skeleton></card-skeleton>
            </div>
        </div>
    </div> -->
</template>
<script>
import { defineComponent } from "vue";
import { Link } from "@inertiajs/inertia-vue3";
import TeacherCard from "@/Components/Teachers/TeacherCard.vue";
import CardSkeleton from "@/Components/Skeleton/CardSkeleton.vue";
import axios from "axios";
import { Carousel, Navigation, Pagination, Slide } from "vue3-carousel";
import Section from "@/Components/Section.vue";

export default defineComponent({
    components: {
        TeacherCard,
        Link,
        Carousel,
        Slide,
        Pagination,
        Navigation,
        Section,
        CardSkeleton,
    },
    created() {
    },
    data() {
        return {
            form: this.$inertia.form({}),
            featured_teachers: [],
            fetching:true,
            key: 1,
            settings: {
                itemsToShow: 1,
                snapAlign: "start",
                autoplay: false,
            },
            // breakpoints are mobile firstTop Featured Teachers
            // any settings not specified will fallback to the carousel settings
            breakpoints: {
                // 700px and up
                700: {
                    itemsToShow: 2,
                    snapAlign: "start",
                },
                // 1024 and up
                1024: {
                    itemsToShow: 2,
                    snapAlign: "start",
                },
                1240: {
                    itemsToShow: 4,
                    snapAlign: "start",
                }
            },
        };
    },
    methods: {
        submit() {},
    },
    props: ["findTeachers", "refresh","academy_teachers"],
    watch: {
        refresh(newVal, oldVal) {
            this.key++;
        },
    },
});
</script>
