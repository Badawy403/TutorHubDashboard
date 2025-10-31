<template>
    <div>
    <!-- Modal -->
    <Modal maxWidth="lg" :id="id">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('delete') }} {{ __('podcast') }}</h5>
                <button :id="id+'close'" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p v-if="modalData">
                    {{ __('this action is irreversible') }}
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('close') }}</button>
                <button @click="remove()" type="button" class="btn btn-danger" >{{ __('delete') }}</button>
            </div>
            </div>
        </Modal>
    </div>
</template>
<script>
import Modal from "@/Components/Modal.vue";

export default {
    components: {
    Modal,
    },
    props: {
      id: {
        type: String,
        required: true
      },
      modalData:{
      },
    },
    data(){
        return {
            form: this.$inertia.form({
             }),
        }
    },
    methods:{
        remove(){
            this.form.delete(this.route('teachers.teacher_podcasts.destroy',this.modalData.id), {
                preserveState: true,
                preserveScroll: true,
                onSuccess: () => {
                    this.$toast.show("Deleted Successfully")
                    this.$emit('refreshData')
                    this.close()
                },
            })


        },
        close(){
            document.getElementById(this.id+'close').click()
        },
    }
}
</script>
