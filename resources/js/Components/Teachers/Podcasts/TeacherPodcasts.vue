<template>
  <div
    class="tab-pane"
    :class="{ active: active }"
    id="podcasts"
    role="tabpanel"
    aria-labelledby="podcasts-tab"
    tabindex="0"
  >
    <Table v-if="!this.fetching">
      <template #TableHeaderTitle>{{__('all')}} {{ __n('podcast') }}</template>
      <template #TableHeaderButtons>
        <div class=" d-flex flex-column justify-content-md-end justify-content-start flex-md-row align-items-md-center mt-3 mt-md-0">

        <div class="form-group border rounded me-md-2 me-0 mb-2 mb-md-0">
            <select v-model="filter.column" class="form-select"
                aria-label="column">
                <option v-for="col in this.columns" :key="col.id" :value="col.value">{{
                    col.name
                }}</option>
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
        <button type="button" id="addEditPodcastModalButton"   class="btn btn-primary" data-bs-toggle="modal" @click="modal_podcast = null" data-bs-target="#addEditPodcastModal">
            <i class="bi bi-plus fs-4"></i> {{__('Add New')}}
        </button>
        <add-edit-podcast-modal :key="key" @refreshData="refreshData()" @clearModalData="clearModalData()" :modalData="modal_podcast" id="addEditPodcastModal"></add-edit-podcast-modal>
      </div>
      </template>
      <template #TableTheadRow>
        <tr>
          <TableTHead v-for="col in this.columns" :key="col.id" :sortable="col.sortable" @onSortChange="onSortChange" :sort="filter.sort" :name="col.value">{{ col.name }} </TableTHead>
        </tr>
      </template>
      <template #TableBody>
        <tr v-if="teacher_podcasts.data.length == 0">
            <td class="align-middle" :colspan="columns.length">
                {{ __('no record found') }}
            </td>
        </tr>
        <tr v-for="podcast in teacher_podcasts.data" :key="podcast.id">
          <td class="align-middle">{{ podcast.name }}</td>
          <td class="align-middle">
            <img v-if="podcast.image" :src="podcast.image" width="75" height="75" :alt="podcast.image" />
            <span v-else>-</span>
          </td>
          <td class="align-middle">{{ podcast.created_at }}</td>

          <td class="align-middle"><span v-if="podcast.is_active" class="badge bg-active rounded-pill px-3">{{ __('active') }}</span> <span class="badge bg-inactive rounded-pill px-3" v-else> {{ __('inactive') }} </span></td>
          <td class="align-middle">
            <div class="d-flex justify-content-center">
            <button type="button" class="border-0  bg-transparent fs-3  text-primary lh-1 p-1 me-2" data-bs-toggle="modal" @click="modal_podcast = podcast" data-bs-target="#viewPodcastModal">
              <i class="bi bi-eye-fill"></i>
            </button>
            <button type="button" class="border-0  bg-transparent  fs-3  lh-1 p-1 me-2" style="color: #E2AE28;" data-bs-toggle="modal" @click="modal_podcast = podcast;" data-bs-target="#addEditPodcastModal">
              <i class="bi bi-pencil-square"></i>
            </button>
            <button type="button" class="border-0  bg-transparent  fs-3  lh-1 p-1" style="color: #FA6B6B;" data-bs-toggle="modal" @click="modal_podcast = podcast" data-bs-target="#deletePodcastModal">
              <i class="bi bi-trash3-fill"></i>
            </button>
            </div>
            <view-podcast-modal @clearModalData="clearModalData()" :modalData="modal_podcast" id="viewPodcastModal"></view-podcast-modal>
            <delete-podcast-modal @refreshData="refreshData()" :modalData="modal_podcast" id="deletePodcastModal"></delete-podcast-modal>

         </td>
          <!-- Button trigger modal -->
        </tr>
      </template>
      <template #Pagination>
        <TablePagination @onPageChange="onPageChange" :meta="teacher_podcasts.meta"></TablePagination>
      </template>
    </Table>
  </div>
</template>
<script>
import { defineComponent } from "vue";
import ValidationErrors from "@/Components/ValidationErrors.vue";
import AddEditPodcastModal from "@/Components/Teachers/Podcasts/AddEditPodcastModal.vue";
import ViewPodcastModal from "@/Components/Teachers/Podcasts/ViewPodcastModal.vue";
import DeletePodcastModal from "@/Components/Teachers/Podcasts/DeletePodcastModal.vue";
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
    AddEditPodcastModal,
    Table,
    TableTHead,
    TablePagination,
    ViewPodcastModal,
    DeletePodcastModal
  },
  props: ["active"],
  mixins: [PaginationMixin],
  data() {
    return {
        teacher_podcasts:{},
        modal_podcast:null,
        key:1,
        columns:[
            {
                "id":1,
                'name': this.__('name') ,
                'value':"name",
                'searchable':true,
                'sortable':true
            },
            {
                "id":3,
                'name':this.__('image'),
                'value':"image",
                'searchable':false,
                'sortable':false
            },
            {
                "id":4,
                'name':this.__('created at'),
                'value':"created_at",
                'searchable':false,
                'sortable':false
            },
            {
                "id":5,
                'name':this.__('status'),
                'value':"status",
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
      if(this.filter.column == ''){
          this.filter.column = 'name'
      }
    this.getPaginatedData()
  },
  methods: {
    async getPaginatedData(loading_more = false){
        await this.getTeacherPodcasts(loading_more)
     },
     clearModalData(){
        this.modal_podcast = null
        this.key++
     },
    getTeacherPodcasts(loading_more){
    axios.post(this.route('teachers.teacher_podcasts.filter'),this.filter).then(res => {
        const data = res.data.data
        if(loading_more){
            this.teacher_podcasts.data = this.teacher_podcasts.data.concat(data.data);
        }else{
            this.teacher_podcasts.data = data.data;
        }
        this.teacher_podcasts.links = data.links
        this.teacher_podcasts.meta = data.meta
        this.fetching = false
    });
    },
  }
});
</script>
