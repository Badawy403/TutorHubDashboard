<template>
    <div>
    <!-- Modal -->
    <Modal maxWidth="lg" :id="id">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title ms-2 text-primary fs-2 fw-bold" id="exampleModalLabel">{{ modalData ? __('update'):__('create') }} {{__('certification')}}</h5>
                <button :id="id+'close'" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <validation-errors></validation-errors>
                <div class="form-group mb-3">
                    <label class="mb-2 fs-4" for="name">{{__('name')}}</label>
                    <input v-model="form.name"
                        class="w-100 rounded-3 form-control px-3"
                        :class="{'is-invalid':form.errors.name}"
                        :placeholder="__('Type Here')" type="text" />
                        <span v-if="form.errors.name">
                            {{ form.errors.name }}
                        </span>
                </div>

                <div class="form-group mb-3">
                    <label class="mb-2 fs-4" for="description">{{__('description')}}</label>
                    <ckeditor :editor="editor" v-model="form.description" :config="editorConfig"></ckeditor>
                    <span v-if="form.errors.description">
                            {{ form.errors.description }}
                        </span>
                </div>
                <div v-if="modalData && modalData.image" class="form-group mb-3">
                    <label for="previous_image">{{__('previous image')}}</label>
                     <img width="250" height="250" v-if="modalData && modalData.image" class="img-fluid"
                                :src="modalData.image" alt="logo">
                      <span v-if="form.errors.image">
                            {{ form.errors.image }}
                        </span>
                </div>
                <div class="file-select p-2">
                    <div class="form-group mb-0">
                        <label for="teacher-image" class="btn btn-secondary text-white px-5">{{ __("Select a File") }}</label>
                        <input id="teacher-image" style="display: none;"  ref="formImage" type="file" @change="onFileChange">
                    <!-- <label for="image">{{__('Select a File')}}</label>
                    <input id="teacher-image" ref="formImage" class="w-100 custom-file-input shadow-none"  @change="onFileChange" type="file"/> -->
                    </div>
                    <div class="form-group me-3">
                    <label style="font-size: 14px;" for="info">{{__('certificate file validation')}}</label>
                    </div>
                </div>

                <!-- <div class="form-group mb-3">
                    <label for="image">{{__('image')}}</label>
                    <input id="academy-image" ref="formImage" class="custom-file-input w-100"  @change="onFileChange" type="file" />
                </div> -->
                    <div>
                    <!-- Cropped image previewer -->
                        <ImageCropperModal :show="showImportModal" id="certificationImageCropModal" :image_url="image_url" @cropImage="cropImage" ></ImageCropperModal>
                        <img class="mx-auto m-2 w-50 bg-light" :src="croppedImageSrc" />
                    </div>
                <div class="form-check form-switch">
                  <input class="form-check-input" v-model="form.is_active" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                   <label class="form-check-label" for="flexSwitchCheckDefault">{{ __('active') }}?</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">{{__('Cancel')}}</button>
                <button :class="{ 'text-white-50': form.processing }" :disabled="form.processing" type="button" class="btn btn-primary" @click="modalData ? update():create()">
                    <div v-show="form.processing" class="spinner-border spinner-border-sm">
                     <span class="visually-hidden">{{ __('loading') }}...</span>
                    </div>
                    <span v-if="modalData">
                    {{__('save changes') }}
                    </span>
                    <span v-else>
                    {{__('create') }}
                    </span>
                </button>
            </div>
            </div>
        </Modal>
    </div>
</template>
<script>
import Modal from "@/Components/Modal.vue";
import { defineComponent } from "vue";
import CKEditor from '@ckeditor/ckeditor5-vue'
import ClassicEditor from '@ckeditor/ckeditor5-build-classic'
import ImageCropperModal from "@/Components//Shared/ImageCropperModal.vue";
import Multiselect from '@vueform/multiselect'


export default defineComponent({
    components: {
        Modal,
        ckeditor: CKEditor.component,
        ClassicEditor,
        ImageCropperModal,
        Multiselect
    },
    data(){
        return {
            form: this.$inertia.form({
                name:"",
                description:"",
                is_active:false,
                image:null,
             }),
            showImportModal:false,
            image_url: null,
            croppedImageSrc: null,
            editor:ClassicEditor,
            editorConfig: {
                toolbar: {
                  items: ['heading','bold','italic','link','numberedList','bulletedList','undo','redo']
                  }
                },
        }
    },
    props: {
      id: {
        type: String,
        required: true
      },
      modalData:{
      },
    },
    mounted(){

    },
    methods:{
        onFileChange(e) {
            this.image_url = null
            const file = e.target.files[0];
            this.image_url = URL.createObjectURL(file);
            this.croppedImageSrc = null
            this.showImportModal = true
        },

        cropImage(image){
            this.croppedImageSrc = image
            this.form.image = image
            this.image_url = null
            this.showImportModal = false
        },

        close(){
            document.getElementById(this.id+'close').click()
        },
        computed: {
        },
        create(){
            this.form.post(this.route('academies.academy_certifications.store'), {
                preserveState: true,
                preserveScroll: true,
                onSuccess: () => {
                    this.$toast.show("Created Successfully")
                    this.$emit('refreshData')
                    this.$emit('clearModalData')
                    this.close()
                },
            })
        },
        update(){
            this.form.transform((data) => ({
                    ...data,
                    _method: "PUT",
                })).post(this.route('academies.academy_certifications.update',{academy_certification:this.modalData.id}), {
                preserveState: true,
                preserveScroll: true,
                onSuccess: () => {
                    this.$toast.show("Updated Successfully")
                    this.$emit('refreshData')
                    this.$emit('clearModalData')
                    this.close()
                },
            })
         },
    },
    watch: {
    modalData: {
      handler() {
        this.form = null
        this.croppedImageSrc = null
        this.$refs.formImage.value = null;
        if(!this.modalData){
            // set defaults
            this.form = this.$inertia.form({
                name:"",
                description:"",
                is_active:false,
                image:null,
            })
            this.image_url = null
        }else{
            // set modal editable data
            this.form = this.$inertia.form(this.modalData)
            this.form.image = null
            if(this.form.is_active){
                this.form.is_active = true
            }else{
                this.form.is_active = false
            }
            this.image_url = null
        }
      },
      deep: true,
    }
},
})
</script>
