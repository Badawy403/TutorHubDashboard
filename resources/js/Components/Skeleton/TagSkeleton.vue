<template>
    <div :class="{ 'col-md-3 col-healer': add_col, 'w-100': !add_col }" class="skeleton-structure">
        <div class="simple-card item-h card-healer border-0">
            <div class="card-body p-0">
                <div class="d-flex card-avatar overflow-hidden position-relative" style="border-radius: 200px 200px 0 0;">
                <div class="img"></div>
                </div>
                <div class="description m-0 p-3">
                    <div class="line line-1"></div>
                    <div class="line line-2"></div>
                    <div class="line line-3"></div>
                </div>
            </div>

            <!-- <div class="stars">
                <div class="btn btn-1"></div>
                <div class="btn btn-2"></div>
            </div> -->
        </div>
    </div>


</template>

<script>
import { defineComponent } from "vue";
export default defineComponent({
    props: [ 'add_col'],
});
</script>

<style></style>
