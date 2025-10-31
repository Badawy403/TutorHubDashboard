<template>

  <app-layout title="My Profile">
<template #header>
    <!-- <page-header >
    My Profile
    </page-header> -->
</template>
<template #default>
        <teacher-account v-if="$page.props.auth.logged_in_as == 'teacher'"></teacher-account>
        <student-account v-if="$page.props.auth.logged_in_as == 'student'"></student-account>
        <academy-account v-if="$page.props.auth.logged_in_as == 'academy'"></academy-account>
</template>

  </app-layout>

</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import PageHeader from "@/Components/PageHeader.vue";
import Navbar from "@/Layouts/AppIncludes/Navbar.vue";
import TeacherAccount from "@/Components/Teachers/TeacherAccount.vue";
import StudentAccount from "@/Components/Students/StudentAccount.vue";
import AcademyAccount from "@/Components/Academies/AcademyAccount.vue";




export default defineComponent({
  components: {
    AppLayout,
    Navbar,
    PageHeader,
    TeacherAccount,
    StudentAccount,
    AcademyAccount
  },
});
</script>
