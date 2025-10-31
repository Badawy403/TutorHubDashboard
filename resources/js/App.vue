<template>
  <CommonMaster>
    <router-view></router-view>
  </CommonMaster>
</template>
<script>
import CommonMaster from "@/Components/Layouts/Master.vue";

export default {
  name: "App",
  components: {
    CommonMaster,
  },

};
</script>
