<template>
  <div
    class="tab-pane"
    :class="{ active: active }"
    id="experiences"
    role="tabpanel"
    aria-labelledby="experiences-tab"
    tabindex="0"
  >
    <Table v-if="!this.fetching">
      <template #TableHeaderTitle>{{__('all')}} {{ __n('experience') }}</template>
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


        <button type="button" id="addEditExperienceModalButton"   class="btn btn-primary h-100" data-bs-toggle="modal" @click="modal_experience = null" data-bs-target="#addEditExperienceModal">
            {{__('add')}}
        </button>
        <add-edit-experience-modal :key="key" @refreshData="refreshData()" @clearModalData="clearModalData()" :modalData="modal_experience" id="addEditExperienceModal"></add-edit-experience-modal>
      </div>
      </template>
      <template #TableTheadRow>
        <tr>
          <TableTHead v-for="col in this.columns" :key="col.id" :sortable="col.sortable" @onSortChange="onSortChange" :sort="filter.sort" :name="col.value">{{ col.name }} </TableTHead>
        </tr>
      </template>
      <template #TableBody>
        <tr v-if="teacher_experiences.data.length == 0">
            <td class="align-middle" :colspan="columns.length">
                {{ __('no record found') }}
            </td>
        </tr>
        <tr v-for="experience in teacher_experiences.data" :key="experience.id">
          <td class="align-middle">{{ experience.company }}</td>
          <td class="align-middle">{{ experience.from }}</td>
          <td class="align-middle">{{ experience.to }}</td>
          <td class="align-middle">
              <a v-if="experience.image" target="_blank" :href="experience.image">{{ __('download') }}</a>
<!--            <img v-if="experience.image" :src="experience.image" width="75" height="75" :alt="experience.image" />-->
            <span v-else>-</span>
          </td>
          <td class="align-middle"><span v-if="experience.is_active" class="badge bg-success">{{ __('active') }}</span> <span class="badge bg-danger" v-else> {{ __('inactive') }} </span></td>
          <td class="align-middle">
            <div class="d-flex">
            <button type="button" class="btn btn-link px-1 lh-1 py-1 me-2" data-bs-toggle="modal" @click="modal_experience = experience" data-bs-target="#viewExperienceModal">
              <i class="bi bi-eye-fill"></i>
            </button>
            <button type="button" class="btn btn-link px-1 lh-1 py-1 me-2" data-bs-toggle="modal" @click="modal_experience = experience;" data-bs-target="#addEditExperienceModal">
              <i class="bi bi-pencil-square"></i>
            </button>
            <button type="button" class="btn btn-link text-danger px-1 lh-1 py-1 " data-bs-toggle="modal" @click="modal_experience = experience" data-bs-target="#deleteExperienceModal">
              <i class="bi bi-trash3-fill"></i>
            </button>
            </div>
            <view-experience-modal :modalData="modal_experience" id="viewExperienceModal"></view-experience-modal>
            <delete-experience-modal @refreshData="refreshData()" :modalData="modal_experience" id="deleteExperienceModal"></delete-experience-modal>

         </td>
          <!-- Button trigger modal -->
        </tr>
      </template>
      <template #Pagination>
        <TablePagination @onPageChange="onPageChange" :meta="teacher_experiences.meta"></TablePagination>
      </template>
    </Table>
  </div>
</template>
<script>
import { defineComponent } from "vue";
import ValidationErrors from "@/Components/ValidationErrors.vue";
import AddEditExperienceModal from "@/Components/Teachers/Experiences/AddEditExperienceModal.vue";
import ViewExperienceModal from "@/Components/Teachers/Experiences/ViewExperienceModal.vue";
import DeleteExperienceModal from "@/Components/Teachers/Experiences/DeleteExperienceModal.vue";
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
    AddEditExperienceModal,
    Table,
    TableTHead,
    TablePagination,
    ViewExperienceModal,
    DeleteExperienceModal
  },
  props: ["active"],
  mixins: [PaginationMixin],
  data() {
    return {
        teacher_experiences:{},
        modal_experience:null,
        key:1,
        columns:[
            {
                "id":1,
                'name': this.__('company') ,
                'value':"company",
                'searchable':true,
                'sortable':true
            },
            {
                "id":2,
                'name':this.__('from'),
                'value':"from",
                'searchable':true,
                'sortable':true
            },
            {
                "id":3,
                'name':this.__('to'),
                'value':"to",
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
        await this.getTeacherExperiences(loading_more)
     },
     clearModalData(){
        this.modal_experience = null
        this.key++
     },
    getTeacherExperiences(loading_more){
    axios.post(this.route('teachers.teacher_experiences.filter'),this.filter).then(res => {
        const data = res.data.data
        if(loading_more){
            this.teacher_experiences.data = this.teacher_experiences.data.concat(data.data);
        }else{
            this.teacher_experiences.data = data.data;
        }
        this.teacher_experiences.links = data.links
        this.teacher_experiences.meta = data.meta
        this.fetching = false
    });
    },
  }
});
</script>
