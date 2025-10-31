<template>
    <Section :heading="__('Find Best Services')">
      <template #paragraph>
        <p class="text-center mb-4">Our commitment to excellence extends to our commitment to integrity. We adhere to the highest ethical standards, treating each case with the utmost professionalism and confidentiality. We understand the gravity of the legal matters we handle, and we approach them with the respect and dedication they deserve.
            </p>
      </template>
        <div class="row d-flex align-items-center">
            <div class="col-12 text-center ">
            <ul class="tags ps-0 mb-0">
                <li v-for="tag in tags" :key="tag.id" class="rounded-5 hvr-shrink d-inline-block m-2 pt-2 pb-1 px-3" style="background-color: rgba(250, 193, 77, 0.43) !important;">
                 <Link class="text-decoration-none text-dark" :href="route('tags.detail',{slug:tag.slug})">
                     {{ tag.name }}
                  </Link>
                </li>
            </ul>
          </div>
        </div>
    </Section>

</template>
<script>
import { defineComponent } from "vue";
import {  Link } from "@inertiajs/inertia-vue3";
import axios from "axios";
import Section from "@/Components/Section.vue";

export default defineComponent({
  components: {
    Link,
    Section,
  },
  created(){
    this.getTags()
  },
  data() {
    return {
      tags:[],
    };
  },
  methods: {
    getTags(){
        axios.get(this.route('getApiFeaturedTags')).then(res => {
                this.tags = res.data.data
            });
    },
    submit() {
    },
  },
});
</script>
