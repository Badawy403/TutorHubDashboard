<template>
  <div class="container-fluid py-5 mx-0">
    <div class="row">
      <div class="col-12">
        <h1 class="text-center">
          <!-- <span class="fw-normal">{{ __("Hello") }} {{ $page.props.auth.user.student.first_name }} {{ $page.props.auth.user.student.last_name }} | </span> -->
          <span class="fw-bold text-primary">{{ __("Appointment Log") }}</span>
        </h1>
        <!-- <p class="text-center mb-0">{{ __("discover The Best Teachers Near You") }}</p> -->
      </div>
    </div>
  </div>

  <div class="container" v-if="fetching">
    <SideTabsPageSkeleton></SideTabsPageSkeleton>
  </div>


    <div class="container" v-else>
      <div class="row">
        <div
          class="col-12 d-flex align-items-start align-items-md-center justify-content-between flex-column flex-md-row"
        >
          <div class="col-lg-6">
            <div
              class="nav nav-pills account-tabs appoint-navs gap-2 gap-md-3 fs-4 fw-bold"
              id="v-pills-tab"
              role="tablist"
              aria-orientation="vertical"
            >
              <li
                class="nav-item mb-3"
                role="presentation"
                @click="() => (currentTab = appIndex)"
                v-for="(status, appIndex) in appointment_status"
                :key="appIndex"
              >
                <button
                  class="nav-link text-dark"
                  :class="{
                    active: currentTab === appIndex,
                  }"
                  :id="'pills-appointment-tab-' + appIndex"
                  data-bs-toggle="pill"
                  :data-bs-target="'#pills-home-' + appIndex"
                  type="button"
                  role="tab"
                  aria-controls="pills-pending"
                  aria-selected="true"
                  @click="getPaginatedData(false, status.status_code)"
                >
                  <div>{{ __(status.display_name) }}</div>
                </button>
              </li>
            </div>
          </div>
          <div class="col-12 col-lg-6">
            <div class="col-12">
              <div
                class="d-md-flex align-items-center justify-content-end mb-3"
              >
                <div class="d-flex me-md-3 mb-3 mb-md-0 bg-white rounded-3">
                  <select
                    style="width: 200px"
                    v-model="filter.column"
                    class="form-select shadow-none rounded-0 h-auto bg-transparent border-end border-primary border-2"
                    aria-label="Select Filter"
                  >
                    <option value selected>
                      {{ __("select") }}
                      {{ __("filter") }}
                    </option>
                    <option
                      v-for="col in this.columns"
                      :key="col.id"
                      :value="col.value"
                    >
                      {{ col.name }}
                    </option>
                  </select>
                  <div v-if="filter.column == 'date'" class="form-group me-2">
                    <input
                      type="date"
                      v-model="filter.search"
                      class="w-100 shadow-none bg-transparent form-control px-3"
                    />
                  </div>
                  <div
                    v-else-if="filter.column == 'start_time'"
                    class="form-group me-2"
                  >
                    <input
                      type="time"
                      v-model="filter.search"
                      class="w-100 shadow-none bg-transparent form-control px-3"
                    />
                  </div>
                  <div
                    v-else-if="filter.column == 'end_time'"
                    class="form-group me-2"
                  >
                    <input
                      type="time"
                      v-model="filter.search"
                      class="w-100 shadow-none bg-transparent form-control px-3"
                    />
                  </div>
                  <div
                    v-else-if="filter.column == 'is_paid'"
                    class="form-group me-2"
                  >
                    <select
                      style="width: 200px"
                      v-model="filter.search"
                      class="form-select shadow-none bg-transparent h-auto"
                      aria-label="Select Filter"
                    >
                      <option value="">{{ __("select please") }}</option>
                      <option value="1">{{ __("Yes") }}</option>
                      <option value="0">{{ __("No") }}</option>
                    </select>
                  </div>
                  <div v-else class="form-group me-2">
                    <input
                      v-model="filter.search"
                      class="w-100 shadow-none bg-transparent form-control px-3"
                      :placeholder="__('Search')"
                      type="text"
                    />
                  </div>
                </div>
                <div>
                  <button
                    type="button"
                    class="btn btn-primary me-2 w-100"
                    @click="getPaginatedData(false, status.status_code)"
                  >
                    {{ __("Search") }}
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>

    <!-- <hr class="border border-primary mt-0" /> -->

    <div class="container py-4">
      <student-appointment-list-card
        :appointments="appointments"
      ></student-appointment-list-card>
      <div class="col-12">
        <TablePagination @onPageChange="onPageChange" :meta="appointments.meta">
        </TablePagination>
      </div>
    </div>
  </div>

  <!-- <div class="">

        <div class="container" v-if="fetching">
            <SideTabsPageSkeleton></SideTabsPageSkeleton>


        </div>
        <div class="container" v-else>
            <div class="row">
                <div class="col-md-3 p-4">
                    <div class="nav flex-column nav-pills account-tabs" id="v-pills-tab" role="tablist"
                        aria-orientation="vertical">
                        <li class="nav-item mb-3" role="presentation" @click="() => (currentTab = appIndex)"
                            v-for="(status, appIndex) in appointment_status" :key="appIndex">
                            <button class="nav-link w-100 text-dark" :class="{ active: currentTab === appIndex }"
                                :id="'pills-appointment-tab-' + appIndex" data-bs-toggle="pill"
                                :data-bs-target="'#pills-home-' + appIndex" type="button" role="tab"
                                aria-controls="pills-pending" aria-selected="true"
                                @click="getPaginatedData(false, status.status_code)">
                                <div>{{ status.display_name }}</div>
                            </button>
                        </li>
                    </div>
                </div>
                <div class="col-md-9 border-start border-dark">
                    <div class="tab-content w-100 p-4" id="v-pills-tabContent">
                        <div v-for="(status, index) in appointment_status" :key="index" class="tab-pane fade"
                            :class="{ 'active show': currentTab === index }" :id="'pills-home-' + index" role="tabpanel"
                            :aria-labelledby="'pills-appointment-tab-' + index">
                            <div class="row">
                                <div class="col-md-12">
                                    <div v-if="currentTab === index">
                                        <div class="col-12">
                                            <div class="d-md-flex align-items-center justify-content-end mb-3">

                                                <div class="form-group me-2 mb-3 mb-md-0">
                                                    <select  v-model="filter.column"
                                                        class="form-select h-auto" aria-label="Select Filter">
                                                        <option value="" selected>{{ __('select') }} {{ __('filter') }}
                                                        </option>
                                                        <option v-for="col in this.columns" :key="col.id"
                                                            :value="col.value">{{ col.name }}</option>
                                                    </select>
                                                </div>
                                                <div v-if="filter.column == 'date'" class="form-group me-2 mb-3 mb-md-0">
                                                  <input type="date" v-model="filter.search"  class="w-100 form-control  px-3">
                                                </div>
                                                <div v-else-if="filter.column == 'start_time'" class="form-group me-2 mb-3 mb-md-0">
                                                  <input type="time" v-model="filter.search"  class="w-100 form-control  px-3">
                                                </div>
                                                <div v-else-if="filter.column == 'end_time'" class="form-group me-2 mb-3 mb-md-0">
                                                  <input type="time" v-model="filter.search"  class="w-100 form-control  px-3">
                                                </div>
                                                <div v-else-if="filter.column == 'is_paid'" class="form-group me-2 mb-3 mb-md-0">
                                                    <select style="width: 200px" v-model="filter.search"
                                                        class="form-select h-auto" aria-label="Select Filter">
                                                        <option value="">{{ __("select please") }}</option>
                                                       <option value="1"> {{ __("Yes") }}</option>
                                                       <option value="0"> {{ __("No") }}</option>
                                                    </select>
                                                </div>
                                                <div v-else class="form-group me-2 mb-3 mb-md-0">
                                                    <input v-model="filter.search" class="w-100 form-control  px-3"
                                                        placeholder="Search" type="text" />
                                                </div>
                                                <div>
                                                    <button type="button" class="btn btn-primary me-2"
                                                        @click="getPaginatedData(false, status.status_code)">
                                                        Search
                                                    </button>
                                                </div>

                                            </div>
                                        </div>
                                        <student-appointment-list-card
                                            :appointments="appointments"></student-appointment-list-card>
                                        <div class="col-12">
                                            <TablePagination @onPageChange="onPageChange" :meta="appointments.meta">
                                            </TablePagination>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
  <!-- ta bs -->
  <!-- </div>

    </div> -->
