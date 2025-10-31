<template>
    <AppLayout title="Bank">
        
        <div class="stats">
            <div class="thank-you-section">
                <div class="p-3">
                    <div class="container">
                        <div class="row align-items-center justify-content-center">
                            <div class="col-12 py-5">
                                <h4 class="mb-4 fw-bold">
                                    {{ __("Account Details") }} <i class="bi bi-bank ms-3"></i>
                                </h4>
                                <div class="card shadow" style="border-radius: 20px">
                                    <div class="card-body">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>{{ __("Select") }}</th>
                                                    <th>{{ __("Bank Name") }}</th>
                                                    <th>{{ __("Account Holder Name") }}</th>
                                                    <th>{{ __("Account Number") }}</th>
                                                    <th>{{ __("IBAN Number") }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="bank_account in bank_accounts" :key="bank_account.id">
                                                    <td>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio"
                                                                :value="bank_account.id" v-model="form.bank_account_id"
                                                                :id="'bank_account_' + bank_account.id" />
                                                            <label class="form-check-label"
                                                                :for="'bank_account_' + bank_account.id">
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td>{{ bank_account.name }}</td>
                                                    <td>{{ bank_account.account_holder_name }}</td>
                                                    <td>{{ bank_account.account_number }}</td>
                                                    <td>{{ bank_account.iban_number }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="d-flex align-items-center gap-2">
                                            <h4 class="fs-3">{{ __("total amount to be paid") }}:</h4>
                                            <h4 class="text-primary fs-3">
                                                <span> {{ getDefaultCurrencySymbol() }}</span>
                                                {{ amount }}
                                            </h4>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-md-6">
                                                <h4 class="text-start mb-3">
                                                    {{ __("Please Attach Payment Screenshot") }}
                                                </h4>
                                                <div class="d-flex align-items-start flex-column gap-2">
                                                    <label for="attachment" class="text-capitalize me-3">{{
                                                        __("attachment") }}</label>

                                                    <input class="w-100 custom-file-input" placeholder="Please Enter"
                                                        type="file" id="attachment_file" ref="attachment_file"
                                                        @change="processFile($event)" name="attachment_file" />
                                                    <img v-if="attachment_view" :src="attachment_view" height="100"
                                                        width="100" class="mt-2 rounded-4" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <div class="d-flex justify-content-start mt-4">
                                            <button type="button" @click="bankTransfer"
                                                class="btn btn-primary fw-bold fs-3 rounded-4 px-4">
                                                {{ __("submit") }}
                                                <img src="@/images/icons/loginbtnicon.png" width="28" class="ms-2"
                                                    alt="" />
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>


<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import PageHeader from "@/Components/PageHeader.vue";
import Navbar from "@/Layouts/AppIncludes/Navbar.vue";
import ValidationErrors from "@/Components/ValidationErrors.vue";
import CalenderSkeleton from "@/Components/Skeleton/CalenderSkeleton.vue";
import Wizard from "form-wizard-vue3";
import { ref } from "vue";
import { Link } from "@inertiajs/inertia-vue3";
import { Carousel, Navigation, Pagination, Slide } from "vue3-carousel";

export default defineComponent({
    components: {
        AppLayout,
        Navbar,
        PageHeader,
        ValidationErrors,
        CalenderSkeleton,
        Wizard,
        Link,
        Carousel,
        Slide,
        Pagination,
        Navigation,

    },
    props: ["bank_accounts", "amount", 'fund_id'],
    created() {

    },
    data() {
        return {
            attachment_view: "",

            form: this.$inertia.form({
                bank_account_id: "",
                attachment: "",
                fund_id: this.fund_id,
                is_fund: 1,
            }),
        };
    },
    methods: {

        bankTransfer() {
            this.form.post(this.route("students.fund_bank_transfer"), {
                onSuccess: (resp) => { },
            });
        },

        processFile(event) {
            this.form.attachment = event.target.files[0];
            if (event.target.files[0].type.includes("image")) {
                this.attachment_view = URL.createObjectURL(event.target.files[0]);
            } else {
                this.attachment_view = "";
            }
        },
    },

    mounted() { },
});
</script>

<style></style>
