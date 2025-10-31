<template>
    <app-layout title="shop">
        <!-- <template #header>
            <page-header>
                {{ __('shop') }}
            </page-header>
        </template> -->
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
