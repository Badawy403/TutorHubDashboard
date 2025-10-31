<template>
    <app-layout title="Heal Yourself">
        <!-- <template #header>
            <page-header>
                Heal Yourself
            </page-header>
        </template> -->
    </app-layout>
</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import PageHeader from "@/Components/PageHeader.vue";

export default defineComponent({
    components: {
        AppLayout,
        PageHeader
    },
});
</script>
