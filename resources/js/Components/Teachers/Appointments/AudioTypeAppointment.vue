<template>
	<div v-if="fetching">
		<time-slots-skeleton></time-slots-skeleton>
	</div>
	<div v-else>
		<!-- <div v-if="schedules.length == 0"> -->
		<div v-if="schedules.length == 0">
			<form @submit.prevent="submit" class="profileForm">
				<div class="row">
					<div class="col-md-12">
						<validation-errors></validation-errors>
						<div class="col-12">
							<div class="row">
								<div class="col-12">
									<div class="row p-4 bg-primary bg-opacity-10 rounded-5 mx-0">
										<h2 class="text-primary py-2 fw-bold fs-2">{{ __('Generate Appointment Slots') }}</h2>
										<hr/>
										<label class="fs-5 fw-regular ms-1 mb-3" for="">{{ __("Toggle the button to designate holidays and working days") }}</label>
										<div class="col-12 switch d-flex gap-3 align-items-center mb-4 flex-column flex-md-row">
											<div v-for="(day, key) in weak_days" :key="key" class="form-check days-check py-2 rounded-3 p-0 bg-white form-switch shadow-sm">
												<label class="form-check-label fs-4 fw-bold mb-2" :for="'flexSwitchCheckChecked' + key">{{ __(day.name) }}</label>
												<input class="form-check-input ms-0" type="checkbox" role="switch" :value="day.value" :id="'flexSwitchCheckChecked' + key" v-model="day.isSelected">
											</div>
										</div>
										<!-- <div class="form-group mb-4">
											<label for="category"
											  >{{ __("select") }} {{ __("days") }}</label
											>
											<Multiselect
											  v-model="form.selected_days"
											  valueProp="value"
											  label="name"
											  mode="tags"
											  :close-on-select="false"
											  :searchable="true"
											  :options="this.weak_days"
											/>
											</div> -->
										<div class="col-lg-3 mb-3">
											<div
												class=" ps-0"
												>
												<label class="fs-5 fw-bold mb-2" for="start_time">{{
												__("start time")
												}}</label>
												<input
													v-model="form.start_time"
													class="w-100 form-control  px-3"
													:placeholder="__('Please Enter')"
													type="time"
													v-on:input="enableButton()"
													/>
											</div>
										</div>
										<div class="col-lg-3 mb-3">
											<div
												class=" ps-0"
												>
												<label  class="fs-5 fw-bold mb-2" for="end_time">{{
												__("end time")
												}}</label>
												<input
													v-model="form.end_time"
													class="w-100 form-control  px-3"
													:placeholder="__('Please Enter')"
													type="time"
													v-on:input="enableButton()"
													/>
											</div>
										</div>
										<div class="col-lg-3 mb-3">
											<div
												class=" ps-0"
												>
												<label  class="fs-5 fw-bold mb-2" for="interval">{{
												__("interval")
												}}</label>
												<input
													v-model="form.interval"
													class="w-100 form-control  px-3"
													:placeholder="__('Please Enter')"
													type="integer"
													v-on:input="enableButton()"
													/>
											</div>
										</div>
										<div class="col-lg-3">
											<div
												class=" ps-0"
												>
												<label  class="fs-5 fw-bold mb-2" for="fee">{{
												__("fee")
												}}</label>
												<div class="input-group mb-3">
													<span class="input-group-text" id="basic-addon1">{{getDefaultCurrencySymbol()}}</span>
													<input
														v-model="form.fee"
														class="form-control px-3"
														:placeholder="__('Please Enter')"
														type="text"
														v-on:input="enableButton()"
														v-on:keypress="inputNumbersOnly()"
														v-bind:on-keypress="updateFeeCommission()"
														/>
													<span class="ps-3"  v-if="isCommissionEnabled()">+</span>
												</div>
											</div>
										</div>
										<div class="col-md-4"  v-if="isCommissionEnabled()">
											<label for="commission">{{ __("commission") }}</label>
											<div class="input-group d-flex align-items-center mb-3">
												<input
													class="form-control px-3"
													:placeholder="commission && (commission.commission_type == 'fixed_rate' ? getDefaultCurrencySymbol() + commission.rate : commission.rate+'%')"
													type="text"
													disabled
													/>
												<span class="ps-3">=</span>
											</div>
										</div>
										<div class="col-md-4"  v-if="isCommissionEnabled()">
											<label for="total">{{ __("total") }}</label>
											<div class="input-group d-flex align-items-center mb-3">
												<input
													class="form-control px-3"
													:placeholder="getDisplayAmount(feeAfterCommission)"
													type="text"
													disabled
													/>
											</div>
										</div>
										<div class="col-12">
											<p v-if="isCommissionEnabled()"><b>Note:</b>
												The administrative has determined that the commission for educational services is <span v-if="commission && commission.commission_type == 'fixed_rate'">{{ getDefaultCurrencySymbol() }} {{ commission.rate }}</span> <span v-if="commission && commission.commission_type == 'percentage'"> {{ commission.rate }}%</span> of the final amount, which is equivalent to {{ getDisplayAmount(feeAfterCommission) }}.
											</p>
										</div>
									</div>
									<div class="row px-0">
										<div class="col-12 px-0 text-end">
											<button
												type="button"
												@click="generateTimeSlots"
												class="submit mt-4 btn btn-primary px-5"
												:disabled="disableButton"
												>
											{{ __("Generate Slots") }}
											</button>
										</div>
									</div>
								</div>
							</div>
							<div  v-if="Object.keys(form.generated_slots).length > 0" class="col-12 cat-card bg-white p-4 time-list mt-4 rounded-4">
								<div>
									<div class="d-flex align-items-center justify-content-between pb-2 mb-4 border-bottom border-primary">
										<div>
											<span class="fw-bold">{{ __('You have successfully generated slots') }}</span>
										</div>
										<div class="d-flex align-items-center">
											<div class="me-3">
												<span class="fw-bold me-2">{{ __("interval") }}:</span> <span>
												{{ form.interval }} min
												</span>
											</div>
											<div>
												<span class="fw-bold me-2">Fee:</span>
												<span v-if="isCommissionEnabled()">
												{{ getDisplayAmount(feeAfterCommission) }}
												</span>
												<span v-else>
												{{ getDisplayAmount(form.fee) }}
												</span>
											</div>
										</div>
									</div>
									<div class="accordion border-0 p-0" id="accordionExample">
										<div
											class="accordion-item border-0 rounded-4 mb-3"
											v-for="(day, dayIndex) in weak_days"
											:key="dayIndex"
											>
											<div
												class="accordion-header rounded-4 shadow-none d-flex align-items-center justify-content-between w-100 py-2 px-3"
												style="background-color: #E7F3FA;"
												:id="'headingOne' + dayIndex"
												>
												<div
													class="accordion-button bg-transparent shadow-none p-1 collapsed"
													type="button"
													data-bs-toggle="collapse"
													:data-bs-target="'#collapseOne' + dayIndex"
													aria-expanded="true"
													:aria-controls="'collapseOne' + dayIndex"
													>
													<div class=" ">
														<div class="fs-5 fw-bold mb-0 ms-4">
															{{ day.name }}
														</div>
													</div>
												</div>
											</div>
											<div
												:id="'collapseOne' + dayIndex"
												class="accordion-collapse collapse show"
												:aria-labelledby="'headingOne' + dayIndex"
												>
												<div
													class="accordion-body p-2 time-slots-list"
													v-if="Object.keys(form.generated_slots).length > 0"
													>
													<div
														v-if="form.generated_slots[day.value]"
														class="position-relative"
														>
														<ul class="list-unstyled d-flex flex-wrap">
															<li
																class="mb-2 p-2 m-1 rounded-5 border border-primary"
																v-for="(slot, index) in form.generated_slots[
																day.value
																]"
																:key="index"
																:class="
																slot.is_active
																? ''
																: 'bg-light text-muted border-light'
																"
																@click="changeSlotStatus(index, day.value)"
																>
																<span
																	>{{ slot.start_time }}
																<i
																	class="bi bi-arrow-left-right text-primary"
																	:class="
																	slot.is_active ? '' : 'text-muted'
																	"
																	></i>
																{{ slot.end_time }}</span
																	>
															</li>
														</ul>
													</div>
													<div
														class="position-relative py-5 d-flex align-items-center justify-content-center h-100"
														v-else
														>
														<h3>
															<i
																class="bi bi-x-octagon-fill fs-2 text-primary"
																></i>
															{{ __("holiday") }}
														</h3>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div
									class="row align-items-center"
									v-if="Object.keys(form.generated_slots).length > 0"
									>
									<div class="col-12 text-center">
										<button
											type="submit"
											:disabled="form.processing"
											class="submit btn btn-primary"
											>
											<SpinnerLoader v-if="form.processing" />
											{{ __("save") }}
										</button>
									</div>
								</div>
							</div>
						</div>
						<br />
					</div>
				</div>
			</form>
		</div>
        <div v-else>
		<div class="row mt-4 mx-0 bg-white cat-card p-3 time-list rounded-4">
			<div class="d-flex align-items-center justify-content-between pb-3 mb-4 border-bottom border-primary">
				<div>
					<span class="fw-bold me-3">{{ __("Your Generated Slots") }}</span>
				</div>
				<div class="d-flex align-items-center">
					<div class="me-0 me-md-3">
						<span class="fw-bold me-2">{{ __('interval') }}:</span> <span>
						{{ generatedSceduleInterval}} min
						</span>
					</div>
					<div>
						<span class="fw-bold me-2">{{ __("fee") }}:</span> <span>
						{{ getDisplayAmount(generatedSceduleFee) }}
						</span>
					</div>
				</div>
			</div>
			<div class="accordion border-0 p-0" id="accordionExample">
				<div
					class="accordion-item border-0 rounded-4 mb-3"
					v-for="(day, dayIndex) in weak_days"
					:key="dayIndex"
					>
					<div
						class="accordion-header rounded-4 shadow-none d-flex align-items-center justify-content-between w-100 py-2 px-3"
						style="background-color: #E7F5FD"
						:class="schedules[day.value] ? 'bg-warning' : 'bg-danger bg-opacity-25'"
						:id="'headingOne' + dayIndex"
						>
						<div
							class="accordion-button bg-transparent shadow-none p-1 collapsed"
							type="button"
							data-bs-toggle="collapse"
							:data-bs-target="'#collapseOne' + dayIndex"
							aria-expanded="true"
							:aria-controls="'collapseOne' + dayIndex"
							>
							<div class="fs-4 fw-bold mb-0 ms-4">{{ day.name }}</div>
						</div>
						<button
							v-if="schedules[day.value]"
							type="button"
							class="btn btn-transparent p-0 border-0 shadow-none"
							data-bs-toggle="modal"
							:data-bs-target="'#deleteScheduleModal_' + dayIndex"
							>
						<i class="bi bi-trash fs-3 px-1 fw-bolder text-danger"></i>
						</button>
						<button
							v-else
							type="button"
							class="btn bg-primary p-0 border-0 shadow-none"
							@click="() => (addForm.day = day.value)"
							data-bs-toggle="modal"
							:data-bs-target="'#addScheduleModal_' + dayIndex"
							>
						<i class="bi bi-plus fs-3 px-1 fw-bolder text-white"></i>
						</button>
					</div>
					<div
						:id="'collapseOne' + dayIndex"
						class="accordion-collapse collapse show"
						:aria-labelledby="'headingOne' + dayIndex"
						>
						<div class="accordion-body p-2 position-relative time-slots-list">
							<div v-if="schedules[day.value]" class="position-relative">
								<ul class="list-unstyled d-flex flex-wrap mb-0">
									<li
										class="mb-2 p-2 m-1 shadow-sm"
										v-for="(slot, index) in schedules[day.value]
										.schedule_slots"
										:key="index"
										>
										<span>{{ slot.start_time }} - {{ slot.end_time }}</span>
										<!-- <i
											class="bi bi-arrow-left-right text-primary"
											:class="slot.is_active ? '' : 'text-muted'"
											></i> -->
									</li>
								</ul>
							</div>
							<div
								class="py-2 d-flex align-items-center justify-content-center h-100"
								v-else
								>
								<h3 class="text-capitalize mb-0">
									<i class="bi bi-x-lg fs-3 text-muted"></i>
									{{ __("holiday") }}
								</h3>
							</div>
						</div>
					</div>
					<!-- Delete Modal -->
					<Modal maxWidth="lg" :id="'deleteScheduleModal_' + dayIndex"  :aria-labelledby="'deleteScheduleModalLabel' + dayIndex">
						<form
							@submit.prevent="
							deleteSelectDaySlots(
							day.value,
							'deleteScheduleModalClose_' + dayIndex
							)
							"
							>
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" :id="'deleteScheduleModalLabel' + dayIndex">
										{{ __("Alert Delete Model") }}
									</h5>
									<button
										type="button"
										class="btn-close"
										data-bs-dismiss="modal"
										aria-label="Close"
										></button>
								</div>
								<div class="modal-body">
									{{ __("Are you sure you want to delete schedule") }}
								</div>
								<div class="modal-footer">
									<button
										type="button"
										class="btn btn-secondary"
										data-bs-dismiss="modal"
										:id="'deleteScheduleModalClose_' + dayIndex"
										>
									{{ __("close") }}
									</button>
									<button
										type="submit"
										:disabled="deleteForm.processing"
										class="btn btn-primary"
										>
									{{ __("yes") }}
									</button>
								</div>
							</div>
						</form>
					</Modal>
					<!-- Add Modal -->
					<Modal maxWidth="xl"   :id="'addScheduleModal_' + dayIndex"  :aria-labelledby="'addSlotsModelLabel' + dayIndex">
						<form
							@submit.prevent="
							addSelectDaySlots(
							day.value,
							'addScheduleModalClose_' + dayIndex
							)
							"
							>
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">
										{{ __("Add Schedule Model") }}
									</h5>
									<button
										type="button"
										class="btn-close"
										data-bs-dismiss="modal"
										aria-label="Close"
										></button>
								</div>
								<div class="modal-body">
									<validation-errors></validation-errors>
									<div class="row px-3">
										<div class="col-4">
											<div class="">
												<label  class="fs-5 fw-bold mb-2" for="start_time">{{
												__("start time")
												}}</label>
												<input
													v-model="addForm.start_time"
													class="w-100 form-control border- px-3"
													:placeholder="__('Please Enter')"
													type="time"
													/>
											</div>
										</div>
										<div class="col-4">
											<div class="">
												<label  class="fs-5 fw-bold mb-2" for="end_time">{{ __("end time") }}</label>
												<input
													v-model="addForm.end_time"
													class="w-100 form-control px-3"
													:placeholder="__('Please Enter')"
													type="time"
													/>
											</div>
										</div>
										<div class="col-4">
											<div class="">
												<label  class="fs-5 fw-bold mb-2" for="interval">{{ __("interval") }}</label>
												<input
													v-model="addForm.interval"
													class="w-100 form-control px-3"
													:placeholder="__('Please Enter')"
													type="integer"
													/>
											</div>
										</div>
									</div>
									<div class="row px-3">
										<div class="col-12">
											<button
												type="button"
												@click="generateTimeSlotsForAdd"
												class="submit mt-4 btn btn-primary"
												>
											{{ __("generate slots") }}
											</button>
										</div>
									</div>
									<div v-if="addForm.generated_slots.length > 0">
										<div class="row border shadow-sm mt-3 rounded-5 mx-3">
											<div class="col-md-12 p-0">
												<div
													class="accordion-header rounded-4 shadow-none d-flex align-items-center justify-content-between w-100 py-2 px-3"
													style="background-color: #E7F5FD"
													>
													<div class="bg-transparent shadow-none p-1">
														<div class=" ">
															<div class="fs-5 fw-bold mb-0 ms-2">
																{{ addForm.day }}
															</div>
														</div>
													</div>
												</div>
											</div>
											<div
												class="col-md-12 mt-3 time-slots-list"
												v-if="addForm.generated_slots.length > 0"
												>
												<ul class="list-unstyled d-flex flex-wrap">
													<li
														class="mb-2 p-2 m-1 rounded-5 border border-primary"
														v-for="(
														slot, slotIndex
														) in addForm.generated_slots"
														:key="slotIndex"
														>
														<span
															>{{ slot.start_time }}
														<i
															class="bi bi-arrow-left-right text-primary"
															:class="slot.is_active ? '' : 'text-muted'"
															></i>
														{{ slot.end_time }}</span
															>
													</li>
												</ul>
											</div>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<button
										type="button"
										class="btn btn-secondary"
										data-bs-dismiss="modal"
										:id="'addScheduleModalClose_' + dayIndex"
										>
									{{ __("close") }}
									</button>
									<button
										type="submit"
										:disabled="addForm.processing"
										class="btn btn-primary"
										>
									{{ __("submit") }}
									</button>
								</div>
							</div>
						</form>
					</Modal>
				</div>
			</div>
		</div>
	</div>
	</div>
	<!-- <div v-else> -->

