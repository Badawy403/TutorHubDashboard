<template>

    <app-layout title="Appointment Log Detail">
  <template #default>
          <teacher-appointment-detail v-if="$page.props.auth.logged_in_as == 'teacher'" :appointment="appointment" :gateway="gateway"></teacher-appointment-detail>
          <academy-appointment-detail v-if="$page.props.auth.logged_in_as == 'academy'" :appointment="appointment" :gateway="gateway"></academy-appointment-detail>
          <student-appointment-detail v-if="$page.props.auth.logged_in_as == 'student'" :appointment="appointment" :gateway="gateway"></student-appointment-detail>
  </template>

    </app-layout>

  </template>

  <script>
  import { defineComponent } from "vue";
  import AppLayout from "@/Layouts/AppLayout.vue";
  import PageHeader from "@/Components/PageHeader.vue";
  import Navbar from "@/Layouts/AppIncludes/Navbar.vue";
  import TeacherAppointmentDetail from "@/Components/Teachers/AppointmentLogs/AppointmentLogDetail.vue";
  import AcademyAppointmentDetail from "@/Components/Academies/AppointmentLogs/AppointmentLogDetail.vue";
  import StudentAppointmentDetail from "@/Components/Students/StudentAppointmentDetail.vue";




  export default defineComponent({
    components: {
      AppLayout,
      Navbar,
      PageHeader,
      TeacherAppointmentDetail,
      StudentAppointmentDetail,
      AcademyAppointmentDetail,

    },
    props:['appointment','gateway'],
    created()
    {
    }
  });
  </script>
