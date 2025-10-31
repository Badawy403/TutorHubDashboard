<template>
    <app-layout>
        <template #default>
            <div class="section p-0 profile">
                <div class="row mx-0 border-bottom border-dark py-5">
                    <div class="col-12 text-center py-3">
                        <p class="fs-2 mb-0">
                            {{ __("hello") }} Jack |
                            <span class="fw-bold">  {{ __("appointment history") }}</span>
                        </p>
                        <p>  {{ __("discover The Best Teachers Near You") }} </p>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 p-4">
                            <div
                                class="nav flex-column nav-pills account-tab"
                                id="v-pills-tab"
                                role="tablist"
                                aria-orientation="vertical"
                            >
                                <li class="nav-item mb-3" role="presentation">
                                    <button
                                        class="nav-link w-100 text-dark"
                                        :class="{
                                            active:
                                                active_tab ==
                                                'all-appointments',
                                        }"
                                        @click="changeTab('all-appointments')"
                                        id="all-appointments-tab"
                                        data-bs-toggle="tab"
                                        data-bs-target="#all-appointments"
                                        type="button"
                                        role="tab"
                                        aria-controls="all-appointments"
                                        aria-selected="true"
                                    >
                                        {{ __("all appointments") }}
                                    </button>
                                </li>

                                <li class="nav-item mb-3" role="presentation">
                                    <button
                                        class="nav-link w-100 text-dark"
                                        :class="{
                                            active:
                                                active_tab ==
                                                'pending-appointments',
                                        }"
                                        @click="
                                            changeTab('pending-appointments')
                                        "
                                        id="pending-appointments-tab"
                                        data-bs-toggle="tab"
                                        data-bs-target="#pending-appointments"
                                        type="button"
                                        role="tab"
                                        aria-controls="pending-appointments"
                                        aria-selected="true"
                                    >
                                        {{ __("pending appointments") }}
                                    </button>
                                </li>
                            </div>
                        </div>
                        <div class="col-md-9 border-start border-dark">
                            <!-- Nav tabs -->

                            <!-- v-if="hasModule('test')" -->
                            <!-- Tab panes -->
                            <div
                                class="tab-content w-100 p-4"
                                id="v-pills-tabContent"
                            >
                                <all-appointments
                                    v-if="active_tab == 'all-appointments'"
                                ></all-appointments>

                                <pending-appointments
                                v-if="
                                        active_tab == 'pending-appointments'
                                    "
                                ></pending-appointments>
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
import { Head, Link } from "@inertiajs/inertia-vue3";
import AllAppointments from "@/Components/Appointment/AllAppointments.vue";
import PendingAppointments from "@/Components/Appointment/PendingAppointments.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import PageHeader from "@/Components/PageHeader.vue";

export default defineComponent({
    components: {
        Head,
        Link,
        AllAppointments,
        PendingAppointments,
        AppLayout,
    },

    data() {
        return {
            active_tab: route().params.active_tab ?? "all-appointments",
        };
    },

    methods: {
        changeTab(tab) {
            this.active_tab = tab;
        },
        submit() {},
    },
});
</script>
