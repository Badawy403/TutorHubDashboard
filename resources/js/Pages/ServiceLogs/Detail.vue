<template>

    <app-layout title="Service Log Detail">
  <template #default>
          <teacher-service-detail v-if="$page.props.auth.logged_in_as == 'teacher'" :service="service"></teacher-service-detail>
          <academy-service-detail v-if="$page.props.auth.logged_in_as == 'academy'" :service="service"></academy-service-detail>
          <student-service-detail v-if="$page.props.auth.logged_in_as == 'student'" :service="service" ></student-service-detail>
  </template>

    </app-layout>
  </template>

  <script>
  import { defineComponent } from "vue";
  import AppLayout from "@/Layouts/AppLayout.vue";
  import PageHeader from "@/Components/PageHeader.vue";
  import Navbar from "@/Layouts/AppIncludes/Navbar.vue";
  import TeacherServiceDetail from "@/Components/Teachers/ServiceLogs/ServiceLogDetail.vue";
  import AcademyServiceDetail from "@/Components/Academies/ServiceLogs/ServiceLogDetail.vue";
  import StudentServiceDetail from "@/Components/Students/ServiceLogs/ServiceLogDetail.vue";




  export default defineComponent({
    components: {
      AppLayout,
      Navbar,
      PageHeader,
      TeacherServiceDetail,
      StudentServiceDetail,
      AcademyServiceDetail,

    },
    props:['service'],
    created()
    {
    }
  });
  </script>
