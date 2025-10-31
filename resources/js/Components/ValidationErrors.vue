<template>
    <div class="alert text-sm p-2" :class="{'alert-info' : errors['type'] == 'info' , 'alert-danger' :  errors['type'] == 'error' , 'alert-success' : errors['type'] == 'success' , 'alert-danger' : errors['type'] == null}" role="alert" v-if="hasErrors">
        <div v-if="errors['type'] == 'error' || errors['type'] == null" class="font-weight-bold">Whoops! Something went wrong.</div>
        <ul>
            <template v-for="(error, key) in errors">

            <li v-if="key != 'type' ">{{ key != 'type' ? error : '' }}</li>
        </template>
        </ul>
    </div>
</template>

<script>
  import { defineComponent } from 'vue'

	export default defineComponent({
		computed: {
			errors() {
				return this.$page.props.errors
			},

			hasErrors() {
				return Object.keys(this.errors).length > 0;
			},
		}
	})
</script>
