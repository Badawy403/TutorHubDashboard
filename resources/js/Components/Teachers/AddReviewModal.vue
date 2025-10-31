<template>
    <Modal maxWidth="md" :id="id">
        <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="RatingModalLabel">{{ __('write a review') }}</h1>
                    <button type="button" :id="id+'close'" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="rating text-center fs-3 text-warning">
                        <star-rating v-model:rating="form.rating" :star-size="25" ></star-rating>
                    </div>
                    <div class="form-group">
                        <textarea v-model="form.comment" class="form-control" id="" cols="30" rows="3"></textarea>
                        <span v-if="form.errors.comment">
                            {{ form.errors.comment }}
                        </span>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-center">
                        <ul class="user-rating w-75">
                        <li>
                            <span class="me-3 w-50">{{ __('experience') }}</span>
                            <div class="rating">
                                <star-rating v-model:rating="form.experience" :star-size="25" ></star-rating>
                            </div>
                        </li>
                        <li>
                            <span class="me-3 w-50">{{ __('service') }}</span>
                            <div class="rating">
                                <star-rating v-model:rating="form.service" :star-size="25" ></star-rating>
                            </div>
                        </li>
                        <li>
                            <span class="me-3 w-50">{{ __('communication') }}</span>
                            <div class="rating">
                                <star-rating v-model:rating="form.communication" :star-size="25" ></star-rating>
                            </div>
                        </li>
                    </ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('close') }}</button>
                    <button @click="submit" type="button" class="btn btn-primary">{{ __('share your experience') }}</button>
                </div>
            </div>
    </Modal>

</template>
<script>
import { defineComponent } from "vue";
import { Link } from "@inertiajs/inertia-vue3";
import axios from "axios";
import Modal from "@/Components/Modal.vue";
export default defineComponent({
  components: {
    Link,
    Modal
  },
  created() {
  },
  props:['teacher_id'],
  data() {
    return {
        id:"RatingModal",
        form: this.$inertia.form({
            comment:"",
            rating:'',
            experience:"",
            communication:"",
            service:"",
            teacher_id:this.teacher_id
        }),
    }
  },
  methods: {
    close(){
            document.getElementById(this.id+'close').click()
        },
    resetForm(){
        this.form= this.$inertia.form({
            comment:"",
            rating:5,
            experience:5,
            communication:5,
            service:5,
            teacher_id:this.teacher_id
        })
    },
    submit(){
        this.form.post(this.route('students.add_teacher_review'), {
            preserveState: true,
            preserveScroll: true,
            onSuccess: () => {
                // this.$toast.show("Created Successfully")
                this.close()
                this.resetForm()
            },
        })
        },
  },
});
</script>

