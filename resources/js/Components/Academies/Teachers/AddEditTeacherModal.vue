<template>
    <div>
    <!-- Modal -->
    <Modal maxWidth="lg" :id="id">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ modalData ? __('update'):__('create') }} {{__('teacher')}}</h5>
                <button :id="id+'close'" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="category"
                                    >{{ __("choose") }}
                                    {{ __("category") }}</label
                                >
                                <Multiselect
                                    v-model="form.teacher_categories"
                                    valueProp="id"
                                    label="name"
                                    groupLabel="name"
                                    groupOptions="categories"
                                    :groupSelect="true"
                                    :groups="true"
                                    mode="tags"
                                    :close-on-select="false"
                                    :searchable="true"
                                    :options="this.teacher_categories"
                                />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="speciality">{{
                                    __("speciality")
                                }}</label>
                                <input
                                    v-model="form.speciality"
                                    class="w-100 form-control px-3"
                                    placeholder="Please Enter"
                                    type="text"
                                />
                            </div>
                        </div>
                        <div
                            class="col-md-6">
                        <div class="form-group mb-3">
                                <label for="experience">{{ __("choose") }} {{ __("experience") }}</label>
                            <Multiselect
                                v-model="form.experience"
                                :close-on-select="true"
                                :searchable="true"
                                :options="experienceOptions"
                                valueProp="value"
                                label="name"
                            />
                            </div>
                        </div>
                    <div class="col-6">
                        <div class="form-group mb-3">
                            <label for="first_name">{{__('first name')}}</label>
                            <input v-model="form.first_name"
                                class="w-100 form-control  px-3"
                                :class="{'is-invalid':form.errors.first_name}"
                                placeholder="Please Enter" type="text" />
                                <span v-if="form.errors.first_name">
                                    {{ form.errors.first_name }}
                                </span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group mb-3">
                            <label for="last_name">{{__('last name')}}</label>
                            <input v-model="form.last_name"
                                class="w-100 form-control  px-3"
                                :class="{'is-invalid':form.errors.last_name}"
                                placeholder="Please Enter" type="text" />
                                <span v-if="form.errors.last_name">
                                    {{ form.errors.last_name }}
                                </span>
                        </div>
                    </div>
                    <div class="col-6" v-if="!modalData">
                        <div class="form-group mb-3">
                            <label for="email">{{__('email')}}</label>
                            <input v-model="form.email"
                                class="w-100 form-control  px-3"
                                :class="{'is-invalid':form.errors.email}"
                                placeholder="Please Enter" type="text" />
                                <span v-if="form.errors.email">
                                    {{ form.errors.email }}
                                </span>
                        </div>
                    </div>
                    <div class="col-6" v-if="!modalData">
                        <div class="form-group mb-3">
                            <label for="username">{{__('user name')}}</label>
                            <input v-model="form.user_name"
                                class="w-100 form-control  px-3"
                                :class="{'is-invalid':form.errors.user_name}"
                                placeholder="Please Enter" type="text" />
                                <span v-if="form.errors.user_name">
                                    {{ form.errors.user_name }}
                                </span>
                        </div>
                    </div>
                    <div class="col-6" v-if="!modalData">
                        <div class="form-group mb-3">
                            <label for="password">{{__('Password')}}</label>
                            <input v-model="form.password"
                                class="w-100 form-control  px-3"
                                :class="{'is-invalid':form.errors.password}"
                                placeholder="Please Enter" type="password" />
                                <span v-if="form.errors.password">
                                    {{ form.errors.password }}
                                </span>
                        </div>
                    </div>
                </div>

<!--
                <div class="form-group mb-3">
                    <label for="description">{{__('description')}}</label>
                    <ckeditor :editor="editor" v-model="form.description" :config="editorConfig"></ckeditor>
                    <span v-if="form.errors.description">
                            {{ form.errors.description }}
                        </span>
                </div> -->
                <div v-if="modalData && modalData.image" class="form-group mb-3">
                    <label for="previous_image">{{__('previous image')}}</label>
                     <img width="250" height="250" v-if="modalData && modalData.image" class="img-fluid"
                                :src="modalData.image" alt="logo">
                      <span v-if="form.errors.image">
                            {{ form.errors.image }}
                        </span>
                </div>
                <div class="form-group mb-3">
                    <label for="image">{{__('image')}}</label>
                    <input id="academy-image" ref="formImage"  @change="onFileChange" type="file" />
                </div>
                <div>
                    <!-- Cropped image previewer -->
                        <ImageCropperModal :show="showImportModal" id="teacherImageCropModal" :image_url="image_url" @cropImage="cropImage" ></ImageCropperModal>
                        <img class="mx-auto m-2 w-50 bg-light" :src="croppedImageSrc" />
                    </div>
                <div class="form-check form-switch">
                  <input class="form-check-input" v-model="form.is_active" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                   <label class="form-check-label" for="flexSwitchCheckDefault">{{ __('active') }}?</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger text-white" data-bs-dismiss="modal">{{__('close')}}</button>
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
                teacher_categories: [],
                first_name:"",
                last_name:"",
                description:"",
                is_active:false,
                image:null,
                experience: "",
                speciality: "",
                email: "",
                user_name:"",
                password: "",
             }),
             teacher_categories:[],
            showImportModal:false,
            image_url: null,
            croppedImageSrc: null,
            experienceOptions:[],
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
    async created(){
        await this.getTeacherCategories();
        this.formExperienceOptions();
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
            this.form.post(this.route('academies.academy_teachers.store'), {
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
                })).post(this.route('academies.academy_teachers.update',{academy_teacher:this.modalData.id}), {
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
         async formExperienceOptions() {
            var options = [
                { value: "", name: this.__("choose") + this.__(" experience") },
            ];
            for (let i = 1; i < 40; i++) {
                if (i == 1) {
                    var obj = { value: i, name: i + " year" };
                }
                else
                {
                    var obj = { value: i, name: i + " years" };
                }
                options.push(obj);
            }
            this.experienceOptions = options;
        },
         async getTeacherCategories() {
          await axios.get(this.route("getApiTeacherMainCategories")).then((res) => {
            this.teacher_categories = res.data.data;
            if (this.teacher_categories.length > 0) {
                this.form.teacher_categories.push(
                    this.teacher_categories[0].id
                )
            }

          });
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
                first_name:"",
                last_name:"",
                is_active:false,
                image:null,
                experience: "",
                speciality: "",
                email: "",
                user_name:"",
                password: "",
                teacher_categories:[]
            })
            this.image_url = null
        }else{
            // set modal editable data
            this.form = this.$inertia.form(this.modalData)
            this.form.teacher_categories = this.modalData.teacher_category_ids
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
