<template>
    <div
        :class="{ 'col-md-3 col-healer': add_col, 'w-100': !add_col }"
        class="skeleton-structure time-slots"
    >
        <!-- <div class="row p-4 bg-white rounded-5 mx-0">
            <div class="col-12 mb-3">
                <div class="description m-0 p-0">
                    <div class="title mb-2" style="width: 150px; height: 20px"></div>
                </div>

                <div class="form-input"></div>
            </div>

            <div class="col-md-6 mb-3">
                <div class="description m-0 p-0">
                    <div class="title mb-2" style="width: 150px; height: 20px"></div>
                </div>

                <div class="form-input"></div>
            </div>

            <div class="col-md-6 mb-3">
                <div class="description m-0 p-0">
                    <div class="title mb-2" style="width: 150px; height: 20px"></div>
                </div>

                <div class="form-input"></div>
            </div>

            <div class="col-md-6 mb-3">
                <div class="description m-0 p-0">
                    <div class="title mb-2" style="width: 150px; height: 20px"></div>
                </div>

                <div class="form-input"></div>
            </div>

            <div class="col-md-6 mb-3">
                <div class="description m-0 p-0">
                    <div class="title mb-2" style="width: 150px; height: 20px"></div>
                </div>

                <div class="form-input"></div>
            </div>
        </div> -->

        <div class="row mt-4 mx-0 bg-white border shadow-sm rounded-5 p-3 pt-5">

            <div class="col-md-12">
                <div>
                    <ul class="list-unstyled d-flex flex-wrap">
                        <li
                            style="width: 150px; height: 40px"
                            class="bg-skeleton rounded-5 me-2 mb-2"
                        ></li>
                        <li
                            style="width: 150px; height: 40px"
                            class="bg-skeleton rounded-5 me-2 mb-2"
                        ></li>
                        <li
                            style="width: 150px; height: 40px"
                            class="bg-skeleton rounded-5 me-2 mb-2"
                        ></li>
                        <li
                            style="width: 150px; height: 40px"
                            class="bg-skeleton rounded-5 me-2 mb-2"
                        ></li>
                        <li
                            style="width: 150px; height: 40px"
                            class="bg-skeleton rounded-5 me-2 mb-2"
                        ></li>
                        <li
                            style="width: 150px; height: 40px"
                            class="bg-skeleton rounded-5 me-2 mb-2"
                        ></li>
                        <li
                            style="width: 150px; height: 40px"
                            class="bg-skeleton rounded-5 me-2 mb-2"
                        ></li>
                        <li
                            style="width: 150px; height: 40px"
                            class="bg-skeleton rounded-5 me-2 mb-2"
                        ></li>
                        <li
                            style="width: 150px; height: 40px"
                            class="bg-skeleton rounded-5 me-2 mb-2"
                        ></li>
                        <li
                            style="width: 150px; height: 40px"
                            class="bg-skeleton rounded-5 me-2 mb-2"
                        ></li>
                        <li
                            style="width: 150px; height: 40px"
                            class="bg-skeleton rounded-5 me-2 mb-2"
                        ></li>
                        <li
                            style="width: 150px; height: 40px"
                            class="bg-skeleton rounded-5 me-2 mb-2"
                        ></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row mt-4 mx-0 bg-white border shadow-sm rounded-5 p-3 pt-5">

            <div class="col-md-12">
                <div>
                    <ul class="list-unstyled d-flex flex-wrap">
                        <li
                            style="width: 150px; height: 40px"
                            class="bg-skeleton rounded-5 me-2 mb-2"
                        ></li>
                        <li
                            style="width: 150px; height: 40px"
                            class="bg-skeleton rounded-5 me-2 mb-2"
                        ></li>
                        <li
                            style="width: 150px; height: 40px"
                            class="bg-skeleton rounded-5 me-2 mb-2"
                        ></li>
                        <li
                            style="width: 150px; height: 40px"
                            class="bg-skeleton rounded-5 me-2 mb-2"
                        ></li>
                        <li
                            style="width: 150px; height: 40px"
                            class="bg-skeleton rounded-5 me-2 mb-2"
                        ></li>
                        <li
                            style="width: 150px; height: 40px"
                            class="bg-skeleton rounded-5 me-2 mb-2"
                        ></li>
                        <li
                            style="width: 150px; height: 40px"
                            class="bg-skeleton rounded-5 me-2 mb-2"
                        ></li>
                        <li
                            style="width: 150px; height: 40px"
                            class="bg-skeleton rounded-5 me-2 mb-2"
                        ></li>
                        <li
                            style="width: 150px; height: 40px"
                            class="bg-skeleton rounded-5 me-2 mb-2"
                        ></li>
                        <li
                            style="width: 150px; height: 40px"
                            class="bg-skeleton rounded-5 me-2 mb-2"
                        ></li>
                        <li
                            style="width: 150px; height: 40px"
                            class="bg-skeleton rounded-5 me-2 mb-2"
                        ></li>
                        <li
                            style="width: 150px; height: 40px"
                            class="bg-skeleton rounded-5 me-2 mb-2"
                        ></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { defineComponent } from "vue";
export default defineComponent({
    props: ["add_col"],
});
</script>

<style></style>