</template>

<script>
import { defineComponent } from "vue";
import ValidationErrors from "@/Components/ValidationErrors.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import axios from "axios";
import Multiselect from "@vueform/multiselect";
import Modal from "@/Components/Modal.vue";
import TimeSlotsSkeleton from "@/Components/Skeleton/TimeSlotsSkeleton.vue";
export default defineComponent({
  components: {
    Head,
    Modal,
    ValidationErrors,
    Link,
    Multiselect,
    TimeSlotsSkeleton,
  },
  props: ["appointment_type_id", "is_schedule_required", "appointment_type"],
  data() {
    return {
        weak_days: {
            sunday: { name: "Sunday", value: "sunday", isSelected: false },
            monday: { name: "Monday", value: "monday", isSelected: false },
            tuesday: { name: "Tuesday", value: "tuesday", isSelected: false },
            wednesday: { name: "Wednesday", value: "wednesday", isSelected: false },
            thursday: { name: "Thursday", value: "thursday", isSelected: false },
            friday: { name: "Friday", value: "friday", isSelected: false },
            saturday: { name: "Saturday", value: "saturday", isSelected: false },
        },
        form: this.$inertia.form({
            appointment_type_id: this.appointment_type_id,
            is_schedule_required: this.is_schedule_required,
            appointment_type: this.appointment_type,
            selected_days: [],
            start_time: "",
            end_time: "",
            fee: "",
            interval: "",
            generated_slots: {},
        }),
      schedules: [],
        commission:null,
      feeAfterCommission:null,
      fetching: true,
      deleteForm: this.$inertia.form({
        day: "",
        appointment_type_id: this.appointment_type_id,
      }),
      addForm: this.$inertia.form({
        day: "",
        appointment_type_id: this.appointment_type_id,
        start_time: "",
        end_time: "",
        interval: "",
        generated_slots: {},
      }),
      disableButton: true,
      generatedSceduleInterval:"",
     generatedSceduleFee:""
    };
  },
  watch: {
    weak_days: {
        handler: function() {
            this.updateSelectedDays();
        },
        deep: true
    }
},
  methods: {
    updateSelectedDays() {
        this.form.selected_days = Object.keys(this.weak_days).filter(day => this.weak_days[day].isSelected);
    },
    getAppointmentschedules() {
      this.fetching = true;
      axios
        .get(
          this.route("teacher.getApiAppointmentSchedules", {
            appointment_type_id: this.form.appointment_type_id,
            is_schedule_required: this.form.is_schedule_required,
          })
        )
        .then((res) => {
          this.schedules = res.data.data;
          let index = 0
            for (const [key, value] of Object.entries(this.schedules)) {
                if (index == 0) {
                this.generatedSceduleInterval = value.slot_duration
                this.generatedSceduleFee = value.fee
                index++;
                }
            }
          this.fetching = false;
        });
    },
    getAppointmentCommission() {
      this.fetching = true;
      axios
        .get(
          this.route("teacher.getApiAppointmentCommission", {
            appointment_type_id: this.form.appointment_type_id,
          })
        )
        .then((res) => {
          this.commission = res.data.data;
          this.fetching = false;
        });
    },
    enableButton() {
      if (
        this.form.start_time &&
        this.form.end_time &&
        this.form.fee &&
        this.form.interval
      ) {
        this.disableButton = false;
      } else {
        this.disableButton = true;
      }
    },
    generateTimeSlots() {
        if (!this.form.interval) {
            this.$toast.error("Interval is required.");
            return;
        }
        this.form.generated_slots = {};
        const slots = [];
        const start = new Date();
        const end = new Date();
        const startParts = this.form.start_time.split(":");
        const endParts = this.form.end_time.split(":");

        start.setHours(startParts[0]);
        start.setMinutes(startParts[1]);
        end.setHours(endParts[0]);
        end.setMinutes(endParts[1]);

        if (end.getTime() === start.getTime()) {
            this.$toast.error("Start time and end time cannot be equal.");
            return;
        }

        if (endParts[0] < startParts[0] || (endParts[0] === startParts[0] && endParts[1] < startParts[1])) {
            end.setDate(end.getDate() + 1);
        }

        const intervalMs = (this.form.interval - 1) * 60000;
        let currentTime = start;

        while (currentTime < end) {
            currentTime.setTime(currentTime.getTime() + 60000);
            let startTime = currentTime.toLocaleTimeString([], { hour: "2-digit", minute: "2-digit" });
            let endTime = currentTime.setTime(currentTime.getTime() + intervalMs) <= end.getTime()
                ? currentTime.toLocaleTimeString([], { hour: "2-digit", minute: "2-digit" })
                : end.toLocaleTimeString([], { hour: "2-digit", minute: "2-digit" });
            let is_active = true;
            slots.push({ start_time: startTime, end_time: endTime, is_active: is_active });
        }

        Object.keys(this.weak_days).forEach(dayKey => {
            if (this.weak_days[dayKey].isSelected) {
                this.form.generated_slots[dayKey] = slots;
            }
        });
    },
    generateTimeSlotsForAdd() {
      if (!this.addForm.interval) {
        this.$toast.error("Interval is required.");
        return;
      }
      this.addForm.generated_slots = {};
      const slots = [];
      const start = new Date();
      const end = new Date();
      const startParts = this.addForm.start_time.split(":");
      const endParts = this.addForm.end_time.split(":");
      start.setHours(startParts[0]);
      start.setMinutes(startParts[1]);
      end.setHours(endParts[0]);
      end.setMinutes(endParts[1]);
      if (end.getTime() === start.getTime()) {
        this.$toast.error("Start time and end time cannot be equal.");
        return;
      }

      // Handle cases where end time is earlier than start time
      if (
        endParts[0] < startParts[0] ||
        (endParts[0] === startParts[0] && endParts[1] < startParts[1])
      ) {
        end.setDate(end.getDate() + 1); // Increment end date by 1 day
      }
      const intervalMs = (this.addForm.interval - 1) * 60000; // Convert interval to milliseconds
      let currentTime = start;
      while (currentTime < end) {
        currentTime.setTime(currentTime.getTime() + 60000);
        let startTime = currentTime.toLocaleTimeString([], {
          hour: "2-digit",
          minute: "2-digit",
        });
        let endTime =
          currentTime.setTime(currentTime.getTime() + intervalMs) <=
          end.getTime()
            ? currentTime.toLocaleTimeString([], {
                hour: "2-digit",
                minute: "2-digit",
              })
            : end.toLocaleTimeString([], {
                hour: "2-digit",
                minute: "2-digit",
              });
        let is_active = true;
        slots.push({
          start_time: startTime,
          end_time: endTime,
          is_active: is_active,
        });
      }
      this.addForm.generated_slots = slots;
    },
    changeSlotStatus(index, day) {
      this.form.generated_slots[day][index].is_active =
        !this.form.generated_slots[day][index].is_active;
    },
    submit() {
      this.form.post(this.route("teacher.save_appointment_schedules"), {
        onSuccess: () => {
          this.getAppointmentschedules();
        },
      });
    },
    deleteSelectDaySlots(day_value, model_id) {
      this.deleteForm.day = day_value;
      this.deleteForm.post(this.route("teacher.delete_appointment_slots"), {
        onSuccess: () => {
          document.getElementById(model_id).click();
          this.getAppointmentschedules();
        },
      });
    },
    addSelectDaySlots(day_value, model_id) {
      this.addForm.day = day_value;
      this.addForm.post(this.route("teacher.add_new_appointment_schedules"), {
        onSuccess: () => {
          document.getElementById(model_id).click();
          this.addForm.day = "";
          this.addForm.start_time = "";
          this.addForm.end_time = "";
          this.addForm.interval = "";
          this.addForm.generated_slots = {};
          this.goToNextTab();
        },
      });
    },
    goToNextTab() {
      this.$inertia.visit(route("account"), {
        data: { active_tab: "appointment" },
      });
    },
    updateFeeCommission()
    {
        if (this.isCommissionEnabled()) {
           this.feeAfterCommission =  this.calculateCommissionAmount(this.form.fee,this.commission)
        }
    }
  },
  created() {
    this.updateSelectedDays();
    this.getAppointmentschedules();
     if (this.isCommissionEnabled()) {
        this.getAppointmentCommission();
    }
  },
});
</script>


