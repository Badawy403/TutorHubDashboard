<template>

    <app-layout title="Cookies Policy">
        <!-- <template #header>
            <page-header>
                Cookies Policy
            </page-header>
        </template> -->

        Cookies Policy
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
