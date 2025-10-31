<template>
    <div>
    <!-- Modal -->
    <Modal maxWidth="lg" :id="id">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('view') }} {{ __('certification') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table" v-if="modalData">
                    <tbody>
                        <tr>
                            <th>
                                {{ __('name') }}
                            </th>
                            <td>
                                {{ modalData.name }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ __('description') }}
                            </th>
                            <td v-html="modalData.description">
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ __('image') }}
                            </th>
                            <td v-if="modalData.image">
                                    <img :src="modalData.image" width="75" height="75"
                                        :alt="modalData.slug">
                                    &nbsp &nbsp
                            </td>
                            <td v-else>-</td>
                        </tr>
                        <tr>
                            <th>
                                {{ __('status') }}

                            </th>
                            <td>
                                <span class="badge bg-success" v-if="modalData.is_active">
                                    {{ __('active') }}
                                </span>
                                <span class="badge bg-danger" v-else>
                                {{ __('inactive') }}
                                </span>

                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ __('created at') }}

                            </th>
                            <td>
                                {{ modalData.created_at }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('close') }}</button>
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
    }
}
</script>
