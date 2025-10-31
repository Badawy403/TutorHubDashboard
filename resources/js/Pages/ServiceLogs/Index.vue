<template>

    <app-layout title="Service Log">
        <template #default>
                <teacher-service-logs v-if="$page.props.auth.logged_in_as == 'teacher'" :service_statuses="service_statuses"></teacher-service-logs>
                <academy-service-logs v-if="$page.props.auth.logged_in_as == 'academy'" :service_statuses="service_statuses"></academy-service-logs>
                <student-service-logs v-if="$page.props.auth.logged_in_as == 'student'" :service_statuses="service_statuses"></student-service-logs>
        </template>
    </app-layout>
  </template>

  <script>
  import { defineComponent } from "vue";
  import AppLayout from "@/Layouts/AppLayout.vue";
  import PageHeader from "@/Components/PageHeader.vue";
  import Navbar from "@/Layouts/AppIncludes/Navbar.vue";
  import TeacherServiceLogs from "@/Components/Teachers/ServiceLogs/ServiceLogs.vue";
  import AcademyServiceLogs from "@/Components/Academies/ServiceLogs/ServiceLogs.vue";
  import StudentServiceLogs from "@/Components/Students/ServiceLogs/ServiceLogs.vue";


  export default defineComponent({
    components: {
      AppLayout,
      Navbar,
      PageHeader,
      TeacherServiceLogs,
      AcademyServiceLogs,
      StudentServiceLogs,
    },
    props:['service_statuses'],
    created()
    {
    }
  });
  </script>
