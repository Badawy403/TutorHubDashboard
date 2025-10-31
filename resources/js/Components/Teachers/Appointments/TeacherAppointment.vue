<template>
    <div
        class="tab-pane"
        :class="{ active: active }"
        id="appointment"
        role="tabpanel"
        aria-labelledby="appointment-tab"
        tabindex="0"
    >
        <ul class="nav appoint-navs nav-pills mb-3 gap-2" id="pills-tab" role="tablist">
            <li
                @click="() => (currentTab = appIndex)"
                class="nav-item"
                role="presentation"
                v-for="(appointmentType, appIndex) in appointment_types"
                :key="appIndex"
            >
                <button
                    class="nav-link fs-5 fw-bold rounded-4"
                    :class="{ active: currentTab === appIndex }"
                    :id="'pills-appointment-tab-' + appIndex"
                    data-bs-toggle="pill"
                    :data-bs-target="'#pills-home-' + appIndex"
                    type="button"
                    role="tab"
                    aria-controls="pills-home"
                    aria-selected="true"
                >
                {{ appointmentType.display_name }}
                </button>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div
                v-for="(appointmentType, index) in appointment_types"
                :key="index"
                class="tab-pane fade"
                :class="{ 'active show': currentTab === index }"
                :id="'pills-home-' + index"
                role="tabpanel"
                :aria-labelledby="'pills-appointment-tab-' + index"
            >
                <video-type-appointment
                    v-if="
                        appointmentType.type == 'video' && currentTab === index
                    "
                    :appointment_type_id="appointmentType.id"
                    :appointment_type="appointmentType.type"
                    :is_schedule_required="appointmentType.is_schedule_required"
                ></video-type-appointment>

                <audio-type-appointment
                    v-if="
                        appointmentType.type == 'audio' && currentTab === index
                    "
                    :appointment_type_id="appointmentType.id"
                    :is_schedule_required="appointmentType.is_schedule_required"
                    :appointment_type="appointmentType.type"
                ></audio-type-appointment>

                <chat-type-appointment
                    v-if="
                        appointmentType.type == 'chat' && currentTab === index
                    "
                    :appointment_type_id="appointmentType.id"
                    :is_schedule_required="appointmentType.is_schedule_required"
                    :appointment_type="appointmentType.type"
                ></chat-type-appointment>
            </div>
        </div>
    </div>
</template>
<script>
import { defineComponent } from "vue";
import VideoTypeAppointment from "@/Components/Teachers/Appointments/VideoTypeAppointment.vue";
import AudioTypeAppointment from "@/Components/Teachers/Appointments/AudioTypeAppointment.vue";
import ChatTypeAppointment from "@/Components/Teachers/Appointments/ChatTypeAppointment.vue";
export default defineComponent({
    components: {
        VideoTypeAppointment,
        AudioTypeAppointment,
        ChatTypeAppointment,
    },
    props: ["active"],
    data() {
        return {
            currentTab: 0,
            appointment_types: this.$page.props.appointment_types,
        };
    },
    mounted() {
    },
});
</script>
