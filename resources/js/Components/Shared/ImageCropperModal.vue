<template>
      <teleport to="body">
    <div class="modal fade" :class="{show:show}" :style="{'display':show ? 'block':'none'}" data-bs-backdrop="static" tabindex="-1" :id="id" :aria-labelledby="id" aria-hidden="true">
      <div class="modal-dialog" :class="maxWidthClass">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">{{ __('crop image') }}</h5>
                    <button @click="close()"  type="button" :id="id+'close'" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <vue-cropper
                        :aspectRatio="aspectRatio"
                        :initialAspectRatio="aspectRatio"
                        :key="key"
                        class="mr-2"
                        ref="cropper"
                        :minContainerWidth="minContainerWidth"
                        :minContainerHeight="minContainerHeight"
                        :guides="true"
                        :src="image_url"
                    ></vue-cropper>
                     <!-- <img v-if="image_url && croppedImageSrc" class="img-fluid" :src="image_url" alt="logo"> -->
                </div>
                <div class="modal-footer">
                    <button type="button" @click="close" class="btn btn-secondary" data-bs-dismiss="modal">{{__('cancel')}}</button>
                    <button type="button" @click="cropImage()" class="btn btn-primary" id="crop">{{__('crop')}}</button>
                </div>
            </div>

    </div>
        </div>
  </teleport>
</template>
<script>
  import { defineComponent } from 'vue'
  import VueCropper from 'vue-cropperjs';
  import 'cropperjs/dist/cropper.css';
  export default defineComponent({
    components:{
        VueCropper
    },
    data(){
        return {
            croppedImageSrc:null,
            key:1
        }
    },
    props: {
      id: {
        type: String,
        required: true
      },
      aspectRatio:{
        default:1/1
      },
      maxWidth: {
        default: 'lg'
      },
      backdrop:{
        default:null
      },
      show:{},
      heading: {
        type: String
      },
      minContainerWidth:{
        default: "500px"
      },
      minContainerHeight:{
        default: "250px"
      },
      image_url:{}
    },
    methods:{
        cropImage() {
            // Get image data for post processing, e.g. upload or setting image src
            this.croppedImageSrc = this.$refs.cropper.getCroppedCanvas().toDataURL()
            this.$emit('cropImage',this.croppedImageSrc)
            this.close()
        },
        close(){
            this.croppedImageSrc = this.$refs.cropper.getCroppedCanvas().toDataURL()
            this.$emit('cropImage',this.croppedImageSrc)
            document.getElementById(this.id+'close').click()
        },
    },
    computed: {
      maxWidthClass() {
        return {
          'sm': 'modal-sm',
          'md': null,
          'lg': 'modal-lg',
          'xl': 'modal-xl',
        }[this.maxWidth]
      }
    },
    watch: {
        image_url: function(newVal, oldVal) { // watch it
            this.key = this.key+1
            this.$refs.cropper.replace(newVal)
            this.$refs.cropper.reset()
        }
      }
  })
</script>
