<template>

    <div :class="{ 'col-md-6 col-events': add_col, 'w-100': !add_col }">
    <div
      class="card item-h card-alt overflow-hidden border-0 rounded-0 shadow-none mx-3"
    >
      <div
        class="d-flex justify-content-center overflow-hidden card-avatar position-relative rounded-4"
        style="height: 400px"
      >
        <img
          v-if="event.image"
          class="img-fluid w-100"
          :src="event.image"
          alt="imageevent"
        />
        <img
          v-if="!event.image"
          src="@/images/account/default_avatar_men.png"
          class="img-fluid"
          alt="eventdefault"
        />
      </div>

        <div class="card-body text-start">
          <Link class="text-decoration-none text-black" :href="route('events.detail', { slug: event.slug })"><h4 class="card-title text-black fw-bold">{{ event.name }}</h4></Link>
          <div class="d-flex aling-items-center justify-content-start mb-2">
            <span class="fs-4 text-secondary fw-medium me-4">{{ eventStartTime }}</span>
            <!-- <span class="fs-4 text-secondary fw-medium me-4">{{ new Date(event.start_at) }}</span> -->
            <span class="text-secondary fs-4 fw-medium">{{ eventStartDate }}</span>
          </div>
          <p
            v-if="event.description && event.description.length > 0"
            class="card-text"
          >
            {{ event.description.substring(0, 100) + "..." }}
          </p>
          <p class="card-text" v-else>{{ event.description }}</p>
          <Link
            :href="route('events.detail', { slug: event.slug })"
            class="btn btn-outline-primary fw-bold"
            >{{ __("View Detail") }}
          </Link>
        </div>
      </div>
    </div>

</template>

  <!-- <div :class="{ 'col-md-6 col-events': add_col, 'w-100': !add_col }">
        <div class="card rounded-0 mx-5">
            <div  style="height: 250px; width: 100%;">
            <img  v-if="event.image" :src="event.image" class="h-100 w-100" alt="eventimg">
            <img  v-if="!event.image" src="@/images/account/default_avatar_men.png"  class="h-100 w-100" alt="eventdefault">
            </div>
            <div class="card-body px-0 text-start">
            <h5 class="card-title text-black fw-bold"> {{ event.name }}</h5>
            <div class="d-flex aling-items-center justify-content-start mb-2">
                <span class="fs-5 text-secondary fw-medium me-4">{{ __('6:00 - 8:00') }}</span>
                <span class="text-secondary fs-5 fw-medium">{{ __('28 Nov,2024') }}</span>
            </div>
            <p v-if="event.description && event.description.length > 0" class="card-text">
                {{  event.description.substring(0, 100) + "..." }}
            </p>
            <p class="card-text" v-else>{{ event.description }}</p>
            <Link :href="route('events.detail', { 'slug': event.slug })"
                class="btn btn-primary fw-bold">{{ __('View Detail') }}
            </Link>
        </div>
        </div>
    </div> -->

        <!-- <div
            class="card item-h shadow-none rounded-0 card-event bg-transparent border-bottom"
        >
            <div
                class="card-body bg-transparent overflow-hidden px-4 mx-3"
            >
                <div class="row mx-0 align-items-center justify-content-between">
                    <div class="col-2">
                      <div class="d-flex flex-column align-items-center border-end border-2">
                        <h3 class="text-primary fw-bold display-5 mb-0">{{ __('08') }}</h3>
                        <span class="text-secondary fs-4 fw-medium">{{ __('September') }}</span>
                      </div>
                    </div>
                    <div class="col-lg-8 col-md-12 p-0">
                        <div class="p-3 pb-0 text-start">
                            <h3 class="mb-3 fs-3 fw-bold text-primary justify-content-start" style="overflow: hidden;
                            display: -webkit-box;
                            -webkit-line-clamp: 2;
                            line-clamp: 2;
                            -webkit-box-orient: vertical;">
                                {{ event.name }}
                            </h3>
                            <div class="d-flex align-items-center mb-2">
                                <div class="d-flex align-items-center me-3">
                                    <i class="bi bi-alarm fs-4 me-2"></i>
                                    <span class="fs-4 text-secondary fw-lightbold">8:00 am to 5:20 pm</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-geo-alt-fill fs-4 me-2"></i>
                                    <span class="fs-4 text-secondary fw-lightbold">NewYork,United State</span>
                                </div>
                            </div>
                            <p
                                class="text-secondary"
                                v-if="
                                    event.description &&
                                    event.description.length > 0
                                "
                            >
                                {{
                                    event.description.substring(0, 100) + "..."
                                }}
                            </p>
                            <p class="text-secondary" v-else>{{ event.description }}</p>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-12  p-0">
                        <div
                            class="d-flex justify-content-end card-avatar overflow-hidden position-relative "
                            style=""
                        >
                            <img
                                v-if="event.image"
                                class="img-fluid w-75"
                                :src="event.image"
                                alt="teacher"
                            />
                            <img
                                v-if="!event.image"
                                class="img-fluid m-3"
                                src="@/images/account/default_avatar_men.png"
                                alt="events"
                            />
                            <div class="item-overlay top"></div>
                            <div class="block--text text-center">
                                <Link :href="route('events.detail', { 'slug': event.slug })"
                                    class="btn btn-primary">{{ __('view detail') }}</Link>
                            </div> -->

                    <!-- </div>

                </div>
            </div>

        </div>

    </div> -->

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

  }
});
</script>
