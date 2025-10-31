<template>
    <div
    class="w-100 item mt-4"
    :class="{ item: add_col }"
  >
    <div class="card mx-3 mx-md-0 spotlight-card item-h bg-white border-0">
      <div class="card-body p-0">
        <div class="row align-items-center p-3">
          <div class="col-lg-4">
            <div
              class="d-flex justify-content-start justify-content-md-center card-avatar overflow-hidden position-relative"

            >
              <img
                v-if="event.image"
                class="img-fluid rounded-4"
                :src="event.image"
                alt="event"
              />
              <img
                v-if="!event.image"
                class="img-fluid m-3 rounded-4"
                src="@/images/account/default_avatar_men.png "
                alt="event"
              />
            </div>
          </div>
          <div class="col-lg-8">
            <div
              class="rounded-2xxl border-0 bg-transparent mb-md-4"
              style="border-radius: 20px"
            >
              <div class="p-0">
                <div class="d-flex align-items-start justify-content-between py-2 py-md-0 pe-md-2">
                  <div class="d-flex flex-column align-items-start mt-2">
                    <h4 class="mb-0 fs-4 text-capitalize fw-bold">
                      {{ event.name }}
                    </h4>
                    <span v-if="event.teacher_id" class="badge bg-primary my-2">{{ __('teacher') }}</span>
                    <span v-else-if="event.academy_id" class="badge bg-primary my-2">{{ __('academy') }}</span>
                    <span v-else class="badge bg-primary my-2">{{ __('admin') }}</span>
                    <div class="d-flex aling-items-center justify-content-start mb-2">
                        <span class="fs-4 text-secondary fw-medium me-4">{{ eventStartTime }}</span>
                        <!-- <span class="fs-4 text-secondary fw-medium me-4">{{ new Date(event.start_at) }}</span> -->
                        <span class="text-secondary fs-4 fw-medium">{{ eventStartDate }}</span>
                    </div>
                  </div>
                  <div class="d-flex align-items-center mt-2 mt-md-2 mt-lg-0">
                    <Link
                      :href="route('events.detail', { slug: event.slug })"
                      class="btn btn-outline-primary fs-5"
                      >{{ __("Details") }}</Link
                    >
                  </div>
                </div>
              </div>
            </div>

            <div class="text-start">
              <p
                class="line-clamp"
                v-if="event.description && event.description.length > 0"
              >
                {{ event.description.substring(0, 400) + "..." }}
              </p>
              <p class="" v-else>{{ event.description }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


</template>
<script>
import { defineComponent } from "vue";
import { Link } from "@inertiajs/inertia-vue3";

export default defineComponent({
  components: {
    Link,
  },
  props: ["event", "add_col"],
  created() {
    this.processEventData(this.event)
  },
  data() {
    return {
        eventStartTime: '',
        eventStartDate: '',
    };
  },
  methods: {
    processEventData(event) {
      const startsAtString = event.starts_at;
      let eventStartDate = new Date(startsAtString);

      let hours = eventStartDate.getHours();
      const minutes = eventStartDate.getMinutes().toString().padStart(2, '0');
      const day = eventStartDate.getDate().toString().padStart(2, '0');
      const month = eventStartDate.getMonth().toString().padStart(2, '0');
      const year = eventStartDate.getFullYear();

      const ampm = hours >=12 ? 'PM' : 'AM';
      hours = hours % 12 ;
      hours = hours ? hours : 12;
      this.eventStartDate = `${day}/${month}/${year}`;
      this.eventStartTime = `${hours}:${minutes} ${ampm}`;
    },
  },
});
</script>
