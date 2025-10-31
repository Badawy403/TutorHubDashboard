<template>
    <div>
        <!-- Modal -->
        <Modal maxWidth="lg" :id="id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ modalData ? __('update') : __('create') }}
                        {{ __('service') }}</h5>
                    <button :id="id + 'close'" type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul class="nav modal-tabs nav-tabs gap-3 px-3 border-bottom border-primary border-2 border-opacity-25 my-2" id="myTab" role="tablist">
                        <li v-for="(lang, index) in $page.props.translation_languages" :key="lang.id"
                        class="nav-item nav-tab" role="presentation">
                            <button :class="{ 'active': index == 0 }" class="nav-link mr-1 fw-bold"
                                :id="`nav-services-${lang.code}-tab`" data-bs-toggle="tab"
                                :data-bs-target="`#nav-services-${lang.code}`" type="button" role="tab"
                                :aria-controls="`nav-${lang.code}`" aria-selected="true">{{ lang.name }}</button>
                        </li>
                    </ul>
                    <div class="row mt-4">

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="mb-2 fs-4" for="category">{{ __('choose') }} {{ __('category') }}</label>
                                <select v-model="form.service_category_id" class="form-select" aria-label="category">
                                    <option value="">{{ __('select') }}</option>
                                    <option v-for="cat in this.service_categories" :key="cat.id" :value="cat.id">{{ cat.name }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="mb-2 fs-4" for="name">{{ __('price') }}</label>
                                <input v-model="form.price" class="w-100 form-control  px-3"
                                    :class="{ 'is-invalid': form.errors.price }" :placeholder="__('Please Enter')"
                                    type="number" />
                                <span v-if="form.errors.price">
                                    {{ form.errors.price }}
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="mb-2 fs-4" for="tag">{{ __('choose') }} {{ __('tag') }}</label>
                                <Multiselect v-model="form.tag_ids" valueProp="id" label="name" placeholder="Select Tags" mode="tags"
                                    :close-on-select="false" :searchable="false" :create-option="true"
                                    :options="this.tags" />
                            </div>
                        </div>

                        <div v-if="modalData && modalData.image" class="form-group mb-3">
                            <label class="mb-2 fs-4" for="previous_image">{{ __('previous image') }}</label>
                            <img width="250" height="250" v-if="modalData && modalData.image" class="img-fluid"
                                :src="modalData.image" alt="logo">
                            <span v-if="form.errors.image">
                                {{ form.errors.image }}
                            </span>
                        </div>

                        <div class="form-group mb-3">
                            <label class="mb-2 fs-4" for="image">{{ __('image') }}</label>
                            <input id="teacher-image" class="w-100 custom-file-input" ref="formImage"
                                @change="onFileChange" type="file" />
                            <div>
                                <!-- Cropped image previewer -->
                                <ImageCropperModal :show="showImportModal" id="serviceImageCropModal"
                                    :image_url="image_url" @cropImage="cropImage"></ImageCropperModal>
                                <img class="mx-auto m-2 w-50 bg-light" :src="croppedImageSrc" />
                            </div>
                        </div>

                        <div class="form-group">
                            <div v-for="(lang, secondIndex) in $page.props.translation_languages" :key="lang.id"
                            class="tab-content " id="myTabContent">
                                <div :class="{ 'show active': secondIndex == 0 }" class="tab-pane fade mb-2"
                                    :id="`nav-services-${lang.code}`" role="tabpanel"
                                    :aria-labelledby="`nav-${lang.code}-tab`">
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label class="mb-2 fs-4" for="name">{{ __('name') }} ({{ lang.code }})</label>
                                            <input v-model="form.name[lang.code]" class="w-100 form-control  px-3"
                                                :class="{ 'is-invalid': form.errors[`name.${lang.code}`] }"
                                                :placeholder="__('Please Enter')" type="text" />
                                            <span v-if="form.errors[`name.${lang.code}`]">
                                                {{ form.errors[`name.${lang.code}`] }}
                                            </span>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="mb-2 fs-4" for="description">{{ __('description') }} ({{ lang.code }})</label>
                                            <textarea placeholder="Enter text here..." :class="{ 'is-invalid': form.errors[`description.${lang.code}`] }"
                                                v-model="form.description[lang.code]" class="form-control"></textarea>
                                            <!-- <ckeditor :editor="editor" v-model="form.description" :config="editorConfig"></ckeditor> -->
                                            <span v-if="form.errors[`description.${lang.code}`]">

                                                {{ form.errors[`description.${lang.code}`] }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <button type="button" class="btn btn-dark btn-sm" @click="addFaq">Add FAQ</button>
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Question</th>
                                                        <th scope="col">Answer</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr style="vertical-align: middle;" v-for="(faq, i) in form.faqs" :key="i">
                                                        <th scope="row">{{+ + i }}</th>
                                                        <td>
                                                            <input v-model="faq.question[lang.code]"
                                                                class="w-100 form-control  px-3"
                                                                :class="{ 'is-invalid': form.errors[`faqs.${i}.question.${lang.code}`] }"
                                                                :placeholder="__('Please Enter')" type="text" />
                                                        </td>
                                                        <td> <input v-model="faq.answer[lang.code]"
                                                                class="w-100 form-control  px-3"
                                                                :class="{ 'is-invalid': form.errors[`faqs.${i}.answer.${lang.code}`] }"
                                                                :placeholder="__('Please Enter')" type="text" />
                                                        </td>
                                                        <td> <button class="btn btn-outline-danger"
                                                                @click="removeFaq(i)">delete</button> </td>
                                                    </tr>
                                                    <tr v-if="form.faqs.length == 0">
                                                        <th scope="row">1</th>
                                                        <td colspan="3"> No FAQs</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="form-group mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" v-model="form.is_active" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                                <label class="form-check-label" for="flexSwitchCheckDefault">{{ __('active') }}?</label>
                            </div>
                        </div>


                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal"> {{ __("Cancel") }}</button>
                    <button :class="{ 'text-white-50': form.processing }" :disabled="form.processing" type="button"
                        class="btn btn-primary" @click="modalData ? update() : create()">
                        <div v-show="form.processing" class="spinner-border spinner-border-sm">
                            <span class="visually-hidden">{{ __('loading') }}...</span>
                        </div>
                        <span v-if="modalData">
                            {{ __('save changes') }}
                        </span>
                        <span v-else>
                            {{ __('create') }}
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
// import ClassicEditor from '@ckeditor/ckeditor5-editor-classic/src/classiceditor';
import ImageCropperModal from "@/Components//Shared/ImageCropperModal.vue";
import Multiselect from '@vueform/multiselect'


export default defineComponent({
    components: {
        Modal,
        // ClassicEditor,
        ImageCropperModal,
        Multiselect
    },
    data() {
        return {
            form: this.$inertia.form({
                name: {},
                description: {},
                is_active: false,
                image: null,
                price: null,
                tag_ids: [],
                service_category_id: '',
                faqs: []
            }),
            service_categories: this.$page.props.service_categories,
            tags: this.$page.props.tags,
            showImportModal: false,
            image_url: null,
            croppedImageSrc: null,
            // editor:ClassicEditor,
            editorConfig: {
                toolbar: {
                    items: ['heading', 'bold', 'italic', 'link', 'numberedList', 'bulletedList', 'undo', 'redo']
                }
            },
        }
    },
    props: {
        id: {
            type: String,
            required: true
        },
        modalData: {
        },
    },
    mounted() {

    },
    methods: {
        addFaq() {
            this.form.faqs.push({
                'question': {},
                'answer': {}
            })
            console.log(this.form.faqs)
        },
        removeFaq(i) {
            this.form.faqs.splice(i - 1, 1)
            console.log(i)
        },
        onFileChange(e) {
            this.image_url = null
            const file = e.target.files[0];
            this.image_url = URL.createObjectURL(file);
            this.croppedImageSrc = null
            this.showImportModal = true
        },
        onServiceFileChange(e, type) {
            const file = e.target.files[0];
            this.form[type] = file;
        },
        cropImage(image) {
            this.croppedImageSrc = image
            this.form.image = image
            this.image_url = null
            this.showImportModal = false
        },

        close() {
            document.getElementById(this.id + 'close').click()
        },
        computed: {
        },
        create() {
            this.form.post(this.route('teachers.teacher_services.store'), {
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
        update() {
            this.form.transform((data) => ({
                ...data,
                _method: "PUT",
            })).post(this.route('teachers.teacher_services.update', { teacher_service: this.modalData.id }), {
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
                if (!this.modalData) {
                    // set defaults
                    this.form = this.$inertia.form({
                        name: {},
                        description: {},
                        is_active: false,
                        image: null,
                        price: null,
                        tag_ids: [],
                        faqs: []
                    })
                    this.image_url = null
                } else {
                    // set modal editable data
                    this.form = this.$inertia.form(this.modalData)
                    this.form.faqs = this.modalData.faqs.map((faq) => {
                        return { question: faq.question_translations, answer: faq.answer_translations };
                    })
                    this.form.image = null
                    this.form.name = this.modalData.name_translations
                    this.form.description = this.modalData.description_translations
                    this.form.price = this.modalData.price
                    if (this.form.is_active) {
                        this.form.is_active = true
                    } else {
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
