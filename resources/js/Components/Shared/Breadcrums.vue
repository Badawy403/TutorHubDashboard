<template>

    <div class="container-fluid px-0">
           <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center my-0">
                <li class="breadcrumb-item mt-1" v-for="(breadcrum,index) in breadcrums" :key="index">
                    <Link v-if="breadcrum.link" class="text-decoration-none text-secondary fw-bold" :href="breadcrum.link">{{breadcrum.name}}</Link>
                    <span class="text-primary fw-bold" v-else> {{breadcrum.name}}</span>
                </li>
            </ol>
            </nav>
    </div>
</template>

<script>
import { defineComponent } from "vue";
import { Link } from "@inertiajs/inertia-vue3";

export default defineComponent({
    components: {
        Link,
    },
    props:['breadcrums'],
    created() {
        console.log(this.breadcrums);
    },
    data() {
        return {
        };
    },
    async mounted() {
    },
    methods: {
    },
});
</script>


<style scoped>

.text-secondary{
    color: #4B4B4B;
}
</style>


