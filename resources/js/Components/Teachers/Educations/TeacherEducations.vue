<template>
  <div
    class="tab-pane"
    :class="{ active: active }"
    id="educations"
    role="tabpanel"
    aria-labelledby="educations-tab"
    tabindex="0"
  >
    <Table v-if="!this.fetching">
      <template #TableHeaderTitle>{{__('all')}} {{ __n('education') }}</template>
      <template #TableHeaderButtons>
        <div class="d-flex align-items-center">

        <div class="form-group me-2">
            <select v-model="filter.column" class="form-select h-auto"
                aria-label="column">
                <option value="">{{__('select column')}}</option>
                <option v-for="col in this.columns" :key="col.id" :value="col.value">
                {{col.name}}</option>
            </select>
        </div>

        <div class="from-group me-2 position-relative">
            <input v-model="filter.search"
            class=" form-control  px-3"
            placeholder="Search" type="text" />
           <span class="position-absolute" style="top: 4px;
           right: 0px;"><button type="button" class="btn border-0 me-2" @click="getPaginatedData(false)">
            <i class="bi bi-search"></i>
          </button></span>
          </div>
        <button type="button" id="addEditEducationModalButton"   class="btn btn-primary" data-bs-toggle="modal" @click="modal_education = null" data-bs-target="#addEditEducationModal">
            {{__('add')}}
        </button>
        <add-edit-education-modal :key="key" @refreshData="refreshData()" @clearModalData="clearModalData()" :modalData="modal_education" id="addEditEducationModal"></add-edit-education-modal>
      </div>
      </template>
      <template #TableTheadRow>
        <tr>
          <TableTHead v-for="col in this.columns" :key="col.id" :sortable="col.sortable" @onSortChange="onSortChange" :sort="filter.sort" :name="col.value">{{ col.name }} </TableTHead>
        </tr>
      </template>
      <template #TableBody>
        <tr v-if="teacher_educations.data.length == 0">
            <td class="align-middle" :colspan="columns.length">
                {{ __('no record found') }}
            </td>
        </tr>
        <tr v-for="education in teacher_educations.data" :key="education.id">
          <td class="align-middle">{{ education.institute }}</td>
          <td class="align-middle">{{ education.degree }}</td>
          <td class="align-middle">{{ education.subject }}</td>
          <!-- <td class="align-middle">{{ education.from }}</td>
          <td class="align-middle">{{ education.to }}</td> -->
          <td class="align-middle">
              <a v-if="education.image" target="_blank" :href="education.image">{{ __('download') }}</a>
<!--            <img v-if="education.image" :src="education.image" width="75" height="75" :alt="education.image" />-->
            <span v-else>-</span>
          </td>
          <td class="align-middle"><span v-if="education.is_active" class="badge bg-success">{{ __('active') }}</span> <span class="badge bg-danger" v-else> {{ __('inactive') }} </span></td>
          <td class="align-middle">
            <div class="d-flex">
            <button type="button" class="btn btn-link px-1 lh-1 py-1 me-2" data-bs-toggle="modal" @click="modal_education = education" data-bs-target="#viewEducationModal">
              <i class="bi bi-eye-fill"></i>
            </button>
            <button type="button" class="btn btn-link px-1 lh-1 py-1 me-2" data-bs-toggle="modal" @click="modal_education = education;" data-bs-target="#addEditEducationModal">
              <i class="bi bi-pencil-square"></i>
            </button>
            <button type="button" class="btn btn-link text-danger px-1 lh-1 py-1 " data-bs-toggle="modal" @click="modal_education = education" data-bs-target="#deleteEducationModal">
              <i class="bi bi-trash3-fill"></i>
            </button>
            </div>
            <view-education-modal :modalData="modal_education" id="viewEducationModal"></view-education-modal>
            <delete-education-modal @refreshData="refreshData()" :modalData="modal_education" id="deleteEducationModal"></delete-education-modal>

         </td>
          <!-- Button trigger modal -->
        </tr>
      </template>
      <template #Pagination>
        <TablePagination @onPageChange="onPageChange" :meta="teacher_educations.meta"></TablePagination>
      </template>
    </Table>
  </div>
</template>
<script>
import { defineComponent } from "vue";
import ValidationErrors from "@/Components/ValidationErrors.vue";
import AddEditEducationModal from "@/Components/Teachers/Educations/AddEditEducationModal.vue";
import ViewEducationModal from "@/Components/Teachers/Educations/ViewEducationModal.vue";
import DeleteEducationModal from "@/Components/Teachers/Educations/DeleteEducationModal.vue";
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
    AddEditEducationModal,
    Table,
    TableTHead,
    TablePagination,
    ViewEducationModal,
    DeleteEducationModal
  },
  props: ["active"],
  mixins: [PaginationMixin],
  data() {
    return {
        teacher_educations:{},
        modal_education:null,
        key:1,
        columns:[
            {
                "id":1,
                'name': this.__('institute') ,
                'value':"institute",
                'searchable':true,
                'sortable':true
            },
            {
                "id":2,
                'name':this.__('degree'),
                'value':"degree",
                'searchable':true,
                'sortable':true
            },
            {
                "id":3,
                'name':this.__('subject'),
                'value':"subject",
                'searchable':true,
                'sortable':true
            },
            {
                "id":4,
                'name':this.__('attachment'),
                'value':"image",
                'searchable':false,
                'sortable':false
            },
            {
                "id":5,
                'name':this.__('status'),
                'value':"is_active",
                'searchable':false,
                'sortable':false
            },
            {
                "id":6,
                'name':this.__('action'),
                'value':"action",
                'searchable':false,
                'sortable':false
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
  mounted(){
    this.getPaginatedData()
  },
  methods: {
    async getPaginatedData(loading_more = false){
        await this.getTeacherEducations(loading_more)
     },
     clearModalData(){
        this.modal_education = null
        this.key++
     },
    getTeacherEducations(loading_more){
    axios.post(this.route('teachers.teacher_educations.filter'),this.filter).then(res => {
        const data = res.data.data
        if(loading_more){
            this.teacher_educations.data = this.teacher_educations.data.concat(data.data);
        }else{
            this.teacher_educations.data = data.data;
        }
        this.teacher_educations.links = data.links
        this.teacher_educations.meta = data.meta
        this.fetching = false
    });
    },
  }
});
</script>
