<template>

    <app-layout title="Appointment Log">
  <template #default>
          <teacher-appointment v-if="$page.props.auth.logged_in_as == 'teacher'" :appointment_status="appointment_status"></teacher-appointment>
          <academy-appointment v-if="$page.props.auth.logged_in_as == 'academy'" :appointment_status="appointment_status"></academy-appointment>
          <student-appointment v-if="$page.props.auth.logged_in_as == 'student'" :appointment_status="appointment_status"></student-appointment>
  </template>

    </app-layout>

  </template>

  <script>
  import { defineComponent } from "vue";
  import AppLayout from "@/Layouts/AppLayout.vue";
  import PageHeader from "@/Components/PageHeader.vue";
  import Navbar from "@/Layouts/AppIncludes/Navbar.vue";
  import TeacherAppointment from "@/Components/Teachers/AppointmentLogs/AppointmentLogs.vue";
  import AcademyAppointment from "@/Components/Academies/AppointmentLogs/AppointmentLogs.vue";
  import StudentAppointment from "@/Components/Students/StudentAppointment.vue";




  export default defineComponent({
    components: {
      AppLayout,
      Navbar,
      PageHeader,
      TeacherAppointment,
      AcademyAppointment,
      StudentAppointment,
    },
    props:['appointment_status'],
    created()
    {
    }
  });
  </script>
