import './bootstrap';
 import { createApp } from 'vue'
import IndependentComponents from './IndependentComponents.vue'


const ind_app = createApp(IndependentComponents)
ind_app.component('AboutUs',AboutUs)
ind_app.component('ContactUs',ContactUs)
ind_app.mount('#ind_app')