</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import ValidationErrors from "@/Components/ValidationErrors.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import Table from "@/Components/Shared/DataTable/Table.vue";
import TableTHead from "@/Components/Shared/DataTable/TableTHead.vue";
import TablePagination from "@/Components/Shared/DataTable/TablePagination.vue";
import PaginationMixin from "@/Mixins/PaginationMixin.vue";
import TableSkeleton from "@/Components/Skeleton/TableSkeleton.vue";
import SideTabsPageSkeleton from "@/Components/Skeleton/SideTabsPageSkeleton.vue";
import StudentAppointmentListCard from "@/Components/Students/StudentAppointmentListCard.vue";
import Breadcrums from "../../Components/Shared/Breadcrums.vue";

export default defineComponent({
  components: {
    Head,
    AppLayout,
    ValidationErrors,
    Link,
    Table,
    TableTHead,
    TablePagination,
    TableSkeleton,
    StudentAppointmentListCard,
    SideTabsPageSkeleton,
    Breadcrums,
  },
  mixins: [PaginationMixin],
  props: ["appointment_status"],
  data() {
    return {
      appointments: {},
      currentTab: 0,
      status_code: 1,
      fetching: false,
      key: 1,
      columns: [
        {
          id: 1,
          name: this.__("teacher"),
          value: "teacher.first_name",
          searchable: false,
          sortable: false,
        },
        {
          id: 2,
          name: this.__("date"),
          value: "date",
          searchable: true,
          sortable: true,
        },
        {
          id: 3,
          name: this.__("start time"),
          value: "start_time",
          searchable: false,
          sortable: true,
        },
        {
          id: 4,
          name: this.__("end time"),
          value: "end_time",
          searchable: false,
          sortable: true,
        },
        {
          id: 5,
          name: this.__("paid"),
          value: "is_paid",
          searchable: false,
          sortable: false,
        },
      ],
      breadcrums: [
        {
          id: 1,
          name: "Home",
          link: "/",
        },
        {
          id: 2,
          name: "My Appointments",
          link: "",
        },
      ],
    };
  },
  async created() {
    this.filter.status_code = this.status_code;
    await this.getAppointmentFilterData(false);
  },
  methods: {
    async getPaginatedData(loading_more = false, status_code) {
      if (status_code) {
        this.status_code = status_code;
      }
      this.filter.status_code = this.status_code;
      await this.getAppointmentFilterData(loading_more);
    },
    getAppointmentFilterData(loading_more) {
      this.fetching = true;
      axios
        .post(this.route("getApiFilterAppointmentLogs"), this.filter)
        .then((res) => {
          const data = res.data.data;

          if (loading_more) {
            this.appointments.data = this.appointments.data.concat(data.data);
          } else {
            this.appointments.data = data.data;
          }
          this.appointments.links = data.links;
          this.appointments.meta = data.meta;
          this.fetching = false;
        });
    },
  },
});
</script>
