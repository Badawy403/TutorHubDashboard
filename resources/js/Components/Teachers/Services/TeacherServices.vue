<template>
  <div class="tab-pane" :class="{ active: active }" id="services" role="tabpanel" aria-labelledby="services-tab"
    tabindex="0">
    <Table v-if="!this.fetching">
      <template #TableHeaderTitle>{{ __('all') }} {{ __n('service') }}</template>
      <template #TableHeaderButtons>
        <div class="d-flex flex-column justify-content-md-end justify-content-start flex-md-row align-items-md-center mt-3 mt-md-0">

          <div class="form-group border rounded me-md-2 me-0 mb-2 mb-md-0">
            <select v-model="filter.column" class="form-select" aria-label="column">
              <option v-for="col in this.columns" :key="col.id" :value="col.value">{{col.name}}</option>
            </select>
          </div>

          <div class="form-group border rounded me-0 me-md-2 mb-2 mb-md-0 position-relative">
            <input v-model="filter.search"
            class=" form-control px-4"
            :placeholder="__('Search')" type="text" />

           <span class="position-absolute" style="top: 2px;
           right: 20px;"><button type="button" class="btn px-0 border-0 shadow-none " @click="getPaginatedData(false)">
            <i class="bi bi-search"></i>
          </button></span>
          </div>
          <button type="button" id="addEditServiceModalButton" class="btn btn-primary" data-bs-toggle="modal"
            @click="modal_service = null" data-bs-target="#addEditServiceModal">
            <i class="bi bi-plus fs-4"></i> {{__('Add New')}}
          </button>
          <add-edit-service-modal :key="key" @refreshData="refreshData()" @clearModalData="clearModalData()"
            :modalData="modal_service" id="addEditServiceModal"></add-edit-service-modal>
        </div>
      </template>
      <template #TableTheadRow>
        <tr>
          <TableTHead v-for="col in this.columns" :key="col.id" :sortable="col.sortable" @onSortChange="onSortChange"
            :sort="filter.sort" :name="col.value">{{ col.name }} </TableTHead>
        </tr>
      </template>
      <template #TableBody>
        <tr v-if="teacher_services.data.length == 0">
          <td class="align-middle" :colspan="columns.length">
            {{ __('no record found') }}
          </td>
        </tr>
        <tr v-for="service in teacher_services.data" :key="service.id">
          <td class="align-middle">{{ service.name }}</td>
          <td class="align-middle">
            <img v-if="service.image" :src="service.image" width="75" height="75" :alt="service.image" />
            <span v-else>-</span>
          </td>
          <td class="align-middle">{{ service.created_at }}</td>

          <td class="align-middle"><span v-if="service.is_active" class="badge bg-success">{{ __('active') }}</span>
            <span class="badge bg-danger" v-else> {{ __('inactive') }} </span></td>
          <td class="align-middle">
            <div class="d-flex justify-content-center">
                <button type="button" class="border-0  bg-transparent fs-3  text-primary lh-1 p-1 me-2" data-bs-toggle="modal"
                @click="modal_service = service" data-bs-target="#viewServiceModal">
                <i class="bi bi-eye-fill"></i>
              </button>
              <button type="button" class="border-0  bg-transparent  fs-3  lh-1 p-1 me-2" style="color: #E2AE28;" data-bs-toggle="modal"
                @click="modal_service = service;" data-bs-target="#addEditServiceModal">
                <i class="bi bi-pencil-square"></i>
              </button>
              <button type="button" class="border-0  bg-transparent  fs-3  lh-1 p-1" style="color: #FA6B6B;" data-bs-toggle="modal"
                @click="modal_service = service" data-bs-target="#deleteServiceModal">
                <i class="bi bi-trash3-fill"></i>
              </button>
            </div>
            <view-service-modal @clearModalData="clearModalData()" :modalData="modal_service"
              id="viewServiceModal"></view-service-modal>
            <delete-service-modal @refreshData="refreshData()" :modalData="modal_service"
              id="deleteServiceModal"></delete-service-modal>

          </td>
          <!-- Button trigger modal -->
        </tr>
      </template>
      <template #Pagination>
        <TablePagination @onPageChange="onPageChange" :meta="teacher_services.meta"></TablePagination>
      </template>
    </Table>
  </div>
</template>
<script>
import { defineComponent } from "vue";
import ValidationErrors from "@/Components/ValidationErrors.vue";
import AddEditServiceModal from "@/Components/Teachers/Services/AddEditServiceModal.vue";
import ViewServiceModal from "@/Components/Teachers/Services/ViewServiceModal.vue";
import DeleteServiceModal from "@/Components/Teachers/Services/DeleteServiceModal.vue";
import Table from "@/Components/Shared/DataTable/Table.vue";
import TableTHead from "@/Components/Shared/DataTable/TableTHead.vue";
import TablePagination from "@/Components/Shared/DataTable/TablePagination.vue";
import PaginationMixin from "@/Mixins/PaginationMixin.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import axios from "axios";

export default defineComponent({
  components: {
    Head,
    Link,
    AddEditServiceModal,
    Table,
    TableTHead,
    TablePagination,
    ViewServiceModal,
    DeleteServiceModal
  },
  props: ["active"],
  mixins: [PaginationMixin],
  data() {
    return {
      teacher_services: {},
      modal_service: null,
      key: 1,
      columns: [
        {
          "id": 1,
          'name': this.__('name'),
          'value': "name",
          'searchable': true,
          'sortable': true
        },
        {
          "id": 3,
          'name': this.__('image'),
          'value': "image",
          'searchable': false,
          'sortable': false
        },
        {
          "id": 4,
          'name': this.__('created at'),
          'value': "created_at",
          'searchable': false,
          'sortable': false
        },
        {
          "id": 5,
          'name': this.__('status'),
          'value': "status",
          'searchable': false,
          'sortable': false
        },
        {
          "id": 6,
          'name': this.__('action'),
          'value': "action",
          'searchable': false,
          'sortable': false
        }
      ],
      editorConfig: {
        toolbar: {
          items: [
            'bold',
            'italic',
            'link',
            'undo',
            'redo'
          ]
        }
      }
    };
  },
  mounted() {
    if (this.filter.column == '') {
      this.filter.column = 'name'
    }
    this.getPaginatedData()
  },
  methods: {
    async getPaginatedData(loading_more = false) {
      await this.getTeacherServices(loading_more)
    },
    clearModalData() {
      this.modal_service = null
      this.key++
    },
    getTeacherServices(loading_more) {
      axios.post(this.route('teachers.teacher_services.filter'), this.filter).then(res => {
        const data = res.data.data
        if (loading_more) {
          this.teacher_services.data = this.teacher_services.data.concat(data.data);
        } else {
          this.teacher_services.data = data.data;
        }
        this.teacher_services.links = data.links
        this.teacher_services.meta = data.meta
        this.fetching = false
      });
    },
  }
});
</script>
