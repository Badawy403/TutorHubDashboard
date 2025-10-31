<template>
    <div class="vh-100 bg-white p-3 shadow position-fixed d-flex flex-column w-195 collapse" id="sidebar">
        <div class="logo">
            Logo Here
        </div>
        <div class="navbar pt-4">
            <ul class="p-0 w-100 pt-3">
                <li>
                    <Link :href="route('home')" :class="{ 'active': route().current('home') }">
                        Home
                    </Link>
                </li>
                         <li>
                    <Link :href="route('home')" :class="{ 'active': route().current('home') }">
                        Home
                    </Link>
                </li>
                         <li>
                    <Link :href="route('home')" :class="{ 'active': route().current('home') }">
                        Home
                    </Link>
                </li>
            </ul>
        </div>
        <div class="side-footer mt-auto">
        </div>
    </div>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";

export default {
  components: {
    Link,
  },

};

</script>
