<template>
    <app-layout title="Donation">
        <template #header>
            <!-- <page-header>
                Donation
            </page-header> -->
        </template>
    </app-layout>
</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import PageHeader from "@/Components/PageHeader.vue";
import Navbar from "@/Layouts/AppIncludes/Navbar.vue";

export default defineComponent({
    components: {
        AppLayout,
        Navbar,
        PageHeader
    },
});
</script>
