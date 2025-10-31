<template>


  <app-layout title="Dashboard">
  <header class="">
    <!-- Page Heading -->
    <!-- <div class="page-heading d-flex py-3 bg-white shadow-sm border-bottomF">
      <div class="container">
        <h2 class="h4 font-weight-bold">Dashboard</h2>
      </div>
    </div> -->
  </header>
  dashboard
  </app-layout>

</template>
<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import Navbar from "@/Layouts/AppIncludes/Navbar.vue";

export default defineComponent({
  components: {
    AppLayout,
    Navbar
  },
});
</script>
